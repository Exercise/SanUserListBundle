<?php

namespace San\UserBundle\Model;

trait UserDynamicListTrait
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
     * @var string
     */
    protected $rawFilters;

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

    /**
     * @return string
     */
    public function getRawFilters()
    {
        return $this->rawFilters;
    }

    /**
     * @param string $rawFilters
     * @return  self
     */
    public function setRawFilters($rawFilters)
    {
        $this->rawFilters = $rawFilters;

        return $this;
    }
}
