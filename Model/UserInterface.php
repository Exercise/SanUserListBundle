<?php

namespace San\UserBundle\Model;

use FOS\UserBundle\Model\UserInterface;

interface UserInterface extends UserInterface
{
    public function getId();

    public function getCell();

    public function setCell($cell);

    public function getFirstName();

    public function setFirstName($firstName);

    public function getLastName();

    public function setLastName($lastName);

    public function getRegistered();
}
