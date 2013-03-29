<?php
/**
 * Abstract FieldHandler Class
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Type;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Exception\FieldHandlerException;
use Molajo\FieldHandler\Adapter\FieldHandlerInterface;

/**
 * Abstract FieldHandler Class
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class AbstractFieldHandler implements FieldHandlerInterface
{
    /**
     * FieldHandler Type
     *
     * @var    mixed
     * @since  1.0
     */
    protected $fieldhandler_type;

    /**
     * Method (validate, filter, escape)
     *
     * @var    string
     * @since  1.0
     */
    protected $method;

    /**
     * Field Name
     *
     * @var    string
     * @since  1.0
     */
    protected $field_name;

    /**
     * Data Value
     *
     * @var    mixed
     * @since  1.0
     */
    protected $field_value;

    /**
     * Options
     *
     * @var    array
     * @since  1.0
     */
    protected $options;

    /**
     * Timezone
     *
     * @var    string
     * @since  1.0
     */
    protected $timezone;

    /**
     * HTML Entities
     *
     * @var    array
     * @since  1.0
     */
    protected $html_entities = array(
        34 => 'quot',
        38 => 'amp',
        60 => 'lt',
        62 => 'gt',
    );

    /**
     * Encoding
     *
     * @var    string
     * @since  1.0
     */
    protected $encoding = 'utf-8';

    /**
     * Constructor
     *
     * @param string $fieldhandler_type
     * @param string $method
     * @param string $field_name
     * @param mixed  $field_value
     * @param array  $options
     *
     * @return mixed
     * @since   1.0
     */
    public function __construct(
        $fieldhandler_type,
        $method,
        $field_name,
        $field_value,
        $options
    ) {
        $this->setFieldHandlerType($fieldhandler_type);
        $this->setMethod($method);
        $this->setFieldName($field_name);
        $this->setFieldValue($field_value);
        $this->setOptions($options);

        $this->getUserTimeZone();

        return $this;
    }

    /**
     * Validate Input
     *
     * @return mixed
     * @since   1.0
     */
    public function validate()
    {
        return $this->getFieldValue();
    }

    /**
     * FieldHandler Input
     *
     * @return mixed
     * @since   1.0
     */
    public function filter()
    {
        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return mixed
     * @since   1.0
     */
    public function escape()
    {
        return $this->getFieldValue();
    }

    /**
     * Set the Method
     *
     * @param string $method
     *
     * @return string
     * @since   1.0
     */
    protected function setMethod($method)
    {
        $method = strtolower($method);

        if ($method == 'validate'
            || $method == 'filter'
            || $method == 'escape'
) {

        } else {
            throw new FieldHandlerException
            ('');
        }

        $this->method = $method;

        return;
    }

    /**
     * Get the Path
     *
     * @return string
     * @since   1.0
     */
    protected function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the FieldHandler Type
     *
     * @param string $method
     *
     * @return string
     * @since   1.0
     */
    protected function setFieldHandlerType($fieldhandler_type)
    {
        $this->fieldhandler_type = $fieldhandler_type;

        return;
    }

    /**
     * Get the FieldHandler Type
     *
     * @return string
     * @since   1.0
     */
    protected function getFieldHandlerType()
    {
        return $this->fieldhandler_type;
    }

    /**
     * Set the Field Name
     *
     * @param string $field_name
     *
     * @return void
     * @since   1.0
     */
    protected function setFieldName($field_name)
    {
        $this->field_name = $field_name;

        return;
    }

    /**
     * Set the Value
     *
     * @param string $field_value
     *
     * @return void
     * @since   1.0
     */
    public function setFieldValue($field_value)
    {
        $this->field_value = $field_value;

        return;
    }

    /**
     * Get Value
     *
     * @return mixed
     * @since   1.0
     */
    public function getFieldValue()
    {
        return $this->field_value;
    }

    /**
     * Set Options
     *
     * @param string $options
     *
     * @return void
     * @since   1.0
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return;
    }

    /**
     * Get Options
     *
     * @return array
     * @since   1.0
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get timezone
     *
     * @return array
     * @since   1.0
     */
    protected function getUserTimeZone()
    {
        $timezone = '';

        if (is_array($this->options)) {
        } else {
            return;
        }

        if (isset($this->options['timezone'])) {
            $timezone = $this->options['timezone'];
        }

        if ($timezone === '') {
            if (ini_get('date.timezone')) {
                $timezone = ini_get('date.timezone');
            }
        }

        if ($timezone === '') {
            $timezone = 'UTC';
        }

        ini_set('date.timezone', $timezone);
        $this->options['timezone'] = $timezone;

        $this->setTimezone($timezone);

        return;
    }

    /**
     * Set the Timezone
     *
     * @param string $timezone
     *
     * @return string
     * @since   1.0
     */
    protected function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return;
    }

    /**
     * Get the Timezone
     *
     * @return string
     * @since   1.0
     */
    protected function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Test the string specified in $filter using the function defined by $test
     *
     * @param string $filter
     *
     * @return string
     * @since   1.0
     */
    public function filterByCharacter($test, $filter)
    {
        $filtered = '';

        if (strlen($filter) > 0) {
            for ($i = 0; $i < strlen($filter); $i ++) {
                if ($test(substr($filter, $i, 1)) == 1) {
                    $filtered .= substr($filter, $i, 1);
                }
            }
        }

        return $filtered;
    }
}
