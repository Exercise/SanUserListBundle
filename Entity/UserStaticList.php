<?php

namespace San\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use San\UserBundle\Entity\UserList;
use San\UserBundle\Model\UserStaticListTrait;

class UserStaticList extends UserList
{
    use UserStaticListTrait;

    public function __construct()
    {
        parent::__construct();
        $this->users = new ArrayCollection();
    }
}
