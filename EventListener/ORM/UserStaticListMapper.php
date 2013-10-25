<?php

namespace San\UserListBundle\EventListener\ORM;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

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
        if ($metadata->name == 'San\UserListBundle\Entity\UserStaticList') {
            $metadata->associationMappings['users']['targetEntity'] = $this->userClass;
            $metadata->setAssociationOverride('users', $metadata->associationMappings['users']);
        }
    }
}
