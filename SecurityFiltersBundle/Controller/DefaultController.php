<?php

namespace Reea\SecurityFiltersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ReeaSecurityFiltersBundle:Default:index.html.twig', array('name' => $name));
    }
}
