<?php
/**
 * Fileextension Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Fileextension Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Fileextension extends AbstractConstraint implements ConstraintInterface
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

        if (is_file($this->field_value)) {
        } else {
            $this->setValidationMessage(9000);
            return false;
        }

        $path_info = pathinfo($this->field_value);

        if (in_array($path_info, $this->getExtensions())) {
            return true;
        }

        $this->setValidationMessage(9000);

        return false;

    }

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        if ($this->field_value === null) {
            return $this->field_value;
        }

        if ($this->validate() === false) {
            $this->field_value = null;
        }

        return $this->field_value;
    }

    /**
     * Escape
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function escape()
    {
        return $this->filter();
    }

    /**
     * Get File Extensions
     *
     * @return  array
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getExtensions()
    {
        if (isset($this->options['array_valid_extensions'])
            && is_array($this->options['array_valid_extensions'])
        ) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Contains: must provide options[contains] array values.'
            );
        }

        return $this->options['array_valid_extensions'];
    }
}