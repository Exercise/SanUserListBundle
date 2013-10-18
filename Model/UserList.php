<?php

namespace Exercise\EPUserBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Exercise\EPUserBundle\Model\EPUserInterface;

class UserList
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $users;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Add user
     *
     * @param \Exercise\EPUserBundle\Model\EPUserInterface $user
     * @return UserList
     */
    public function addUser(EPUserInterface $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Exercise\EPUserBundle\Model\EPUserInterface $user
     */
    public function removeUser(EPUserInterface $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
