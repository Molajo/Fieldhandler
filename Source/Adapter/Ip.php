<?php
/**
 * Ip Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;

/**
 * Ip Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Ip extends AbstractFieldhandler
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

            $test = filter_var($this->getFieldValue(), FILTER_VALIDATE_IP, $this->setFlags());

            if ($test == true) {
            } else {
                throw new UnexpectedValueException
                ('Validate Ip: Invalid Value');
            }
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

            $test = filter_var($this->getFieldValue(), FILTER_VALIDATE_IP, $this->setFlags());

            if ($test == true) {
            } else {
                $this->setFieldValue(false);
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

        $test = filter_var($this->getFieldValue(), FILTER_VALIDATE_IP, $this->setFlags());

        if ($test == true) {
        } else {
            $this->setFieldValue(false);
        }

        return $this->getFieldValue();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0
     */
    public function setFlags()
    {
        $filter = '';
        if (isset($this->options['FILTER_FLAG_IPV4'])) {
            $filter = 'FILTER_FLAG_IPV4';
        }

        if (isset($this->options['FILTER_FLAG_IPV6'])) {
            $filter = 'FILTER_FLAG_IPV6';
        }

        $range = '';
        if (isset($this->options['FILTER_FLAG_NO_PRIV_RANGE'])) {
            $range = 'FILTER_FLAG_NO_PRIV_RANGE';
        }

        if (isset($this->options['FILTER_FLAG_NO_RES_RANGE'])) {
            $range = 'FILTER_FLAG_NO_RES_RANGE';
        }

        $filterRange = '';
        if ($filter == '') {
            return $filterRange;
        }

        $filterRange = $filter;
        if ($range == '') {
            return $filterRange;
        }

        return $filter . ' | ' . $range;
    }
}
