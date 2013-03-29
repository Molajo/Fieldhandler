<?php
/**
 * Time FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Type;

defined('MOLAJO') or die;

/**
 * Time FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Time extends AbstractFieldHandler
{
    /**
     * Constructor
     *
     * @param string $method
     * @param string $field_name
     * @param mixed  $field_value
     * @param array  $fieldhandler_type_chain
     * @param array  $options
     *
     * @return mixed
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
     * @return mixed
     * @since   1.0
     */
    public function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {
        } else {

            $test = strtotime($this->getFieldValue());

            if ($test == false) {
            } else {
                throw new FieldHandlerException
                ('Validate Time: ' . FILTER_INVALID_VALUE);
            }
        }

        return $this->getFieldValue();
    }

    /**
     * FieldHandler Input
     *
     * @return mixed
     * @since   1.0
     */
    public function filter()
    {
        parent::filter();

        $test = strtotime($this->getFieldValue());

        if ($test == false) {
        } else {
            throw new FieldHandlerException
            ('Validate Time: ' . FILTER_INVALID_VALUE);
        }

        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return mixed
     * @since   1.0
     */
    public function escape()
    {
        parent::escape();

        $this->setFieldValue($this->filterByCharacter('ctype_digit', $this->getFieldValue()));

        return $this->getFieldValue();
    }
}
