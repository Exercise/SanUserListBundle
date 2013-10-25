<?php

namespace San\UserListBundle\EventListener\ODM;

use Doctrine\ODM\MongoDB\Event\LoadClassMetadataEventArgs;

class UserStaticListMapper
{
    /**
     * @var string
     */
    protected $userClass;

    /**
     * @param string $userClass
     */
    public function __construct($userClass)
    {
        $this->userClass = $userClass;
    }

    /**
     * @param  LoadClassMetadataEventArgs $args
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $metadata = $args->getClassMetadata();
        if ($metadata->name == 'San\UserListBundle\Document\UserStaticList') {
            $metadata->associationMappings['users']['targetDocument'] = $this->userClass;
            $metadata->mapManyReference($metadata->associationMappings['users']);
        }
    }
}
