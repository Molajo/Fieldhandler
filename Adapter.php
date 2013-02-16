<?php
/**
 * Filter Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters;

defined('MOLAJO') or die;

use Exception;
use Molajo\Filters\Exception\FilterException;

/**
 * Filter Adapter
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
     * Array of requested filters
     *
     * @var    array
     * @since  1.0
     */
    public $filter_types;

    /**
     * Array of values needed for filters
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
     * @param   array    $filter_type_chain
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $filter_type_chain,
        $options = array()
    ) {

        $this->initialise();

        $this->editRequest($method, $field_name, $field_value, $filter_type_chain, $options);

        $this->processRequest();

        return $this;
    }

    /**
     * Edit Request
     *
     * @param   string   $method
     * @param   string   $field_name
     * @param   mixed    $field_value
     * @param   string   $filter_type_chain
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     * @throws  FilterException
     */
    protected function editRequest(
        $method,
        $field_name,
        $field_value,
        $filter_type_chain,
        $options = array()
    ) {

        $method = strtolower($method);
        if (in_array($method, array('validate', 'filter', 'escape'))) {
            $this->method = $method;
        } else {
            throw new FilterException
            ('Filters: Must provide the name of the requested method.');
        }

        if ($field_name == '' || $field_name === null) {
            throw new FilterException
            ('Filters: Must provide the field name.');
        } else {
            $this->field_name = $field_name;
        }

        $this->field_value = $field_value;

        $filter_types = explode(',', $filter_type_chain);

        if (is_array($filter_types) && count($filter_types) > 0) {
            $this->filter_types = $filter_types;
        } else {
            throw new FilterException
            ('Filters: Must request at least one filter type');
        }

        if (is_array($filter_types) && count($filter_types) > 0) {
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
     * @throws  FilterException
     */
    protected function processRequest()
    {
        foreach ($this->filter_types as $filter_type) {

            $filter_type = ucfirst(strtolower($filter_type));

            $class = $this->getType($filter_type);

            try {

                $ft = new $class (
                    $filter_type,
                    $this->method,
                    $this->field_name,
                    $this->field_value,
                    $this->options
                );

            } catch (Exception $e) {

                throw new FilterException
                ('Filters: Could not instantiate Filter Type: ' . $filter_type
                    . ' Class: ' . $class);
            }

            try {

                $method            = $this->method;

                $this->field_value = $ft->$method();

            } catch (Exception $e) {

                throw new FilterException
                ('Filters: Could not call Filter Type: ' . $filter_type
                    . ' Class: ' . $class
                    . ' for Method: ' . $this->method);
            }
        }

        return;
    }

    /**
     * Instantiates Filter Class
     *
     * @param   string  $filter_type
     *
     * @return  object
     * @since   1.0
     * @throws  FilterException
     */
    protected function getType($filter_type)
    {
        $class = 'Molajo\\Filters\\Type\\' . $filter_type;

        if (class_exists($class)) {
        } else {
            throw new FilterException
            ('Filter Type Class ' . $class . ' does not exist.');
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
