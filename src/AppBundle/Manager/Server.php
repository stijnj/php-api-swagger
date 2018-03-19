<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Server as ServerEntity;
use AppBundle\Repository\ServerRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormBuilderInterface;

class Server
{
    /**
     * @var ServerRepositoryInterface
     */
    protected $repository;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var FormBuilderInterface
     */
    protected $formBuilder;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return ServerEntity
     */
    public function create()
    {
        return new ServerEntity();
    }

    /**
     * @param int $id
     * @return ServerEntity
     */
    public function get($id)
    {
        return $this->getServerRepository()->findOneById($id);
    }

    /**
     * @return ServerEntity[]
     */
    public function all()
    {
        return $this->getServerRepository()->findAll();
    }

    /**
     * @param ServerEntity $entity
     */
    public function delete(ServerEntity $entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    /**
     * @param ServerEntity $entity
     */
    public function post(ServerEntity $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * @return ServerRepositoryInterface
     */
    protected function getServerRepository()
    {
        return $this->em->getRepository(ServerEntity::class);
    }
}