<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Server
 *
 * @ORM\Table(name="server")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServerRepository")
 */
class Server
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="cpu_count", type="integer")
     */
    private $cpuCount;

    /**
     * @var int
     *
     * @ORM\Column(name="memory_count", type="integer")
     */
    private $memoryCount;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=true)
     */
    private $ip;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Server
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set cPUCount
     *
     * @param integer $cpuCount
     *
     * @return Server
     */
    public function setCpuCount($cpuCount)
    {
        $this->cpuCount = $cpuCount;

        return $this;
    }

    /**
     * Get cPUCount
     *
     * @return int
     */
    public function getCpuCount()
    {
        return $this->cpuCount;
    }

    /**
     * Set memoryCount
     *
     * @param integer $memoryCount
     *
     * @return Server
     */
    public function setMemoryCount($memoryCount)
    {
        $this->memoryCount = $memoryCount;

        return $this;
    }

    /**
     * Get memoryCount
     *
     * @return int
     */
    public function getMemoryCount()
    {
        return $this->memoryCount;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Server
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }
}

