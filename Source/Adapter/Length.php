<?php
/**
 * Stringlength Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Stringlength Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Stringlength extends AbstractFieldhandler implements FieldhandlerAdapterInterface
{
    /**
     * Validate Input
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        $from_to = $this->getFromto();

        $string_length = strlen(trim($this->field_value));

        if ($string_length >= $from_to[0]
            && $string_length <= $from_to[1]
        ) {
            return true;
        }

        $this->setErrorMessage(8000);

        return false;
    }

    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        if ($this->validate()) {
        } else {
            $this->field_value = null;
        }

        return $this->field_value;
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0.0
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
    public function getFromto()
    {
        $string_length_from = 0;
        $string_length_to   = 999999999999;

        if (isset($this->options['from'])) {
            $string_length_from = $this->options['from'];
        }

        if (isset($this->options['to'])) {
            $string_length_to = $this->options['to'];
        }

        return array($string_length_from, $string_length_to);
    }
}
