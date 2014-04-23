<?php
/**
 * Length Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Length Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Length extends AbstractConstraint implements ConstraintInterface
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

        $results = $this->testMinimumMaximum();

        if ($results === true) {
            return true;
        }

        $this->setValidateMessage(8000);

        return false;
    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->validate()) {
        } else {
            $this->field_value = null;
        }

        return $this->field_value;
    }

    /**
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        return $this->field_value;
    }

    /**
     * Get Minimum and Maximum
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testMinimumMaximum()
    {
        $minimum = 0;
        $maximum = 999999999999;

        if (isset($this->options['minimum_length'])) {
            $minimum = $this->options['minimum_length'];
        }

        if (isset($this->options['maximum_length'])) {
            $maximum = $this->options['maximum_length'];
        }

        $string_length = strlen(trim($this->field_value));

        if ($string_length >= $minimum
            && $string_length <= $maximum
        ) {
            return true;
        }

        return false;
    }
}
