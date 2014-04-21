<?php
/**
 * Mimetypes Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Mimetypes Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Mimetypes extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
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

        $this->setValidateMessage(12000);

        return false;
    }

    /**
     * Handle Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleInput()
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
     * Handle Output
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleOutput()
    {
        return $this->handleInput();
    }

    /**
     * Test Array Entry Mimetypes
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function getMimetypes()
    {
        $field_values = array();


        if (isset($this->options['array_valid_mimetypes'])) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Mimetypes: must provide options[array_valid_mimetypes] array values.'
            );
        }

        if (isset($this->options['array_valid_mimetypes'])) {
            $field_values = $this->options['array_valid_mimetypes'];
        }

        return $field_values;
    }
}
