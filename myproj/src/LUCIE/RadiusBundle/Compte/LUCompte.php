<?php

namespace LUCIE\RadiusBundle\Compte;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LUCIE\RadiusBundle\Exception\InvalidJsonException;
use LUCIE\RadiusBundle\Entity\Radreply;
use LUCIE\RadiusBundle\Entity\Radgroupcheck;
use LUCIE\RadiusBundle\Entity\Radgroupreply;
use LUCIE\RadiusBundle\Entity\Radcheck;
use LUCIE\RadiusBundle\Entity\Radusergroup;
use LUCIE\RadiusBundle\Entity\Userinfo;
use LUCIE\RadiusBundle\Entity\Userbillinfo;
use LUCIE\RadiusBundle\Form\RadcheckType;

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
  protected $userbillinfo;


      public function __construct(ObjectManager $om, FormFactoryInterface $formFactory, $container) {
          $this->container = $container;
          $this->om = $om;
          $this->formFactory = $formFactory;
          $this->radreply = $this->om->getRepository("LUCIERadiusBundle:Radreply");
          $this->radgroupcheck = $this->om->getRepository("LUCIERadiusBundle:Radgroupcheck");
          $this->radgroupreply = $this->om->getRepository("LUCIERadiusBundle:Radgroupreply");
          $this->radcheck = $this->om->getRepository("LUCIERadiusBundle:Radcheck");
          $this->radusergroup = $this->om->getRepository("LUCIERadiusBundle:Radusergroup");
          $this->userinfo = $this->om->getRepository("LUCIERadiusBundle:Userinfo");
          $this->userbillinfo = $this->om->getRepository("LUCIERadiusBundle:Userbillinfo");
      }



      /**
       * ajoute userinfo et userbillinfo s'il n'exite pas
       *
       * @param string $username
       *
       *
       *
       */
      public function addUser($username){

            $reply = $this->radreply->findByUsername($username);
            if(!empty($reply)){
                return;
              }
            $check = $this->radcheck->findByUsername($username);
            if(empty($check)){
                    return;
            }
            $infopost = new Userinfo;
            $infopost->setUsername($username);//($compte->getUsername());
            $infopost->setChangeuserinfo("0");
            $day = date("Y-m-d H:i:s");
            $infopost->setCreationdate(new \DateTime($day));
            $infopost->setCreationby("newuser.pl");
            $infopost->setUpdatedate(new \DateTime($day));
            $this->om->persist($infopost);
            $this->om->flush();
            $billinfopost = new Userbillinfo;
            $billinfopost->setUsername($username);//($compte->getUsername());
            $billinfopost->setCreationdate(new \DateTime($day));
            $billinfopost->setCreationby("newuser.pl");
            $billinfopost->setLastbill(new \DateTime($day));
            $billinfopost->setNextbill(new \DateTime($day));
            $billinfopost->setUpdatedate(new \DateTime($day));
            $billinfopost->setUpdateby("newuser.pl");
            $this->om->persist($billinfopost);
            $this->om->flush();
            return;
      }





      /**
       * ajoute un nouveau entity
       *
       * @param string $table filter search array
       * @throws InvalidJsonException when usename doesn't existe
       *
       *
       */
      public function newObject($table){
          switch($table){
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
       * verifier si username double
       *
       * @param string $username filter search array
       *
       *@return boolean
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
       *@return boolean
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
        $data = $parameters["data"];
        foreach ($data as $key => $value) {
          if(empty($value)){
            throw new InvalidJsonException('Invalid '.$key);
          }
        }
          return ;
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
            case "reply":
              $entity_class = "LUCIERadiusBundle:Radreply";
              break;
            case "check":
              $entity_class = "LUCIERadiusBundle:Radcheck";
              break;
            case "groupcheck":
              $entity_class = "LUCIERadiusBundle:Radgroupcheck";
              break;
            case "groupreply":
              $entity_class = "LUCIERadiusBundle:Radgroupreply";
              break;
            case "usergroup":
              $entity_class = "LUCIERadiusBundle:Radusergroup";
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
       * Create a new LIGNE
       *
       * @param array $username
       * @param array $parameters
       * @param array $table
       *
       *
       * @return integer
       */
        public function patch($username, $parameters, $table) {
          $patch =  null;
          $post = null;
          if($username){
            $patch = $this->get($table, $username);
          }else{
            $post = $this->newObject($table);
          }
          if(!$parameters)return;
          $data = $parameters["data"];
          if($patch){
            foreach ($data as $key => $value){
              switch($key){
                case "username":
                    foreach ($patch as $element){
                      $element->setUsername($value);
                      }
                break;
                case "groupname":
                    foreach ($patch as $element){
                      $element->setGroupname($value);
                    }
                break;
                case "attribute":
                    foreach ($patch as $element){
                      $element->setAttribute($value);
                    }
                break;
                case "op":
                    foreach ($patch as $element){
                      $element->setOp($value);
                    }
                break;
                case "value":
                    foreach ($patch as $element){
                      $element->setValue($value);
                    }
                break;
                case "priority":
                    foreach ($patch as $element){
                      $element->setPriority($value);
                    }
                break;
              }
            }
            $list = array();
            foreach ($patch as $element){
              $this->om->persist($element);
              $this->om->flush();
              if($table == "usergroup"){
                $list[] = $element->getUsername();
              }
              $list[] = $element->getId();
            }
            return $list;
          }
          if($post){
            foreach ($data as $key => $value){
              switch($key){
                case "username":
                  $post->setUsername($value);
                break;
                case "groupname":
                  $post->setGroupname($value);
                break;
                case "attribute":
                  $post->setAttribute($value);
                break;
                case "op":
                  $post->setOp($value);
                break;
                case "value":
                  $post->setValue($value);
                break;
                case "priority":
                  $post->setPriority($value);
                break;
              }
            }
            $this->om->persist($post);
            $this->om->flush();
            if($table == "usergroup"){
              return $post->getUsername();
            }
            return $post->getId();
          }

        }


        /**
         * DELETE DANS UNE TABLE
         *
         * @param string $table
         * @param string $username
         *
         */
          public function delete($table, $username) {

              $delete = $this->get($table, $username);
              if($table == "reply"){
                $delete = array_merge($delete,$this->userinfo->findByUsername($username));
                $delete = array_merge($delete,$this->userbillinfo->findByUsername($username));
              }
              foreach ($delete as $value) {
                $this->om->remove($value);
                $this->om->flush();
              }

              return;
          }


          /**
           * DELETE DANS TOUTES LES TABLES
           *
           * @param string $username
           *
           */
            public function deleteAll($username) {

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
                $this->om->remove($value);
                $this->om->flush();
              }
                return;
            }

          /**
           * Get an OBJET
           *
           * @param mixed $username
           *
           * @return array
           * @throws NotFoundHttpException when row not exist
           */
            public function get($table, $username) {

              switch($table){
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
         * @return Radcheck
         *
         * @throws InvalidJsonException
         */
         public function processForm( array $parameters, $method = "PUT") {

           $form = $this->formFactory->create("LUCIE\RadiusBundle\Form\RadcheckType", $patch, array('method' => $method));

           $form->submit($parameters, false);
           return $form;
           //throw new InvalidJsonException('Invalid submitted data', $form);
         }



}
