<?php
/**
 * Source
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Reflection;

use Exception;
use ReflectionClass;
use stdClass;

/**
 * Uses PHP Reflection Classes to extract documentation from PHP repository
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @api
 */
class Source
{
    /**
     * Base Path
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $base_path;

    /**
     * Classmap
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $classmap = array();

    /**
     * Primary Project
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $primary_project = 'Molajo';

    /**
     * Source Repository
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $source_repository = 'https://github.com/';

    /**
     * Source 'path' at root of repo
     *
     * 'https://github.com/' . 'project-name/' . 'repo-name/' . $class_url_path
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $class_url_path = '/tree/master/';

    /**
     * Document 'path' after repository and before individual class document files
     *
     * 'https://github.com/' . 'project-name/' . 'repo-name/' . $document_url_path
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $document_url_path = '/blob/master/.dev/Doc/';

    /**
     * Unit Testing 'path' after repository up individual test files
     *
     * 'https://github.com/' . 'project-name/' . 'repo-name/' . $unit_tests_url_path
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $unit_tests_url_path = '/blob/master/.dev/Tests/';

    /**
     * Constructor
     *
     * @param   string $base_path
     * @param   array  $classmap
     *
     * @since   1.0.0
     */
    public function __construct(
        $primary_project = '',
        $source_repository = '',
        $class_url_path = '',
        $document_url_path = '',
        $unit_tests_url_path = ''
    ) {
        if ($primary_project === '') {
        } else {
            $this->primary_project = $primary_project;
        }

        if ($source_repository === '') {
        } else {
            $this->source_repository = $source_repository;
        }

        if ($class_url_path === '') {
        } else {
            $this->class_url_path = $class_url_path;
        }

        if ($document_url_path === '') {
        } else {
            $this->document_url_path = $document_url_path;
        }

        if ($unit_tests_url_path === '') {
        } else {
            $this->unit_tests_url_path = $unit_tests_url_path;
        }
    }

    /**
     * Using PHP Reflection and for the associative array of classes and namespaces, extract
     *  Class, Interface, Property, Method, and Parameter information
     *
     * @param  string $base_path
     * @param  array  $classmap
     *
     * ```php
     *
     * $source = new \Molajo\Reflection\Source();
     * $response = $source->process($field_name, $field_value, $constraint, $options);
     *
     * if ($response->getValidateResponse() === true) {
     *     // all is well
     * } else {
     *      foreach ($response->getValidateMessages as $code => $message) {
     *          echo $code . ': ' . $message . '/n';
     *      }
     * }
     *
     * ```
     * @api
     * @return  \CommonApi\Model\ValidateResponseInterface
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function process(
        $base_path,
        array $classmap = array()
    ) {
        $this->base_path = $base_path;
        $this->classmap  = $classmap;

        $class_array = array();
        foreach ($this->classmap as $class_namespace => $class_path) {
            $results = $this->processClass($class_namespace, $class_path);
            if ($results === null) {
            } else {
                $class_array[] = $results;
            }
        }
        echo '<pre>';
        var_dump($class_array);


    }

    /**
     * Extract information on class
     *
     * @param   string $class_namespace
     * @param   string $class_path
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function processClass($class_namespace, $class_path)
    {
        $use = true;

        $nodes      = explode('\\', $class_namespace);
        $project    = $nodes[0];
        $repository = $nodes[1];
        $class_name = $nodes[count($nodes) - 1];

        $relative_path = substr($class_path, strlen($this->base_path . '/'), 9999);
        $remove_path   = strtolower('vendor/' . $project . '/' . $repository . '/');

        if (substr($relative_path, 0, strlen($remove_path)) == $remove_path) {
            $relative_path = substr($relative_path, strlen($remove_path), 9999);
            $extra_urls    = false;
        } else {
            $extra_urls = true;
        }

        if ($project == $this->primary_project) {
        } else {
            $extra_urls = false;
        }

        /**
         *  New Class
         */
        $reflectorClass = $this->reflectClassNamespace($class_namespace);
        if ($reflectorClass === false) {
            return null;
        }

        $doc = new stdClass();

        /**
         *  Project Repository
         */
        $doc->source_repository = $this->source_repository . $project . '/' . $repository;
        $doc->project           = $project;
        $doc->repository        = $repository;

        /**
         *  Class
         */
        $doc->class_name      = $class_name;
        $doc->class_namespace = $class_namespace;
        $doc->namespace       = $reflectorClass->getNamespaceName();

        $doc->class_url = $doc->source_repository . $this->class_url_path . $relative_path;

        if ($extra_urls === true) {
            $doc->document_url = $doc->source_repository . $this->document_url_path . $relative_path;
            $doc->unittest_url = $doc->source_repository . $this->unit_tests_url_path . $class_name . 'Test.php';
        } else {
            $doc->document_url = null;
            $doc->unittest_url = null;
        }

        $doc->file_path       = $relative_path;
        $doc->instantiable    = $reflectorClass->isInstantiable();
        $doc->final           = $reflectorClass->isFinal();
        $doc->abstract        = $reflectorClass->isAbstract();
        $doc->interface_names = $reflectorClass->getInterfaceNames();

        $doc = $this->processComment($reflectorClass->getDocComment(), 'class_', $doc);

        /**
         *  Parent
         */
        $temp = $reflectorClass->getParentClass();
        if (is_object($temp)) {
            $doc->parent_class = $temp->name;
        } else {
            $doc->parent_class = null;
        }

