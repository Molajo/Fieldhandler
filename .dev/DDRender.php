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

    /**
     *  Project Repository
     */
  echo 'Project: [' .  $doc->github_repository . '](' . $doc->github_repository . ')';
  //  $doc->document_url
  //  $doc->unittest_url

    //    $doc->file_path
    // $doc->class_name
    echo '# ' . $doc->class_name;
    echo '# [' . $doc->class_namespace . '](' . $doc->class_url . ')';

    echo $doc->class_name . ' is:';

    echo '* Instantiable' . $doc->instantiable . '<br>';
    echo '* Final' .  $doc->final . '<br>';
    echo '* Abstract' . $doc->abstract . '<br>';

    echo $doc->class_comment;

    echo '## ' . 'Implements Interfaces: ' ;

    foreach ($doc->interface_names as $interface) {
        echo '* ' . $interface;
    }

    echo '## ' . 'Class Properties: ' ;

        foreach ($doc->class_properties as $properties) {
            echo $properties->name . '<br>';
            echo $properties->property_comment . '<br>';
            echo $properties->property_value . '<br>';
        }

    /**
     *  Methods
     */
 /**   if (count($doc->methods)  > 0) {


    foreach ($doc->methods as $method) {


            $method_class->name
            $method_class->method_comment

            /**
             *  Method Parameters
             */
/**            foreach ($method_class->parameters as $parameter) {

                $parameter->name
                $parameter->allows_null
                $parameter->default_value
                $parameter->is_array
                $parameter->is_optional

            }

        }
}
 */
    //$doc->methods = $method_array;
}
