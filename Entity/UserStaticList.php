<?php

namespace San\UserListBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use San\UserListBundle\Entity\UserList;
use San\UserListBundle\Model\UserStaticListTrait;

class UserStaticList extends UserList
{
    use UserStaticListTrait;

    public function __construct()
    {
        parent::__construct();
        $this->users = new ArrayCollection();
    }
}
