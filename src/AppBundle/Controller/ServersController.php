<?php

namespace AppBundle\Controller;

use AppBundle\Form\ServerType;
use FOS\RestBundle\Controller\FOSRestController;

use AppBundle\Entity\Server;
use AppBundle\Manager\Server as ServerManager;
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
        $view = $this->view($this->getServerManager()->all(), 200);
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
        $entity = $this->getServerManager()->get($id);
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
        $entity = $this->getServerManager()->create();
        $form = $this->createForm(ServerType::class, $entity);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $this->getServerManager()->post($entity);
            $view = $this->view(null, Response::HTTP_CREATED);
        } else {
            $view = $this->view($form, Response::HTTP_BAD_REQUEST);
        }

        return $this->handleView($view);
    }

    /**
     * @SWG\Delete(
     *     path="/servers/{id}",
     *     tags={"Servers"},
     *     summary="Delete a server",
     *     produces={"application/json"},
     *     @SWG\Parameter( name="id", in="path", required=true, type="integer"),
     *     @SWG\Response(response="204", description="successfully deleted"),
     *     @SWG\Response(response="404", description="not found")
     * )
     *
     * @param int $id
     * @return Response
     */
    public function deleteServerAction($id)
    {
        $entity = $this->getServerManager()->get($id);
        if (!$entity) {
            throw $this->createNotFoundException("Server with id '{$id}' not found.");
        }

        $this->getServerManager()->delete($entity);

        $view = $this->view(null, Response::HTTP_NO_CONTENT);
        return $this->handleView($view);
    }

    /**
     * @return ServerManager
     */
    protected function getServerManager()
    {
        return $this->get('AppBundle\Manager\Server');
    }
}
