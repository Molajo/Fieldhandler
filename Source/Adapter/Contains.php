<?php
/**
 * Contains Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldHandlerAdapterInterface;

/**
 * Contains Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Contains extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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
     */
    public function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {
            return $this->getFieldValue();
        }

        $results = $this->testContains();
        if ($results === false) {
            throw new UnexpectedValueException
            ('Validate Contains: Invalid Value');
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
            return $this->getFieldValue();
        }

        $results = $this->testContains();
        if ($results === false) {
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
     * If needed, apply default to Field
     *
     * @return  boolean
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function testContains()
    {
        if ($this->getFieldValue() === null) {
            return false;
        }

        if (isset($this->options['contains'])) {
            $contains = $this->options['contains'];
        } else {
            throw new UnexpectedValueException
            ('Validate Contains: must send in options contains value: ');
        }

        $input = $this->getFieldValue();

        $x = mb_strpos($input, $contains, 0, mb_detect_encoding($input));
        if ($x === false) {
            return false;
        } else {
            return true;
        }
    }
}
