<?php
/**
 * Length Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Length Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Length extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 8000;

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
            return true;
        }

        return false;
    }
}
