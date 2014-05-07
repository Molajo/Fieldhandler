<?php
/**
 * Resource Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Resource Constraint
 *
 * A resource is a special variable, holding a reference to an external resource
 *
 * @link       http://www.php.net/manual/en/language.types.resource.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Resource extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 13000;

    /**
     * Sanitize
     *
     * @return  resource|null
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {

        } else {

            if (is_resource($this->field_value)) {
            } else {
                $this->field_value = NULL;
            }
        }

        return $this->field_value;
    }

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (is_resource($this->field_value)) {
            return TRUE;
        }

        return FALSE;
    }
}
