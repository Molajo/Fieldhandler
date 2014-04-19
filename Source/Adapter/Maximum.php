<?php
/**
 * Maximum Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Maximum Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Maximum extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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

        } else {

            if ($this->getMaximum() > $this->field_value) {
                return true;
            }
        }

        $this->setErrorMessage(10000);

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

            if ($this->getMaximum() > $this->field_value) {
            } else {
                $this->field_value = $this->getMaximum();
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
        return $this->field_value;
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMaximum()
    {
        $field_value = '';

        if (isset($this->options['maximum'])) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Maximum: must provide options[maximum] array values.'
            );
        }

        if (isset($this->options['maximum'])) {
            $field_value = $this->options['maximum'];
        }

        return $field_value;
    }
}
