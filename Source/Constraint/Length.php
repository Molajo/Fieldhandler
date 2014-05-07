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
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 8000;

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
            $this->field_value = NULL;
        }

        return $this->field_value;
    }

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        $minimum = $this->getOption('minimum_length', 0);
        $maximum = $this->getOption('maximum_length', 999999999999);

        $string_length = strlen(trim($this->field_value));

        if ($string_length >= $minimum
            && $string_length <= $maximum
        ) {
            return TRUE;
        }

        return FALSE;
    }
}
