<?php
/**
 * Float Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Float Constraint
 *
 * @link       http://php.net/manual/en/function.is-float.php
 * @link       http://php.net/manual/en/function.is-double.php
 * @link       http://php.net/manual/en/function.is-real.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Float extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        if (filter_var($this->field_value, FILTER_VALIDATE_FLOAT) === false) {
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
        $results = filter_var($this->field_value, FILTER_VALIDATE_FLOAT);

        if ($results === false) {

            $this->field_value = null;

            return $this->field_value;
        }

        if ((float) $results === (float) $this->field_value) {
        } else {
            $this->field_value = $results;
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
}
