<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SwaggerController extends Controller
{
    /**
     * @return Response
     */
    public function jsonAction()
    {
        $swagger = \Swagger\scan($this->get('kernel')->getRootDir() . '/../src');
        return new JsonResponse($swagger);
    }
}
