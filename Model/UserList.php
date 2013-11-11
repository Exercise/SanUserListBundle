<?php

namespace San\UserListBundle\Model;

use Doctrine\ORM\Mapping as ORM;

class UserList
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var array
     */
    protected $filters;

    /**
     * @var string
     */
    protected $rawFilters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return UserList
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
     * Set description
     *
     * @param string $description
     * @return UserList
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     * @return self
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * @return string
     */
    public function getRawFilters()
    {
        return $this->rawFilters;
    }

    /**
     * @param string $rawFilters
     * @return  self
     */
    public function setRawFilters($rawFilters)
    {
        $this->rawFilters = $rawFilters;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
