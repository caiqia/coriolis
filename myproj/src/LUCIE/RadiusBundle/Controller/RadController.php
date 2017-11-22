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
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing voicemails.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many voicemails to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function getRadreplysAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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

      	$total = $this->container->get('radius.compte')->count($table,$search) ;
        var_dump($total);
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"TEST-count")));
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
        //  $this->container->get('radius.compte')->jsonVeri($request->request->all(), $table);
        }catch(InvalidJsonException $exception){
          $msg = $exception->getMessage();
          $response = new Response();
          $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
          $response->headers->set('Content-Type', 'application/json');
         return $response;
        }
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
        $id = $this->container->get('radius.compte')->post($request->request->all(),$table);

        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-OK", 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




    /**
     * SUPPRIME UNE LIGNE
     * @Annotations\Delete("/{id}/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup", "id"="\d+"})
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @param int     $id      the radreply id
     *
     * @return Response
     * @throws NotFoundHttpException when radreply not exist
     */
      public function deleteAction($version, $id, $table)
      {
          echo $version."\n";
          try{
            $msg = $this->container->get('radius.compte')->delete($table, $id);
          }catch(NotFoundHttpException $exception){
            $msg = "LA LIGNE ".$id." DANS LA TABLE ".$table." EST VIDE";
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
       * @Annotations\Get("/{id}/{table}",requirements = {"id"="\d+","table"="check|reply|groupcheck|groupreply|usergroup"})
       * get single Radreply
       * @ApiDoc(
       *   resource = true,
       *   description = "RECUPERER UNE LIGNE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     404 = "Returned when the radreply is not found"
       *   }
       * )
       *
       * @param int     $id      the object id
       * @throws NotFoundHttpException when object not exist
       *
       * @return Response
       */
        public function getAction($version, $id,$table)
        {
            echo $version."\n";
            try{
              $get = $this->container->get('radius.compte')->get($table, $id);
            }catch(NotFoundHttpException $exception){
              $msg = "LA LIGNE ".$id." DANS LA TABLE ".$table." EST VIDE";
              $response = new Response();
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            //$msg = "VALUE EST '".$get->getValue()."'";
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
              new Radreply;
              $response = new Response();
              $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PUT-OK")));
              $response->headers->set('Content-Type', 'application/json');
              return $response;

          }

}
