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

    try {
        $reflector = new ReflectionClass($key);
    } catch (Exception $e) {
        $use = false;
    }

    if ($use === true) {

        /**
         *  Project Repository
         */
        $doc                    = new stdClass();
        $doc->github_repository = 'https://github.com/' . $project . '/' . $repository;
        $doc->class_url         = $doc->github_repository . '/tree/master/' . $relative_path;
        if ($extra_urls === true) {
            $doc->document_url = $doc->github_repository . '/blob/master/.dev/Doc/' . $relative_path;
            $doc->unittest_url = $doc->github_repository . '/blob/master/.dev/Tests/' . $class_name . 'Test.php';
        } else {
            $doc->document_url = null;
            $doc->unittest_url = null;
        }

        /**
         *  Class
         */
        $doc->file_path       = $relative_path;
        $doc->class_name      = $class_name;
        $doc->class_namespace = $key;
        $doc->class_comment   = $reflector->getDocComment();
        $doc->namespace       = $reflector->getNamespaceName();
        $doc->interface_names = $reflector->getInterfaceNames();
        $doc->instantiable    = $reflector->isInstantiable();
        $doc->final           = $reflector->isFinal();
        $doc->abstract        = $reflector->isAbstract();

        /**
         *  Class Properties
         */
        $properties_array = array();
        foreach ($reflector->getProperties() as $property) {

            $pinstance = $reflector->getProperty($property->name);

            $pinstance->setAccessible(true);

            $row                   = new stdClass();
            $row->name             = $property->name;
            $row->property_comment = $pinstance->getDocComment();
            $row->property_value   = $pinstance->getValue($pinstance);

            $properties_array[] = $row;
        }

        $doc->class_properties = $properties_array;

        /**
         *  Methods
         */
        $method_array = array();
        foreach ($reflector->getMethods() as $method) {

            if ($method->isPublic()) {

                $method_class                 = new stdClass();
                $method_class->name           = $method->name;
                $method_class->method_comment = $method->getDocComment();
                $method_parameters            = array();

                /**
                 *  Method Parameters
                 */
                foreach ($method->getParameters() as $parameter) {

                    $param_class       = new stdClass();
                    $param_class->name = $parameter->name;

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

                    if ($parameter->isOptional()) {
                        $param_class->is_optional = true;
                    } else {
                        $param_class->is_optional = false;
                    }

                    $method_parameters[] = $param_class;
                }

                $method_class->parameters = $method_parameters;

                $method_array[$method_class->name] = $method_class;
            }
        }

        $doc->methods = $method_array;
    }
    $class_array[] = $doc;
}
