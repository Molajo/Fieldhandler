<?php
/**
 * Required FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Handler;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Exception\FieldHandlerException;

use Molajo\FieldHandler\Api\FieldHandlerInterface;

/**
 * Required FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Required extends AbstractFieldHandler
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
    protected function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {

            if ($this->getRequired() === false) {
            } else {
                throw new FieldHandlerException
                ('FieldHandler Required: ' . FILTER_INVALID_VALUE);
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
    protected function filter()
    {
        parent::filter();

        if ($this->getFieldValue() === null) {

            if ($this->getRequired() === false) {
            } else {
                throw new FieldHandlerException
                ('FieldHandler Required: ' . FILTER_INVALID_VALUE);
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
    protected function escape()
    {
        parent::escape();

        if ($this->getFieldValue() === null) {

            if ($this->getRequired() === false) {
            } else {
                throw new FieldHandlerException
                ('FieldHandler Required: ' . FILTER_INVALID_VALUE);
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
    public function getRequired()
    {
        $field_value = false;

        if (isset($this->options['required'])) {
            $field_value = true;
        }

        return $field_value;
    }
}
