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
          //$this->userinfo = $this->om->getRepository("LUCIERadiusBundle:Userinfo");
          //$this->userbillinfo = $this->om->getRepository("LUCIERadiusBundle:Userbillinfo");

      }

      /**
       * VERIFIER FORMAT JSON
       *
       * @param array $parameters filter search array
       *
       * @return
       */
      public function jsonVeri(array $parameters, $table) {
        switch($table){
          case "reply":
            if( empty($parameters["data"]["username"]) ||
                empty($parameters["data"]["attribute"]["ipv4"]) ||
                empty($parameters["data"]["attribute"]["ipv6Prefix"]) ||
                empty($parameters["data"]["attribute"]["ipv6PrefixDelegate"]) ||
                empty($parameters["data"]["ipv4"]) ||
                empty($parameters["data"]["op"]) ||
                empty($parameters["data"]["ipv6"]["ipv6Prefix"])  ||
                empty($parameters["data"]["ipv6"]["ipv6PrefixDelegate"])){
                    throw new InvalidJsonException('Invalid submitted data');
                }


            break;
          case "check":
            if (empty($parameters["data"]["username"]) ||
                empty($parameters["data"]["attribute"]) ||
                empty($parameters["data"]["ipv4"]) ||
                empty($parameters["data"]["value"]) ||
                empty($parameters["data"]["op"])){
                    throw new InvalidJsonException('Invalid submitted data');
                }

            break;
          case "groupcheck":
            if( empty($parameters["data"]["groupname"]) ||
                empty($parameters["data"]["attribute"]) ||
                empty($parameters["data"]["value"]) ||
                empty($parameters["data"]["op"])){
                    throw new InvalidJsonException('Invalid submitted data');
                }

            break;
          case "groupreply":
            if( empty($parameters["data"]["groupname"]) ||
                empty($parameters["data"]["attribute"]) ||
                empty($parameters["data"]["value"]) ||
                empty($parameters["data"]["op"])){
                    throw new InvalidJsonException('Invalid submitted data');
                }

            break;
          case "usergroup":
            if( empty($parameters["data"]["groupname"]) ||
                empty($parameters["data"]["priority"]) ||
                empty($parameters["data"]["username"])){
                    throw new InvalidJsonException('Invalid submitted data');
                }
            break;
          case "userinfo":
            break;
          case "userbillinfo":
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
          case "userinfo":
            break;
          case "userbillinfo":
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
          var_dump($table);

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
            case "userinfo":
              $entity_class = "LUCIERadiusBundle:Userinfo";

              break;
            case "userbillinfo":
              $entity_class = "LUCIERadiusBundle:Userbillinfo";

              break;
          }

          $metadata = $this->om->getClassMetadata($entity_class);
          $qb = $this->om->createQueryBuilder();
          $qb->select($qb->expr()->count('t'))->from($entity_class, 't');
          $i = 0;
          echo("test-count3\n");
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
       */
        public function post(array $parameters, $table) {

                echo $table."\n";
                try{
                  echo "test-exception\n";
                  $this->jsonVeri($parameters, $table);
                }catch(InvalidFormException $exception){
                  var_dump($exception->getMessage());
                  return;
                }
                switch($table){
                  case "reply":
                    $radreply1 = new Radreply;
                    $radreply1->setUsername($parameters["data"]["username"]);//($compte->getUsername());
                    $radreply1->setAttribute($parameters["data"]["attribute"]["ipv4"]);//"Framed-IP-Address"
                    $radreply1->setOp($parameters["data"]["op"]);//":="
                    $radreply1->setValue($parameters["data"]["ipv4"]);//($compte->getIPV4ADDR());
                    $this->om->persist($radreply1);
                    $this->om->flush($radreply1);

                    $radreply2 = new Radreply;
                    $radreply2->setUsername($parameters["data"]["username"]);//($compte->getUsername());
                    $radreply2->setAttribute($parameters["data"]["attribute"]["ipv6Prefix"]);//"Framed-IPv6-Prefix"
                    $radreply2->setOp($parameters["data"]["op"]);//":="
                    $radreply2->setValue($parameters["data"]["ipv6"]["ipv6Prefix"]);
                    $this->om->persist($radreply2);
                    $this->om->flush($radreply2);
                    $radreply3 = new Radreply;
                    $radreply3->setUsername($parameters["data"]["username"]);//($compte->getUsername());
                    $radreply3->setAttribute($parameters["data"]["attribute"]["ipv6PrefixDelegate"]);//"Delegated-IPv6-Prefix"
                    $radreply3->setOp($parameters["data"]["op"]);//":="
                    $radreply3->setValue($parameters["data"]["ipv6"]["ipv6PrefixDelegate"]);//($compte->getIPV4ADDR());
                    $this->om->persist($radreply3);
                    $this->om->flush($radreply3);
                    break;

                  case "check":
                    $radcheck = new Radcheck;
                    $radcheck->setUsername($parameters["data"]["username"]);//($compte->getUsername());
                    $radcheck->setAttribute($parameters["data"]["attribute"]);//"Cleartext-Password"
                    $radcheck->setOp($parameters["data"]["op"]);
                    $radcheck->setValue($parameters["data"]["value"]);//"Redback"
                    $this->om->persist($radcheck);
                    $this->om->flush($radcheck);
                    break;

                  case "groupcheck":
                    $radgroupcheck = new Radgroupcheck;
                    $radgroupcheck->setGroupname($parameters["data"]["groupname"]);
                    $radgroupcheck->setAttribute($parameters["data"]["attribute"]);//"TEST-GROUP-CHECK"
                    $radgroupcheck->setValue($parameters["data"]["value"]);
                    $radgroupcheck->setOp($parameters["data"]["op"]);
                    $this->om->persist($radgroupcheck);
                    $this->om->flush($radgroupcheck);
                    break;

                  case "groupreply":
                    $radgroupreply = new Radgroupreply;
                    $radgroupreply->setGroupname($parameters["data"]["groupname"]);
                    $radgroupreply->setAttribute($parameters["data"]["attribute"]);
                    $radgroupreply->setValue($parameters["data"]["value"]);
                    $radgroupreply->setOp($parameters["data"]["op"]);
                    $this->om->persist($radgroupreply);
                    $this->om->flush($radgroupreply);
                    break;

                  case "usergroup":
                    $radusergroup = new Radusergroup;
                    $radusergroup->setUsername($parameters["data"]["username"]);//($compte->getUsername());
                    $radusergroup->setGroupname($parameters["data"]["groupname"]);//"ctx-GP-1G"
                    $radusergroup->setPriority($parameters["data"]["priority"]);//0
                    $this->om->persist($radusergroup);
                    $this->om->flush($radusergroup);
                    break;

                  case "userinfo":
                    $userinfo = new Userinfo;
                    $userinfo->setUsername($parameters["data"]["mac"]);//($compte->getUsername());
                    $userinfo->setChangeuserinfo("0");
                    $day = date("Y-m-d H:i:s");
                    $userinfo->setCreationdate(new \DateTime($day));
                    $userinfo->setCreationby("newuser.pl");
                    $userinfo->setUpdatedate(new \DateTime($day));
                    $this->om->persist($userinfo);
                    $this->om->flush($userinfo);
                    break;

                  case "userbillinfo":
                    $day = date("Y-m-d H:i:s");
                    $userbillinfo = new Userbillinfo;
                    $userbillinfo->setUsername($parameters["data"]["mac"]);//($compte->getUsername());
                    $userbillinfo->setCreationdate(new \DateTime($day));
                    $userbillinfo->setCreationby("newuser.pl");
                    $userbillinfo->setLastbill(new \DateTime($day));
                    $userbillinfo->setNextbill(new \DateTime($day));
                    $userbillinfo->setUpdatedate(new \DateTime($day));
                    $userbillinfo->setUpdateby("newuser.pl");
                    $this->om->persist($userbillinfo);
                    $this->om->flush($userbillinfo);
                    break;

                }
                return;
        }

        /**
         * Delete an Radreply.
         *
         * @param mixed $id
         *
         */
          public function delete($table, $id) {
              echo $table."\n";
              $delete = $this->get($table, $id);
              $this->om->remove($delete);
              $this->om->flush();
              return;
          }



          /**
           * Get an Radreply.
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
                case "userinfo":
                  break;
                case "userbillinfo":
                  break;
              }
              if(!$get){
                throw new NotFoundHttpException(sprintf('LA LIGNE \'%s\' DANS \'%s\' EST VIDE.',$id,$table));
              }
              return $get ;
              //$radreply = $this->radreply->find($id);
            }



}
