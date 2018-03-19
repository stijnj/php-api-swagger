<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

use AppBundle\Entity\Server;
use Symfony\Component\HttpFoundation\Response;

class ServersController extends FOSRestController
{
    /**
     * @return Response
     */
    public function getServersAction()
    {
        $view = $this->view($this->getServerRepository()->findAll(), 200);
        return $this->handleView($view);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getServerAction($id)
    {
        $entity = $this->getServerRepository()->findOneBy(['id' => $id]);
        if (!$entity) {
            throw $this->createNotFoundException("Server with id '{$id}' not found.");
        }

        $view = $this->view($entity, 200);
        return $this->handleView($view);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getServerRepository()
    {
        return $this->getDoctrine()->getRepository(Server::class);
    }
}
