<?php
/**
 * AbstractOpposite Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * AbstractOpposite Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractOpposite extends AbstractArrays implements ConstraintInterface
{

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Validate - testing for a set of values that are NOT desired - reverse results
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        $results = parent::validate();

        if ($results == false) {
            $this->validate_messages = array();
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Sanitize - testing for a set of values that are NOT desired - reverse results
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function sanitize()
    {
        $hold = $this->field_value;

        parent::sanitize();

        if ($this->field_value === null) {
            $this->field_value = $hold;
        } else {
            $this->field_value = null;
        }

        return $this->field_value;
    }
}
