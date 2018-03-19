<?php

namespace AppBundle\Repository;


interface ServerRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findOneById($id);

    /**
     * @return mixed
     */
    public function findAll();
}