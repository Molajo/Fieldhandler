<?php
/**
 * True Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * True Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class True extends AbstractConstraint implements ConstraintInterface
{
    /**
     * True array
     *
     * Override in the Request using $options['true_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $true_array = array(TRUE => TRUE, 1 => 1, 'yes' => 'yes', 'on' => 'on');

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Constructor
     *
     * @param   string $constraint
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $options
     *
     * @api
     * @since   1.0.0
     */
    public function __construct(
        $constraint,
        $method,
        $field_name,
        $field_value,
        array $options = array()
    ) {
        $options = $this->setPropertyKeyWithOptionKey($options, 'true_array');

        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );
    }

    /**
     * Sanitize
     *
     * Sets the return value to NULL if it is not true, 1, 'yes', or 'on.'
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {
            return $this->field_value;
        }

        if ($this->validation() === TRUE) {
        } else {
            $this->field_value = NULL;
        }

        return $this->field_value;
    }

    /**
     * Verifies value is true, 1, 'yes', or 'on', responding with true or false and messages
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (in_array($this->field_value, $this->true_array) === FALSE) {
            return FALSE;
        }

        return TRUE;
    }
}
