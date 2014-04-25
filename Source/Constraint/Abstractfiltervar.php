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
class AbstractFiltervar extends AbstractConstraint implements ConstraintInterface
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
     * Validate
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        $results = $this->testFilterVar('validate');

        if ($results === false) {
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
        $results = $this->testFilterVar('sanitize');

        if ($results == false) {
            $this->field_value = null;
        }

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
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    protected function testFilterVar($method)
    {
        $results = filter_var($this->field_value, $this->filter_type, $this->setFlags());

        if ($results === false) {
            return false;
        }

        if ($method === 'sanitize') {
            $this->field_value = $results;

            return $results;
        }

        if ($this->filter_type === FILTER_VALIDATE_FLOAT) {
            if ((float)$results === (float)$this->field_value) {
                return true;
            }
        }

        if ($this->field_value === $results) {
            return true;
        }

        return false;
    }
}
