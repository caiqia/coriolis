<?php

namespace LUCIE\RadiusBundle\Compte;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LUCIE\RadiusBundle\Exception\InvalidJsonException;
use LUCIE\RadiusBundle\Entity\Radreply;
use LUCIE\RadiusBundle\Entity\Radgroupcheck;
use LUCIE\RadiusBundle\Entity\Radgroupreply;
use LUCIE\RadiusBundle\Entity\Radcheck;
use LUCIE\RadiusBundle\Entity\Radusergroup;
use LUCIE\RadiusBundle\Entity\Userinfo;
use LUCIE\RadiusBundle\Entity\Userbillinfo;

class LUCompte
{

  protected $om;
  protected $radreply;
  protected $radgroupcheck;
  protected $radgroupreply;
  protected $radcheck;
  protected $radusergroup;
  protected $userinfo;
  protected $userbillinfo;


      public function __construct(ObjectManager $om, $container) {
          $this->container = $container;
          $this->om = $om;
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
            $this->om->flush($infopost);
            $billinfopost = new Userbillinfo;
            $billinfopost->setUsername($username);//($compte->getUsername());
            $billinfopost->setCreationdate(new \DateTime($day));
            $billinfopost->setCreationby("newuser.pl");
            $billinfopost->setLastbill(new \DateTime($day));
            $billinfopost->setNextbill(new \DateTime($day));
            $billinfopost->setUpdatedate(new \DateTime($day));
            $billinfopost->setUpdateby("newuser.pl");
            $this->om->persist($billinfopost);
            $this->om->flush($billinfopost);
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
      public function put($table){
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

      }

      /**
       * verifier si username existe
       *
       * @param string $username filter search array
       * @throws InvalidJsonException when usename doesn't existe
       *
       *
       */
      public function veriUser($username){

          $get = $this->radcheck->findByUsername($username);
          if(empty($get)){
                throw new InvalidJsonException('Invalid username');
            }
      }


      /**
       * VERIFIER FORMAT JSON
       *
       * @param array $parameters filter search array
       * @throws InvalidJsonException when json est vide
       *
       * @return
       */
      public function jsonVeri(array $parameters, $table) {
        switch($table){
          case "reply":
            if( empty($parameters["data"]["username"])){throw new InvalidJsonException('Invalid username');}
            if( empty($parameters["data"]["attribute"])){throw new InvalidJsonException('Invalid attribute');}
            if( empty($parameters["data"]["value"])){throw new InvalidJsonException('Invalid value');}
            if( empty($parameters["data"]["op"])){throw new InvalidJsonException('Invalid op');}

            break;
          case "check":
            if (empty($parameters["data"]["username"])){throw new InvalidJsonException('Invalid username');}
            if( empty($parameters["data"]["attribute"])){throw new InvalidJsonException('Invalid attribute');}
            if( empty($parameters["data"]["value"])){throw new InvalidJsonException('Invalid value');}
            if( empty($parameters["data"]["op"])){throw new InvalidJsonException('Invalid op');}

            break;
          case "groupcheck":
            if( empty($parameters["data"]["groupname"])){throw new InvalidJsonException('Invalid groupname');}
            if( empty($parameters["data"]["attribute"])){throw new InvalidJsonException('Invalid attribute');}
            if( empty($parameters["data"]["value"])){throw new InvalidJsonException('Invalid value');}
            if( empty($parameters["data"]["op"])){throw new InvalidJsonException('Invalid op');}

            break;
          case "groupreply":
            if( empty($parameters["data"]["groupname"])){throw new InvalidJsonException('Invalid groupname');}
            if( empty($parameters["data"]["attribute"])){throw new InvalidJsonException('Invalid attribute');}
            if( empty($parameters["data"]["value"])){throw new InvalidJsonException('Invalid value');}
            if( empty($parameters["data"]["op"])){throw new InvalidJsonException('Invalid op');}

            break;
          case "usergroup":
            if( empty($parameters["data"]["groupname"])){throw new InvalidJsonException('Invalid groupname');}
            if( empty($parameters["data"]["priority"])){throw new InvalidJsonException('Invalid priority');}
            if( empty($parameters["data"]["username"])){throw new InvalidJsonException('Invalid username');}
            break;
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
       * Create a new Radreply.
       *
       * @param array $parameters
       *
       *
       * @return integer
       */
        public function post(array $parameters, $table) {


                switch($table){
                  case "reply":
                        $post = new Radreply;
                        $post->setUsername($parameters["data"]["username"]); //($compte->getUsername());
                        $post->setAttribute($parameters["data"]["attribute"]); // NomAttribute
                        $post->setOp($parameters["data"]["op"]);//":="
                        $post->setValue($parameters["data"]["value"]);//ValueAttribute
                    break;
                  case "check":
                    $post = new Radcheck;
                    $post->setUsername($parameters["data"]["username"]);//($compte->getUsername());
                    $post->setAttribute($parameters["data"]["attribute"]);//"Cleartext-Password"
                    $post->setOp($parameters["data"]["op"]);
                    $post->setValue($parameters["data"]["value"]);//"Redback"
                    break;
                  case "groupcheck":
                      $post = new Radgroupcheck;
                      $post->setGroupname($parameters["data"]["groupname"]);
                      $post->setAttribute($parameters["data"]["attribute"]);//"TEST-GROUP-CHECK"
                      $post->setValue($parameters["data"]["value"]);
                      $post->setOp($parameters["data"]["op"]);
                    break;
                  case "groupreply":
                      $post = new Radgroupreply;
                      $post->setGroupname($parameters["data"]["groupname"]);
                      $post->setAttribute($parameters["data"]["attribute"]);
                      $post->setValue($parameters["data"]["value"]);
                      $post->setOp($parameters["data"]["op"]);
                    break;
                  case "usergroup":
                      $post = new Radusergroup;
                      $post->setUsername($parameters["data"]["username"]);//($compte->getUsername());
                      $post->setGroupname($parameters["data"]["groupname"]);//"ctx-GP-1G"
                      $post->setPriority($parameters["data"]["priority"]);//0
                    break;
                }
                $this->om->persist($post);
                $this->om->flush($post);
                return $post->getId();
        }

        /**
         * Delete an Radreply.
         *
         * @param mixed $id
         *
         */
          public function delete($table, $id) {

              $delete = $this->get($table, $id);
              $this->om->remove($delete);
              $this->om->flush();
              return;
          }


          /**
           * Get an OBJET
           *
           * @param mixed $id
           *
           * @return Radreply
           * @throws NotFoundHttpException when row not exist
           */
            public function get($table, $id) {

              switch($table){
                case "reply":
                  $get = $this->radreply->find($id);
                  break;
                case "check":
                  $get = $this->radcheck->find($id);
                  break;
                case "groupcheck":
                  $get = $this->radgroupcheck->find($id);
                  break;
                case "groupreply":
                  $get = $this->radgroupreply->find($id);
                  break;
                case "usergroup":
                  $get = $this->radusergroup->find($id);
                  break;
              }
              if(empty($get)){
                throw new NotFoundHttpException(sprintf('LA LIGNE \'%s\' DANS \'%s\' EST VIDE.',$id,$table));
              }
              return $get ;

            }



}
