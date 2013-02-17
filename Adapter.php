<?php
/**
 * FieldHandler Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler;

defined('MOLAJO') or die;

use Exception;
use Molajo\FieldHandler\Exception\FieldHandlerException;

/**
 * FieldHandler Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
Class Adapter
{
    /**
     * Method (validate, filter, or escape)
     *
     * @var    string
     * @since  1.0
     */
    public $method;

    /**
     * Name of Field
     *
     * @var    string
     * @since  1.0
     */
    public $field_name;

    /**
     * Field Value
     *
     * @var    string
     * @since  1.0
     */
    public $field_value;

    /**
     * Array of requested field handlers
     *
     * @var    array
     * @since  1.0
     */
    public $fieldhandler_types;

    /**
     * Array of values needed for field handlers
     *
     * @var    array
     * @since  1.0
     */
    public $options;

    /**
     * Constructor
     *
     * @param   string   $method
     * @param   string   $field_name
     * @param   mixed    $field_value
     * @param   array    $fieldhandler_type_chain
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $fieldhandler_type_chain,
        $options = array()
    ) {

        $this->initialise();

        $this->editRequest($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->processRequest();

        return $this;
    }

    /**
     * Edit Request
     *
     * @param   string   $method
     * @param   string   $field_name
     * @param   mixed    $field_value
     * @param   string   $fieldhandler_type_chain
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     * @throws  FieldHandlerException
     */
    protected function editRequest(
        $method,
        $field_name,
        $field_value = null,
        $fieldhandler_type_chain,
        $options = array()
    ) {

        $method = strtolower($method);
        if (in_array($method, array('validate', 'filter', 'escape'))) {
            $this->method = $method;
        } else {
            throw new FieldHandlerException
            ('FieldHandler: Must provide the name of the requested method.');
        }

        if ($field_name == '' || $field_name === null) {
            throw new FieldHandlerException
            ('FieldHandler: Must provide the field name.');
        } else {
            $this->field_name = $field_name;
        }

        $this->field_value = $field_value;

        if (strpos($fieldhandler_type_chain, ',')) {
            $fieldhandler_types = explode(',', $fieldhandler_type_chain);
        } else {
            $fieldhandler_types = array();
            if (trim($fieldhandler_type_chain) == '' || $fieldhandler_type_chain === null) {
            } else {
                $fieldhandler_types[] = $fieldhandler_type_chain;
            }
        }


        if (is_array($fieldhandler_types) && count($fieldhandler_types) > 0) {
            $this->fieldhandler_types = $fieldhandler_types;
        } else {
            throw new FieldHandlerException
            ('FieldHandler: Must request at least one field handler type');
        }

        if (is_array($fieldhandler_types) && count($fieldhandler_types) > 0) {
            $this->options = $options;
        } else {
            $this->options = array();
        }

        return;
    }

    /**
     * Process Request
     *
     * @return  void
     * @since   1.0
     * @throws  FieldHandlerException
     */
    protected function processRequest()
    {
        foreach ($this->fieldhandler_types as $fieldhandler_type) {

            $fieldhandler_type = ucfirst(strtolower($fieldhandler_type));

            $class = $this->getType($fieldhandler_type);

            try {

                $ft = new $class (
                    $fieldhandler_type,
                    $this->method,
                    $this->field_name,
                    $this->field_value,
                    $this->options
                );

            } catch (Exception $e) {

                throw new FieldHandlerException
                ('FieldHandler: Could not instantiate FieldHandler Type: ' . $fieldhandler_type
                    . ' Class: ' . $class);
            }

            $method = $this->method;

            $this->field_value = $ft->$method();
        }

        return;
    }

    /**
     * Instantiates FieldHandler Class
     *
     * @param   string  $fieldhandler_type
     *
     * @return  object
     * @since   1.0
     * @throws  FieldHandlerException
     */
    protected function getType($fieldhandler_type)
    {
        $class = 'Molajo\\FieldHandler\\Type\\' . $fieldhandler_type;

        if (class_exists($class)) {
        } else {
            throw new FieldHandlerException
            ('FieldHandler Type Class ' . $class . ' does not exist.');
        }

        return $class;
    }

    /**
     * initialise
     *
     * @return  void
     * @since   1.0
     */
    protected function initialise()
    {
        if (defined('FILTER_VALUE_REQUIRED')) {
            return;
        }

        if (defined('FILTER_VALUE_REQUIRED')) {
        } else {
            define('FILTER_VALUE_REQUIRED', ' Value required.');
        }

        if (defined('FILTER_INVALID_VALUE')) {
        } else {
            define('FILTER_INVALID_VALUE', ' Invalid value.');
        }

        return;
    }
}
