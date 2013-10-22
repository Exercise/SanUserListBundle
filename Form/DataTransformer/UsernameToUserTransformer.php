<?php

namespace San\UserBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use San\UserBundle\Model\User;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UsernameToUserTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (PersistentCollection) to a string of usernames.
     *
     * @param  \Doctrine\ORM\PersistentCollection|null $users
     * @return string
     */
    public function transform($users)
    {
        if (null === $users) {
            return '';
        }

        $usersList = array();
        $usersList = $users->map(function($user) {
            return $user->getUsername();
        });

        return implode(', ', $usersList->toArray());
    }

    /**
     * Transforms a string (userList) to an collection of objects (User).
     *
     * @param  string $username
     *
     * @return User|null
     *
     * @throws TransformationFailedException if object (User) is not found.
     */
    public function reverseTransform($userList)
    {
        if (!$userList) {
            return null;
        }

        $users = new ArrayCollection();
        $usernames = explode(',', $userList);
        $usernames = array_map(function($username) { return trim($username); }, $usernames);

        foreach ($usernames as $username) {
            $user = $this->om->getRepository('SanUserBundle:User')->findOneBy(array('username' => $username));
            if (null === $user) {
                throw new TransformationFailedException(sprintf('User with username "%s" does not exist!', $username));
            }
            $users->add($user);
        }

        return $users;
    }
}
