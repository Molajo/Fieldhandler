<?php
/**
 * String Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * String Fieldhandler
 *
 * @link       http://php.net/manual/en/function.is-string.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class String extends AbstractConstraint implements ConstraintInterface
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

        if (filter_var($this->field_value, FILTER_SANITIZE_STRING, $this->setFlags())) {
            return true;
        }

        $this->setValidationMessage(1000);

        return false;
    }

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        if ($this->field_value === null) {
        } else {
            $this->field_value = filter_var($this->field_value, FILTER_SANITIZE_STRING, $this->setFlags());
        }

        return $this->field_value;
    }

    /**
     * Escape
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function escape()
    {
        return $this->filter();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function setFlags()
    {
        $filter = '';
        if (isset($this->options['FILTER_FLAG_NO_ENCODE_QUOTES'])) {
            $filter = 'FILTER_FLAG_NO_ENCODE_QUOTES';
        }

        if (isset($this->options['FILTER_FLAG_STRIP_LOW'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_STRIP_LOW';
        }

        if (isset($this->options['FILTER_FLAG_STRIP_HIGH'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_STRIP_HIGH';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_LOW'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_LOW';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_HIGH'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_HIGH';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_AMP'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_AMP';
        }

        return $filter;
    }
}