        /**
         *  Properties
         */
        $properties = array();

        foreach ($reflectorClass->getProperties() as $property) {
            $properties[] = $this->getProperty($reflectorClass, $property->name);
        }

        $doc->class_properties = $properties;

        /**
         *  Methods
         */
        $methods = array();

        foreach ($reflectorClass->getMethods() as $method) {
            if ($method->isPublic()) {
                $row                 = $this->getMethod($reflectorClass, $method, $doc->class_url);
                $row                 = $this->getParameters($method, $row);
                $methods[$row->name] = $row;
            }
        }

        $doc->methods = $methods;

        return $doc;
    }

    /**
     * Get Class Reflection Object
     *
     * @param   string $class_namespace
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function reflectClassNamespace($class_namespace)
    {
        try {
            $reflectorClass = new ReflectionClass($class_namespace);

        } catch (Exception $e) {
            return false;
        }

        return $reflectorClass;
    }

    /**
     * Get Property
     *
     * @param   object $reflectorClass
     * @param   string $property_name
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getProperty($reflectorClass, $property_name)
    {
        $reflectorProperty = $reflectorClass->getProperty($property_name);

        $reflectorProperty->setAccessible(true);

        $row = new stdClass();

        $row->name           = $property_name;
        $row                 = $this->processComment($reflectorProperty->getDocComment(), 'property_', $row);
        $row->property_value = $reflectorProperty->getValue($reflectorProperty);

        return $row;
    }

    /**
     * Get Class Method
     *
     * @param   object $reflectorClass
     * @param   object $method
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMethod($reflectorClass, $method, $class_url)
    {
        $row                 = new stdClass();
        $row->name           = $method->name;
        $row                 = $this->processComment($method->getDocComment(), 'method_', $row);
        $row->get_start_line = $method->getStartLine();
        $row->method_url     = $class_url . '#L' . $row->get_start_line;

        return $row;
    }

    /**
     * Get all parameters for specified method
     *
     * @param   object $method
     * @param   object $row
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getParameters($method, $row)
    {
        $method_parameters = array();

        $param_array = array();
        if (isset($row->param_array)) {
            $param_array = $row->param_array;
        }
        $count = count($param_array);

        foreach ($method->getParameters() as $parameter) {
            $temp             = $this->getParameter($parameter);
            $temp->data_type  = '';
            $temp->definition = '';

            $needle = '$' . $temp->name;
            if ($count > 0) {
                foreach ($param_array as $param_item) {
                    if (strpos($param_item, $needle)) {
                        $temp->data_type = trim(substr($param_item, 0, strpos($param_item, $needle)));
                        $x = trim(substr(
                            $param_item,
                            strpos($param_item, $needle) + 1 + strlen($param_item),
                            9999
                        ));
                        if ($x === false) {
                            $temp->definition = null;
                        } else {
                            $temp->definition = $x;
                        }
                    }
                }
            }

            $method_parameters[] = $temp;
        }

        $row->parameters = $method_parameters;

        return $row;
    }

    /**
     * Get a parameter
     *
     * @param   object $parameter
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getParameter($parameter)
    {
        $param_class           = new stdClass();
        $param_class->name     = $parameter->getName();
        $param_class->position = $parameter->getPosition();

        if ($parameter->allowsNull()) {
            $param_class->allows_null = 1;
        } else {
            $param_class->allows_null = 0;
        }

        if ($parameter->isDefaultValueAvailable()) {
            $param_class->default_value = $parameter->getDefaultValue();
        } else {
            $param_class->default_value = null;
        }

        if ($parameter->isArray()) {
            $param_class->is_array = true;
        } else {
            $param_class->is_array = false;
        }

        if ($parameter->isCallable()) {
            $param_class->is_callable = true;
        } else {
            $param_class->is_callable = false;
        }
        if ($parameter->isOptional()) {
            $param_class->is_optional = true;
        } else {
            $param_class->is_optional = false;
        }

        $param_class->type_hint = $parameter->getClass();

        return $param_class;
    }

    /**
     * Split comment into associative array
     *
     * @param   string $comment
     * @param   string $prefix
     * @param   object $doc
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function processComment($comment, $prefix, $doc)
    {
        $params = array();

        $results = explode('@', $comment);

        if (count($results) > 0 && is_array($results)) {
        } else {
            return $results;
        }

        $i = 0;
        foreach ($results as $item) {
            if ($i == 0) {
                $doc->comment = $this->cleanItem($item);

            } else {
                $name  = $this->cleanItem(ltrim(rtrim(substr($item, 0, strpos($item, ' ')))));
                $value = $this->cleanItem(ltrim(rtrim(substr($item, strpos($item, ' ') + 1, 999999))));

                if ($name === 'param') {
                    $params[] = $value;

                } else {
                    if ($name === 'api') {
                        $name  = 'api';
                        $value = true;

                    } else {
                        $name = $prefix . $name;
                    }
                    $doc->$name = $value;
                }
            }
            $i ++;
        }

        if (is_array($params) && count($params) > 0) {
            $doc->param_array = $params;
        }

        return $doc;
    }

    /**
     * Clean item of non-content data
     *
     * @param   string $item
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function cleanItem($item)
    {
        return ltrim(rtrim(str_replace(array('/**', '*/', '*'), '', $item)));
    }
}
