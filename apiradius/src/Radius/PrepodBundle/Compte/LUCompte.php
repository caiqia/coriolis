<?php

namespace Radius\PrepodBundle\Compte;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Radius\PrepodBundle\Exception\InvalidJsonException;
use Radius\PrepodBundle\Entity\Radreply;
use Radius\PrepodBundle\Entity\Radgroupcheck;
use Radius\PrepodBundle\Entity\Radgroupreply;
use Radius\PrepodBundle\Entity\Radcheck;
use Radius\PrepodBundle\Entity\Radusergroup;
use Radius\PrepodBundle\Entity\Userinfo;
use Radius\PrepodBundle\Entity\Radiusgroup;
use Radius\PrepodBundle\Entity\Userbillinfo;
use Radius\PrepodBundle\Form\RadcheckType;

class LUCompte
{

  protected $om;
  protected $formFactory;
  protected $radreply;
  protected $radgroupcheck;
  protected $radgroupreply;
  protected $radcheck;
  protected $radusergroup;
  protected $userinfo;
  protected $radiusgroup;
  protected $userbillinfo;


      public function __construct(ObjectManager $om, FormFactoryInterface $formFactory, $container) {
          $this->container = $container;
          $this->om = $om;
          $this->formFactory = $formFactory;
          $this->radreply = $this->om->getRepository("RadiusPrepodBundle:Radreply");
          $this->radgroupcheck = $this->om->getRepository("RadiusPrepodBundle:Radgroupcheck");
          $this->radgroupreply = $this->om->getRepository("RadiusPrepodBundle:Radgroupreply");
          $this->radcheck = $this->om->getRepository("RadiusPrepodBundle:Radcheck");
          $this->radusergroup = $this->om->getRepository("RadiusPrepodBundle:Radusergroup");
          $this->userinfo = $this->om->getRepository("RadiusPrepodBundle:Userinfo");
		  $this->radiusgroup = $this->om->getRepository("RadiusPrepodBundle:Radiusgroup");
          $this->userbillinfo = $this->om->getRepository("RadiusPrepodBundle:Userbillinfo");
      }





	  /**
       * creation d'un utilisateur
       * @param array $parameters the parameters in POST request body
       * @return integer 
       */
       public function users($parameters){	 
           $post = new Userinfo;
           $post->setUsername($parameters["data"]["username"]);	  
           $post->setChangeuserinfo("0");
           $day = date("Y-m-d H:i:s");
           $post->setCreationdate(new \DateTime($day));
           $post->setCreationby("newuser.pl");
           $post->setUpdatedate(new \DateTime($day));       
		    $this->om->persist($post);
			$this->om->flush($post);
			$post2 = new Userbillinfo;
			$post2->setUsername($parameters["data"]["username"]);
			$post2->setChangeuserbillinfo("0");
			$post2->setCreationdate(new \DateTime($day));
			$post2->setCreationby("newuser.pl");
			$post2->setUpdatedate(new \DateTime($day)); 
			$post2->setLastbill(new \DateTime($day));
			$post2->setNextbill(new \DateTime($day)); 
			$this->om->persist($post2);	
			$this->om->flush($post2);
			$id = array();
			$id[] = $post->getId();
			$id[] = $post2->getId();
		   return $id;
       }
	



     /**
      * verifier si url est correcte 
      * @param array $search filter search array
      * @param string $table entity radius
      * 
      *
      * @throws InvalidJsonException
      *
      * @return 
      */
      public function searchVeri($search,$table){ 
          $msg = 'incorrecte url paramettre';
          if($table == "check" ||$table == "reply" ){
             foreach ($search as $key => $value){
                if(($key != 'id')&&($key != 'username')&&($key != 'op')&&($key != 'value')&&($key != 'attribute') ){                        
                    throw new InvalidJsonException($msg,400);     
                 }
             }
          }
          if($table == "groupcheck" ||$table == "groupreply" ){
               foreach ($search as $key => $value){
                    if(($key != 'id')&&($key != 'groupname')&&($key != 'op')&&($key != 'value')&&($key != 'attribute') ){     
                        throw new InvalidJsonException($msg,400);     
                    }    
               } 
            }
          if($table == "usergroup"  ){
              foreach ($search as $key => $value){
                  if(($key != 'groupname')&&($key != 'username')&&($key != 'priority') ){
                        throw new InvalidJsonException($msg,400);
                  }   
              }
          }
		  if($table == "userinfo" || $table == "radiusgroup"){
				/*
				ne vérifie pas parce qu'il y a trop de colonne dans userinfo				
				*/
			}
           return;     
      }





