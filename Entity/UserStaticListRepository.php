<?php

namespace San\UserListBundle\Entity;

use Doctrine\ORM\EntityRepository;
use San\UserListBundle\Entity\UserStaticList;

class UserStaticListRepository extends EntityRepository
{
    /**
     * @param  UserStaticList $userStaticList
     * @return array
     */
    public function getEmailsByList(UserStaticList $userStaticList)
    {
        return $this
            ->createQueryBuilder('usl')
            ->innerJoin('usl.users', 'u')
            ->select('u.email, u.username')
            ->getQuery()
            ->execute()
        ;
    }
}
