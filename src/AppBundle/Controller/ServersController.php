<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Server;

class ServersController extends FOSRestController
{
    /**
     * @return View
     */
    public function getServersAction()
    {
        $view = $this->view($this->getServerRepository()->findAll(), 200);
        return $this->handleView($view);
    }

    protected function getServerRepository()
    {
        return $this->getDoctrine()->getRepository(Server::class);
    }
}
