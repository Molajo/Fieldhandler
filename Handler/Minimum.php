<?php
/**
 * Minimum FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Handler;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Exception\FieldHandlerException;

/**
 * Minimum FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Minimum extends AbstractFieldHandler
{
    /**
     * Constructor
     *
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $fieldhandler_type_chain
     * @param   array  $options
     *
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        parent::__construct($method, $field_name, $field_value, $fieldhandler_type_chain, $options);
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

            if ($this->getFieldValue() > $this->getMinimum()) {
            } else {
                throw new FieldHandlerException
                ('Validate Minimum: ' . FILTER_INVALID_VALUE);
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

            if ($this->getFieldValue() > $this->getMinimum()) {
            } else {
                $this->setFieldValue($this->getMinimum());
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

        if ($this->getFieldValue() === null) {
        } else {

            if ($this->getFieldValue() > $this->getMinimum()) {
            } else {
                $this->setFieldValue($this->getMinimum());
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0
     */
    public function getMinimum()
    {
        $field_value = '';

        if (isset($this->options['minimum'])) {
            $field_value = $this->options['minimum'];
        }

        return $field_value;
    }
}
