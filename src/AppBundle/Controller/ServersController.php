<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServersController extends FOSRestController
{
    /**
     * @return View
     */
    public function getServersAction(Request $request)
    {
        $view = $this->view(['servers'=>[]], 200);
        return $this->handleView($view);
    }
}
