<?php
/**
 * Required Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Required Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Required extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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
        if ($this->getFieldValue() === null) {

            if ($this->getRequired() === false) {
            } else {
                throw new UnexpectedValueException
                (
                    'Fieldhandler Required: Invalid Value'
                );
            }
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
        if ($this->getFieldValue() === null) {

            if ($this->getRequired() === false) {
            } else {
                throw new UnexpectedValueException
                (
                    'Fieldhandler Required: Invalid Value'
                );
            }
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
        if ($this->getFieldValue() === null) {

            if ($this->getRequired() === false) {
            } else {
                throw new UnexpectedValueException
                (
                    'Fieldhandler Required: Invalid Value'
                );
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
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
