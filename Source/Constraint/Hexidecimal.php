<?php
/**
 * Hexidecimal Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Hexidecimal Constraint
 *
 * @link       http://php.net/manual/en/function.ctype-xdigit.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Hexidecimal extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Constraint Options
     *
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options = array(
        'FILTER_FLAG_ALLOW_OCTAL',
        'FILTER_FLAG_ALLOW_HEX'
    );

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

        if (ctype_xdigit($this->field_value)) {
            return true;
        }

        $this->setValidateMessage(2000);

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
        if ($this->field_value === null) {

        } elseif (ctype_xdigit($this->field_value)) {

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
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function format()
    {
        return $this->sanitize();
    }
}
