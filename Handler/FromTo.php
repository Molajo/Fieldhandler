<?php
/**
 * FromTo FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Handler;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Exception\FieldHandlerException;

use Molajo\FieldHandler\Api\FieldHandlerInterface;

/**
 * FromTo FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class FromTo extends AbstractFieldHandler
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
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        return parent::__construct($method, $field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    protected function validate()
    {
        parent::validate();

        $FromTo = $this->getFromTo();

        if ($this->getFieldValue() >= $FromTo[0]
            && $this->getFieldValue() <= $FromTo[1]) {

        } else {

            throw new FieldHandlerException
            ('Validate Value: ' . $this->getFieldValue()
                . ' is not a value From: ' . $FromTo[0] . '  To:' . $FromTo[1]);
        }

        return $this->getFieldValue();
    }

    /**
     * FieldHandler Input
     *
     * @return  mixed
     * @since   1.0
     */
    protected function filter()
    {
        parent::filter();

        $FromTo = $this->getFromTo();

        if ($this->getFieldValue() > $FromTo[0]
            && $this->getFieldValue() < $FromTo[1]) {

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
    protected function escape()
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
    public function getFromTo()
    {
        $field_value_from = 0;
        $field_value_to = 999999999999;

        if (isset($this->options['from_value'])) {
            $field_value_from = $this->options['from_value'];
        }

        if (isset($this->options['to_value'])) {
            $field_value_to = $this->options['to_value'];
        }

        return array($field_value_from, $field_value_to);
    }
}
