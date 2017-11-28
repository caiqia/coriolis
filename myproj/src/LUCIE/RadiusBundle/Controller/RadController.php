<?php

namespace LUCIE\RadiusBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use LUCIE\RadiusBundle\Exception\InvalidJsonException;
use LUCIE\RadiusBundle\Entity\Radreply;
use LUCIE\RadiusBundle\Entity\Radgroupcheck;
use LUCIE\RadiusBundle\Entity\Radgroupreply;
use LUCIE\RadiusBundle\Entity\Radcheck;
use LUCIE\RadiusBundle\Entity\Radusergroup;




class RadController extends FOSRestController
{


      /**
       * RETOURNE LE NOMBRE DE LIGNE.
       * @Annotations\Get("/count/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup"})
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="entities id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="entity: username=x")
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing voicemails.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many voicemails to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function getCountAction($table, Request $request, ParamFetcherInterface $paramFetcher)
      {
          $offset = $paramFetcher->get('offset');
          $offset = null == $offset ? 0 : $offset;
          $limit = $paramFetcher->get('limit');
        	$search =  $paramFetcher->all();
        	unset($search['offset']);
        	unset($search['limit']);
        	foreach($search as $key => $value )
        	{
        		if(empty($value))
        		{
        			unset($search[$key]);
        		}
        	}

      	$total = $this->container->get('radius.compte')->count($table,$search);

        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $total)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
          //return $this->container->get('mystream.voicemail.handler')->all($limit, $offset, $search);
      }


      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE
       * @Annotations\Get("/search/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup"})
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="Array of voicemail ids : id[]=x&id[]=x")
       * @Annotations\QueryParam(name="username",  nullable=true, description="mailbox number: mailbox=x")
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing voicemails.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many voicemails to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function getSearchAction($table, Request $request, ParamFetcherInterface $paramFetcher)
      {
          $offset = $paramFetcher->get('offset');
          $offset = null == $offset ? 0 : $offset;
          $limit = $paramFetcher->get('limit');
          $search =  $paramFetcher->all();
          unset($search['offset']);
          unset($search['limit']);
          foreach($search as $key => $value )
          {
            if(empty($value))
            {
              unset($search[$key]);
            }
          }

        $total = $this->container->get('radius.compte')->all($table,$limit,$offset,$search);

        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
          //return $this->container->get('mystream.voicemail.handler')->all($limit, $offset, $search);
      }


      /**
       * CREE UNE NOUVELLE LIGNE A PARTIR DES DONNEE
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Post("/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup"})
       * @ApiDoc(
       *   resource = true,
       *   description = "CREE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the form has errors"
       *   }
       * )
       *
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function postAction($version, $table, Request $request)
      {

        try{
          $this->container->get('radius.compte')->jsonVeri($request->request->all(), $table);
        }catch(InvalidJsonException $exception){
          $msg = $exception->getMessage();
          $response = new Response();
          $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
          $response->headers->set('Content-Type', 'application/json');
         return $response;
        }
        if($table =="check"){
           $flag = $this->container->get('radius.compte')->veriCheck($request->request->all()["data"]["username"]);
           if(!$flag){
             $msg = "username existe déjà dans radcheck";
             $response = new Response();
             $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
             $response->headers->set('Content-Type', 'application/json');
            return $response;
           }
       }else{
         if($table =="reply"){
          try{
            $this->container->get('radius.compte')->veriUser($request->request->all()["data"]["username"]);
          }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
         }
          $this->container->get('radius.compte')->addUser($request->request->all()["data"]["username"]);
        }
       }

        $id = $this->container->get('radius.compte')->post($request->request->all(),$table);
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-OK", 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



      /**
       * CREE UNE NOUVELLE LIGNE A PARTIR DES DONNEE
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/{username}/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup"})
       * @ApiDoc(
       *   resource = true,
       *   description = "CREE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the form has errors"
       *   }
       * )
       *
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function patchAction($version,$username,$table, Request $request)
      {

        $formFactory = Forms::createFormFactory();
        $this->container->get('radius.compte');

        $id = $this->container->get('radius.compte')->post($request->request->all(),$table);

        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-OK", 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


    /**
     * SUPPRIME DANS UNE TABLE
     * @Annotations\Delete("/{username}/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup"})
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @param string     $username
     *
     * @return Response
     * @throws NotFoundHttpException when radreply not exist
     */
      public function deleteAction($version, $username, $table)
      {

          try{
            $msg = $this->container->get('radius.compte')->delete($table, $username);
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }

          $response = new Response();
          $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-OK")));
          $response->headers->set('Content-Type', 'application/json');
          return $response;
      }

      /**
       * SUPPRIME DANS TOUTES LES TABLES
       * @Annotations\Delete("/{username}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @param string     $username
       *
       * @return Response
       * @throws NotFoundHttpException when radreply not exist
       */
        public function deleteAllAction($version, $username)
        {

            try{
              $msg = $this->container->get('radius.compte')->deleteAll($username);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }

            $response = new Response();
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-OK")));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }


      /**
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Get("/{username}/{table}",requirements = {"table"="check|reply|usergroup|groupcheck|groupreply"})
       * get les objects par username
       * @ApiDoc(
       *   resource = true,
       *   description = "RECUPERER UNE LIGNE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     404 = "Returned when the radreply is not found"
       *   }
       * )
       *
       * @param string     $username      the object username
       * @throws NotFoundHttpException when object not exist
       *
       * @return Response
       */
        public function getAction($version, $username, $table)
        {
            try{
              $get = $this->container->get('radius.compte')->get($table, $username);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            $response = new Response();
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }




        /**
         * CREE UN NOUVEAU OBJET
         * @Annotations\Put("/put/{table}")
         *
         * @ApiDoc(
         *   resource = true,
         *   statusCodes = {
         *     200 = "Returned when successful"
         *   }
         * )
         *
         *@return Response
         *
         */
          public function putAction($table)
          {

              $put = $this->container->get('radius.compte')->put($table);
              $response = new Response();
              $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PUT-OK")));
              $response->headers->set('Content-Type', 'application/json');
              return $response;

          }

}
