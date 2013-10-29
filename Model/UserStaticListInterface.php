<?php

namespace San\UserListBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\UserInterface;

interface UserStaticListInterface
{
    /**
     * Add user
     *
     * @param \San\UserBundle\Model\UserInterface $user
     * @return UserList
     */
    public function addUser(UserInterface $user);

    /**
     * Remove user
     *
     * @param \San\UserBundle\Model\UserInterface $user
     */
    public function removeUser(UserInterface $user);

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers();

    /**
     * @param ArrayCollection $users
     * @return self
     */
    public function setUsers(ArrayCollection $users);

    /**
     * @return integer
     */
    public function getUsersNumber();
}
