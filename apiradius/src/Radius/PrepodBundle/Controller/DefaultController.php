<?php

namespace Radius\PrepodBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RadiusPrepodBundle:Default:index.html.twig');
    }
}
