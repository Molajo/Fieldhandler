<?php
/**
 * Extensions Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Handler;

use CommonApi\Exception\UnexpectedValueException;

/**
 * Extensions Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Extensions extends AbstractFieldhandler
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
     * @throws \CommonApi\Exception\UnexpectedValueException
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
                ('Validate Extensions: Invalid Value');
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

            $this->testValues(true);
        }

        $temp = $this->getFieldValue();
        if (is_array($temp)) {
            if (count($temp) === 0) {
                $this->setFieldValue(null);
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

        if (isset($this->options['array_valid_extensions'])) {
            $field_values = $this->options['array_valid_extensions'];
        }

        if (is_array($field_values) && count($field_values) > 0) {
        } else {
            return $this;
        }

        $entries = $this->getFieldValue();
        $new     = array();

        foreach ($entries as $entry) {

            if (in_array($entry, $field_values)) {
                $new[] = $entry;
            } else {

                if ($filter === true) {
                } else {
                    throw new UnexpectedValueException
                    ('Fieldhandler Extensions: Array Value is not valid');
                }
            }
        }

        $this->setFieldValue($new);

        return $this;
    }
}
