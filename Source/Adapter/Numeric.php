<?php
/**
 * Numeric Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Numeric Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Numeric extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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

            $test = is_numeric($this->field_value);
            if ($test == 1) {
            } else {
                throw new UnexpectedValueException
                (
                    'Validate Numeric: Invalid Value'
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

            $test = is_numeric($this->field_value);

            if ($test == 1) {
            } else {
                $this->setFieldValue(0);
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
        $test = is_numeric($this->field_value);

        if ($test == 1) {
        } else {
            $this->setFieldValue(0);
        }

        return $this->field_value;
    }
}
