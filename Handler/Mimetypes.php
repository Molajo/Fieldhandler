<?php
/**
 * Mimetypes Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Handler;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerInterface;

/**
 * Mimetypes Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Mimetypes extends AbstractFieldhandler
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

            $test = in_array($this->getFieldValue(), $this->getMimetypes());

            if ($test == 1) {
            } else {
                throw new UnexpectedValueException
                ('Validate Mimetypes: Invalid Value');
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

            $test = in_array($this->getFieldValue(), $this->getMimetypes());

            if ($test == 1) {
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

        if ($this->getFieldValue() === null) {
        } else {

            $test = in_array($this->getFieldValue(), $this->getMimetypes());

            if ($test == 1) {
            } else {
                $this->setFieldValue(false);
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Test Array Entry Mimetypes
     *
     * @return  mixed
     * @since   1.0
     */
    public function getMimetypes()
    {
        $field_values = array();

        if (isset($this->options['array_valid_mimetypes'])) {
            $field_values = $this->options['array_valid_mimetypes'];
        }

        return $field_values;
    }
}