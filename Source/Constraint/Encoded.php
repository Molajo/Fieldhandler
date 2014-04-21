<?php
/**
 * Encoded Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Encoded Constraint
 *
 * URL-encode string, optionally strip or encode special characters.
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Encoded extends AbstractConstraint implements ConstraintInterface
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

        if ($this->field_value === filter_var($this->field_value, FILTER_SANITIZE_ENCODED, $this->setFlags())) {
            return true;
        }

        $this->setValidateMessage(8000);

        return false;
    }

    /**
     * Handle Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleInput()
    {
        $this->field_value = filter_var($this->field_value, FILTER_SANITIZE_ENCODED, $this->setFlags());

        return $this->field_value;
    }

    /**
     * Handle Output
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleOutput()
    {
        return $this->handleInput();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function setFlags()
    {
        $filter = null;
        if (isset($this->options['FILTER_FLAG_STRIP_LOW'])) {
            $filter = 'FILTER_FLAG_STRIP_LOW';
        }

        if (isset($this->options['FILTER_FLAG_STRIP_HIGH'])) {
            if ($filter === null) {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_STRIP_HIGH';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_LOW'])) {
            if ($filter === null) {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_LOW';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_HIGH'])) {
            if ($filter === null) {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_HIGH';
        }

        return $filter;
    }
}
