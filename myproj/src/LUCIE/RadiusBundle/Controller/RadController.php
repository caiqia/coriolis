<?php

namespace LUCIE\RadiusBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use LUCIE\RadiusBundle\Exception\InvalidJsonException;
use LUCIE\RadiusBundle\Entity\Radcheck;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;





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
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="username ")
       * @Annotations\QueryParam(name="groupname",  nullable=true, description="groupname ")
       * @Annotations\QueryParam(name="attribute",  nullable=true, description="object attribute")
       * @Annotations\QueryParam(name="value",  nullable=true, description="object value ")
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing object.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many objects to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function getCountAction($table, Request $request, ParamFetcherInterface $paramFetcher)
      {
          $string = $request->getRequestUri(); 
          $search =  $paramFetcher->all();
          foreach($search as $key => $value )
          {
        	if(empty($value))
        	{
        	    unset($search[$key]);
        	}
          }       
         try{
            $this->container->get('radius.compte')->requestUri($string,$search,$table);
        }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count($table,$search);
        $msg = "IL Y A ".$total." LIGNES DANS rad".$table;
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
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
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="username ")
       * @Annotations\QueryParam(name="groupname",  nullable=true, description="groupname ")
       * @Annotations\QueryParam(name="attribute",  nullable=true, description="object attribute")
       * @Annotations\QueryParam(name="value",  nullable=true, description="object value ")
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing object.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many objects to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function getSearchAction($table, Request $request, ParamFetcherInterface $paramFetcher)
      {
          $string = $request->getRequestUri();
           $offset = $paramFetcher->get('offset');
           $offset = null == $offset ? 0 : $offset;
           $limit = $paramFetcher->get('limit');
           $limit = null == $limit ? 0 : $limit;
           $search =  $paramFetcher->all();
          foreach($search as $key => $value )
          {
            if(empty($value))
            {
              unset($search[$key]);
            }
          } 
        try{
            $this->container->get('radius.compte')->requestUri($string,$search,$table);
        }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all($table,$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
          //return $this->container->get('mystream.voicemail.handler')->all($limit, $offset, $search);
      }



         



      /**
       * CREE UNE NOUVELLE LIGNE A PARTIR DES DONNEES
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
      public function postAction( $table, Request $request)
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
          if($table == "check"){
             $flag1 = $this->container->get('radius.compte')->veriCheck($request->request->all()["data"]["username"]);
             if(!$flag1){
               $msg = "username existe deja dans radcheck";
               $response = new Response();
               $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
               $response->headers->set('Content-Type', 'application/json');
              return $response;
             }
           }
          if($table == "reply"){
              $flag1 = $this->container->get('radius.compte')->veriCheck($request->request->all()["data"]["username"]);
              if($flag1){
              $msg = "USERNAME N'EXISTE PAS DANS RADCHECK";
              $response = new Response();
              $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
              $response->headers->set('Content-Type', 'application/json');
             return $response;
              }
            $this->container->get('radius.compte')->addUser($request->request->all()["data"]["username"]);
          }
          if($table == "groupcheck"){
             $flag2 = $this->container->get('radius.compte')->veriGroupcheck($request->request->all()["data"]["groupname"]);
             if(!$flag2){
               $msg = "groupname existe deja dans radgroupcheck";
               $response = new Response();
               $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
               $response->headers->set('Content-Type', 'application/json');
              return $response;
             }
           }
          if($table == "groupreply"){
              $flag2 = $this->container->get('radius.compte')->veriGroupcheck($request->request->all()["data"]["groupname"]);
              if($flag2){
                $msg = "GROUPNAME N'EXISTE PAS DANS RADGROUPCHECK";
                $response = new Response();
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
               return $response;
              }
          }
         if($table == "usergroup"){
            try{
                $this->container->get('radius.compte')->veriUsergroup($request->request->all()["data"]["username"],$request->request->all()["data"]["groupname"]);
            }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
                $response->setContent(json_encode(array('success'=> FALSE, 'msg'=> $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }       
          }

        $id = $this->container->get('radius.compte')->patch(null, $request->request->all(),$table);
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-OK", 'id ou username' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



      /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/{id}/{table}",requirements = {"id"="\d+","table"="check|reply|groupcheck|groupreply|usergroup"})
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
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
      public function patchAction( $id, $table, Request $request)
      {
        $method = $request->getMethod();
        try{
          $this->container->get('radius.compte')->jsonVeri($request->request->all(), $table);
        }catch(InvalidJsonException $exception){
          $msg = $exception->getMessage();
          $response = new Response();
          $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
          $response->headers->set('Content-Type', 'application/json');
         return $response;
        }
        if($table == "check" || $table == "reply"){
            $flag = $this->container->get('radius.compte')->veriCheck($request->request->all()["data"]["username"]);
         }
        if($table == "groupcheck" || $table == "groupreply"){
            $flag = $this->container->get('radius.compte')->veriGroupcheck($request->request->all()["data"]["groupname"]);
         }
        if($flag){
             $msg = "USERNAME N'EXISTE PAS DANS RADCHECK";
             $response = new Response();
             $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
             $response->headers->set('Content-Type', 'application/json');
            return $response;
         }
        if($method == "PATCH"){
          $id = $this->container->get('radius.compte')->patch($id,$request->request->all(),$table);
        }
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-OK", 'id ou username' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


      /**
       * PUT UN NOUVEAU OBJECT
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Put("/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup"})
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
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
      public function putAction( $table, Request $request)
      {

        $method = $request->getMethod();
        if($method == "PUT"){
          $id = $this->container->get('radius.compte')->patch(null,null,$table);
        }
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PUT-OK" )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


    /**
     * SUPPRIME DANS UNE TABLE
     * @Annotations\Delete("/{username}/{table}",requirements = {"table"="check|reply|groupcheck|groupreply"})
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
            $id = $this->container->get('radius.compte')->delete($table, $username);
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }
          $response = new Response();
          $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-OK",'id ou username' => $id)));
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
              $id = $this->container->get('radius.compte')->deleteAll($username);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $response = new Response();
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-ALL-OK",'id ou username' => $id)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }


      /**
       * @Annotations\Get("/group/{username}/{groupname}")
       * operation get pour usergroup
       * @ApiDoc(
       *    resource = true,
       *    description= "operation get pour usergroup",
       *    statusCodes= {
       *        200 = "returned when successful",
       *        404 = "returned when usergroup is not found"
       *    }
       * )
       *
       * @param string $username element username
       * @param string $groupname element groupname
       * @throws NotFoundHttpException when element not existe
       *
       * @return Response
       *
       */
       public function getUsergroupAction($username,$groupname){
            try{
                $get = $this->container->get('radius.compte')->getUsergroup($username, $groupname);         
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
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Get("/name/{username}/{table}",requirements = {"table"="check|reply|groupcheck|groupreply"})
       * recupere les elements par username
       * @ApiDoc(
       *   resource = true,
       *   description = "RECUPERER UNE LIGNE AVEC USERNAME OU GROUPNAME",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     404 = "Returned when the radreply is not found"
       *   }
       * )
       *
       * @param string     $username      the element username
       * @throws NotFoundHttpException when object not exist
       *
       * @return Response
       */
        public function getUserAction($version, $username, $table)
        {

            try{
              $get = $this->container->get('radius.compte')->getUsername($table, $username);
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
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Get("/{id}/{table}",requirements = {"id"="\d+","table"="check|reply|usergroup|groupcheck|groupreply"})
       * get les objects par id
       * @ApiDoc(
       *   resource = true,
       *   description = "RECUPERER UNE LIGNE AVEC ID",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     404 = "Returned when the radreply is not found"
       *   }
       * )
       *
       * @param integer     $id      the object id
       * @throws NotFoundHttpException when object not exist
       *
       * @return Response
       */
        public function getIdAction($version, $id, $table)
        {
            if($table == 'usergroup'){
                $msg = 'on ne peut pas recupere usergroup par id';
                $response = new Response();
                $response->setContent(json_encode(array('success' => FALSE, 'msg' => $msg)));
                $response->headers->set('Content-Type','application/json');
                return $response;
            }
            try{
              $get = $this->container->get('radius.compte')->getId($table, $id);
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



}
