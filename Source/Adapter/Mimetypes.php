<?php
/**
 * Mimetypes Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
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
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        if ($this->getFieldValue() === null) {
        } else {

            $test = in_array($this->getFieldValue(), $this->getMimetypes());

            if ($test == 1) {
            } else {
                throw new UnexpectedValueException
                (
                    'Validate Mimetypes: Invalid Value'
                );
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter()
    {
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
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape()
    {
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
