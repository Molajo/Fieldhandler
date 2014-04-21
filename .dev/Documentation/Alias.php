<?php
/**
 * Alias Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Alias Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Alias extends AbstractConstraint implements ConstraintInterface
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

        if ($this->testValidate() === false) {
            $this->setValidationMessage(1000);
            return false;
        }

        return true;
    }

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        if ($this->testValidate() === false) {
            $this->createAlias();
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
     * Create Alias from Text Value
     *
     * @return  $this
     * @since   1.0.0
     */
    public function createAlias()
    {
        $alias = $this->field_value;

        if ($alias === null) {
            return $this;
        }

        /** Replace dashes with spaces */
        $alias = str_replace('-', ' ', strtolower(trim($alias)));

        /** Removes double spaces, ensures only alphanumeric characters */
        $alias = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $alias);

        /** Trim dashes at beginning and end */
        $alias = trim($alias, '-');

        /** Replace spaces with underscores */
        $alias = str_replace(' ', '_', strtolower(trim($alias)));

        /** Sanitize */
        $alias = filter_var($alias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $this->field_value = $alias;

        return $this;
    }

    /**
     * Test the Alias validity
     *
     * @return  bool
     * @since   1.0.0
     */
    public function testValidate()
    {
        $test = $this->field_value;

        $test = preg_replace('/ /', '-', $test);
        if ($this->field_value === $test) {
        } else {
            return false;
        }

        $test = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $test);

        if ($this->field_value === $test) {
        } else {
            return false;
        }

        $test = filter_var($test, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($this->field_value === $test) {
        } else {
            return false;
        }

        return true;
    }
}