        /**
         * traite l'uri donnée par l'utilisateur
         *  
         * @param string $uri uri given by user
         * @param array $search filter search array
         * @param string $table entity radius
         * @throws InvalidJsonException when usename doesn't existe
         *  
         *                                           
         */
		 public function requestUri($uri, $search,$table ){
             $msg = 'incorrecte url parametter';
             $arg0 = strstr($uri,'?');          // des paramettres été ajoutés
             if($arg0 == '?'){ 
                return;
            }
            if(!empty($arg0)){              
                $buff = strstr($arg0,'limit');
                $param = true;                      
                foreach($search as $key => $value){
                    if(!empty($value)){
                        if(($key!='limit')||(($key == 'limit')&&(!empty($buff)))){
                              $param = false;                 
                        }
                    }
                }
                if($param){
                    throw new InvalidJsonException($msg,400);       
                }else{
                     unset($search['offset']);
                     unset($search['limit']);
                    $this->searchVeri($search, $table);
                }
            }else{ 
                return;
            }
         }

 
			  
  	  /**
       * creation d'un group
       * @param array $parameters
       * @return 
       */
       public function groups($parameters){	 
           $post = new Radiusgroup;
           $post->setGroupname($parameters["data"]["groupname"]);
		    $this->om->persist($post);
			$this->om->flush();
		   return $post->getId();
       }



      /**
       * post et patch dans radcheck, radreply, radgroupcheck et radgroupreply
	   * @param integer $id
	   * @param string $table
       * @param array $parameters
       * @return 
       */
       public function checkReply($id,$table,$parameters){
			if($id != null){                        //method patch
				if($table == null){                 //entity radusergroup
					$patch = $this->getUsergroup($id[0],$id[1]);
				    $patch->setPriority($parameters["data"]["priority"]);
					$this->om->persist($patch);
              		$this->om->flush();	
					$ret = $patch->getUsername();				
				}else{                              //radcheck,radreply,radgroupcheck,radgroupreply                              
					$patch = $this->getbyId($table, $id);
					$patch->setAttribute($parameters["data"]["attribute"]);
		   			$patch->setOp($parameters["data"]["op"]);
		   			$patch->setValue($parameters["data"]["value"]);
					$this->om->persist($patch);
              		$this->om->flush();
					$ret = $patch->getId();				
				}		
			}else{                                     //method post
				if($table != null){                    //radcheck,radreply,radgroupcheck,radgroupreply
				 	if($table=="check"){
						$post = new Radcheck;
						$post->setUsername($parameters["data"]["username"]);	
					}
				   if($table=="reply"){
						$post = new Radreply;
						$post->setUsername($parameters["data"]["username"]);	
					}
				   if($table=="groupcheck"){
						$post = new Radgroupcheck;
						$post->setGroupname($parameters["data"]["groupname"]);	
					}
				   if($table=="groupreply"){
						$post = new Radgroupreply;
						$post->setGroupname($parameters["data"]["groupname"]);	
					}
					$post->setAttribute($parameters["data"]["attribute"]);
			   		$post->setOp($parameters["data"]["op"]);
			   		$post->setValue($parameters["data"]["value"]);	
					$this->om->persist($post);
           			$this->om->flush();
					$ret = $post->getId();
				}else{                                //entity radusergroup
					$post = new Radusergroup;
					$post->setUsername($parameters["data"]["username"]);
					$post->setGroupname($parameters["data"]["groupname"]);	
					$post->setPriority($parameters["data"]["priority"]);
					$this->om->persist($post);
           			$this->om->flush();
					$ret = $post->getUsername();
				}	
			}		
			return $ret;
       }


   

      /**
       * ajoute un nouveau entity
       *
       * @param string $table filter search array
       *
       *
       */
      public function newObject($table){
          switch($table){
			case "userinfo":
               return new Userinfo;
              break;
			case "radiusgroup":
               return new Radiusgroup;
              break;
            case "reply":
               return new Radreply;
              break;
            case "check":
              return new Radcheck;
              break;
            case "groupcheck":
              return new Radgroupcheck;
              break;
            case "groupreply":
              return new Radgroupreply;
              break;
            case "usergroup":
              return new Radusergroup;
              break;
          }
          return;
      }
  


