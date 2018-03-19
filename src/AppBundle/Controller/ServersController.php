<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

use AppBundle\Entity\Server;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return Response
     */
    public function postServersAction(Request $request)
    {
        $server = new Server();
        $server->setName($request->request->get('name'));
        $server->setCPUCount(0);
        $server->setMemoryCount(0);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($server);
        $manager->flush();

        $view = $this->view(null, Response::HTTP_CREATED);
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
