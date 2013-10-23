<?php

namespace San\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use San\UserBundle\Entity\UserList;
use San\UserBundle\Model\UserInterface;

class UserStaticList extends UserList
{
    /**
     * @var string
     */
    protected $type = self::TYPE_STATIC;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $users;

    public function __construct()
    {
        parent::__construct();
        $this->users = new ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \San\UserBundle\Model\UserInterface $user
     * @return UserList
     */
    public function addUser(UserInterface $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \San\UserBundle\Model\UserInterface $user
     */
    public function removeUser(UserInterface $user)
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

    /**
     * @param ArrayCollection $users
     * @return self
     */
    public function setUsers(ArrayCollection $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUsersNumber()
    {
        return $this->users->count();
    }
}
