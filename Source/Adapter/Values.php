<?php
/**
 * Values Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Values Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Values extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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
        if ($this->field_value === null) {
        } else {

            $test = in_array($this->field_value, $this->getFieldValues());

            if ($test == 1) {
            } else {
                throw new UnexpectedValueException
                (
                    'Validate Values: Invalid Value'
                );
            }
        }

        return $this->field_value;
    }

    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter()
    {
        if ($this->field_value === null) {
        } else {

            $test = in_array($this->field_value, $this->getFieldValues());

            if ($test == 1) {
            } else {
                $this->setFieldValue(false);
            }
        }

        return $this->field_value;
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
        if ($this->field_value === null) {
        } else {

            $test = in_array($this->field_value, $this->getFieldValues());

            if ($test == 1) {
            } else {
                $this->setFieldValue(false);
            }
        }

        return $this->field_value;
    }

    /**
     * Test Array Entry Values
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function getFieldValues()
    {
        $field_values = array();

        if (isset($this->options['array_valid_values'])) {
            $field_values = $this->options['array_valid_values'];
        }

        return $field_values;
    }
}