	  /**
	   * get objet radusergroup
	   *
	   * @param string $username
	   * @param string $groupname
	   * @return Radusergroup
	   */
	   public function getUsergroup($username,$groupname){
			
			$list = $this->radusergroup->findByUsername($username);
			$get = null;
			foreach($list as $value){
				if($value->getGroupname() == $groupname){
					$get = $value;
				}
			}
			if(empty($get)){
				throw new NotFoundHttpException(sprintf('\'%s\' \'%s\' N\'EXISTE PAS DANS radusergroup.',$username,$groupname));
			}
	   		return $get;
       }



      /**
       * verifier si username double
       *
       * @param string $username filter search array
       *
       * @return boolean
       */
      public function veriCheck($username){

          $get = $this->radcheck->findByUsername($username);

          if(empty($get)){
                return TRUE;
            }else{
              return FALSE;
            }
      }



      /**
       * verifier si username double
       *
       * @param string $username filter search array
       *
       * @return boolean
       */
      public function veriGroupcheck($groupname){

          $get = $this->radgroupcheck->findByGroupname($groupname);

          if(empty($get)){
                return TRUE;
            }else{
              return FALSE;
            }
      }


      /**
       * VERIFIER FORMAT JSON
       *
       * @param array $parameters filter search array
       * @throws InvalidJsonException when json format is not correct
       *
       * @return
       */
      public function jsonVeri(array $parameters, $table) {

            $msg = "incorrect data json";
            $data = $parameters["data"];
            $cpt = array();
            switch($table){
              case "reply":
                $cpt = array(1,1,1,1);
                foreach ($data as $key => $value){
                    if(!empty($data[$key])){
                        if($key == "username"){
                          $cpt[0] =0;
                        }
                        if($key == "attribute"){
                          $cpt[1] =0;
                        }
                        if($key == "value"){
                          $cpt[2] =0;
                        }
                        if($key == "op"){
                          $cpt[3] =0;
                        }
                    }else{
                      $msg = $msg. ": invalid ".$key;
                    }
                }
                break;
              case "check":
                $cpt = array(1,1,1,1);
                foreach ($data as $key => $value){
                  if(!empty($data[$key])){
                      if($key == "username"){
                        $cpt[0] =0;
                      }
                      if($key == "attribute"){
                        $cpt[1] =0;
                      }
                      if($key == "value"){
                        $cpt[2] =0;
                      }
                      if($key == "op"){
                        $cpt[3] =0;
                      }
                  }else{
                    $msg = $msg. ": invalid ".$key;
                  }
                }

                break;
              case "groupcheck":
              $cpt = array(1,1,1,1);
                foreach ($data as $key => $value){
                  if(!empty($data[$key])){
                      if($key == "groupname"){
                        $cpt[0] =0;
                      }
                      if($key == "attribute"){
                        $cpt[1] =0;
                      }
                      if($key == "value"){
                        $cpt[2] =0;
                      }
                      if($key == "op"){
                        $cpt[3] =0;
                      }
                  }else{
                    $msg = $msg. ": invalid ".$key;
                  }
                }
                break;
              case "groupreply":
                $cpt = array(1,1,1,1);
                foreach ($data as $key => $value){
                  if(!empty($data[$key])){
                      if($key == "groupname"){
                        $cpt[0] =0;
                      }
                      if($key == "attribute"){
                        $cpt[1] =0;
                      }
                      if($key == "value"){
                        $cpt[2] =0;
                      }
                      if($key == "op"){
                        $cpt[3] =0;
                      }
                  }else{
                    $msg = $msg. ": invalid ".$key;
                  }
                }
                break;
              case "usergroup":
                $cpt = array(1,1,1);
                foreach ($data as $key => $value){
                      if($key == "groupname"){
                        if(!empty($data[$key])){
                          $cpt[0] =0;
                        }else{
                          $msg = $msg. ": invalid ".$key;
                        }
                      }
                      if($key == "username"){
                        if(!empty($data[$key])){
                          $cpt[1] =0;
                        }else{
                          $msg = $msg. ": invalid ".$key;
                        }
                      }
                      if($key == "priority"){
                        $cpt[2] =0;
                      }
                }
              break;
			 case "userinfo":
                $cpt = array(1);
                foreach ($data as $key => $value){
                      if($key == "username"){
                        if(!empty($data[$key])){
                          $cpt[0] =0;
                        }else{
                          $msg = $msg. ": invalid ".$key;
                        }
                      }
                }
              break;
			 case "radiusgroup":
                $cpt = array(1);
                foreach ($data as $key => $value){
                      if($key == "groupname"){
                        if(!empty($data[$key])){
                          $cpt[0] =0;
                        }else{
                          $msg = $msg. ": invalid ".$key;
                        }
                      }
                }
              break;
            }
            if(array_sum($cpt) != 0){
                throw new InvalidJsonException($msg,400);
            }
            return;
      }



