<?php

namespace San\UserListBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;
use San\UserListBundle\Document\UserStaticList;

class UserStaticListRepository extends DocumentRepository
{
    /**
     * @param  UserStaticList $userStaticList
     * @return array
     */
    public function getEmailsByList(UserStaticList $userStaticList)
    {
        $usersIds = $this
            ->createQueryBuilder()
            ->field('id')->equals(new \MongoId($userStaticList->getId()))
            ->distinct('users.$id')
            ->getQuery()
            ->execute()
        ;

        $userRepository = $this->dm->getRepository($this->class->fieldMappings['users']['targetDocument']);

        return $userRepository
            ->createQueryBuilder()
            ->select('email', 'username')
            ->field('id')->in($usersIds->toArray())
            ->hydrate(false)
            ->getQuery()
            ->execute()
        ;
    }
}
