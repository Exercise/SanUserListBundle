<?php

namespace San\UserListBundle\Document;

use San\UserListBundle\Document\UserList;
use San\UserListBundle\Model\UserDynamicListInterface;
use San\UserListBundle\Model\UserDynamicListTrait;

class UserDynamicList extends UserList implements UserDynamicListInterface
{
    use UserDynamicListTrait;
}
