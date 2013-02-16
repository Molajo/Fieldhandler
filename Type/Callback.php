<?php
/**
 * Callbacks Filter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

/**
 * Callbacks Filter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Callbacks extends AbstractFilter
{
    /**
     * Constructor
     *
     * @param   string   $method
     * @param   string   $field_name
     * @param   mixed    $field_value
     * @param   array    $filter_type_chain
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $filter_type_chain,
        $options = array()
    ) {
        return parent::__construct($method, $field_name, $field_value, $filter_type_chain, $options);
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {

        } else {

            $test = filter_var($this->getFieldValue(), FILTER_CALLBACK, $this->setCallback());

            if ($test == $this->getFieldValue()) {
            } else {

                throw new FilterException
                ('Validate Callbacks: ' . FILTER_INVALID_VALUE);
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function filter()
    {
        parent::filter();

        if ($this->getFieldValue() === null) {

        } else {

            $test = filter_var($this->getFieldValue(), FILTER_CALLBACK, $this->setCallback());

            if ($test == $this->getFieldValue()) {
            } else {
                $this->setFieldValue(filter_var($this->getFieldValue(), FILTER_CALLBACK, $this->setCallback()));
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

        $test = filter_var($this->getFieldValue(), FILTER_CALLBACK, $this->setCallback());

        if ($test == $this->getFieldValue()) {

        } else {
            $this->setFieldValue(filter_var($this->getFieldValue(), FILTER_CALLBACK, $this->setCallback()));
        }

        return $this->getFieldValue();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0
     */
    public function setCallback()
    {
        if (isset($this->options['Callback'])) {
            $callback = $this->options['Callback'];
        }

        $callback = array('options' => $callback);

        return $callback;
    }
}
