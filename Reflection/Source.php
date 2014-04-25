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
     * Primary Repository
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $primary_repository = 'Fieldhandler';

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
     * Relative Path to install base
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $relative_path = null;

    /**
     * All Class URLs
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $class_url_array = array();

    /**
     * Class Data Object
     *
     * @api
     * @var    object
     * @since  1.0.0
     */
    protected $class_data_object = null;

    /**
     * Class Reflection Object
     *
     * @api
     * @var    object
     * @since  1.0.0
     */
    protected $class_reflection_object = null;

    /**
     * Constructor
     *
     * @param   string $source_repository
     * @param   string $class_url_path
     * @param   string $document_url_path
     * @param   string $unit_tests_url_path
     *
     * @since   1.0.0
     */
    public function __construct(
        $source_repository = '',
        $class_url_path = '',
        $document_url_path = '',
        $unit_tests_url_path = ''
    ) {
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
     * @param  string  $base_path
     * @param  array   $classmap
     * @param  string  $primary_project
     * @param  string  $primary_repository
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
        array $classmap = array(),
        $primary_project,
        $primary_repository
    ) {
        $this->base_path = $base_path;
        $this->classmap  = $classmap;

        if ($primary_project === '') {
        } else {
            $this->primary_project = $primary_project;
        }

        if ($primary_repository === '') {
        } else {
            $this->primary_repository = $primary_repository;
        }

        $this->class_url_array = array();
        foreach ($this->classmap as $class_namespace => $class_path) {
            $this->class_url_array[$class_namespace]
                = $this->preprocessClassLocations($class_namespace, $class_path);
        }

        $class_array = array();
        foreach ($this->classmap as $class_namespace => $class_path) {

            if (isset($this->class_url_array[$class_namespace])
                && $this->class_url_array[$class_namespace]->primary_project === true
                && $this->class_url_array[$class_namespace]->primary_repository === true
            ) {
                $class_name     = $this->class_url_array[$class_namespace]->class_name;
                $this->reflectClassNamespace($class_namespace);

                if ($this->class_reflection_object === false) {
                } else {
                    $this->class_data_object = new stdClass();

                    $this->processClass($class_name, $class_namespace);

                    $class_array[] = $this->class_data_object;
                }
            }
        }

        file_put_contents(__DIR__ . '/' . $this->primary_project . $this->primary_repository . '.json',
            json_encode($class_array, JSON_PRETTY_PRINT)
        );

        return $this;
    }

    /**
     * Preprocess all class locations so that URL's and paths are available for parent classes
     *
     * @param   string $class_namespace
     * @param   string $class_path
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function preprocessClassLocations($class_namespace, $class_path)
    {
        $nodes      = explode('\\', $class_namespace);
        $project    = $nodes[0];
        $repository = $nodes[1];
        $class_name = $nodes[count($nodes) - 1];

        $relative_path = substr($class_path, strlen($this->base_path . '/'), 9999);

        $class_location                    = new stdClass();
        $class_location->project           = $project;
        $class_location->repository        = $repository;
        $class_location->source_repository = $this->source_repository . $project . '/' . $repository;
        $class_location->class_name        = $class_name;

        if ($project == $this->primary_project) {
            $class_location->primary_project = true;
        } else {
            $class_location->primary_project = false;
        }

        if ($repository == $this->primary_repository) {
            $class_location->primary_repository = true;
        } else {
            $class_location->primary_repository = false;
        }

        if ($class_location->primary_project === true
            && $class_location->primary_repository === true
        ) {
            $class_location->relative_path = $relative_path;
            $class_location->class_url     = $class_location->source_repository . $this->class_url_path . $relative_path;
        } else {
            $class_location->relative_path = null;
            $class_location->class_url     = null;

        }

        return $class_location;
    }

    /**
     * Extract information on class
     *
     * @param   string $class_name
     * @param   string $class_namespace
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function processClass($class_name, $class_namespace)
    {
        $this->getClassProject($class_namespace);
        $this->getClassMeta($class_name, $class_namespace);
        $this->processComment($this->class_reflection_object->getDocComment(), $this->class_data_object);
        $this->getParent();
        $this->getProperties();
        $this->getMethods();

        return $this;
    }

    /**
     * Get Class Reflection Object
     *
     * @param   string $class_namespace
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function reflectClassNamespace($class_namespace)
    {
        try {
            $this->class_reflection_object = new ReflectionClass($class_namespace);

        } catch (Exception $e) {
            return false;
        }

        return $this;
    }

    /**
     * Extract information on class
     *
     * @param   string $class_namespace
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getClassProject($class_namespace)
    {
        $this->class_data_object->project           = $this->primary_project;
        $this->class_data_object->repository        = $this->primary_repository;
        $this->class_data_object->source_repository = $this->class_url_array[$class_namespace]->source_repository;

        return $this;
    }

    /**
     * Get Class Meta Data
     *
     * @param   string $class_name
     * @param   string $class_namespace
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getClassMeta($class_name, $class_namespace)
    {
        $this->class_data_object->class_name      = $class_name;
        $this->class_data_object->class_namespace = $class_namespace;
        $this->class_data_object->namespace       = $this->class_reflection_object->getNamespaceName();

        $this->class_data_object->class_url
            = $this->class_url_array[$class_namespace]->class_url;
        $this->class_data_object->document_url
            = $this->class_data_object->source_repository . $this->document_url_path . $this->relative_path;
        $this->class_data_object->unittest_url
            = $this->class_data_object->source_repository . $this->unit_tests_url_path . $class_name . 'Test.php';
        $this->class_data_object->file_path
            = $this->class_url_array[$class_namespace]->relative_path;

        $this->class_data_object->instantiable    = $this->class_reflection_object->isInstantiable();
        $this->class_data_object->final           = $this->class_reflection_object->isFinal();
        $this->class_data_object->abstract        = $this->class_reflection_object->isAbstract();
        $this->class_data_object->interface_names = $this->class_reflection_object->getInterfaceNames();

        return $this;
    }

    /**
     * Retrieve Parent Class information
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getParent()
    {
        $temp = $this->class_reflection_object->getParentClass();

        if (is_object($temp)) {
            $this->class_data_object->parent_class
                = $temp->name;
            $this->class_data_object->parent_class_url
                = $this->class_url_array[$this->class_data_object->parent_class]->class_url;
        } else {
            $this->class_data_object->parent_class     = null;
            $this->class_data_object->parent_class_url = null;
        }

        return $this;
    }

    /**
     * Retrieve properties for class
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getProperties()
    {
        $properties = array();

        foreach ($this->class_reflection_object->getProperties() as $property) {
            $properties[] = $this->getProperty($property->name);
        }

        $this->class_data_object->class_properties = $properties;

        return $this;
    }

    /**
     * Get a specific property for the class
     *
     * Appears PHP does not support getStartLine() for class properties?
     *
     * @param   string $property_name
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getProperty($property_name)
    {
        $reflectorProperty = $this->class_reflection_object->getProperty($property_name);
        $reflectorProperty->setAccessible(true);

        $row = new stdClass();

        $row->name            = $property_name;
        $row->declaring_class = $reflectorProperty->getDeclaringClass()->name;
        $row->property_url    = $this->class_url_array[$row->declaring_class]->class_url;

        if ($reflectorProperty->isDefault() === true) {
            $row->method_modifier = 'default';
        } elseif ($reflectorProperty->isPrivate() === true) {
            $row->method_modifier = 'private';
        } elseif ($reflectorProperty->isProtected() === true) {
            $row->method_modifier = 'protected';
        } elseif ($reflectorProperty->isPublic() === true) {
            $row->$reflectorProperty = 'public';
        } else {
            $row->$reflectorProperty = 'static';
        }

        $row        = $this->processComment($reflectorProperty->getDocComment(), $row);
        $row->value = $reflectorProperty->getValue($reflectorProperty);

        return $row;
    }

    /**
     * Retrieve methods for class
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMethods()
    {
        $methods = array();

        foreach ($this->class_reflection_object->getMethods() as $method) {
            $row                 = $this->getMethod($method, $this->class_data_object->class_url);
            $row                 = $this->getParameters($method, $row);
            $methods[$row->name] = $row;
        }

        $this->class_data_object->methods = $methods;

        return $this;
    }

    /**
     * Get a specific method for the class
     *
     * @param   object $method
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getMethod($method)
    {
        $row       = new stdClass();
        $row->name = $method->name;

        if ($method->isConstructor() === true) {
            $row->method_modifier = 'constructor';
        } elseif ($method->isDestructor() === true) {
            $row->method_modifier = 'destructor';
        } elseif ($method->isFinal() === true) {
            $row->method_modifier = 'final';
        } elseif ($method->isPrivate() === true) {
            $row->method_modifier = 'private';
        } elseif ($method->isProtected() === true) {
            $row->method_modifier = 'protected';
        } elseif ($method->isPublic() === true) {
            $row->method_modifier = 'public';
        } elseif ($method->isStatic() === true) {
            $row->method_modifier = 'static';
        } else {
            $row->method_modifier = 'abstract';
        }

        $row->declaring_class = $method->getDeclaringClass()->name;
        $row                  = $this->processComment($method->getDocComment(), $row);
        $row->get_start_line  = $method->getStartLine();
        $row->get_end_line    = $method->getEndLine();
        $row->method_url      = $this->class_url_array[$row->declaring_class]->class_url
            . '#L' . $row->get_start_line;
        $row->method_url_end  = $this->class_url_array[$row->declaring_class]->class_url
            . '#L' . $row->get_end_line;

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

        if (isset($row->param_array)) {
            $comment_param_array = $row->param_array;
            unset($row->param_array);
        } else {
            $comment_param_array = array();
        }

        foreach ($method->getParameters() as $parameter) {
            $method_parameters[] = $this->getParameter($parameter, $comment_param_array);
        }

        $row->parameters = $method_parameters;

        return $row;
    }

    /**
     * Get a specific method parameter
     *
     * @param   object $parameter
     * @param   array  $comment_param_array
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getParameter($parameter, $comment_param_array)
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

        if ($parameter->isOptional()) {
            $param_class->is_optional = true;
        } else {
            $param_class->is_optional = false;
        }

        $results              = $this->searchCommentParamArray($param_class->name, $comment_param_array);
        $data_type            = $results[0];
        $param_class->comment = $results[1];

        if ($parameter->isArray() === true) {
            $param_class->method_modifier = 'array';

        } elseif ($parameter->isCallable() === true) {
            $param_class->method_modifier = 'callable';

        } else {
            $param_class->method_modifier = $data_type;
        }

        $param_class->type_hint = $parameter->getClass();

        return $param_class;
    }

    /**
     * For those parameters without type hints (array or callable), search the comments
     *  for a matching parameter name and use the definition there
     *
     * @param   string $parameter_name
     * @param   array  $comment_param_array
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function searchCommentParamArray($parameter_name, array $comment_param_array)
    {
        $needle = '$' . $parameter_name;

        $data_type  = null;
        $definition = null;

        if (count($comment_param_array) > 0) {
        } else {
            return array($data_type, $definition);
        }

        foreach ($comment_param_array as $item) {

            if (strpos($item, $needle)) {

                $data_type  = trim(substr($item, 0, strpos($item, $needle)));
                $definition = trim(substr($item, strpos($item, $needle) + 1 + strlen($item), 9999));

                if ($definition === false) {
                    $definition = null;
                }
                break;
            }
        }

        return array($data_type, $definition);
    }

    /**
     * Split comment into associative array
     *
     * @param   string $comment
     * @param   object $source_data_object
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function processComment($comment, $source_data_object)
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
                $source_data_object->comment = $this->cleanItem($item);

            } else {
                $name  = $this->cleanItem(ltrim(rtrim(substr($item, 0, strpos($item, ' ')))));
                $value = $this->cleanItem(ltrim(rtrim(substr($item, strpos($item, ' ') + 1, 999999))));

                if ($name === 'var') {
                    $name = 'data_type';
                }

                if ($name === 'param') {
                    $params[] = $value;

                } else {
                    if ($name === 'api') {
                        $name  = 'api';
                        $value = true;
                    }

                    $source_data_object->$name = $value;
                }
            }
            $i ++;
        }

        if (is_array($params) && count($params) > 0) {
            $source_data_object->param_array = $params;
        }

        return $source_data_object;
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
