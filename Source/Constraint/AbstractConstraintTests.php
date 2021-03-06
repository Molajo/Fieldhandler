<?php
/**
 * Abstract Constraint Tests
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * Abstract Constraint Tests
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractConstraintTests extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Flags can be set in options array
     *
     * @return  null|string
     * @since   1.0.0
     */
    protected function setFlags()
    {
        $this->selected_constraint_options = null;

        foreach ($this->constraint_allowable_options as $entry) {
            $this->setFlag($entry);
        }

        return $this->selected_constraint_options;
    }

    /**
     * Flags can be set in options array
     *
     * @param   string $entry
     *
     * @return  AbstractConstraint
     * @since   1.0.0
     */
    protected function setFlag($entry)
    {
        $value = $this->getOption($entry);

        if ($value === null) {
            return $this;
        }

        if ($this->selected_constraint_options === null) {
        } else {
            $this->selected_constraint_options .= ', ';
        }

        $this->selected_constraint_options .= $entry;

        return $this;
    }

    /**
     * Test the string specified in $filter using the function defined by $test
     *
     * @param   string  $filter
     * @param   string  $test
     * @param   boolean $allow_space_character
     *
     * @return  string
     * @since   1.0.0
     */
    protected function sanitizeByCharacter($filter, $test, $allow_space_character = false)
    {
        $filtered = '';

        if (strlen($test) > 0) {
            for ($i = 0; $i < strlen($test); $i++) {
                $filtered .= $this->sanitizeCharacter($filter, substr($test, $i, 1), $allow_space_character);
            }
        }

        return $filtered;
    }

    /**
     * Test the string specified in $filter using the function defined by $test
     *
     * @param   string  $filter
     * @param   string  $value
     * @param   boolean $allow_space_character
     *
     * @return  string
     * @since   1.0.0
     */
    protected function sanitizeCharacter($filter, $value, $allow_space_character)
    {
        if ($filter($value) === true
            || ($allow_space_character === true && $value === ' ')
        ) {
            return $value;
        }

        return '';
    }

    /**
     * Equal
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function testEqual()
    {
        if ($this->field_value === $this->getOption('equals')) {
            return true;
        }

        return false;
    }

    /**
     * Not equal
     *
     * @return  null|string
     * @since   1.0.0
     */
    protected function testNotequal()
    {
        if ($this->field_value === $this->getOption('not_equal')) {
            return false;
        }

        return true;
    }

    /**
     * Greater Than
     *
     * @return  null|string
     * @since   1.0.0
     */
    protected function testGreaterthan()
    {
        if ($this->field_value > $this->getOption('greater_than')) {
            return true;
        }

        return false;
    }

    /**
     * Less Than
     *
     * @return  null|string
     * @since   1.0.0
     */
    protected function testLessthan()
    {
        if ($this->field_value < $this->getOption('less_than')) {
            return true;
        }

        return false;
    }

    /**
     * Maximum
     *
     * @param   string $key
     *
     * @return  null|string
     * @since   1.0.0
     */
    protected function testMaximum($key)
    {
        if ($this->getOption($key) >= $this->field_value) {
            return true;
        }

        return false;
    }

    /**
     * Minimum
     *
     * @param   string $key
     *
     * @return  null|string
     * @since   1.0.0
     */
    protected function testMinimum($key)
    {
        if ($this->getOption($key) <= $this->field_value) {
            return true;
        }

        return false;
    }
}
