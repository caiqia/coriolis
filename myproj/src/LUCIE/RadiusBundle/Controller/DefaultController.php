<?php

namespace LUCIE\RadiusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LUCIERadiusBundle:Default:index.html.twig');
    }
}
