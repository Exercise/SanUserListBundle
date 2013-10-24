<?php

namespace San\UserListBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use San\UserListBundle\Document\UserList;
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
