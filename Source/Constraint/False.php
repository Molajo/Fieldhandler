<?php
/**
 * False Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * False Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class False extends AbstractConstraint implements ConstraintInterface
{
    /**
     * False array
     *
     * Override in the Request using $options['false_array'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $false_array = array(FALSE => FALSE, 0 => 0, 'no' => 'no', 'off' => 'off');

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
        $options = $this->setPropertyKeyWithOptionKey($options, 'false_array');

        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );
    }

    /**
     * Validate
     *
     * Verifies value is false, 0, 'no', or 'off', responding with true or false and messages
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        $testValue = $this->field_value;

        if (in_array($testValue, $this->false_array) === TRUE || $testValue === FALSE) {
        } else {
            return FALSE;
        }

        return TRUE;
    }
}
