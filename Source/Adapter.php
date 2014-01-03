<?php
/**
 * Fieldhandler Adapter
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use Exception;
use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerInterface;

/**
 * Fieldhandler Adapter
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
class Adapter implements FieldhandlerInterface
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
     * @return  mixed
     * @since   1.0
     */
    public function __construct()
    {

    }

    /**
     * Validate
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $fieldhandler_type_chain
     * @param   array      $options
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate(
        $field_name,
        $field_value = null,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        return $this->editRequest(
            'validate',
            $field_name,
            $field_value,
            $fieldhandler_type_chain,
            $options
        );
    }

    /**
     * Filter
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $fieldhandler_type_chain
     * @param   array      $options
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter(
        $field_name,
        $field_value = null,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        return $this->editRequest(
            'filter',
            $field_name,
            $field_value,
            $fieldhandler_type_chain,
            $options
        );
    }

    /**
     * Escape
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $fieldhandler_type_chain
     * @param   array      $options
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape(
        $field_name,
        $field_value = null,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        return $this->editRequest(
            'escape',
            $field_name,
            $field_value,
            $fieldhandler_type_chain,
            $options
        );
    }

    /**
     * Edit Request
     *
     * @param   string     $method
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $fieldhandler_type_chain
     * @param   array      $options
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
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
            throw new UnexpectedValueException
            ('Fieldhandler: Must provide the name of the requested method.');
        }

        if ($field_name == '' || $field_name === null) {
            throw new UnexpectedValueException
            ('Fieldhandler: Must provide the field name.');
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
            throw new UnexpectedValueException
            ('Fieldhandler: Must request at least one field handler type');
        }

        if (is_array($fieldhandler_types) && count($fieldhandler_types) > 0) {
            $this->options = $options;
        } else {
            $this->options = array();
        }

        return $this->processRequest();
    }

    /**
     * Process Request
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
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

                throw new UnexpectedValueException
                ('Fieldhandler: Could not instantiate Fieldhandler Type: ' . $fieldhandler_type
                . ' Class: ' . $class);
            }

            $method = $this->method;

            $this->field_value = $ft->$method();
        }

        return $this->field_value;
    }

    /**
     * Instantiates Fieldhandler Class
     *
     * @param   string $fieldhandler_type
     *
     * @return  object
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getType($fieldhandler_type)
    {
        $class = 'Molajo\\Fieldhandler\\Handler\\' . $fieldhandler_type;

        if (class_exists($class)) {
        } else {
            throw new UnexpectedValueException
            ('Fieldhandler Type class ' . $class . ' does not exist.');
        }

        return $class;
    }
}
