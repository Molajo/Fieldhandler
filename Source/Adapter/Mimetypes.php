<?php
/**
 * Mimetypes Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Mimetypes Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Mimetypes extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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

        if (in_array($this->field_value, $this->getMimetypes())) {
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
        if ($this->field_value === null) {
        } else {

            if (in_array($this->field_value, $this->getMimetypes())) {
            } else {
                $this->field_value = null;
            }
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
     * Test Array Entry Mimetypes
     *
     * @return  mixed
     * @since   1.0.0
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
