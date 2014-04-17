<?php
/**
 * Notequal Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Notequal Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Notequal extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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


        $notEqual = $this->getNotEqual();

        if ($this->getFieldValue() == $notEqual) {

            throw new UnexpectedValueException
            (
                'Validate Value: ' . $this->getFieldValue() . ' must not be equal to: ' . $notEqual
            );
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


        $notEqual = $this->getNotEqual();

        if ($this->getFieldValue() == $notEqual) {
            $this->setFieldValue(null);
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


        return $this->filter();
    }

    /**
     * From value and To value
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getNotEqual()
    {
        $field_value = '';

        if (isset($this->options['not_equal'])) {
            $field_value = $this->options['not_equal'];
        }

        return $field_value;
    }
}
