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
class Callback extends AbstractConstraint implements ConstraintInterface
{
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

        if (filter_var($this->field_value, FILTER_CALLBACK, $this->setCallback()) === false) {
            $this->setValidateMessage(1000);

            return false;
        }

        return true;
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
            return $this->field_value;
        }

        if (filter_var($this->field_value, FILTER_CALLBACK, $this->setCallback())) {
            return $this->field_value;
        }

        $this->field_value = null;

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
        return $this->field_value;
    }

    /**
     * Flags can be set in options array
     *
     * @return  array
     * @since   1.0.0
     */
    protected function setCallback()
    {
        $callback = null;

        if (isset($this->options['callback'])) {
            $callback = $this->options['callback'];
        }

        $return            = array();
        $return['options'] = $callback;

        return $return;
    }
}
