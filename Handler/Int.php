<?php
/**
 * Int FieldHandler
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
 * Int FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Int extends AbstractFieldHandler
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
        } else {

            $test = filter_var($this->getFieldValue(), FILTER_VALIDATE_INT, $this->setFlags());

            if ($test == true) {
            } else {
                throw new FieldHandlerException
                ('Validate Int: ' . FILTER_INVALID_VALUE);
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
        } else {

            $test = filter_var($this->getFieldValue(), FILTER_VALIDATE_INT, $this->setFlags());

            if ($test == true) {
            } else {
                $this->setFieldValue(filter_var($this->getFieldValue(), FILTER_SANITIZE_NUMBER_INT));
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

        $test = filter_var($this->getFieldValue(), FILTER_VALIDATE_INT, $this->setFlags());

        if ($test == true) {
        } else {
            $this->setFieldValue(filter_var($this->getFieldValue(), FILTER_SANITIZE_NUMBER_INT));
        }

        return $this->getFieldValue();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0
     */
    public function setFlags()
    {
        $filter = '';

        if (isset($this->options['FILTER_FLAG_ALLOW_OCTAL'])) {
            $filter = 'FILTER_FLAG_ALLOW_OCTAL';
        }

        if (isset($this->options['FILTER_FLAG_ALLOW_HEX'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ALLOW_HEX';
        }

        return $filter;
    }
}
