<?php
/**
 * Callback Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;


use CommonApi\Model\ConstraintInterface;

/**
 * Callback Constraint
 *
 * @link       http://us3.php.net/callback
 * @link       http://us3.php.net/manual/en/language.types.callable.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Callback extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter = null;

    /**
     * Sanitize Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter = FILTER_CALLBACK;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        $hold = $this->field_value;

        if ($hold === $this->sanitize()) {
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
        $this->field_value = filter_var($this->field_value, $this->sanitize_filter, $this->setCallback());

        return $this->field_value;
    }

    /**
     * Format
     *
     * @return  null|mixed
     * @since   1.0.0
     */
    public function format()
    {
        return $this->sanitize();
    }

    /**
     * Callback set in the $options array for $request
     *
     * @return  array
     * @since   1.0.0
     */
    protected function setCallback()
    {
        $return            = array();
        $return['options'] = $this->getOption('callback', null);

        return $return;
    }
}
