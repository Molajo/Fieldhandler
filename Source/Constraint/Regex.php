<?php
/**
 * Regex Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Regex Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Regex extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 8000;

    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (preg_match($this->getOption('regex'), $this->field_value) === 1) {
            return true;
        }

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
        $this->field_value = preg_replace($this->getOption('regex'), '', $this->field_value);

        return $this->field_value;
    }
}