      /**
       * Get a list of Radreply.
       *
       * @param int $limit  the limit of the result
       * @param int $offset starting from the offset
       * @param array $search filter search array
       *
       * @return array
       */
      public function all($table, $limit = 5, $offset = 0, $search = array()) {
        switch($table){
			case "userinfo":
            $all = $this->userinfo->findBy($search, null, $limit, $offset);
            break;
			case "radiusgroup":
            $all = $this->radiusgroup->findBy($search, null, $limit, $offset);
            break;
          case "reply":
            $all = $this->radreply->findBy($search, null, $limit, $offset);
            break;
          case "check":
            $all = $this->radcheck->findBy($search, null, $limit, $offset);
            break;
          case "groupcheck":
            //array('groupname' => 'ctx-GP-324324')
            $all = $this->radgroupcheck->findBy($search, null, $limit, $offset);
            break;
          case "groupreply":
            $all = $this->radgroupreply->findBy($search, null, $limit, $offset);
            break;
          case "usergroup":
            $all = $this->radusergroup->findBy($search, null, $limit, $offset);
            break;
        }
          return $all;
      }



      /**
       * Get the count of Radreply.
       *
       * @param string $table filter search array
       * @param array $search filter search array
       *
       * @return int
       */
      public function count($table, $search = array()) {

          switch($table){
			case "userinfo":
              $entity_class = "RadiusPrepodBundle:Userinfo";
              break;
			case "radiusgroup":
              $entity_class = "RadiusPrepodBundle:Radiusgroup";
              break;
            case "reply":
              $entity_class = "RadiusPrepodBundle:Radreply";
              break;
            case "check":
              $entity_class = "RadiusPrepodBundle:Radcheck";
              break;
            case "groupcheck":
              $entity_class = "RadiusPrepodBundle:Radgroupcheck";
              break;
            case "groupreply":
              $entity_class = "RadiusPrepodBundle:Radgroupreply";
              break;
            case "usergroup":
              $entity_class = "RadiusPrepodBundle:Radusergroup";
              break;
          }

          $metadata = $this->om->getClassMetadata($entity_class);
          $qb = $this->om->createQueryBuilder();

          $qb->select($qb->expr()->count('t'))->from($entity_class, 't');
          $i = 0;

          foreach ($search as $key => $value) {
              $i++;
              if (is_array($value)) {
                  $qb->add('where', $qb->expr()->in("t." . $metadata->getFieldName($key), $value))
                  ;
              } else {
                  $qb->andwhere("t." . $metadata->getFieldName($key) . " = ?$i")
                          ->setParameter($i, $value);
              }
          }
          $query = $qb->getQuery();
          return $query->getSingleScalarResult();

      }



        /**
         * DELETE DANS UNE TABLE
         *
         * @param string $table
         * @param string $username
         *
         */
          public function delete($username,$table) {
              $id = array();
              $delete = $this->getbyUsername($table, $username);
              foreach ($delete as $value) {
                $id[] = $value->getId();
                $this->om->remove($value);
                $this->om->flush();
              }
              return $id;
          }


	
		/**
         * DELETE DANS LA TABLE radusergroup
         *
         * @param string $table
         * @param string $username
		 * @return integer 
         *
         */
          public function deleteUsergroup($username,$groupname) {
				$delete = $this->getUsergroup($username,$groupname);
                $id = $delete->getUsername();
                $this->om->remove($delete);
                $this->om->flush();
              return $id;
          }


		  /**
           * DELETE utilisateur
           *
           * @param string $username
           *
           */
            public function deleteUser($username) {
				
			  $delete = $this->userinfo->findByUsername($username);
              $id = array();
              $all = $this->radreply->findByUsername($username);
              $all = array_merge($all,$this->radcheck->findByUsername($username));
              $all = array_merge($all,$this->radusergroup->findByUsername($username));
              $all = array_merge($all,$this->userinfo->findByUsername($username));
              $all = array_merge($all,$this->userbillinfo->findByUsername($username));
              $all = array_merge($all,$this->radgroupcheck->findByGroupname($username));
              $all = array_merge($all,$this->radgroupreply->findByGroupname($username));
              if(empty($all)){
                throw new NotFoundHttpException(sprintf('\'%s\'N\'EXISTE PAS DANS RADIUS.',$username));
                return;
              }
              foreach ($all as $value) {
                $id[] = $value->getId();
                $this->om->remove($value);
                $this->om->flush();
              }
                return $id;
            }



