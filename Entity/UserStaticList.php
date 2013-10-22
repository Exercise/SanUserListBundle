<?php

namespace San\UserBundle\Entity;

use San\UserBundle\Entity\UserList;

class UserStaticList extends UserList
{
    /**
     * @var string
     */
    protected $type = self::TYPE_STATIC;
}
