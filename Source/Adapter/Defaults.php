<?php
/**
 * Defaults Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Defaults Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Defaults extends AbstractFieldhandler implements FieldhandlerAdapterInterface
{
    /**
     * Validate Input
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        $this->setDefault();

        if ($this->field_value === null) {
            return false;
        }

        return true;
    }

    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        $this->setDefault();

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
     * If needed, apply default to Field
     *
     * @return  $this
     * @since   1.0.0
     */
    protected function setDefault()
    {
        if ($this->field_value === null) {

            $default = null;

            if (isset($this->options['default'])) {
                $default = $this->options['default'];
            }

            if ($default === null) {
            } else {
                $this->field_value = $default;
            }
        }

        return $this;
    }
}
