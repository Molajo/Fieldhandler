<?php
/**
 * Abstract Constraint Tests
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Abstract Constraint Tests
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractConstraintTests extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Set Property->$Key with Option[$Key]
     *
     * @param   string $key
     * @param   array  $options
     *
     * @return  array
     * @since   1.0.0
     */
    protected function setPropertyKeyWithOptionKey(array $options = array(), $key)
    {
        if (isset($options[ $key ])) {
            $this->$key = $options[ $key ];
            unset($options[ $key ]);
        }

        return $options;
    }

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
     * Get $option $key value, if available, or use $default value
     *
     * @param   string     $key
     * @param   null|mixed $default
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException;
     */
    protected function getOption($key, $default = null)
    {
        if (isset($this->options[ $key ])) {
            return $this->options[ $key ];
        }

        if ($default === null) {
            return null;
        }

        $this->options[ $key ] = $default;

        return $this->options[ $key ];
    }

    /**
     * Test the string specified in $filter using the function defined by $test
     *
     * @param   string  $filter
     * @param   string  $test
     * @param   boolean $allow_whitespace
     *
     * @return  string
     * @since   1.0.0
     */
    protected function sanitizeByCharacter($filter, $test, $allow_whitespace = false)
    {
        $filtered = '';

        if (strlen($test) > 0) {
            for ($i = 0; $i < strlen($test); $i ++) {
                $filtered .= $this->sanitizeCharacter($filter, $test, $allow_whitespace, $i);
            }
        }

        return $filtered;
    }

    /**
     * Test the string specified in $filter using the function defined by $test
     *
     * @param   string  $filter
     * @param   string  $test
     * @param   boolean $allow_whitespace
     * @param   integer $filter
     * @param integer   $i
     *
     * @return  string
     * @since   1.0.0
     */
    protected function sanitizeCharacter($filter, $test, $allow_whitespace, $i)
    {
        $value    = substr($test, $i, 1);
        $filtered = $filter($value);

        if ($filtered === 1
            || ($allow_whitespace === true && $value === ' ')
        ) {
            return $value;
        }

        return '';
    }

    /**
     * Get timezone
     *
     * @return  AbstractConstraint
     * @since   1.0.0
     */
    protected function getUserTimeZone()
    {
        $timezone = $this->timezone;

        if ($timezone === '') {
            if (ini_get('date.timezone')) {
                $timezone = ini_get('date.timezone');
            }
        }

        if ($timezone === '') {
            $timezone = 'UTC';
        }

        $this->timezone = $timezone;

        return $this;
    }
}
