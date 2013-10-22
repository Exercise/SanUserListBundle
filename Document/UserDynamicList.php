<?php

namespace San\UserBundle\Document;

use San\UserBundle\Document\UserList;

class UserDynamicList extends UserList
{
    /**
     * @var string
     */
    protected $type = self::TYPE_DYNAMIC;
}
