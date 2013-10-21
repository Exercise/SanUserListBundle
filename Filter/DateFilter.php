<?php

namespace San\UserBundle\Filter;

use Sonata\DoctrineORMAdminBundle\Filter\AbstractDateFilter;

class DateFilter extends AbstractDateFilter
{
    /**
     * {@inheritdoc}
     */
    protected function getOperator($type)
    {
        return '>=';
    }

    /**
     * {@inheritdoc}
     */
    public function getRenderSettings()
    {
        $name = 'san_type_filter_date';

        if ($this->time) {
            $name .= 'time';
        }

        if ($this->range) {
            $name .= '_range';
        }

        return array($name, array(
            'field_type'    => $this->getFieldType(),
            'field_options' => $this->getFieldOptions(),
            'label'         => $this->getLabel(),
        ));
    }
}
