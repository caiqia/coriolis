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
       * @Annotations\Get("/users/{id}")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param integer              $id           id of a user
       * @param Request              $request      the request object
       * @throws NotFoundHttpException when userinfo doesn't exist
       *
       *
       * @return Response
       */
	  public function getUserAction( $id, Request $request)
      {
          try{
              $get = array();
              $get[] = $this->container->get('radius.compte')->getbyId("userinfo", $id);
              $name = $this->container->get('radius.compte')->idtoName($id);
              $bill_id = $this->container->get('radius.compte')->nametoId($name)["userbillinfo"];
              $get[] = $this->container->get('radius.compte')->getbyId("userbillinfo", $bill_id);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * get pour l'entity groupinfo
       * @Annotations\Get("/groups/{groupname}")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string                $groupname    groupname of a group
       * @param Request               $request      the request object
       * @throws NotFoundHttpException when groupinfo doesn't exist
       *
       *
       * @return Response
       */
      public function getGroupAction( $groupname, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("groupinfo", $groupname);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * @Annotations\Get("/users/{id}/check")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param integer              $id           id of radcheck
       * @param Request              $request      the request object
       * @throws NotFoundHttpException when radcheck doesn't exist
       *
       *
       * @return Response
       */
	  public function getCheckAction( $id, Request $request)
      {
            try{
			  $username = $this->container->get('radius.compte')->idtoName( $id );
              $get = $this->container->get('radius.compte')->getbyUsername("check", $username);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string               $groupname    groupname of radgroupcheck
       * @param Request              $request      the request object
       * @throws NotFoundHttpException when groupcheck doesn't exist
       *
       *
       * @return Response
       */
	  public function getGroupcheckAction( $groupname, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("groupcheck", $groupname);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * @Annotations\Get("/users/{id}/reply")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param integer              $id           id of radreply
       * @param Request              $request      the request object
       * @throws NotFoundHttpException when radreply doesn't exist
       *
       *
       * @return Response
       */
	  public function getReplyAction( $id, Request $request)
      {
            try{
			  $username = $this->container->get('radius.compte')->idtoName( $id );
              $get = $this->container->get('radius.compte')->getbyUsername("reply", $username);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       *
       * @param string               $groupname    groupname of radgroupreply
       * @param Request              $request      the request object
       * @throws NotFoundHttpException when groupreply doesn't exist
       *
       *
       * @return Response
       */
	  public function getGroupreplyAction( $groupname, Request $request)
      {
            try{
              $get = $this->container->get('radius.compte')->getbyUsername("groupreply", $groupname);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * obtenir id dans userinfo avec username
       * @Annotations\Post("/users/name")
       * @ApiDoc(
       *    resource = true,
       *    description = "obtenir id dans userinfo avec username",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param Request $request  the request object
       * @throws NotFoundHttpException when username doesn't exist in userinfo
       *
       * @return Response
       */
	  public function nametoIdAction( Request $request){
 	    try{
              $get = $this->container->get('radius.compte')->nametoId($request->request->all()["data"]["username"])["userinfo"];
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
	      	  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }
            $response = new Response();
	    	$response->setStatusCode(200);
            $response->setContent(json_encode(array('success' => TRUE,'msg' =>$get)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}




      /**
       * GET POUR ENTITY radusergroup
       * @Annotations\Get("users/{id}/groups/{groupname}")
       *
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param integer  $id  id of object
       * @param string  $groupname groupname of object
       * @param Request  $request      the request object
       * @throws NotFoundHttpException when usergroup doesn't exist
       *
       *
       * @return Response
       */
      public function getUsergroupAction($id,$groupname, Request $request)
      {
		try{
			$get = $this->container->get('radius.compte')->getUsergroup($id,$groupname);
		}catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * @Annotations\Post("/users")
       * @ApiDoc(
       *    resource = true,
       *    description = "creation d'un utilisateur",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param Request $request  the request object
       * @throws InvalidJsonException when format data is incorrect
       * @throws UniqueConstraintViolationException when userinfo is not unique
       *
       * @return Response
       */
      public function UserAction( Request $request)
      {
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "userinfo");
			$id = $this->container->get('radius.compte')->users($request->request->all());		
			$ret = implode(",", $id);
 		}catch(UniqueConstraintViolationException $exception){
			$msg = "UniqueConstraintViolation : ".$exception->getErrorCode();
                        $response = new Response();
			$response->setStatusCode(400);
                        $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                        $response->headers->set('Content-Type', 'application/json');
                        return $response;
		}catch(InvalidJsonException $exception){
                        $msg = $exception->getMessage()." avec code: ".$exception->getCode();
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
       * @throws InvalidJsonException when format data is incorrect
       * @throws UniqueConstraintViolationException when groupinfo is not unique
       *
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
                        $msg = $exception->getMessage()." avec code: ".$exception->getCode();
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
       * @Annotations\Post("/users/{id}/check")
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radcheck",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param integer  $id the id of object
       * @param Request $request the request object
       * @throws NotFoundHttpException when id of username not exist
       * @throws InvalidJsonException when format data is incorrect
       * @throws UniqueConstraintViolationException when radcheck is not unique
       * @throws ForeignKeyConstraintViolationException  when user doesn't exist previously
       *                      
       * @return Response
       */
      public function postCheckAction($id,Request $request)
      {
		
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "check");
			$this->container->get('radius.compte')->compareName($id, $request->request->all());
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
                    $msg = $exception->getMessage()." avec code: ".$exception->getCode();
                    $response = new Response();
	    	    $response->setStatusCode(400);
                    $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                    $response->headers->set('Content-Type', 'application/json');
                    return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
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
       * @Annotations\Post("/users/{id}/reply")
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radreply",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param integer $id the id of object
       * @param Request $request the request object
       * @throws NotFoundHttpException when id of username not exist
       * @throws InvalidJsonException when format data is incorrect
       * @throws ForeignKeyConstraintViolationException  when user doesn't exist previously
       *                      
       * @return Response
       */
      public function postReplyAction($id,Request $request)
      {
		
		try{
			$string = $request->getRequestUri(); 
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "reply");
			$this->container->get('radius.compte')->compareName($id, $request->request->all());
			$ret = $this->container->get('radius.compte')->checkReply(null,"reply",$request->request->all());
 		}catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
                        $response = new Response();
			$response->setStatusCode(400);
                        $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                        $response->headers->set('Content-Type', 'application/json');
                        return $response;
		}catch(InvalidJsonException $exception){
                        $msg = $exception->getMessage()." avec code: ".$exception->getCode();
                        $response = new Response();
	    	        $response->setStatusCode(400);
                        $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
                        $response->headers->set('Content-Type', 'application/json');
                        return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
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
       * @throws InvalidJsonException when format data is incorrect
       * @throws UniqueConstraintViolationException when groupcheck is not unique
       * @throws ForeignKeyConstraintViolationException  when user or group doesn't exist previously
       *                      
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
            $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * @throws InvalidJsonException when format data is incorrect
       * @throws ForeignKeyConstraintViolationException  when groupinfo doesn't exist previously
       *                      
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
 		}catch(ForeignKeyConstraintViolationException $exception){
			$msg = "ForeignKeyConstraintViolation : ".$exception->getErrorCode();
                        $response = new Response();
			$response->setStatusCode(400);
                        $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
		}catch(InvalidJsonException $exception){
			
            $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * @Annotations\Post("/users/{id}/groups/{groupname}")
       * @ApiDoc(
       *    resource = true,
       *    description = "post dans radusergroup",
       *    statusCodes = {
       *        200 = "returned when successful",
       *        400 = "returned when the data has errors"
       *    }
       * )
       * @param integer     $id
       * @param string $groupname
       * @param Request $request the request object
       * @throws NotFoundHttpException when id of username not exist
       * @throws InvalidJsonException when format data is incorrect
       * @throws UniqueConstraintViolationException when usergroup is not unique
       * @throws ForeignKeyConstraintViolationException  when user or group doesn't exist previously
       *        
       *        
       * @return Response
       */
      public function userGroupAction($id,$groupname, Request $request)
      {
		
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
			$this->container->get('radius.compte')->compareName($id, $request->request->all());
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
            $msg = $exception->getMessage()." avec code: ".$exception->getCode();
            $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
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
       * PUT UN NOUVEAU OBJECT radusergroup
       * @Annotations\Route(condition="request.attributes.get('version') == 'v1'")
       * @Annotations\Put("/users/{id}/groups/{groupname}")
       * @ApiDoc(
       *   resource = true,
       *   description = "UPDATE UNE NOUVELLE LIGNE A PARTIR DES DONNEE",
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when the data has errors"
       *   }
       * )
       *
       * @param integer     $id
       * @param string $groupname
       * @param Request $request the request object
       * @throws NotFoundHttpException when usergroup not exist
       * @throws InvalidJsonException when format data is incorrect
       *        
       *
       * @return Response
       *
       */
      public function putUsergroupAction( $id,$groupname,Request $request)
      {
        try{
			$string = $request->getRequestUri();
			$this->container->get('radius.compte')->jsonVeri($request->request->all(), "usergroup");
			$id=array($id,$groupname);
			$ret = $this->container->get('radius.compte')->checkReply( $id ,null,$request->request->all());			
		}catch(InvalidJsonException $exception){
                        $msg = $exception->getMessage()." avec code: ".$exception->getCode();
                        $response = new Response();
			$response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
			  $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
            }	
        $response = new Response();
		$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PUT-Usergroup-OK", 'username' => $string .'/'.$ret)));
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
       * @param integer     $id
       * @param Request $request the request object
       * @throws NotFoundHttpException when radreply not exist
       * @throws InvalidJsonException when format data is incorrect
       *
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
            $msg = $exception->getMessage()." avec code: ".$exception->getCode();
            $response = new Response();
	    $response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
	      $response->setStatusCode(400);	
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }	
  		
        $response = new Response();
	$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PUT-radcheck-OK", 'id' => $string .'/'.$ret)));
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
       * @param integer     $id
       * @param Request $request the request object
       * @throws NotFoundHttpException when radreply not exist
       * @throws InvalidJsonException when format data is incorrect
       *        
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
            $msg = $exception->getMessage()." avec code: ".$exception->getCode();
            $response = new Response();
	    $response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
	      $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }	
		
        $response = new Response();
	$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PUT-radreply-OK", 'id' => $string .'/'.$ret )));
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
       * @param integer     $id
       * @throws NotFoundHttpException when groupcheck not exist
       * @throws InvalidJsonException when format data is incorrect
       *        
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
            $msg = $exception->getMessage()." avec code: ".$exception->getCode();
            $response = new Response();
	    $response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
	      $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }
        $response = new Response();
	$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PUT-radgroupcheck-OK", 'id' => $string .'/'.$ret)));
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
       * @param integer     $id
       * @throws NotFoundHttpException when groupreply not exist
       * @throws InvalidJsonException when format data is incorrect
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
            $msg = $exception->getMessage()." avec code: ".$exception->getCode();
            $response = new Response();
	    $response->setStatusCode(400);
            $response->setContent(json_encode(array('success' => FALSE,'msg' => $msg)));
            $response->headers->set('Content-Type', 'application/json');
           return $response;
          }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
              $response = new Response();
	      $response->setStatusCode(400);
              $response->setContent(json_encode(array('success' => FALSE,'msg' =>$msg)));
              $response->headers->set('Content-Type', 'application/json');
              return $response;
          }
        $response = new Response();
	$response->setStatusCode(200);
        $response->setContent(json_encode(array('success' => TRUE,'msg' =>"PUT-radgroupreply-OK", 'id' => $string .'/'.$ret)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
      }




  	  /**
       * SUPPRIME DANS LA TABLE userinfo 
       * @Annotations\Delete("/users/{id}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param Request $request the request object
       * @param integer     $id
       *
       * @return Response
       * @throws NotFoundHttpException when userinfo not exist
       */
        public function deleteUserAction( $id, Request $request)
        {
			
            try{
                $del_id = array();
                $string = $request->getRequestUri();
                $name = $this->container->get('radius.compte')->idtoName($id);
                $bill_id = $this->container->get('radius.compte')->nametoId($name)["userbillinfo"];
                $del_id[] = $this->container->get('radius.compte')->delete($id,"userinfo",$request->request->all());
                $del_id[] = $this->container->get('radius.compte')->delete($bill_id,"userbillinfo",$request->request->all());
                $ret = implode(",", $del_id);
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * SUPPRIME DANS LA TABLE groupinfo
       * @Annotations\Delete("/groups/{id}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param integer     $id
       * @param Request $request the request object
       *
       * @return Response
       * @throws NotFoundHttpException when groupinfo not exist
       */
        public function deleteGroupAction( $id, Request $request)
        {

            try{
		$string = $request->getRequestUri();
                $ret = $this->container->get('radius.compte')->delete($id,"groupinfo",$request->request->all());
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
     * @Annotations\Delete("/users/{id}/check")
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
	 *	   400 = "Returned when no ressource found"
     *   }
     * )
     *
     * @param integer     $id
     * @param Request $request the request object
     *
     * @return Response
     * @throws NotFoundHttpException when radcheck not exist
     */
      public function deleteCheckAction($id, Request $request)
      {
          try{
			$string = $request->getRequestUri();
            $ret = $this->container->get('radius.compte')->delete($id,"check",$request->request->all());
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
     * @Annotations\Delete("/groups/{id}/check")
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
	 *	   400 = "Returned when no ressource found"
     *   }
     * )
     *
     * @param integer     $id
     * @param Request $request the request object
     *
     * @return Response
     * @throws NotFoundHttpException when radgroupcheck not exist
     */
      public function deletegroupCheckAction($id, Request $request)
      {
          try{
			$string = $request->getRequestUri();
            $ret = $this->container->get('radius.compte')->delete($id,"groupcheck",$request->request->all());
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
     * @Annotations\Delete("/users/{id}/reply")
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
	 *	   400 = "Returned when no ressource found"
     *   }
     * )
     *
     * @param  integer     $id
     * @param Request $request the request object
     *
     * @return Response
     * @throws NotFoundHttpException when radcheck not exist
     */
      public function deleteReplyAction($id, Request $request)
      {
          try{
			$string = $request->getRequestUri();
            $ret = $this->container->get('radius.compte')->delete($id,"reply",$request->request->all());
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
     * @Annotations\Delete("/groups/{id}/reply")
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
	 *	   400 = "Returned when no ressource found"
     *   }
     * )
     *
     * @param integer     $id
     * @param Request $request the request object
     *
     * @return Response
     * @throws NotFoundHttpException when radgroupreply not exist
     */
      public function deletegroupReplyAction($id, Request $request)
      {
          try{
			$string = $request->getRequestUri();
            $ret = $this->container->get('radius.compte')->delete($id,"groupreply",$request->request->all());
          }catch(NotFoundHttpException $exception){
            $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       * @Annotations\Delete("/users/{id}/groups/{groupname}")
       * @ApiDoc(
       *   resource = true,
       *   statusCodes = {
       *     200 = "Returned when successful",
	   *	 400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param integer     $id
       * @param Request $request the request object
       *
       * @param string     $groupname
       *
       * @return Response
       * @throws NotFoundHttpException when radusergroup not exist
       */
        public function deleteUsergroupAction($id,$groupname,Request $request)
        {
            try{
		$string = $request->getRequestUri();
              	$ret = $this->container->get('radius.compte')->deleteUsergroup($id,$groupname,$request->request->all());
            }catch(NotFoundHttpException $exception){
              $msg = $exception->getMessage()." avec code: ".$exception->getStatusCode();
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
       *     400 = "Returned when no ressource found"
       *   }
       * )
       *
       * @param integer     $id      the object id
       * @param string      $table   the name of table
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
