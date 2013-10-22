<?php

namespace San\UserBundle\Document;

use San\UserBundle\Document\UserList;

class UserStaticList extends UserList
{
    /**
     * @var string
     */
    protected $type = self::TYPE_STATIC;
}
