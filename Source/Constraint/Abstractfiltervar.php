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
 * @link       http://php.net/manual/en/function.is-float.php
 * @link       http://php.net/manual/en/function.is-double.php
 * @link       http://php.net/manual/en/function.is-real.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Abstractfiltervar extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type;

    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        if (filter_var($this->field_value, $this->filter_type, $this->setFlags()) === false) {
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
        $this->field_value = filter_var($this->field_value, $this->filter_type, $this->setFlags());

        if ($this->field_value === false) {
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
}
