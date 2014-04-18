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
use CommonApi\Model\FieldhandlerAdapterInterface;

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
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === $this->getEqual()) {
            return true;
        }

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
        if ($this->field_value === $this->getEqual()) {
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
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getEqual()
    {
        $field_value = null;

        if (isset($this->options['equals'])) {
            $field_value = $this->options['equals'];
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Equal: must provide options[equals] value.'
            );
        }

        return $field_value;
    }
}
