<?php
/**
 * Url Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Url Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Url extends AbstractConstraint implements ConstraintInterface
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

        $hold = $this->field_value;

        if ($this->filter() === $hold) {
            return true;
        }

        //setValidProtocols

        $this->setValidationMessage(8000);

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

            if (filter_var($this->field_value, FILTER_VALIDATE_URL, $this->setFlags())) {
                $this->field_value = filter_var($this->field_value, FILTER_SANITIZE_URL, $this->setFlags());
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
     * @return  string
     * @since   1.0.0
     */
    protected function setValidProtocols()
    {
        $valid_protocols = array();

        if (isset($this->options['valid_protocols'])) {
            $valid_protocols = explode(',', $this->options['valid_protocols']);
        } else {
            $valid_protocols[] = 'http';
            $valid_protocols[] = 'https';
        }

        return $valid_protocols;
    }

    /**
     * Flags can be set in options array
     *
     * @return  string
     * @since   1.0.0
     */
    protected function setFlags()
    {
        $filter = '';

        if (isset($this->options['FILTER_FLAG_PATH_REQUIRED'])) {
            $filter = 'FILTER_FLAG_PATH_REQUIRED';
        }

        if (isset($this->options['FILTER_FLAG_IPV6'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_QUERY_REQUIRED';
        }

        return $filter;
    }
}
