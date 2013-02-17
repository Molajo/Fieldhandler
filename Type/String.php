<?php
/**
 * String FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Type;

defined('MOLAJO') or die;

/**
 * String FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class String extends AbstractFieldHandler
{
    /**
     * Constructor
     *
     * @param string $method            (validate, filter, escape)
     * @param string $fieldhandler_type
     *
     * @param mixed  $field_value
     * @param null   $default
     * @param bool   $required
     * @param null   $min
     * @param null   $max
     * @param array  $field_values
     * @param string $regex
     * @param object $callback
     * @param array  $options
     *
     * @return mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $fieldhandler_type,
        $field_value,
        $default = null,
        $required = true,
        $min = null,
        $max = null,
        $field_values = array(),
        $regex = null,
        $callback = null,
        $options = array()
    ) {
        return parent::__construct();
    }

    /**
     * Validate Input
     *
     * @return mixed
     * @since   1.0
     */
    public function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {
        } else {

            $test = filter_var($this->getFieldValue(), FILTER_SANITIZE_STRING, $this->setFlags());

            if ($test == $this->getFieldValue()) {
            } else {
                throw new FieldHandlerException
                ('Validate String: ' . FILTER_INVALID_VALUE);
            }
        }

        return $this->getFieldValue();
    }

    /**
     * FieldHandler Input
     *
     * @return mixed
     * @since   1.0
     */
    public function filter()
    {
        parent::filter();

        if ($this->getFieldValue() === null) {
        } else {

            $test = filter_var($this->getFieldValue(), FILTER_SANITIZE_STRING, $this->setFlags());

            if ($test == true) {
            } else {
                $this->setFieldValue(filter_var($this->getFieldValue(), FILTER_SANITIZE_STRING));
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return mixed
     * @since   1.0
     */
    public function escape()
    {
        parent::escape();

        $test = filter_var($this->getFieldValue(), FILTER_SANITIZE_STRING, $this->setFlags());

        if ($test == true) {
        } else {
            $this->setFieldValue(filter_var($this->getFieldValue(), FILTER_SANITIZE_STRING));
        }

        return $this->getFieldValue();
    }

    /**
     * Flags can be set in options array
     *
     * @return mixed
     * @since   1.0
     */
    public function setFlags()
    {
        $filter = '';
        if (isset($this->options['FILTER_FLAG_NO_ENCODE_QUOTES'])) {
            $filter = 'FILTER_FLAG_NO_ENCODE_QUOTES';
        }

        if (isset($this->options['FILTER_FLAG_STRIP_LOW'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_STRIP_LOW';
        }

        if (isset($this->options['FILTER_FLAG_STRIP_HIGH'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_STRIP_HIGH';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_LOW'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_LOW';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_HIGH'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_HIGH';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_AMP'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_AMP';
        }

        return $filter;
    }
}
