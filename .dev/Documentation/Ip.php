<?php
/**
 * Ip Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Ip Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Ip extends AbstractConstraint implements ConstraintInterface
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

        if (filter_var($this->field_value, FILTER_VALIDATE_IP, $this->setFlags())) {
            return true;
        }

        $this->setValidationMessage(2000);

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

            if (filter_var($this->field_value, FILTER_VALIDATE_IP, $this->setFlags())) {
            } else {
                $this->field_value = null;
            }
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
        if (isset($this->options['FILTER_FLAG_IPV4'])) {
            $filter = 'FILTER_FLAG_IPV4';
        }

        if (isset($this->options['FILTER_FLAG_IPV6'])) {
            $filter = 'FILTER_FLAG_IPV6';
        }

        $range = '';
        if (isset($this->options['FILTER_FLAG_NO_PRIV_RANGE'])) {
            $range = 'FILTER_FLAG_NO_PRIV_RANGE';
        }

        if (isset($this->options['FILTER_FLAG_NO_RES_RANGE'])) {
            $range = 'FILTER_FLAG_NO_RES_RANGE';
        }

        $filterRange = '';
        if ($filter == '') {
            return $filterRange;
        }

        $filterRange = $filter;
        if ($range == '') {
            return $filterRange;
        }

        return $filter . ' | ' . $range;
    }
}
