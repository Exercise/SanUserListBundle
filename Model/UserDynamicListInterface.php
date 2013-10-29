<?php

namespace San\UserListBundle\Model;

interface UserDynamicListInterface
{
    /**
     * @return array
     */
    public function getFilters();

    /**
     * @param array $filters
     * @return self
     */
    public function setFilters(array $filters);

    /**
     * @return string
     */
    public function getRawFilters();

    /**
     * @param string $rawFilters
     * @return  self
     */
    public function setRawFilters($rawFilters);
}
