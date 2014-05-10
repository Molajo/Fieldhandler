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
abstract class AbstractFiltervar extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * Defined in subtype class
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter;

    /**
     * Validate Filter
     *
     * Defined in subtype class
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 2000;

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        if ($this->validate_filter === null) {
            return $this->validateCompare();
        }

        if (filter_var($this->field_value, $this->validate_filter, $this->setFlags())) {
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Validate by comparison to sanitized result
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validateCompare()
    {
        $temp = $this->field_value;

        if ($temp === $this->sanitize()) {
            return true;
        }

        $this->setValidateMessage($this->message_code);

        return false;
    }

    /**
     * Sanitize
     *
     * @return  null|mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->sanitize_filter === null) {
            return $this->sanitizeValidate();
        }

        $this->field_value = filter_var($this->field_value, $this->sanitize_filter, $this->setFlags());

        if ($this->validate_filter === null) {
            return $this->field_value;
        }

        return $this->sanitizeValidate();
    }

    /**
     * Once sanitized result is available, verify if it is valid
     *
     * @return  null|mixed
     * @since   1.0.0
     */
    public function sanitizeValidate()
    {
        if (filter_var($this->field_value, $this->validate_filter, $this->setFlags())) {
        } else {
            $this->field_value = null;
        }

        return $this->field_value;
    }
}
