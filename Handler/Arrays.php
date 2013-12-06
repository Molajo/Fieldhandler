<?php
/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Handler;

use CommonApi\Exception\UnexpectedValueException;

/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Arrays extends AbstractFieldhandler
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

            $test = is_array($this->getFieldValue());

            if ($test == 1) {
            } else {
                throw new UnexpectedValueException
                ('Validate Array: Invalid Value');
            }

            $this->testValues();
        }

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function filter()
    {
        parent::filter();

        if ($this->getFieldValue() === null) {
        } else {

            $test = is_array($this->getFieldValue());

            if ($test == 1) {
            } else {
                $temp   = array();
                $temp[] = $this->getFieldValue();
                $this->setFieldValue($temp);
            }

            $this->testValues();
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

        $this->filter();

        return $this->getFieldValue();
    }

    /**
     * Test Array Entry Values
     *
     * @param   bool $filter
     *
     * @return  mixed
     * @since   1.0
     */
    public function testValues($filter = false)
    {
        $field_values = array();

        if (isset($this->options['array_valid_values'])) {
            $field_values = $this->options['array_valid_values'];
        }

        if (is_array($field_values) && count($field_values) > 0) {
        } else {
            return $this;
        }

        $entries = $this->getFieldValue();

        foreach ($entries as $entry) {

            if (in_array($entry, $field_values)) {
            } else {

                if ($filter === true) {
                    unset ($entry);
                } else {
                    throw new UnexpectedValueException
                    ('Fieldhandler Arrays: Array Value is not valid');
                }
            }
        }

        $this->setFieldValue($entries);

        return $this;
    }
}
