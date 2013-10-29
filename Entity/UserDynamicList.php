<?php

namespace San\UserListBundle\Entity;

use San\UserListBundle\Entity\UserList;
use San\UserListBundle\Model\UserDynamicListInterface;
use San\UserListBundle\Model\UserDynamicListTrait;

class UserDynamicList extends UserList implements UserDynamicListInterface
{
    use UserDynamicListTrait;
}
