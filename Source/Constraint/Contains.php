<?php
/**
 * Contains Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Contains Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Contains extends AbstractConstraint implements ConstraintInterface
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

        if ($this->testContains() === false) {
            $this->setValidateMessage(1000);
            return false;
        }

        return true;
    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === null) {
            return $this->field_value;
        }

        if ($this->testContains() === false) {
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
     * Test Contains
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function testContains()
    {
        if ($this->field_value === null) {
            return false;
        }

        if (isset($this->options['contains'])) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Contains: must provide options[contains] array values.'
            );
        }

        return mb_strpos($this->field_value, $this->options['contains'], 0, mb_detect_encoding($this->field_value));
    }
}
