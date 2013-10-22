<?php

namespace San\UserBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use San\UserBundle\Model\UserInterface;

class UserList
{
    const TYPE_STATIC = 'static';
    const TYPE_DYNAMIC = 'dynamic';

    public static $types = array(
        self::TYPE_STATIC,
        self::TYPE_DYNAMIC
    );

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
        $this->users = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
