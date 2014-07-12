<?php

namespace Aseduis\FrontalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AseduisFrontalBundle:Default:index.html.twig', array('name' => $name));
    }
}
