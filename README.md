=======
FieldHandler
=======

[![Build Status](https://travis-ci.org/Molajo/FieldHandler.png?branch=master)](https://travis-ci.org/Molajo/FieldHandler)

Validates input. Filters input. Escapes (and formats) output.

Standard data type and PHP-specific filters and validation, value list verification, callbacks,
regex checking, and more. Use with rendering to ensure proper escaping of output data and for
special field-level formatting needs. Supports chaining.

## Basic Usage ##

Each field is validated, filtered, or escaped by a single or set of field handler(s).

```php
    try {
        $adapter = new Molajo\FieldHandler\Adapter();
        $filtered = $adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

    } catch (Exception $e) {
        //handle the exception
    }

    // Success!
    echo $filtered;
```


###Three methods:###

1. **validate** Validates the field value using field handler(s) requested.
2. **filter** Filters the field value using field handler(s) requested.
3. **escape** Escapes (or formats) the field for display, given the field handler(s) requested.

###Four parameters:###

1. **$field_name** specify the name of the field for use in exception messages;
2. **$field_value** send in the existing data value to be validated, filtered, escaped or formatted;
3. **$fieldhandler_type_chain** one or more field handlers, separated by a comma, processed in left-to-right order;
4. **$options** associative array of named pair values required by field handlers.

###Two possible results:###

1. **Success** processed field value returned
2. **Failure** exception thrown

####Example Usage####

The following example demonstrates how to validate the `extension_id` field.

* A chain of field handlers: `int`, `default`, and `required` which will be processed in this order.
* The `options` associative array with two elements:
    1. `default` and the default value for the field;
    2. `required` element and the value `true`.

```php

    $fieldhandler_type_chain = array('int', 'default', 'required', 'foreignkey');
    $options = array('default' => 14, 'required' => true, 'foreignkey' => 'id', 'table' => 'extensions');

    try {
        $adapter = new Molajo/FieldHandler/Adapter();
        $validated_value = $adapter->validate('extension_id', 12, $fieldhandler_type_chain, $options);

    } catch (Exception $e) {
        //handle the exception here
    }

    // Success!
    echo $validated_value;

```
**Results:**

If the method was a success, simply retrieve the field value from the resulting object.

Use the Try/Catch pattern, as presented above, to catch thrown exceptions.

## Available FieldHandlers ##

The examples in this section assume the *Fieldhandler* has been instantiated, as follows:

```php
    $adapter = new Molajo/FieldHandler/Adapter();
```

### Accepted ###
Value is true, 1, 'yes', or 'on.'

```php
        $validated_value = $adapter->validate('agreement', 1, 'Accepted');

```

### Alias ###
Tests if values are valid for a URL slug. When used with `filter` or `escape`, the value returned can be used as
an alias value.

```php
        // Title 'Jack and Jill' will be returned as 'jack-and-jill' for filter and escape
        // An exception would be thrown for validate
        $alias = $this->adapter->filter('title', 'Jack and Jill', 'Alias');

```

### Alpha ###
Tests if values are a character of A through Z.

```php
        // Field order_number 'ABC123#' would be returned as 'ABC' for filter and escape
        // An exception would be thrown for validate
        $results = $this->adapter->filter('order_number', 'ABC123#', 'Alpha');

```

### Alphanumeric ###
Tests if values are a character of A through Z or 0 through 9.

```php
        // Field order_number 'ABC123#' would be returned as 'ABC123' for filter and escape
        // An exception would be thrown for validate
        $results = $this->adapter->filter('order_number', 'ABC123#', 'Alphanumeric');

```

### Arrays ###
Tests if value is an array.

```php
        // Field order_number 'ABC123#' would be returned as 'ABC123' for filter and escape
        // An exception would be thrown for validate
        $results = $this->adapter->filter('order_number', 'ABC123#', 'Alphanumeric');

```
### Boolean ###
Tests if value is true or false.

```php
        // Field on_or_off_field false would be returned as NULL for filter and escape
        // An exception would be thrown for validate
        $results = $this->adapter->filter('on_or_off_field', false, 'Boolean');

```

### Callback ###
Processes a value by the specified Callback. For Validate, if the resulting value does not match
the current value, an Exception is thrown. For Filter and Escape, the value produced by the
Callback is returned.

```php
        // The value of field `example_field` is 'DOG' and is processed by the callback `strtolower`.
        // An exception would be thrown for validate. The value 'dog' is returned for Filter and Escape.
        $options = array();
        $options['callback'] = 'strtolower';
        $results = $this->adapter->filter('example_field', 'DOG', 'Callback', $options);

```

### Date ###
Processes a value to determine if it is a valid date. For Validate, if the resulting value is not a valid
 date, an Exception is thrown. For Filter and Escape, the value returned is NULL if it is not valid.

```php
        // The value of field `date_field` is '2013/04/01 01:00:00' and determined to be valid
        $options = array();
        $options['callback'] = '2013/04/01 01:00:00';
        $results = $this->adapter->filter('date_field', '2013/04/01 01:00:00', 'Date');

```

### Defaults ###
Changes a null value to the value provided for default.

```php
        // The value of field `dog_field` is NULL and is set to 'bark'.
        $options = array();
        $options['default'] = 'bark';
        $results = $this->adapter->filter('dog_field', NULL, 'Default');

```

### Digit ###
Tests that each digit is numeric.

```php
        // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 123.
        // For 'validate', an exception is thrown.

        $results = $this->adapter->filter('numeric_field', 'ABC123', 'Digit');

```

### Encoded ###
Tests that an encoded value is sanitized.

```php
        // The value of field `encoded_field` is 'my-apples&are green and red'.
        // The filtered and escaped values will be 'my-apples%26are%20green%20and%20red'.

        $results = $this->adapter->filter('encoded_field', 'my-apples&are green and red', 'Encoded');

```

### Equals ###
Tests that a value is equal to the specified value. If the value does not match for validate, an
Exception is thrown. If the value does not match for filter or escape, null is returned.

```php
        // The value of field `field1` is 'dog' and is tested to see if it matches 'dog'.
        $results = $this->adapter->filter('field1', 'dog', 'Equals');

```
## System Requirements ##

* PHP 5.3.3, or above
* [PSR-0 compliant Autoloader](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* PHP Framework independent
* [optional] PHPUnit 3.5+ to execute the test suite (phpunit --version)

### Installation

#### Install using Composer from Packagist

**Step 1** Install composer in your project:

```php
    curl -s https://getcomposer.org/installer | php
```

**Step 2** Create a **composer.json** file in your project root:

```php
{
    "require": {
        "Molajo/FieldHandler": "1.*"
    }
}
```

**Step 3** Install via composer:

```php
    php composer.phar install
```

About
=====

Molajo Project observes the following:

 * [Semantic Versioning](http://semver.org/)
 * [PSR-0 Autoloader Interoperability](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
 * [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
 and [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
 * [phpDocumentor2] (https://github.com/phpDocumentor/phpDocumentor2)
 * [phpUnit Testing] (https://github.com/sebastianbergmann/phpunit)
 * [Travis Continuous Improvement] (https://travis-ci.org/profile/Molajo)
 * [Packagist] (https://packagist.org)


Submitting pull requests and features
------------------------------------

Pull requests [GitHub](https://github.com/Molajo/FieldHandler/pulls)

Features [GitHub](https://github.com/Molajo/FieldHandler/issues)

Author
------

Amy Stephen - <AmyStephen@gmail.com> - <http://twitter.com/AmyStephen><br />
See also the list of [contributors](https://github.com/Molajo/FieldHandler/contributors) participating in this project.

License
-------

**Molajo FieldHandler** is licensed under the MIT License - see the `LICENSE` file for details

More Information
----------------
- [Extend](https://github.com/Molajo/FieldHandler/blob/master/.dev/Doc/extend.md)
- [Install](https://github.com/Molajo/FieldHandler/blob/master/.dev/Doc/install.md)
