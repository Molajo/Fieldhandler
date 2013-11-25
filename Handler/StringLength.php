<?php
/**
 * Stringlength Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Handler;

use CommonApi\Exception\UnexpectedValueException;

/**
 * Stringlength Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Stringlength extends AbstractFieldhandler
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

        $Fromto = $this->getFromto();

        $string_length = strlen(trim($this->getFieldValue()));

        if ($string_length >= $Fromto[0]
            && $string_length <= $Fromto[1]
        ) {
        } else {

            throw new UnexpectedValueException
            ('Validate Value: ' . $string_length
            . ' is not a value From: ' . $Fromto[0] . '  To:' . $Fromto[1]);
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

        $Fromto = $this->getFromto();

        if ($string_length > $Fromto[0]
            && $string_length < $Fromto[1]
        ) {
        } else {
            $this->setFieldValue(null);
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

        return $this->filter();
    }

    /**
     * From value and To value
     *
     * @return  mixed
     * @since   1.0
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
