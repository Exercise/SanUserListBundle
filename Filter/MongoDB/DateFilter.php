<?php

namespace San\UserListBundle\Filter\MongoDB;

use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\Type\Filter\DateType;
use Sonata\DoctrineMongoDBAdminBundle\Filter\AbstractDateFilter;

class DateFilter extends AbstractDateFilter
{
    /**
     * {@inheritdoc}
     */
    protected function getOperator($type)
    {
        return 'gte';
    }

    /**
     * {@inheritdoc}
     */
    public function filter(ProxyQueryInterface $queryBuilder, $alias, $field, $data)
    {
        $data['type'] = DateType::TYPE_GREATER_EQUAL;

        return parent::filter($queryBuilder, $alias, $field, $data);
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
