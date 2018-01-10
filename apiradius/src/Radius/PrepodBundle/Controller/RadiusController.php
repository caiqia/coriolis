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
       * get pour l'entity userinfo.
       * @Annotations\Get("/users/{username}")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string               $username     username of a user
       * @param Request              $request      the request object
       *
       * @return Response
       */
	  public function getUserAction( $username, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("userinfo", $username);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
      }



	  /**
       * get pour l'entity radiusgroup
       * @Annotations\Get("/groups/{groupname}")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string                $groupname    groupname of a group
       * @param Request               $request      the request object
       *
       * @return Response
       */
      public function getGroupAction( $groupname, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("radiusgroup", $groupname);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
      }



      /**
       * get pour l'entity radcheck.
       * @Annotations\Get("/users/{username}/check")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string               $username     username of radcheck
       * @param Request              $request      the request object
       *
       * @return Response
       */
	  public function getCheckAction( $username, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("check", $username);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
      }




      /**
       * get pour l'entity radgroupcheck.
       * @Annotations\Get("/groups/{groupname}/check")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string               $groupname    groupname of radgroupcheck
       * @param Request              $request      the request object
       *
       * @return Response
       */
	  public function getGroupcheckAction( $groupname, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("groupcheck", $groupname);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
      }



      /**
       * get pour l'entity radreply.
       * @Annotations\Get("/users/{username}/reply")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string               $username     username of radreply
       * @param Request              $request      the request object
       *
       * @return Response
       */
	  public function getReplyAction( $username, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("reply", $username);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
      }



      /**
       * get pour l'entity radgroupreply.
       * @Annotations\Get("/groups/{groupname}/reply")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string               $groupname    groupname of radgroupreply
       * @param Request              $request      the request object
       *
       * @return Response
       */
	  public function getGroupreplyAction( $groupname, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("groupreply", $groupname);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
      }



   	  /**
       * RETOURNE LE NOMBRE DE LIGNE DANS userinfo.
       * @Annotations\Get("/users/count")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="username ")
       * @Annotations\QueryParam(name="creationdate",  nullable=true, description="object creationdate")
       * @Annotations\QueryParam(name="updatedate",  nullable=true, description="object updatedate ")
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
				$response->setStatusCode(400);
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("userinfo",$search);
        $msg = "IL Y A ".$total." LIGNES DANS userinfo";
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE userinfo
       * @Annotations\Get("/users/search")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="groupname ")
       * @Annotations\QueryParam(name="creationdate",  nullable=true, description="object creationdate")
       * @Annotations\QueryParam(name="updatedate",  nullable=true, description="object updatedate ")
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
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("userinfo",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }


 	  /**
       * RETOURNE LE NOMBRE DE LIGNE DANS radiusgroup.
       * @Annotations\Get("/groups/count")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
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
				$response->setStatusCode(400);
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("radiusgroup",$search);
        $msg = "IL Y A ".$total." LIGNES DANS radiusgroup";
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response; 
      }



      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE radiusgroup
       * @Annotations\Get("/groups/search")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
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
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("radiusgroup",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




	  /**
       * RETOURNE LE NOMBRE DE LIGNE DANS radcheck.
       * @Annotations\Get("/users/count/check")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
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
      public function countCheckAction( Request $request, ParamFetcherInterface $paramFetcher){
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
            $this->container->get('radius.compte')->requestUri($string,$search,"check");
        }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
				$response->setStatusCode(400);
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("check",$search);
        $msg = "IL Y A ".$total." LIGNES DANS radcheck";
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

	  }





	  /**
       * RETOURNE LE NOMBRE DE LIGNE DANS radreply.
       * @Annotations\Get("/users/count/reply")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
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
      public function countReplyAction( Request $request, ParamFetcherInterface $paramFetcher){
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
            $this->container->get('radius.compte')->requestUri($string,$search,"reply");
        }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
				$response->setStatusCode(400);
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("reply",$search);
        $msg = "IL Y A ".$total." LIGNES DANS radreply";
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

	  }




	  /**
       * RETOURNE LE NOMBRE DE LIGNE DANS radusergroup.
       * @Annotations\Get("/users/count/groups")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="username of object")
       * @Annotations\QueryParam(name="groupname",  nullable=true, description="groupname of object")
       * @Annotations\QueryParam(name="priority",  nullable=true, description="object priority ")
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing object.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many objects to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function countuserGroupAction( Request $request, ParamFetcherInterface $paramFetcher){
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
            $this->container->get('radius.compte')->requestUri($string,$search,"usergroup");
        }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
				$response->setStatusCode(400);
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("usergroup",$search);
        $msg = "IL Y A ".$total." LIGNES DANS radusergroup";
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

	  }





	  /**
       * RETOURNE LE NOMBRE DE LIGNE DANS radgroupcheck.
       * @Annotations\Get("/groups/count/check")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="groupname",  nullable=true, description="groupname of objet")
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
      public function countGroupcheckAction( Request $request, ParamFetcherInterface $paramFetcher){
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
            $this->container->get('radius.compte')->requestUri($string,$search,"groupcheck");
        }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
				$response->setStatusCode(400);
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("groupcheck",$search);
        $msg = "IL Y A ".$total." LIGNES DANS radgroupcheck";
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

	  }





	  /**
       * RETOURNE LE NOMBRE DE LIGNE DANS radgroupreply.
       * @Annotations\Get("/groups/count/reply")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="groupname",  nullable=true, description="groupname of objet")
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
      public function countgroupReplyAction( Request $request, ParamFetcherInterface $paramFetcher){
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
            $this->container->get('radius.compte')->requestUri($string,$search,"groupreply");
        }catch(InvalidJsonException $exception){
                $msg = $exception->getMessage();
                $response = new Response();
				$response->setStatusCode(400);
                $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
      	$total = $this->container->get('radius.compte')->count("groupreply",$search);
        $msg = "IL Y A ".$total." LIGNES DANS radgroupreply";
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $msg)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

	  }



      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE radcheck
       * @Annotations\Get("/users/search/check")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="username of object")
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
      public function searchCheckAction( Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"check");
        }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("check",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



	  /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE radreply
       * @Annotations\Get("/users/search/reply")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="username of object")
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
      public function searchReplyAction( Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"reply");
        }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("reply",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




	  /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE radusergroup
       * @Annotations\Get("/users/search/groups")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="username",  nullable=true, description="username of object")
       * @Annotations\QueryParam(name="groupname",  nullable=true, description="groupname of object")
       * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing object.")
       * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, default="10", description="How many objects to return.")
       *
       *
       * @param Request               $request      the request object
       * @param ParamFetcherInterface $paramFetcher param fetcher service
       *
       * @return Response
       */
      public function searchuserGroupAction( Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"usergroup");
        }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("usergroup",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE radgroupcheck
       * @Annotations\Get("/groups/search/check")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="groupname",  nullable=true, description="groupname of object")
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
      public function searchgroupCheckAction( Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"groupcheck");
        }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("groupcheck",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




      /**
       * RETOURNE TOUS OBJECTS DANS LA TABLE radgroupreply
       * @Annotations\Get("/groups/search/reply")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @Annotations\QueryParam(name="id", requirements="\d+", nullable=true, description="object id ")
       * @Annotations\QueryParam(name="groupname",  nullable=true, description="groupname of object")
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
      public function searchgroupReplyAction( Request $request, ParamFetcherInterface $paramFetcher)
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
            $this->container->get('radius.compte')->requestUri($string,$search,"groupreply");
        }catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        unset($search['offset']);
        unset($search['limit']);
        $total = $this->container->get('radius.compte')->all("groupreply",$limit,$offset,$search);
        $data = $this->get('jms_serializer')->serialize($total, 'json');
        $response = new Response();
		$response->setStatusCode(200);
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
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param string  $username  username of object
       * @param string  $groupname groupname of object
       * @param Request  $request      the request object
       *
       * @return Response
       */
      public function getUsergroupAction($username,$groupname, Request $request)
      {
		try{
			$get = $this->container->get('radius.compte')->getUsergroup($username,$groupname);
		}catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }
        
		$data = $this->get('jms_serializer')->serialize($get, 'json');
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' => $data)));
        $response->headers->set('Content-Type', 'application/json');
        return $response; 
      }



	  /**
       * creation d'un utilisateur
       * @Annotations\Post("/users/{username}")
       * @ApiDoc(
       *    resource = true,
       *    description = "creation d'un utilisateur",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
	   * @param string  $username username of object
       * @param Request $request  the request object
       * @return Response
       */
      public function UserAction( $username, Request $request)
      {
		if($username != $request->request->all()["data"]["username"]){
			$msg = "incorrect url username ";
			$response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
		}
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "userinfo");
			$id = $this->container->get('radius.compte')->users($request->request->all());		
			$ret = implode(",", $id);
			
			var_dump($ret);
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-User-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



 	  /**
       * creation d'un group
       * @Annotations\Post("/groups/{groupname}")
       * @ApiDoc(
       *    resource = true,
       *    description = "creation d'un group",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
	   * @param string  $groupname groupname of object
       * @param Request $request   the request object
       * @return Response
       */
      public function GroupAction( $groupname, Request $request)
      {
		if( $groupname != $request->request->all()["data"]["groupname"]){
			$msg = "incorrect url groupname ";
			$response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
		}   
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "radiusgroup");
			$ret = $this->container->get('radius.compte')->groups($request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"Creation-Group-OK", 'id' => $string .'/'.$ret )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }

		

	  /**
       * post dans radcheck
       * @Annotations\Post("/users/{username}/check")
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radcheck",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
 	   * @param string  $username the username of object
       * @param Request $request the request object
       * @return Response
       */
      public function postCheckAction($username,Request $request)
      {
		if($username != $request->request->all()["data"]["username"]){
			$msg = "incorrect url username ";
			$response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
		}
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "check");
			$ret = $this->container->get('radius.compte')->checkReply(null,"check",$request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-radcheck-OK", 'id' => $string .'/'.$ret )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




      /**
       * post dans radreply
       * @Annotations\Post("/users/{username}/reply")
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radreply",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
 	   * @param string  $username the username of object
       * @param Request $request the request object
       * @return Response
       */
      public function postReplyAction($username,Request $request)
      {
		if($username != $request->request->all()["data"]["username"]){
			$msg = "incorrect url username ";
			$response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
		}
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "reply");
			$ret = $this->container->get('radius.compte')->checkReply(null,"reply",$request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-radreply-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



      /**
       * post dans radgroupcheck
       * @Annotations\Post("/groups/{groupname}/check")
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radgroupcheck",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
 	   * @param string  $groupname the groupname of object
       * @param Request $request the request object
       * @return Response
       */
      public function postgroupCheckAction($groupname,Request $request)
      {
		if( $groupname != $request->request->all()["data"]["groupname"]){
			$msg = "incorrect url groupname ";
			$response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
		}
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "groupcheck");
			$ret = $this->container->get('radius.compte')->checkReply(null,"groupcheck",$request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-radgroupcheck-OK", 'id' => $string .'/'.$ret )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




      /**
       * post dans radgroupreply
       * @Annotations\Post("/groups/{groupname}/reply")
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radgroupreply",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
 	   * @param string  $groupname the groupname of object
       * @param Request $request the request object
       * @return Response
       */
      public function postgroupReplyAction($groupname,Request $request)
      {
		if( $groupname != $request->request->all()["data"]["groupname"]){
			$msg = "incorrect url groupname ";
			$response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
		}
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "groupreply");
			$ret = $this->container->get('radius.compte')->checkReply(null,"groupreply",$request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
			
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-radgroupreply-OK", 'id' => $string .'/'.$ret)));
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
		if($username != $request->request->all()["data"]["username"]){
			$msg = "incorrect url username ";
			$response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
		}
		if($groupname != $request->request->all()["data"]["groupname"]){
			$msg = "incorrect url groupname ";
			$response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
		}
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "usergroup");
			$ret = $this->container->get('radius.compte')->checkReply(null,null,$request->request->all());
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}
		catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }
		$response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"POST-Usergroup-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }

      



 	  /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE DANS radcheck
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/users/{id}/check")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
	   * @param integer $id 	 id of object
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function patchCheckAction( $id,Request $request)
      {
		try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "check");
			$ret  = $this->container->get('radius.compte')->checkReply( $id , "check",$request->request->all());
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);	
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }	
  		
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-radcheck-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



 	  /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE DANS radreply
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/users/{id}/reply")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
	   * @param integer $id 	 id of object
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function patchReplyAction( $id,Request $request)
      {
		try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "reply");
			$ret  = $this->container->get('radius.compte')->checkReply( $id , "reply",$request->request->all());
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }	
		
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-radreply-OK", 'id' => $string .'/'.$ret )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




 	  /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE DANS radgroupcheck
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/groups/{id}/check")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
	   * @param integer $id 	 id of object
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function patchgroupCheckAction( $id,Request $request)
      {
		try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "groupcheck");
			$ret = $this->container->get('radius.compte')->checkReply( $id , "groupcheck",$request->request->all());	
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-radgroupcheck-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



 	  /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE DANS radgroupreply
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/groups/{id}/reply")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
	   * @param integer $id 	 id of object
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function patchgroupReplyAction( $id,Request $request)
      {
		try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "groupreply");
			$ret = $this->container->get('radius.compte')->checkReply( $id , "groupreply",$request->request->all());	
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-radgroupreply-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




	  /**
       * UPDATE UNE LIGNE EXISTE A PARTIR DES DONNEE DANS radusergroup
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Patch("/users/{username}/groups/{groupname}" )
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function patchuserGroupAction($username,$groupname,Request $request)
      {
		try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "usergroup");
			$id=array($username,$groupname);
			$ret = $this->container->get('radius.compte')->checkReply( $id ,null,$request->request->all());			
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }	
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-Usergroup-OK", 'username' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




      /**
       * PUT UN NOUVEAU OBJECT radusergroup
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Put("/users/{username}/groups/{groupname}")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function putUsergroupAction( $username,$groupname,Request $request)
      {
        try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "usergroup");
			$id=array($username,$groupname);
			$ret = $this->container->get('radius.compte')->checkReply( $id ,null,$request->request->all());			
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }	
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-Usergroup-OK", 'username' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




      /**
       * PUT UN NOUVEAU OBJECT radcheck
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Put("/users/{id}/check")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function putCheckAction($id, Request $request)
      {

        try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "check");
			$ret  = $this->container->get('radius.compte')->checkReply( $id , "check",$request->request->all());
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);	
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }	
  		
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-radcheck-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



      /**
       * PUT UN NOUVEAU OBJECT radreply
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Put("/users/{id}/reply")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function putReplyAction($id, Request $request)
      {

        try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "reply");
			$ret  = $this->container->get('radius.compte')->checkReply( $id , "reply",$request->request->all());
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }	
		
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-radreply-OK", 'id' => $string .'/'.$ret )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




      /**
       * PUT UN NOUVEAU OBJECT radgroupcheck
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Put("/groups/{id}/check")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function putgroupCheckAction( $id,Request $request)
      {

        try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "groupcheck");
			$ret = $this->container->get('radius.compte')->checkReply( $id , "groupcheck",$request->request->all());	
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-radgroupcheck-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }



 	  /**
       * PUT UN NOUVEAU OBJECT radgroupreply
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Put("/groups/{id}/reply")
       * @ApiDoc(
       *   resource = true,
       *   description = "PUT UN NOUVEAU OBJECT radgroupreply",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
       * @param Request $request the request object
       *
       * @return Response
       *
       */
      public function putgroupReplyAction( $id,Request $request)
      {
        try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "groupreply");
			$ret = $this->container->get('radius.compte')->checkReply( $id , "groupreply",$request->request->all());	
		}catch(InvalidJsonException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PATCH-radgroupreply-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }





	  /**
       * SUPPRIME DANS LA TABLE userinfo 
       * @Annotations\Delete("/users/{username}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param string     $username
       *
       * @return Response
       * @throws NotFoundHttpException when userinfo not exist
       */
        public function deleteUserAction( $username, Request $request)
        {
			
            try{
			  $string = $request->getRequestUri();
              $id = $this->container->get('radius.compte')->delete($username,"userinfo");
			  $ret = implode(",", $id);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-User-OK",'id' =>$string .'/'. $ret)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }



 	  /**
       * SUPPRIME DANS LA TABLE radiusgroup
       * @Annotations\Delete("/groups/{groupname}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param string     $groupname
       *
       * @return Response
       * @throws NotFoundHttpException when radiusgroup not exist
       */
        public function deleteGroupAction( $groupname, Request $request)
        {

            try{
				$string = $request->getRequestUri();
                $id = $this->container->get('radius.compte')->delete($groupname,"radiusgroup");
				$ret = implode(",", $id);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-Group-OK",'id' => $string .'/'.$ret)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }



 	/**
     * SUPPRIME DANS LA TABLE radcheck
     * @Annotations\Delete("/users/{username}/check")
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
	 *	   400 = "Returned when no ressource found"
     *   }
     * )
     *
     * @param string     $username
     *
     * @return Response
     * @throws NotFoundHttpException when radcheck not exist
     */
      public function deleteCheckAction($username, Request $request)
      {
          try{
			$string = $request->getRequestUri();
            $id = $this->container->get('radius.compte')->delete($username,"check");
			$ret = implode(",", $id);
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }
          $response = new Response();
		  $response->setStatusCode(200);
          $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-radcheck-OK",'id' => $string .'/'.$ret)));
          $response->headers->set('Content-Type', 'application/json');
          return $response;
      }




 	/**
     * SUPPRIME DANS LA TABLE radgroupcheck
     * @Annotations\Delete("/groups/{groupname}/check")
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
	 *	   400 = "Returned when no ressource found"
     *   }
     * )
     *
     * @param string     $groupname
     *
     * @return Response
     * @throws NotFoundHttpException when radgroupcheck not exist
     */
      public function deletegroupCheckAction($groupname, Request $request)
      {
          try{
			$string = $request->getRequestUri();
            $id = $this->container->get('radius.compte')->delete($groupname,"groupcheck");
			$ret = implode(",", $id);
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }
          $response = new Response();
		  $response->setStatusCode(200);
          $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-radgroupcheck-OK",'id' => $string .'/'.$ret )));
          $response->headers->set('Content-Type', 'application/json');
          return $response;
      }




 	/**
     * SUPPRIME DANS LA TABLE radreply
     * @Annotations\Delete("/users/{username}/reply")
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
	 *	   400 = "Returned when no ressource found"
     *   }
     * )
     *
     * @param string     $username
     *
     * @return Response
     * @throws NotFoundHttpException when radcheck not exist
     */
      public function deleteReplyAction($username, Request $request)
      {
          try{
			$string = $request->getRequestUri();
            $id = $this->container->get('radius.compte')->delete($username,"reply");
			$ret = implode(",", $id);
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }
          $response = new Response();
		  $response->setStatusCode(200);
          $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-radreply-OK",'id' => $string .'/'.$ret)));
          $response->headers->set('Content-Type', 'application/json');
          return $response;
      }




 	/**
     * SUPPRIME DANS LA TABLE groupreply
     * @Annotations\Delete("/groups/{groupname}/reply")
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
	 *	   400 = "Returned when no ressource found"
     *   }
     * )
     *
     * @param string     $groupname
     *
     * @return Response
     * @throws NotFoundHttpException when radgroupreply not exist
     */
      public function deletegroupReplyAction($groupname, Request $request)
      {
          try{
			$string = $request->getRequestUri();
            $id = $this->container->get('radius.compte')->delete($groupname,"groupreply");
			$ret = implode(",", $id);
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }
          $response = new Response();
		  $response->setStatusCode(200);
          $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-radgroupreply-OK",'id' => $string .'/'.$ret)));
          $response->headers->set('Content-Type', 'application/json');
          return $response;
      }





     /**
       * SUPPRIME DANS LA TABLE radusergroup
       * @Annotations\Delete("/users/{username}/groups/{groupname}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param string     $username
	   * @param string     $groupname
       *
       * @return Response
       * @throws NotFoundHttpException when radusergroup not exist
       */
        public function deleteUsergroupAction($username,$groupname,Request $request)
        {

            try{
				$string = $request->getRequestUri();
              	$ret = $this->container->get('radius.compte')->deleteUsergroup($username,$groupname);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>"DELETE-radusergroup-OK",'username' => $string .'/'.$ret)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }




      /**
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Get("/{id}/{table}",requirements = {"id"="\d+","table"="userinfo|radiusgroup|check|reply|groupcheck|groupreply"})
       * get les objects par id
       * @ApiDoc(
       *   resource = true,
       *   description = "RECUPERER UNE LIGNE AVEC ID",
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
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
              $get = $this->container->get('radius.compte')->getbyId($table, $id);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $data = $this->get('jms_serializer')->serialize($get, 'json');
            $response = new Response();
			$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$data)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }



}
