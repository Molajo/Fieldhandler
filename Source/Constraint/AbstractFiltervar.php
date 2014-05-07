<?php
/**
 * Abstract Fieldhandler for filter_var data types
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Abstract Fieldhandler for filter_var data types
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractFiltervar extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * Defined in child class
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Validate
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        return parent::validate();
    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        $this->field_value = filter_var($this->field_value, $this->filter_type, $this->setFlags());

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
        return parent::format();
    }

    /**
     * Validation test
     *
     * @api
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->filter_type === FILTER_VALIDATE_FLOAT
            && (float)$this->field_value === (float)$this->sanitize()
        ) {
            return TRUE;

        } elseif ($this->field_value === $this->sanitize()) {
            return TRUE;
        }

        return FALSE;
    }
}
