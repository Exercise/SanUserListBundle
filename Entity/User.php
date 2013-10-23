<?php

namespace San\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use San\UserBundle\Model\UserInterface;

class User extends BaseUser implements UserInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * Cell number
     *
     * @var integer
     */
    protected $cell;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var \DateTime
     */
    protected $registered;

    public function __construct()
    {
        parent::__construct();
        $this->registered = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getCell()
    {
        return $this->cell;
    }

    /**
     * @param mixed $cell
     */
    public function setCell($cell)
    {
        $this->cell = $cell;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get registered
     *
     * @return \DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }
}
