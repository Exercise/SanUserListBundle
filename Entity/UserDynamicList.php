<?php

namespace San\UserListBundle\Entity;

use San\UserListBundle\Model\UserDynamicListTrait;
use San\UserListBundle\Entity\UserList as BaseUserList;

class UserDynamicList extends BaseUserList
{
    use UserDynamicListTrait;
}
