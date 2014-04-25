<?php
/**
 * Automate User Doc
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */

$base_path   = substr(__DIR__, 0, strlen(__DIR__) - 5);

foreach ($class_array as $doc) {
    if ($doc->project !== 'Molajo') {
    } elseif ($doc->class_name !== 'Request') {
    } else {


//foreach ($class_array as $doc) {
        echo '<pre>';
        var_dump($doc);
        die;
        /**
         *  Project Repository
         */
        echo 'Project: [' . $doc->github_repository . '](' . $doc->github_repository . ')' . PHP_EOL;
        echo 'Parent Class: [' . $doc->parent_class . PHP_EOL;

        //  $doc->document_url
        //  $doc->unittest_url

        //    $doc->file_path

        echo '# ' . $doc->class_name . ' #' . PHP_EOL;
        echo '# [' . $doc->class_namespace . '](' . $doc->class_url . ')' . PHP_EOL;
        echo '# [' . $doc->file_path . '](' . $doc->file_path . ')' . PHP_EOL;

        echo $doc->class_name . ' is:';

        echo '* Parent' . $doc->parent_class . PHP_EOL;
        echo '* Instantiable' . $doc->instantiable . PHP_EOL;
        echo '* Final' . $doc->final . PHP_EOL;
        echo '* Abstract' . $doc->abstract . PHP_EOL;

        echo $doc->class_comment . PHP_EOL;


        echo '## ' . 'Implements Interfaces: ' . PHP_EOL;
        foreach ($doc->interface_names as $interface) {
            echo '* ' . $interface . PHP_EOL;
        }

        echo '## ' . 'Class Properties: ' . PHP_EOL;

        foreach ($doc->class_properties as $properties) {
            echo $properties->name . PHP_EOL;
            echo $properties->property_comment . PHP_EOL;
            echo $properties->property_value . PHP_EOL;
        }
        die;
        /**
         *  Methods
         */
        /**   if (count($doc->methods)  > 0) {
         *
         *
         * foreach ($doc->methods as $method) {
         *
         *
         * $method_class->name
         * $method_class->method_comment
         *
         * /**
         *  Method Parameters
         */
        /**            foreach ($method_class->parameters as $parameter) {
         *
         * $parameter->name
         * $parameter->allows_null
         * $parameter->default_value
         * $parameter->is_array
         * $parameter->is_optional
         *
         * }
         *
         * }
         * }
         */
        //$doc->methods = $method_array;
    }
}
