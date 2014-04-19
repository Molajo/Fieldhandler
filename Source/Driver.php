<?php
/**
 * Fieldhandler Driver
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use Exception;
use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ValidateInterface;
use CommonApi\Model\FilterInterface;
use CommonApi\Model\EscapeInterface;

/**
 * Fieldhandler Driver
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
class Driver implements ValidateInterface, FilterInterface, EscapeInterface
{
    /**
     * Validate
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $fieldhandler_type_chain
     * @param   array      $options
     *
     * @return  \CommonApi\Model\FieldhandlerItemInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate($field_name, $field_value = null, $fieldhandler_type_chain, array $options = array())
    {
        return $this->processRequest('validate', $field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * Filter
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $fieldhandler_type_chain
     * @param   array      $options
     *
     * @return  \CommonApi\Model\FieldhandlerItemInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter($field_name, $field_value = null, $fieldhandler_type_chain, array $options = array())
    {
        return $this->processRequest('filter', $field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * Escape
     *
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $fieldhandler_type_chain
     * @param   array      $options
     *
     * @return  \CommonApi\Model\FieldhandlerItemInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape($field_name, $field_value = null, $fieldhandler_type_chain, array $options = array())
    {
        return $this->processRequest('escape', $field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * Process Request
     *
     * @param   string     $method
     * @param   string     $field_name
     * @param   null|mixed $field_value
     * @param   string     $fieldhandler_type_chain
     * @param   array      $options
     *
     * @return  \CommonApi\Model\FieldhandlerItemInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function processRequest(
        $method,
        $field_name,
        $field_value = null,
        $fieldhandler_type_chain,
        array $options = array()
    ) {
        $method             = $this->editMethod($method);
        $field_name         = $this->editFieldName($field_name);
        $fieldhandler_types = $this->editFieldhandlerTypes($fieldhandler_type_chain);
        $return_value       = true;
        $error_messages     = array();

        foreach ($fieldhandler_types as $fieldhandler_type) {

            $fieldhandler_type = ucfirst(strtolower($fieldhandler_type));
            $class             = $this->getType($fieldhandler_type);

            try {
                $fieldhandler_instance = new $class ($fieldhandler_type, $method, $field_name, $field_value, $options);

            } catch (Exception $e) {

                throw new UnexpectedValueException
                (
                    'Fieldhandler Driver: Could not instantiate Fieldhandler Adapter for Type: ' . $fieldhandler_type
                    . ' Class: ' . $class
                );
            }

            $method_response = $fieldhandler_instance->$method();

            $messages = $fieldhandler_instance->getErrorMessages();

            if (count($messages) > 0) {
                $tokens['field_name']        = $field_name;
                $tokens['field_value']       = $field_value;
                $tokens['fieldhandler_type'] = $fieldhandler_type;
                $tokens['method']            = $method;
                $messages                    = $this->setErrorMessageTokens($messages, $tokens);
            }

            if (count($messages) > 0 && is_array($messages)) {
                $error_messages = $messages + $error_messages;
            }

            if ($method === 'validate') {
                if ($method_response === false) {
                    $return_value = false;
                }
            } else {
                $field_value  = $method_response;
                $return_value = $method_response;
            }
        }

        return $this->getFieldhandlerItem($field_name, $return_value, $error_messages);
    }

    /**
     * Replace tokens in error messages
     *
     * @param   array $error_messages
     * @param   array $token
     *
     * @return  array
     * @since   1.0.0
     */
    protected function setErrorMessageTokens(array $error_messages, array $tokens)
    {
        $replace = array();
        foreach ($tokens as $token => $value) {
            if (is_array($value)) {
                $value = implode(',', $value);
            } elseif (is_object($value)) {
                $value = 'object';
            }
            $value                       = (string)$value;
            $replace['{' . $token . '}'] = $value;
        }

        $new = array();
        foreach ($error_messages as $code => $message) {
            $new[$code] = strtr($message, $replace);
        }

        return $new;
    }

    /**
     * Edit Method Value
     *
     * @param   string $method
     *
     * @return  string
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function editMethod($method)
    {
        $method = strtolower($method);

        if (in_array($method, array('validate', 'filter', 'escape'))) {
            return $method;
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler: Must provide the name of the requested method.'
            );
        }
    }

    /**
     * Edit Field Name
     *
     * @param   string $field_name
     *
     * @return  string
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function editFieldName($field_name)
    {
        if ($field_name == '' || $field_name === null) {
            throw new UnexpectedValueException
            (
                'Fieldhandler: Must provide the field name.'
            );
        }

        return $field_name;
    }

    /**
     * Edit Fieldhandler Requests
     *
     * @param   string $fieldhandler_type_chain
     *
     * @return  array
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function editFieldhandlerTypes($fieldhandler_type_chain)
    {
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
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler: Must request at least one field handler type'
            );
        }

        return $fieldhandler_types;
    }

    /**
     * Instantiates Fieldhandler Class
     *
     * @param   string $fieldhandler_type
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getType($fieldhandler_type)
    {
        $class = 'Molajo\\Fieldhandler\\Adapter\\' . $fieldhandler_type;

        if (class_exists($class)) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Type class ' . $class . ' does not exist.'
            );
        }

        return $class;
    }

    /**
     * Instantiates, loads and returns Fieldhandler Item Class
     *
     * @param   string $field_name
     * @param   mixed  $return_value
     * @param   array  $error_messages
     *
     * @return  \CommonApi\Model\FieldhandlerItemInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getFieldhandlerItem($field_name, $return_value, $error_messages)
    {
        $class = 'Molajo\\Fieldhandler\\FieldhandlerItem';

        try {
            return new $class($field_name, $return_value, $error_messages);

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler getFieldhandlerItem Method: Cannot create class ' . $class
            );
        }
    }
}
