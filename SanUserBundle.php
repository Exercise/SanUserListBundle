<?php

namespace San\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SanUserBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
