<?php
/**
 * Equal Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldHandlerAdapterInterface;

/**
 * Equal Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Equal extends AbstractFieldhandler implements FieldhandlerAdapterInterface
{
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

        $equals = $this->getEqual();

        if ($this->getFieldValue() == $equals) {
        } else {
            throw new UnexpectedValueException
            (
                'Validate Equal: Invalid Value'
            );
        }

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter()
    {
        parent::filter();

        $equals = $this->getEqual();

        if ($this->getFieldValue() == $equals) {
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
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape()
    {
        parent::escape();

        return $this->filter();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0
     */
    public function getEqual()
    {
        $field_value = null;

        if (isset($this->options['equals'])) {
            $field_value = $this->options['equals'];
        }

        return $field_value;
    }
}