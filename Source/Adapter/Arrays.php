<?php
/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Arrays Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Arrays extends AbstractFieldhandler implements FieldhandlerAdapterInterface
{
    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
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
                (
                    'Validate Array: Invalid Value'
                );
            }

            $this->testValues();
        }

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
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
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
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
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
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
                    (
                        'Fieldhandler Arrays: Array Value is not valid'
                    );
                }
            }
        }

        $this->setFieldValue($entries);

        return $this;
    }
}
