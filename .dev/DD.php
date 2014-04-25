<?php
/**
 * Retrieve Class Data
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */

$base_path   = substr(__DIR__, 0, strlen(__DIR__) - 5);
$class_array = array();

foreach ($classmap as $key => $path) {

    $use = true;

    $nodes      = explode('\\', $key);
    $project    = $nodes[0];
    $repository = $nodes[1];
    $class_name = $nodes[count($nodes) - 1];

    $relative_path = substr($path, strlen($base_path . '/'), 9999);
    $remove_path   = strtolower('vendor/' . $project . '/' . $repository . '/');

    if (substr($relative_path, 0, strlen($remove_path)) == $remove_path) {
        $relative_path = substr($relative_path, strlen($remove_path), 9999);
        $extra_urls    = false;
    } else {
        $extra_urls = true;
    }
    if ($project == 'Molajo') {
    } else {
        $extra_urls = false;
    }


    /**
     *  Query
     */
    try {
        $reflectorClass = new ReflectionClass($key);
    } catch (Exception $e) {
        $use = false;
    }

    if ($use === true) {

        /**
         *  New Class
         */
        $doc = new stdClass();

        /**
         *  Project Repository
         */
        $doc->github_repository = 'https://github.com/' . $project . '/' . $repository;
        $doc->project = $project;
        $doc->repository = $repository;

        /**
         *  Class
         */
        $doc->class_name      = $class_name;
        $doc->class_namespace = $key; // From class map
        $doc->namespace       = $reflectorClass->getNamespaceName(); // From reflection

        $doc->class_url = $doc->github_repository . '/tree/master/' . $relative_path;
        if ($extra_urls === true) {
            $doc->document_url = $doc->github_repository . '/blob/master/.dev/Doc/' . $relative_path;
            $doc->unittest_url = $doc->github_repository . '/blob/master/.dev/Tests/' . $class_name . 'Test.php';
        } else {
            $doc->document_url = null;
            $doc->unittest_url = null;
        }

        $doc->file_path = $relative_path;

        $doc->class_comment   = $reflectorClass->getDocComment();

        $temp = $reflectorClass->getParentClass();
        if (is_object($temp)) {
            $doc->parent_class = $temp->name;
        } else {
            $doc->parent_class = null;
        }

        $doc->instantiable    = $reflectorClass->isInstantiable();
        $doc->final           = $reflectorClass->isFinal();
        $doc->abstract        = $reflectorClass->isAbstract();
        $doc->interface_names = $reflectorClass->getInterfaceNames();

        /**
         *  Class Properties
         */
        $properties_array = array();

        foreach ($reflectorClass->getProperties() as $property) {

            $reflectorProperty = $reflectorClass->getProperty($property->name);
            $reflectorProperty->setAccessible(true);

            $row                   = new stdClass();
            $row->name             = $property->name;
            $row->property_comment = $reflectorProperty->getDocComment();
            $row->property_value   = $reflectorProperty->getValue($reflectorProperty);

            $properties_array[] = $row;
        }

        $doc->class_properties = $properties_array;

        /**
         *  Methods
         */
        $method_array = array();

        foreach ($reflectorClass->getMethods() as $method) {

            if ($method->isPublic()) {

                $reflectorMethod = $reflectorClass->getMethod($method->name);

                $row                 = new stdClass();
                $row->name           = $method->name;
                $row->method_comment = $method->getDocComment();
                $row->get_start_line = $method->getStartLine();
                $row->method_url     = $doc->class_url . '#L' . $row->get_start_line;

                /**
                 *  Parameters
                 */
                $method_parameters = array();

                foreach ($method->getParameters() as $parameter) {

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

                    $method_parameters[] = $param_class;
                }

                $row->parameters = $method_parameters;

                $method_array[$row->name] = $row;
            }
        }

        $doc->methods = $method_array;
    }

    $class_array[] = $doc;
}
