<?php

namespace San\UserBundle\Entity;

use San\UserBundle\Model\UserDynamicListTrait;
use San\UserBundle\Entity\UserList as BaseUserList;

class UserDynamicList extends BaseUserList
{
    use UserDynamicListTrait;
}
