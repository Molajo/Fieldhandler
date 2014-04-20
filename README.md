=======
Fieldhandler [Alpha]
=======

[![Build Status](https://travis-ci.org/Molajo/Fieldhandler.png?branch=master)](https://travis-ci.org/Molajo/Fieldhandler)

The *Molajo Fieldhandler* is a data integrity assurance package for PHP applications. As the name suggests, the
focus of the package is cleansing, verifying, and formatting field values.

Combined, these data custodial activities ensure clean, verified and useful information. Failure to build
protections into data collection processes is guaranteed to eventually lead to data corruption challenges.

Mission critical applications rely on well designed and carefully implemented cleansing, formatting and verification
routines. The goal of the *Molajo Fieldhandler* is to make it easier for PHP developers to accomplish this goal.


## Fieldhandler Data Integrity Support ##

### Request ###

1. **validate** Validates the field value using field handler(s) requested.
All field handlers requested will run and multiple error messages could be returned.
Validate only returns a true or false value.

2. **clean** Cleans the field value using field handler(s) requested.
The field value that results following the filter operation(s) is returned.
No error messages are returned using the `filter` method.

3. **format** Formats (or formats) the field for display, given the field handler(s) requested.
The field value that results following the escape operation(s) is returned.
No error messages are returned using the `escape` method.

#### Parameters ####

There are four parameters for the `validate` request. (And the same four parameters are used for
the `clean` and `format` requests.):

1. **$field_name** specify the name of the field for use in error messages;
2. **$field_value** existing data value that is subject to validation, cleansing and formattingd;
3. **$constraint** one or more field handler constraints, separated by commas, to be processed in left-to-right order;
4. **$options** (optional) am associative array of named pair values required by field handlers.

### Fieldhandler Validate ###

Ensuring data integrity requires validating `constraints` (rules) for each input data element.
It is not uncommon to define a collection of constraints to ensure correctness of each data element.

Consider how these data constraints are implemented in the following code example:

* Order quantity must be numeric.
* Order quantity is required.

1. Note how multiple tests are chained in the third parameter using the same validation request. The
Fieldhandler will process requests in left to right order.
2. Validation results in a `true` response when data conforms.
3. A `false` response isolates data integrity issues defined in an accompanying error message.

#### Validate Example ####

```php

$fieldhandler = new Molajo\Fieldhandler\Request();

$results = $fieldhandler->validate('Order Quantity', $order_quantity, 'numeric, required');

if ($results->getValidationResponse() === false) {
    $error_messages = $results->getValidationMessages());
}

```

#### Validation Constraints and NULL Data Value ####

Constraints are not used to test conformance with the data element if the data element value is NULL.
The obvious exception to that is `Null` and `Notnull` validation constraints.

If a NULL value is incorrect for the field, include a clean request to set the `default` value for
 the data element. If that is not possible, add a `required` validation constraint to ensure
 the NULL value is returned to the user along with the `required` error message.


### Fieldhandler Clean ###

Filter input for expected values.

It is important to understand that data validation does not modify field values. However,
 data cleansing requests can modify the value of the data. Both validation and cleansing are necessary
 for safe data collection.

Perhaps you recognized a problem with the previous data validation example? The constraints allow a value
of 0 for order quantity. Clearly there is a need to tighten the logic. So, let's add the following
data cleansing constraints.

* Filter order quantity as an integer.
* If order quantity is 0, set order quantity to a default value of 1.

1. Since data cleansing operations can change data values, the data element must be retrieved following
 each cleansing request.

2. If the user failed to enter an order quantity, consider the impact of testing `required` before
issuing the data cleansing `default assignment` request.

#### Clean Example ####

```php

$fieldhandler = new Molajo\Fieldhandler\Request();

// 1. Cleansing: order quantity must be an integer

$results = $fieldhandler->clean('Order Quantity', $order_quantity, 'integer');
$order_quantity = $results->getValidationResponse();

// 2. Validation: order quantity is required.

$results = $fieldhandler->validate('Order Quantity', $order_quantity, 'required');
if ($results->getValidationResponse() === false) {
    $error_messages = $error_messages + $results->getValidationMessages());
}

// 3. Cleansing: if order quantity is zero, set the default value to 1

$results = $fieldhandler->clean('Order Quantity', $order_quantity, 'default', array('default_value' => 1));
$order_quantity = $results->getValidationResponse();

// 4. Validation: Order Quantity must be numeric

$results = $fieldhandler->validate('Order Quantity', $order_quantity, 'numeric');
if ($results->getValidationResponse() === false) {
    $error_messages = $error_messages + $results->getValidationMessages());
}

```

Hopefully, this example helps underscore the potential for using both data cleansing and validation
constraints. It is equally important to consider the proper sequence of these requests to obtain
the desired result.



### Fieldhandler Format ###

Filter input for expected values.

It is important to understand that data validation does not modify field values. However,
 data cleansing requests can modify the value of the data. Both validation and cleansing are necessary
 for safe data collection.

Perhaps you recognized a problem with the previous data validation example? The constraints allow a value
of 0 for order quantity. Clearly there is a need to tighten the logic. So, let's add the following
data cleansing constraints.

* Filter order quantity as an integer.
* If order quantity is 0, set order quantity to a default value of 1.

1. Since data cleansing operations can change data values, the data element must be retrieved following
 each cleansing request.

2. If the user failed to enter an order quantity, consider the impact of testing `required` before
issuing the data cleansing `default assignment` request.

#### Format Example ####

```php

$fieldhandler = new Molajo\Fieldhandler\Request();

// 1. Formatting: display phone number as (402) 555-1212

$results = $fieldhandler->format('phone_number', $phone_number, 'tel');
$phone_number = $results->getValidationResponse();


```

Hopefully, this example helps underscore the potential for using both data cleansing and validation
constraints. It is equally important to consider the proper sequence of these requests to obtain
the desired result.

## Creating Custom Constraints ##

How? Do it.

## Messages ##

Messages are defined for each delivered constraint and available for translating language strings.
 The messages can also be customized .

Messages
Tokens
Localization


## Basic Usage ##

Types
Multiple
Messages
Tokens
Localization
Custom Constraints


$filtered = $fieldhandler->filter('Title', $title, 'string, required');
$escaped = $fieldhandler->escape('Title', $filtered->getValidationResponse(), 'string');

$title = $escaped->getValidationResponse();

```



###Results:###

An object is returned from all three methods that can be used in the following manner:

1. To retrieve the results of operations:

```php

    // For Validation:
    $validation_success_or_failure = $results->getValidationResponse():

    // For Filtering and Escaping:
    $field_value = $results->getValidationResponse();

```

2. To retrieve an associative array (code, message) of error messages (only for validation and if validation failed):

    $messages = $results->getValidationMessages();


## Constraints ##

- [Callback](https://github.com/Molajo/Fieldhandler#callback)

Basic
- [Required](https://github.com/Molajo/Fieldhandler#required)
- [Defaults](https://github.com/Molajo/Fieldhandler#defaults)
- [Alpha](https://github.com/Molajo/Fieldhandler#alpha)
- [Alphanumeric](https://github.com/Molajo/Fieldhandler#alphanumeric)
- [Boolean](https://github.com/Molajo/Fieldhandler#boolean)
- [Digit](https://github.com/Molajo/Fieldhandler#digit)

- Double - [use Float](http://php.net/manual/en/function.is-double.php)
- [Float](https://github.com/Molajo/Fieldhandler#float)
- [Integer](https://github.com/Molajo/Fieldhandler#integer)
- [Numeric](https://github.com/Molajo/Fieldhandler#numeric)
- [Object](https://github.com/Molajo/Fieldhandler#object)
- [Raw](https://github.com/Molajo/Fieldhandler#raw)

- Real - [use Float](http://php.net/manual/en/function.is-real.php)
- [Scalar]
- [String](https://github.com/Molajo/Fieldhandler#string)

Date/Time
- [Date](https://github.com/Molajo/Fieldhandler#date)
- [Datetime](https://github.com/Molajo/Fieldhandler#datetime)
- [Time](https://github.com/Molajo/Fieldhandler#time)

File-related Data Types
- [Fileextension](https://github.com/Molajo/Fieldhandler#fileextension)
- [Image](https://github.com/Molajo/Fieldhandler#image)
- [Mimetypes](https://github.com/Molajo/Fieldhandler#mimetypes)
- [File]
- [Size]
- [Path]
- [Filename]
- [Exists]

Value
- [True](https://github.com/Molajo/Fieldhandler#true)
- [False]
- [Null]
- [Not null]
- [Nothing]
- [Something]
- [Space]

- [Fromto](https://github.com/Molajo/Fieldhandler#Fromto)
- [Range] see Fromto...

- [Contains](https://github.com/Molajo/Fieldhandler#contains)
- [Values](https://github.com/Molajo/Fieldhandler#values)

- [Minimum](https://github.com/Molajo/Fieldhandler#minimum)
- [Maximum](https://github.com/Molajo/Fieldhandler#maximum)

- [Regex](https://github.com/Molajo/Fieldhandler#regex)

- [Length](https://github.com/Molajo/Fieldhandler#stringlength)

Arrays
- [Arrays](https://github.com/Molajo/Fieldhandler#arrays)
- [Count]
- [Values]
- [Keys]
- Unique
- Sorted

Comparison
- [Equal](https://github.com/Molajo/Fieldhandler#equal)
- [Notequal](https://github.com/Molajo/Fieldhandler#notequal)
- [GreaterThan]
- [LessThan] or equal to

Database
- [Foreignkey](https://github.com/Molajo/Fieldhandler#foreignkey)
- [Lookup](https://github.com/Molajo/Fieldhandler#lookup)

User
- Password
- Userid
- Username
- [Email](https://github.com/Molajo/Fieldhandler#email)
- [Tel](https://github.com/Molajo/Fieldhandler#tel)
- Credit Card
- Zip Code

Special Handling
- [Fullspecialchars](https://github.com/Molajo/Fieldhandler#fullspecialchars)
- [Html](https://github.com/Molajo/Fieldhandler#html)
- [Encoded](https://github.com/Molajo/Fieldhandler#encoded)

Formatting
- [Lower](https://github.com/Molajo/Fieldhandler#lower)
- [Upper](https://github.com/Molajo/Fieldhandler#upper)
- [Trim](https://github.com/Molajo/Fieldhandler#trim)
- [Format]
- [Printable]
- [Punctuation]
- [Controlcharacters]

Special Field Types
- [Alias](https://github.com/Molajo/Fieldhandler#alias)
- [Ip](https://github.com/Molajo/Fieldhandler#ip)
- [Uuid]()
- [Url](https://github.com/Molajo/Fieldhandler#url)


The examples in this section assume the *Fieldhandler* has been instantiated, as follows:

```php

    $fieldhandler = new Molajo/Fieldhandler/Driver();

```

### Accepted ###
Value is true, 1, 'yes', or 'on.'

```php
    $validated_value = $fieldhandler->validate('agreement', 1, 'Accepted');

```
Note: The list of `accepted` values can be customized by including an array of desired values
in the `options` array, as shown below:

```php
    $options = array();
    $options['true_array'] = array(true, 1);
    $validated_value = $fieldhandler->validate('agreement', 1, 'Accepted', $options);

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
    // Field order_number array('ABC123', 'DEF456') would be returned as same for

    $results = $this->adapter->filter('order_number', array('ABC123', 'DEF456'), 'Array');

    array_valid_keys
    array_valid_values
    array_minimum (default 0)
    array_maximum (default 9999999999)

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

### Datetime ###
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
    $results = $this->adapter->validate('email_address', 'AmyStephen@Molajo.org', 'Email');

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

### Fileextension ###
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
    $constraint = 'Extensions';

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
    $constraint = 'Foreignkey';
    $options                 = array();
    $options['database']     = $database;
    $options['table']        = 'molajo_actions';
    $options['key']          = 'id';

    $results = $fieldhandler->validate($field_name, $field_value, $constraint, $options);

```

### Fromto ###
Verifies that the $field_value is greater than the From value and less than the To value.

```php
    $field_name              = 'my_field';
    $field_value             = 5;
    $constraint = 'Fromto';
    $options                 = array();
    $options['from']         = 0;
    $options['to']           = 10;

    $results = $fieldhandler->validate($field_name, $field_value, $constraint, $options);

```

### Fullspecialchars ###
Converts special characters to HTML entities. Equivalent to [htmlspecialchars](http://www.php.net/manual/en/function.htmlspecialchars.php)
with with ENT_QUOTES set.

```php
    $field_name              = 'my_field';
    $field_value             = '&';
    $constraint = 'Fullspecialchars';
    $options                 = array();

    $results = $fieldhandler->validate($field_name, $field_value, $constraint, $options);

```

### Html ###

add whitelist description
Escapes HTML entities. Equivalent to [htmlspecialchars](http://www.php.net/manual/en/function.htmlspecialchars.php)
with with ENT_QUOTES set.

```php
    $field_name              = 'my_field';
    $field_value             = '&';
    $constraint = 'Html';
    $options                 = array();

    $results = $fieldhandler->validate($field_name, $field_value, $constraint, $options);

```

### Image ###
Tests that the value is an image.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 0.
    // For 'validate', an exception is thrown. The following will return 123.

    $results = $this->adapter->filter('numeric_field', '123', 'Int');

```

### Integer ###
Tests that the value is an integer.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 0.
    // For 'validate', an exception is thrown. The following will return 123.

    $results = $this->adapter->filter('numeric_field', '123', 'Int');

```

### Ip ###
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
    $constraint = 'Maximum';
    $options                 = array();
    $options['maximum']      = 3;

    $results = $fieldhandler->validate($field_name, $field_value, $constraint, $options);

```

### Mimetypes ###
Validates or filters/escapes xxxx

```php
    // The value of field `input_field` is 10. Maximum is 3. Validate will fail.
    // Filtered and escaped values will return 3.
    $field_name              = 'my_field';
    $field_value             = 10;
    $constraint = 'Maximum';
    $options                 = array();
    $options['maximum']      = 3;

    $results = $fieldhandler->validate($field_name, $field_value, $constraint, $options);

```

### Minimum ###
Validates or filters/escapes numeric value to not exceed the maximum.

```php
    // The value of field `input_field` is 10. Minimum is 3.
    // Validate, filtered and escaped values will return 10.
    $field_name              = 'my_field';
    $field_value             = 10;
    $constraint = 'Minimum';
    $options                 = array();
    $options['minimum']      = 3;

    $results = $fieldhandler->validate($field_name, $field_value, $constraint, $options);

```

### Notequal ###
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
    $constraint = 'Raw';
    $options                 = array();
    $options['FILTER_FLAG_ENCODE_AMP']      = true;


    $results = $fieldhandler->validate($field_name, $field_value, $constraint, $options);

```

### Regex ###
Performs regex checking against the input value for the regex sent in.

```php
    // The value of field `input_field` may not be null
    $field_name              = 'my_field';
    $field_value             = AmyStephen@Molajo.org;
    $constraint = 'Regex';
    $options                 = array();
    $options['regex']      = $regex_expression;

    $results = $fieldhandler->validate($field_name, $field_value, $constraint);

```

### Required ###
Field is required. Null value is not allowed. Use after Default when used in combination.

```php
    // The value of field `input_field` may not be null
    $field_name              = 'my_field';
    $field_value             = null;
    $constraint = 'Required';

    $results = $fieldhandler->validate($field_name, $field_value, $constraint);

```

### String ###
Tests that the value is a string.

```php
    // The value of field `input_field` may not be null
    $field_name              = 'my_field';
    $field_value             = 'Lots of stuff in here that is stringy.';
    $constraint = 'String';

    $results = $fieldhandler->validate($field_name, $field_value, $constraint);
```

### Stringlength ###
Tests that the length of the string is from a specific value and to a second value.
From and To testing includes the from and to values.

```php
    // The value of field `input_field` may not be null
    $options                 = array();
    $options['from']         = 5;
    $options['to']           = 10;

    $results = $fieldhandler->validate('My Field Name', $field_to_measure, 'Stringlength', $options);
```

### Tel ###
Tests that the value is a string.

### Time ###
Tests that the value is a string.

### Trim ###
Tests that the string is trimmed.

```php

    $field_name              = 'my_field';
    $field_value             = 'Lots of stuff in here that is stringy.          ';
    $constraint = 'Trim';

    $results = $fieldhandler->filter($field_name, $field_value, $constraint);
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
    $constraint = 'Values';
    $options                 = array();
    $options['array_valid_values']      = array('a', 'b', 'c');

    $results = $fieldhandler->validate($field_name, $field_value, $constraint);

```

## Requirements and Compliance
 * PHP framework independent, no dependencies
 * Requires PHP 5.4, or above
 * [Semantic Versioning](http://semver.org/)
 * Compliant with:
    * [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) Basic Coding Standards
    * [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) Coding Style
    * [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) Coding Standards
 * [phpDocumentor2] (https://github.com/phpDocumentor/phpDocumentor2)
 * [phpUnit Testing] (https://github.com/sebastianbergmann/phpunit)
 * Author [AmyStephen](http://twitter.com/AmyStephen)
 * [Travis Continuous Improvement] (https://travis-ci.org/profile/Molajo)
 * Listed on [Packagist] (http://packagist.org) and installed using [Composer] (http://getcomposer.org/)
 * Use github to submit [pull requests](https://github.com/Molajo/Fieldhandler/pulls) and [features](https://github.com/Molajo/Fieldhandler/issues)
 * Licensed under the MIT License - see the `LICENSE` file for details
