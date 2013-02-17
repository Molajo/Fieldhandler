<?php
/**
 * Accepted FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Type;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Exception\FieldHandlerException;

/**
 * Accepted FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Accepted extends AbstractFieldHandler
{
    /**
     * Constructor
     *
     * @param   string   $method
     * @param   string   $field_name
     * @param   mixed    $field_value
     * @param   array    $fieldhandler_type_chain
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        return parent::__construct($method, $field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {
        } else {

            $trueArray = $this->getTrueArray();
            $testValue = $this->getTestValue();

            if (in_array($testValue, $trueArray, true) === true) {

            } else {
                throw new FieldHandlerException
                ('Validate Accepted: ' . FILTER_INVALID_VALUE);
            }

        }

        return $this->getFieldValue();
    }

    /**
     * FieldHandler Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function filter()
    {
        parent::filter();

        if ($this->getFieldValue() === null) {
        } else {

            $trueArray = $this->getTrueArray();
            $testValue = $this->getTestValue();

            if (in_array($testValue, $trueArray, true) === true) {

            } else {
                $this->getFieldValue(null);
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape()
    {
        parent::escape();

        return $this->filter();
    }

    /**
     * Get the 'true' array
     *
     * @return  array
     * @since   1.0
     */
    public function getTrueArray()
    {
        $trueArray = array();
        $trueArray[] = true;
        $trueArray[] = 1;
        $trueArray[] = 'yes';
        $trueArray[] = 'on';

        return $trueArray;
    }

    /**
     * Get the test input value
     *
     * @return  mixed
     * @since   1.0
     */
    public function getTestValue()
    {
        $testValue = $this->getFieldValue();
        if (is_numeric($testValue) || is_bool($testValue)) {
        } else {
            $testValue = strtolower($testValue);
        }

        return $testValue;
    }
}
