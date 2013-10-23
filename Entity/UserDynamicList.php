<?php

namespace San\UserBundle\Entity;

use San\UserBundle\Entity\UserList;

class UserDynamicList extends UserList
{
    /**
     * @var string
     */
    protected $type = self::TYPE_DYNAMIC;

    /**
     * @var array
     */
    protected $filters;

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     * @return self
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;

        return $this;
    }
}
