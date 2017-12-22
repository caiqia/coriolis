<?php

namespace Radius\PrepodBundle\Controller;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Radius\PrepodBundle\Exception\InvalidJsonException;
use Radius\PrepodBundle\Entity\Radcheck;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;




class RadiusController extends FOSRestController
{


   	  /**
       * RETOURNE LE NOMBRE DE LIGNE.
       * @Annotations\Get("/users/count/{table}",requirements = {"table"="check|reply"})
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
      public function userCountAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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
        $msg = "IL Y A ".$total." LIGNES DANS rad".$table;
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;   
      }


      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE
       * @Annotations\Get("/users/search/{table}",requirements = {"table"="check|reply"})
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
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
      public function userSearchAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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
      }


 	  /**
       * RETOURNE LE NOMBRE DE LIGNE.
       * @Annotations\Get("/groups/count/{table}",requirements = {"table"="groupcheck|groupreply"})
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
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
      public function groupCountAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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
        $msg = "IL Y A ".$total." LIGNES DANS rad".$table;
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;   
      }


      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE
       * @Annotations\Get("/groups/search/{table}",requirements = {"table"="groupcheck|groupreply"})
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
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
      public function groupSearchAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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
      }



	 /**
       * creation d'un utilisateur
       * @Annotations\Post("/users")
       * @ApiDoc(
       *    resource = true,
       *    description = "creation d'un utilisateur",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param Request $request the request object
       * @return Response
       */
      public function UserAction(Request $request)
      {   
		try{
			$id = $this->container->get('radius.compte')->users($request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-User-OK", 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



 	  /**
       * creation d'un group
       * @Annotations\Post("/groups")
       * @ApiDoc(
       *    resource = true,
       *    description = "creation d'un group",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param Request $request the request object
       * @return Response
       */
      public function GroupAction(Request $request)
      {   
		try{
			$id = $this->container->get('radius.compte')->groups($request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-Group-OK", 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



	 /**
       * post dans racheck et radreply
       * @Annotations\Post("/users/{username}/{table}",requirements = {"table"="check|reply"})
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans racheck et radreply",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param Request $request the request object
       * @return Response
       */
      public function CheckAction($username, $table, Request $request)
      {
		try{
			$id = $this->container->get('radius.compte')->checkReply($table,$request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-User-OK", 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


	  /**
       * post dans radusergroup
       * @Annotations\Post("/users/{username}/groups/{groupname}")
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radusergroup",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param Request $request the request object
       * @return Response
       */
      public function userGroupAction($username,$groupname, Request $request)
      {
		try{
			$id = $this->container->get('radius.compte')->checkReply(null,$request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-User-OK", 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



 	  /**
       * post dans radgroupcheck et radgroupreply
       * @Annotations\Post("/groups/{groupname}/{table}",requirements = {"table"="groupcheck|groupreply"})
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radgroupcheck et radgroupreply",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param Request $request the request object
       * @return Response
       */
      public function GroupcheckAction($groupname, $table, Request $request)
      {
		try{
			$id = $this->container->get('radius.compte')->checkReply( $table,$request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-User-OK", 'id' => $id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


      /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/users/{id}/{table}",requirements = {"id"="\d+","table"="check|reply|groupcheck|groupreply|usergroup"})
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
       * @Annotations\Put("/users/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup"})
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
     * @Annotations\Delete("/users/{username}/{table}",requirements = {"table"="check|reply|groupcheck|groupreply|usergroup"})
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
       * @Annotations\Delete("/users/{username}")
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
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-OK",'id ou username' => $id)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }


      /**
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Get("/name/{username}/{table}",requirements = {"table"="check|reply|usergroup|groupcheck|groupreply"})
       * get les objects par username
       * @ApiDoc(
       *   resource = true,
       *   description = "RECUPERER UNE LIGNE AVEC USERNAME OU GROUPNAME",
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
