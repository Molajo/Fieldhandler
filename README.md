=======
Fieldhandler
=======

[![Build Status](https://travis-ci.org/Molajo/Fieldhandler.png?branch=master)](https://travis-ci.org/Molajo/Fieldhandler)

Validates input. Filters input. Escapes (and formats) output.

Standard data type and PHP-specific filters and validation, value list verification, callbacks,
regex checking, and more. Use with rendering to ensure proper escaping of output data and for
special field-level formatting needs. Supports chaining.

## Basic Usage ##

Each field is validated, filtered, or escaped by a single or set of field handler(s).

```php
    $adapter = new Molajo\Fieldhandler\Adapter();

    try {
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

1. **Success** processed field value returned as the result
2. **Failure** exception thrown

####Example Usage####

The following example demonstrates how to validate the `extension_id` field.

* A chain of field handlers: `int`, `default`, and `required` which will be processed in this order.
* The `options` associative array with two elements:
    1. `default` and the default value for the field;
    2. `required` element and the value `true`.

```php
    $adapter = new Molajo/Fieldhandler/Adapter();

    $fieldhandler_type_chain = array('int', 'default', 'required', 'foreignkey');
    $options = array('default' => 14, 'required' => true, 'foreignkey' => 'id', 'table' => 'extensions');

    try {
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

## Available Fieldhandlers ##

- [Accepted](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#accepted)
- [Alias](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#alias)
- [Alpha](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#alpha)
- [Alphanumeric](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#alphanumeric)
- [Arrays](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#arrays)
- [Boolean](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#boolean)
- [Callback](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#callback)
- [Contains](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#contains)
- [Date](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#date)
- [Defaults](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#default)
- [Digit](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#digit)
- [Email](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#email)
- [Encoded](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#encoded)
- [Equals](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#equals)
- [Extensions](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#extensions)
- [Float](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#float)
- [Foreignkey](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#foreignkey)
- [Fromto](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#Fromto)
- [Fullspecialchars](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#fullspecialchars)
- [Html](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#html)
- [Int](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#int)
- [Ip](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#ip)
- [Lower](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#lower)
- [Maximum](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#maximum)
- [Mimetypes](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#mimetypes)
- [Minimum](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#minimum)
- [NotEqual](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#notequal)
- [Numeric](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#numeric)
- [Object](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#object)
- [Raw](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#raw)
- [Regex](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#regex)
- [Required](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#required)
- [String](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#string)
- [Stringlength](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#stringlength)
- [Time](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#time)
- [Trim](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#trim)
- [Upper](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#upper)
- [Url](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#url)
- [Values](https://github.com/Molajo/Standard/tree/master/Vendor/Molajo/Fieldhandler#values)

The examples in this section assume the *Fieldhandler* has been instantiated, as follows:

```php
    $adapter = new Molajo/Fieldhandler/Adapter();
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

### Contains ###
Tests if a value is contained within the input field. If it is not, validate fails and filter and escape
change the input to null.

```php
    // Is the value `bark` contained within the dog_field?
    $options = array();
    $options['contains'] = 'bark';
    $results = $this->adapter->filter('dog_field', $dog_field, 'Contains');

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

### Email ###
Tests that a value is a valid email address. When invalid, validate throws exception while
Filter and Escape return null.

```php
    $results = $this->adapter->validate('email_address', 'AmyStephen@gmail.com', 'Email');

```

### Encoded ###
Tests that an encoded value is sanitized.

```php
    // The value of field `encoded_field` is 'my-apples&are green and red'.
    // The filtered and escaped values will be 'my-apples%26are%20green%20and%20red'.

    $results = $this->adapter->filter('encoded_field', 'my-apples&are green and red', 'Encoded');

```

### Equal ###
Tests that a value is equal to a specified value.

```php
    // The value of field `field1` is 'dog' and is tested to see if it matches 'dog'.
    $results = $this->adapter->filter('field1', 'dog', 'Equal');

```

### Extensions ###
Tests that a value is equal to the specified value. If the value does not match for validate, an
Exception is thrown. If the value does not match for filter or escape, null is returned.

```php
    // A set of values can be sent in for testing
    $input = array();
    $input[] = '.jpg';
    $input[] = '.gif';
    $input[] = '.png';

    $field_name              = 'extensions_field';
    $field_value             = $input;
    $fieldhandler_type_chain = 'Extensions';

    $options                 = array();
    $array_valid_values = array();
    $array_valid_values[] = '.jpg';
    $array_valid_values[] = '.gif';
    $array_valid_values[] = '.png';

    $options = array('array_valid_extensions' => $array_valid_values);

    $results = $this->adapter->filter('extensions_field', $input, 'Extensions');

```

### Float ###
Tests a value to determine if it is a valid Float value.

```php
    // The value of field `numeric_field` is 1234.5678.
    $results = $this->adapter->filter('numeric_field', 1234.5678, 'Float');

```

### Foreignkey ###
Uses the database connection defined in $options['database'] to execute a query that verifies there is
a row for the table named in $options['table'] with a field named $options['key'] with a value of
$field_value.

```php
    $field_name              = 'my_foreign_key';
    $field_value             = 1;
    $fieldhandler_type_chain = 'Foreignkey';
    $options                 = array();
    $options['database']     = $database;
    $options['table']        = 'molajo_actions';
    $options['key']          = 'id';

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

```

### From To ###
Verifies that the $field_value is greater than the From value and less than the To value.

```php
    $field_name              = 'my_field';
    $field_value             = 5;
    $fieldhandler_type_chain = 'Fromto';
    $options                 = array();
    $options['from']         = 0;
    $options['to']           = 10;

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

```

### Fullspecialchars ###
Converts special characters to HTML entities. Equivalent to [htmlspecialchars](http://www.php.net/manual/en/function.htmlspecialchars.php)
with with ENT_QUOTES set.

```php
    $field_name              = 'my_field';
    $field_value             = '&';
    $fieldhandler_type_chain = 'Fullspecialchars';
    $options                 = array();

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

```

### Html ### - do white list and black list
Escapes HTML entities. Equivalent to [htmlspecialchars](http://www.php.net/manual/en/function.htmlspecialchars.php)
with with ENT_QUOTES set.

```php
    $field_name              = 'my_field';
    $field_value             = '&';
    $fieldhandler_type_chain = 'Html';
    $options                 = array();

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

```

### Int ###
Tests that the value is an integer.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 0.
    // For 'validate', an exception is thrown. The following will return 123.

    $results = $this->adapter->filter('numeric_field', '123', 'Int');

```

### IP Address ###
Tests that the value is an IP Address.

```php
    // The value of field `input_field` is '127.0.0.1'.
    // Validate, filtered and escaped values will return the same.
    $results = $this->adapter->filter('input_field', '127.0.0.1', 'Ip');

```

### Lower ###
Validates or filters/escapes each character to be lower case.

```php
    // The value of field `input_field` is 'ABC123'. Validate will fail.
    // Filtered and escaped values will return 'abc123'.
    $results = $this->adapter->filter('input_field', 'ABC123', 'lower');

```

### Maximum ###
Validates or filters/escapes numeric value to not exceed the maximum.

```php
    // The value of field `input_field` is 10. Maximum is 3. Validate will fail.
    // Filtered and escaped values will return 3.
    $field_name              = 'my_field';
    $field_value             = 10;
    $fieldhandler_type_chain = 'Maximum';
    $options                 = array();
    $options['maximum']      = 3;

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

```

### Minimum ###
Validates or filters/escapes numeric value to not exceed the maximum.

```php
    // The value of field `input_field` is 10. Minimum is 3.
    // Validate, filtered and escaped values will return 10.
    $field_name              = 'my_field';
    $field_value             = 10;
    $fieldhandler_type_chain = 'Minimum';
    $options                 = array();
    $options['minimum']      = 3;

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

```

### Not Equal ###
Tests that a value is not equal to a specified value.

```php
    // The value of field `field1` is 'dog' and is tested to ensure it is NOT equal to 'dog'.
    $results = $this->adapter->filter('field1', 'dog', 'Notequal');

```

### Numeric ###
Tests that the value is an numeric.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 0.
    // For 'validate', an exception is thrown. The following will return 123.

    $results = $this->adapter->filter('numeric_field', '123', 'Numeric');

```

### Object ###
Tests that a value is an object.

```php
    // The value of field `database` is an object containing the database connection.
    // All will return the object

    $results = $this->adapter->filter('database', $instance, 'Object');

```

### Raw ###
Do nothing, optionally strip or encode special characters.  FILTER_FLAG_STRIP_LOW,
FILTER_FLAG_STRIP_HIGH, FILTER_FLAG_ENCODE_LOW, FILTER_FLAG_ENCODE_HIGH, FILTER_FLAG_ENCODE_AMP.
See [sanitize filters](http://php.net/manual/en/filter.filters.sanitize.php).

```php
    // The value of field `input_field` is 10. Minimum is 3.
    // Validate, filtered and escaped values will return 10.
    $field_name              = 'my_field';
    $field_value             = 'Me & You';  //returns 'Me &amp; You'
    $fieldhandler_type_chain = 'Raw';
    $options                 = array();
    $options['FILTER_FLAG_ENCODE_AMP']      = true;


    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

```

### Regex ###
Performs regex checking against the input value for the regex sent in.

```php
    // The value of field `input_field` may not be null
    $field_name              = 'my_field';
    $field_value             = AmyStephen@gmail.com;
    $fieldhandler_type_chain = 'Regex';
    $options                 = array();
    $options['regex']      = $regex_expression;

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain);

```

### Required ###
Field is required. Null value is not allowed. Use after Default when used in combination.

```php
    // The value of field `input_field` may not be null
    $field_name              = 'my_field';
    $field_value             = null;
    $fieldhandler_type_chain = 'Required';

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain);

```

### String ###
Tests that the value is a string.

```php
    // The value of field `input_field` may not be null
    $field_name              = 'my_field';
    $field_value             = 'Lots of stuff in here that is stringy.';
    $fieldhandler_type_chain = 'String';

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain);
```

### String Length ###
Tests that the length of the string is from a specific value and to a second value.
From and To testing includes the from and to values.

```php
    // The value of field `input_field` may not be null
    $options                 = array();
    $options['from']         = 5;
    $options['to']           = 10;

    $results = $adapter->validate('My Field Name', $field_to_measure, 'Stringlength', $options);
```

### Time ###
Tests that the value is a string.


### Trim ###
Tests that the string is trimmed.

```php

    $field_name              = 'my_field';
    $field_value             = 'Lots of stuff in here that is stringy.          ';
    $fieldhandler_type_chain = 'Trim';

    $results = $adapter->filter($field_name, $field_value, $fieldhandler_type_chain);
```

### Upper ###
Validates or filters/escapes each character to be upper case.

```php
    // The value of field `input_field` is 'abc123'. Validate will value.
    // Filtered and escaped values will return 'ABC123'.
    $results = $this->adapter->filter('input_field', 'abc123', 'lower');

```

### Url ###
Tests that a value is a valid email address. When invalid, validate throws exception while
Filter and Escape return null.

```php
    $results = $this->adapter->validate('url_field', 'http://google.com', 'Url');

```

### Values ###
Compares a field_value against a set of values;

```php
    // The value of field `input_field` must be in the array_valid_values
    $field_name              = 'my_field';
    $field_value             = 'a';
    $fieldhandler_type_chain = 'Values';
    $options                 = array();
    $options['array_valid_values']      = array('a', 'b', 'c');

    $results = $adapter->validate($field_name, $field_value, $fieldhandler_type_chain);

```

## Install using Composer from Packagist

### Step 1: Install composer in your project

```php
    curl -s https://getcomposer.org/installer | php
```

### Step 2: Create a **composer.json** file in your project root

```php
{
    "require": {
        "Molajo/Fieldhandler": "1.*"
    }
}
```

### Step 3: Install via composer

```php
    php composer.phar install
```

## Requirements and Compliance
 * PHP framework independent, no dependencies
 * Requires PHP 5.3, or above
 * [Semantic Versioning](http://semver.org/)
 * Compliant with:
    * [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) and [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) Namespacing
    * [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) Coding Standards
 * [phpDocumentor2] (https://github.com/phpDocumentor/phpDocumentor2)
 * [phpUnit Testing] (https://github.com/sebastianbergmann/phpunit)
 * Author [AmyStephen](http://twitter.com/AmyStephen)
 * [Travis Continuous Improvement] (https://travis-ci.org/profile/Molajo)
 * Listed on [Packagist] (http://packagist.org) and installed using [Composer] (http://getcomposer.org/)
 * Use github to submit [pull requests](https://github.com/Molajo/Fieldhandler/pulls) and [features](https://github.com/Molajo/Fieldhandler/issues)
 * Licensed under the MIT License - see the `LICENSE` file for details
