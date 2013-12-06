<?php
/**
 * Time Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Handler;

use CommonApi\Exception\UnexpectedValueException;

/**
 * Time Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Time extends AbstractFieldhandler
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
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {
        } else {

            $test = strtotime($this->getFieldValue());

            if ($test == false) {
            } else {
                throw new UnexpectedValueException
                ('Validate Time: Invalid Value');
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter()
    {
        parent::filter();

        $test = strtotime($this->getFieldValue());

        if ($test == false) {
        } else {
            throw new UnexpectedValueException
            ('Validate Time: Invalid Value');
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

        $this->setFieldValue($this->filterByCharacter('ctype_digit', $this->getFieldValue()));

        return $this->getFieldValue();
    }
}
