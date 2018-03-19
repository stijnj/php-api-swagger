<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

use AppBundle\Entity\Server;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;

/**
 * @SWG\Swagger(
 *  @SWG\Info(title="Servers API", version="1")
 * )
 */
class ServersController extends FOSRestController
{
    /**
     * @SWG\Get(
     *     path="/servers",
     *     tags={"Servers"},
     *     summary="List all available servers",
     *     produces={"application/json"},
     *     @SWG\Response(response="200", description="successful operation")
     * )
     *
     * @return Response
     */
    public function getServersAction()
    {
        $view = $this->view($this->getServerRepository()->findAll(), 200);
        return $this->handleView($view);
    }

    /**
     * @SWG\Get(
     *     path="/servers/{id}",
     *     tags={"Servers"},
     *     summary="Show details of a single server",
     *     produces={"application/json"},
     *     @SWG\Parameter( name="id", in="path", required=true, type="integer"),
     *     @SWG\Response(response="200", description="successful operation"),
     *     @SWG\Response(response="404", description="not found")
     * )
     *
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
     * @SWG\Post(
     *     path="/servers",
     *     tags={"Servers"},
     *     summary="Add a new server to the list",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Server object that needs to be added to the list",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Server"),
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Server created",
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input",
     *     )
     * )
     * @param Request $request
     * @return Response
     */
    public function postServersAction(Request $request)
    {
        $server = new Server();
        $server->setName($request->request->get('name'));
        $server->setCpuCount(0);
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