          /**
           * DELETE DANS TOUTES LES TABLES
           *
           * @param string $username
           *
           */
            public function deleteAll($username) {
              $id = array();
              $all = $this->radreply->findByUsername($username);
              $all = array_merge($all,$this->radcheck->findByUsername($username));
              $all = array_merge($all,$this->radusergroup->findByUsername($username));
              $all = array_merge($all,$this->userinfo->findByUsername($username));
              $all = array_merge($all,$this->userbillinfo->findByUsername($username));
              $all = array_merge($all,$this->radgroupcheck->findByGroupname($username));
              $all = array_merge($all,$this->radgroupreply->findByGroupname($username));
              if(empty($all)){
                throw new NotFoundHttpException(sprintf('\'%s\'N\'EXISTE PAS DANS RADIUS.',$username));
                return;
              }
              foreach ($all as $value) {
                $id[] = $value->getId();
                $this->om->remove($value);
                $this->om->flush();
              }
                return $id;
            }





	      /**
           * Get an OBJET
           *
           * @param mixed $username
           *
		   * @throws NotFoundHttpException when row not exist
           * @return array
           *
           */
            public function getbyId($table, $id) {
              switch($table){
				 case "userinfo":
                  $get = $this->userinfo->findOneById($id);
                  break;
				 case "radiusgroup":
                  $get = $this->radiusgroup->findOneById($id);
                  break;
                case "reply":
                  $get = $this->radreply->findOneById($id);
                  break;
                case "check":
                  $get = $this->radcheck->findOneById($id);
                  break;
                case "groupcheck":
                    $get = $this->radgroupcheck->findOneById($id);
                    break;
                case "groupreply":
                    $get = $this->radgroupreply->findOneById($id);
                    break;
              }
              if(empty($get)){
                throw new NotFoundHttpException(sprintf('\'%s\' DANS \'rad%s\' N\'EXISTE PAS.',$id,$table));
              }
              return $get;

            }





          /**
           * Get an OBJET
           *
           * @param mixed $username
           *
		   * @throws NotFoundHttpException when row not exist
           * @return array
           *
           */
            public function getbyUsername($table, $username) {

              switch($table){
		
				case "userinfo":
                  $get = $this->userinfo->findByUsername($username);
				  if(!empty($this->userbillinfo->findByUsername($username))){
						$get[] = $this->userbillinfo->findByUsername($username)[0];
					}	  
                  break;
				case "radiusgroup":
                  $get = $this->radiusgroup->findByGroupname($username);
                  break;
                case "reply":
                  $get = $this->radreply->findByUsername($username);
                  break;
                case "check":
                  $get = $this->radcheck->findByUsername($username);
                  break;
                case "usergroup":
                  $get = $this->radusergroup->findByUsername($username);
                  break;
                case "groupcheck":
                    $get = $this->radgroupcheck->findByGroupname($username);
                    break;
                case "groupreply":
                    $get = $this->radgroupreply->findByGroupname($username);
                    break;
              }
              if(empty($get)){
                throw new NotFoundHttpException(sprintf('\'%s\' DANS \'%s\' N\'EXISTE PAS.',$username,$table));
              }
              return $get;

            }


        /**
         * Processes the form.
         *
         * @param array         $parameters
         * @param String        $method
         *
		 * @throws InvalidJsonException
         * @return Userinfo
         *
         *
         */
         public function processForm( $parameters ,$username) {
	
			$post = new Userinfo;
           $post->setUsername($parameters["data"]["username"]);
           $post->setChangeuserinfo("0");
           $day = date("Y-m-d H:i:s");
           $post->setCreationdate(new \DateTime($day));
           $post->setCreationby("newuser.pl");
           $post->setUpdatedate(new \DateTime($day)); 

		//	$get = $this->getbyUsername("userinfo",$username)[0];
			$form = $this->formFactory->create("Radius\PrepodBundle\Form\UserinfoType", $post, array('method' => 'PATCH'));
		    unset($parameters['_method']);
		    $form->submit($parameters, false);
		//    if ($form->isValid()) {
		       $post = $form->getData();
		        $this->om->persist($post);
		        $this->om->flush();
		//		var_dump($get);
		        return $form;
		//    }
		    throw new InvalidJsonException('Invalid submitted data', $form);
           //throw new InvalidJsonException('Invalid submitted data', $form);
         }



}
