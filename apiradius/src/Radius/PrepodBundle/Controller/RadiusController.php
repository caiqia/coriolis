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
       * @Annotations\Get("/users/count")
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
      public function userCountAction( Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"userinfo");
        }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("userinfo",$search);
        $msg = "IL Y A ".$total." LIGNES DANS userinfo";
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE
       * @Annotations\Get("/users/search")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="groupname ")
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
      public function userSearchAction(Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"userinfo");
        }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("userinfo",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


 	  /**
       * RETOURNE LE NOMBRE DE LIGNE.
       * @Annotations\Get("/groups/count")
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
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing object.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many objects to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function groupCountAction(Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"radiusgroup");
        }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("radiusgroup",$search);
        $msg = "IL Y A ".$total." LIGNES DANS radiusgroup";
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response; 
      }



      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE
       * @Annotations\Get("/groups/search")
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
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing object.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many objects to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function groupSearchAction(Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"radiusgroup");
        }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("radiusgroup",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



	  /**
       * RETOURNE LE NOMBRE DE LIGNE.
       * @Annotations\Get("/users/count/{table}",requirements = {"table"="check|reply|usergroup"})
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
      public function checkCountAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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
      }



      /**
       * RETOURNE LE NOMBRE DE LIGNE.
       * @Annotations\Get("/groups/count/{table}",requirements = {"table"="groupcheck|groupreply|usergroup"})
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
      public function groupcheckCountAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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
      }




      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE
       * @Annotations\Get("/users/search/{table}",requirements = {"table"="check|reply|usergroup"})
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
      public function checkSearchAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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
      }



      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE
       * @Annotations\Get("/groups/search/{table}",requirements = {"table"="groupcheck|groupreply|usergroup"})
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
      public function groupcheckSearchAction($table, Request $request, ParamFetcherInterface $paramFetcher)
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
      }




	  /**
       * GET POUR ENTITY radusergroup
       * @Annotations\Get("users/{username}/groups/{groupname}")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function getUsergroupAction($username,$groupname, Request $request)
      {
        $get = $this->container->get('radius.compte')->getUsergroup($username,$groupname);
		$data = $this->get('jms_serializer')->serialize($get, 'json');
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $data)));
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
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "userinfo");
			$id = $this->container->get('radius.compte')->users($request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-User-OK", 'id' => $string .'/'.$id)));
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
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "radiusgroup");
			$id = $this->container->get('radius.compte')->groups($request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-Group-OK", 'id' => $string .'/'.$id)));
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
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), $table);
			$id = $this->container->get('radius.compte')->checkReply(null,$table,$request->request->all());
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
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-OK", 'id' => $string .'/'.id)));
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
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "usergroup");
			$id = $this->container->get('radius.compte')->checkReply(null,null,$request->request->all());
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
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-Usergroup-OK", 'id' => $string .'/'.$id)));
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
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), $table);
			$id = $this->container->get('radius.compte')->checkReply( null,$table,$request->request->all());
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
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-OK", 'id' => $string .'/'.$id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


      /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/users/{id}/{table}",requirements = {"id"="\d+","table"="check|reply"})
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
      public function UserpatchAction( $id, $table, Request $request)
      {
		try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), $table);
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
  		
		$id = $this->container->get('radius.compte')->checkReply( $id ,$table,$request->request->all());	
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-User-OK", 'id' => $string .'/'.$id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



 	  /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/groups/{id}/{table}",requirements = {"id"="\d+","table"="groupcheck|groupreply"})
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
      public function GrouppatchAction( $id, $table, Request $request)
      {
  		try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), $table);
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$id = $this->container->get('radius.compte')->checkReply( $id ,$table,$request->request->all());	
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-Group-OK", 'id' => $string .'/'.$id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


	  /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/users/{username}/groups/{groupname}" )
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
      public function UsergrouppatchAction($username,$groupname,Request $request)
      {
		try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "usergroup");
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
  		$id=array($username,$groupname);
		$id = $this->container->get('radius.compte')->checkReply( $id ,null,$request->request->all());	
        $response = new Response();
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-Usergroup-OK", 'username' => $string .'/'.$id)));
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
        public function deleteUserAction( $username)
        {
            try{
			  $string = $request->getRequestUri();
              $id = $this->container->get('radius.compte')->delete($username,"userinfo");
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $response = new Response();
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-User-OK",'id' =>$string .'/'. $id)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }



 	  /**
       * SUPPRIME DANS TOUTES LES TABLES
       * @Annotations\Delete("/groups/{groupname}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @param string     $groupname
       *
       * @return Response
       * @throws NotFoundHttpException when radreply not exist
       */
        public function deleteGroupAction( $groupname)
        {

            try{
				$string = $request->getRequestUri();
              $id = $this->container->get('radius.compte')->delete($groupname,"radiusgroup");
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $response = new Response();
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-Group-OK",'id' => $string .'/'.$id)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }


    /**
     * SUPPRIME DANS UNE TABLE
     * @Annotations\Delete("/users/{username}/{table}",requirements = {"table"="check|reply"})
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
      public function deletecheckAction($version, $username, $table)
      {
          try{
			$string = $request->getRequestUri();
            $id = $this->container->get('radius.compte')->delete($username,$table);
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }
          $response = new Response();
          $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-OK",'id' => $string .'/'.$id)));
          $response->headers->set('Content-Type', 'application/json');
          return $response;
      }



    /**
     * SUPPRIME DANS UNE TABLE
     * @Annotations\Delete("/groups/{groupname}/{table}",requirements = {"table"="groupcheck|groupreply"})
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @param string     $groupname
     *
     * @return Response
     * @throws NotFoundHttpException when radreply not exist
     */
      public function deletegroupCheckAction($groupname, $table)
      {

          try{
			$string = $request->getRequestUri();
            $id = $this->container->get('radius.compte')->delete($groupname,$table);
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
            $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }
          $response = new Response();
          $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-OK",'id' => $string .'/'.$id)));
          $response->headers->set('Content-Type', 'application/json');
          return $response;
      }



     /**
       * SUPPRIME DANS TOUTES LES TABLES
       * @Annotations\Delete("/users/{username}/group/{groupname}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful"
       *   }
       * )
       *
       * @param string     $username
	   * @param string     $groupname
       *
       * @return Response
       * @throws NotFoundHttpException when radreply not exist
       */
        public function deleteUsergroupAction($username,$groupname)
        {

            try{
				$string = $request->getRequestUri();
              $id = $this->container->get('radius.compte')->deleteUsergroup($username,$groupname);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $response = new Response();
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-radusergroup-OK",'username' => $string .'/'.$id)));
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
        public function getIdAction($id, $table)
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
