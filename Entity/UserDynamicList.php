<?php

namespace San\UserBundle\Entity;

use San\UserBundle\Entity\UserList;

class UserDynamicList extends UserList
{
    /**
     * @var string
     */
    protected $type = self::TYPE_DYNAMIC;
}
