<?php

namespace App\Traits;

trait FieldTestInputs
{
    /**
     * @return array
     */
    public function getFieldValidInputs()
    {
        return [
            'name'      => 'field name',
            'capacity'  => 30,
        ];
    }

    /**
     * @return array
     */
    public function getFieldInvalidName()
    {
        return [
            'name'      => '',
            'capacity'  => 10,
        ];
    }

    /**
     * @return array
     */
    public function getFieldInvalidCapacity()
    {
        return [
            'name'      => 'field name',
            'capacity'  => null,
        ];
    }
}
