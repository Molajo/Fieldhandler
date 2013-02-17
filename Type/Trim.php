<?php
/**
 * Trim FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Type;

defined('MOLAJO') or die;

/**
 * Trim FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Trim extends AbstractFieldHandler
{
    /**
     * Constructor
     *
     * @param   string   $method (validate, filter, escape)
     * @param   string   $fieldhandler_type
     *
     * @param   mixed    $field_value
     * @param   null     $default
     * @param   bool     $required
     * @param   null     $min
     * @param   null     $max
     * @param   array    $field_values
     * @param   string   $regex
     * @param   object   $callback
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $fieldhandler_type,
        $field_value,
        $default = null,
        $required = true,
        $min = null,
        $max = null,
        $field_values = array(),
        $regex = null,
        $callback = null,
        $options = array()
    ) {
        return parent::__construct();
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

            $test = trim($this->getFieldValue());
            if ($test == 1) {
            } else {
                throw new FieldHandlerException
                ('Validate Trim: ' . FILTER_INVALID_VALUE);
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

            $test = trim($this->getFieldValue());
            if ($test == $this->getFieldValue()) {
            } else {
                $this->setFieldValue($test);
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
        if ($this->getFieldValue() === null) {
        } else {

            $test = trim($this->getFieldValue());
            if ($test == $this->getFieldValue()) {
            } else {
                $this->setFieldValue($test);
            }
        }

        return $this->getFieldValue();
    }
}
