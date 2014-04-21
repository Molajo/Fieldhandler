=======
Molajo Fieldhandler [Alpha]
=======

[![Build Status](https://travis-ci.org/Molajo/Fieldhandler.png?branch=master)](https://travis-ci.org/Molajo/Fieldhandler)

*Molajo Fieldhandler* bundles *filter*, *escape* and *validate*
into an integrated data integrity assurance package for PHP applications.
The approach aligns fields with constraints, applying *filter*, *escape* and *validate*
functionality very specifically as specialised tools. In unifying tool usage around a focus
on field-level rule compliance, applications ensure data
collection processes provide clean, verified, and useful information.

Mission critical applications rely on well designed and carefully implemented cleansing, formatting and verification
routines. The goal of the *Molajo Fieldhandler* is to make it easier for PHP developers not only to accomplish
this goal but as importantly to be able to communicate exactly how the application enforcing
integrity constraints in terms that the client can understand.

## Overview of the Methodology ##

At the most basic level, *constraints* define data collection and usage rules.

For data collection, constraints can include rules related to
minimum and maximum field length, number of occurrences,
whether or not a value is required for the field or if there is a list or data range
that can be used to confirm data values.

Constraints are just as important for using data and can include formatting requirements,
or whether a "lookup value" should be displayed in place of key field data,
if a mask should be used to prevent display of secure information, and so on.

In the *Molajo Fieldhandler*, each constraint is implemented as a separate PHP classes with methods for *filter*,
 *validate* and *escape.* On the input side, *filter* and *validate* typically enforce rule adherence whereas
 the *escape* function is useful in ensuring data treatment requirements.


### Basic Approach

A critical step in application development associates specific integrity
constraints with each field in the collection. It is simply not possible to ensure clean data
if the rules defining that state are not articulated.

#### Define Integrity Constraints

As an example, assume these constraints for the `password` field:

1. Passwords can contain alphanumeric characters, the underscore (_), dollar sign ($), and pound sign (#).
2. Passwords must be from 8 to 30 characters in length.
3. Passwords expire every 90 days.
4. The new password cannot match the existing value.
4. Passwords should never be displayed and must be masked as asterisks.

#### Design enforcement strategy

Review the existing *Molajo Fieldhandler* Constraint classes to define enforcement.
Custom Constraints can be created when delivered constraints are not enough.

1. Validate the password 'last change date' using the *Date Constraint* to verify the date is not over 90 days previous.
2. Validate the field data using the *Alphanumeric Constraint* and values (_), ($), and (#).
3. Validate the field data using the *Length Constraint* to ensure a length of 8 to 30 characters.
4. Escape the password using the *Password Constraint* class to replace password values with asterisks.

#### Write code to deploy enforcement strategy

There are three *Molajo Fieldhandler* Request methods:

1. **validate** Validates the field value using field handler(s) requested.
All field handlers requested will run and multiple error messages could be returned.
Validate only returns a true or false value.

2. **filter** Cleans the field value using field handler(s) requested.
The field value that results following the filter operation(s) is returned.
No error messages are returned using the `filter` method.

3. **escape** Formats (or formats) the field for display, given the field handler(s) requested.
The field value that results following the escape operation(s) is returned.
No error messages are returned using the `escape` method.

There are four parameters for the request, regardless of whether it is `validate`, `filter`, or `escape`.

1. **$field_name** the name of the field for use in error messages;
2. **$field_value** existing data value subject to validation, filtering or escaping operations;
3. **$constraint** the name of the constraint;
4. **$options** (optional) am associative array of named pair values required by constraint processing.

##### Example: Verbose

This is a verbose example for purposes of learning where each constraint is specifically enforced.

```php

// 1. Instantiate the Molajo Fieldhandler and inject $fieldhandler into class

$fieldhandler = new Molajo\Fieldhandler\Request();

// 2. Verify the password is still valid

$results = $request->validate('Last Changed', $last_changed, 'Date', array('LT' => 91, 'Context' => 'Days');
if ($results->getValidateResponse() === false) {
    // deal with the problem
    $messages = $results->getValidateMessages();
}

// 3. Verify data values using the *Alphanumeric Constraint* and values (_), ($), and (#).

$results = $request->validate('Password', $password, 'Alphanumeric', array('special_characters' => '-, $, #');
if ($results->getValidateResponse() === false) {
    // deal with the problem
    $messages = $results->getValidateMessages();
}

// 4. Passwords must be from 8 to 30 characters in length.

$results = $request->validate('Password', $password, 'Length', array('minimum' => 8, 'maximum' => 30);
if ($results->getValidateResponse() === false) {
    // deal with the problem
    $messages = $results->getValidateMessages();
}

// 5. Display Password

$results = $request->escaoe('Password', $display_password, 'Password';
if ($results->getChangeIndicator() === true) {
    $display_password = $results->getFieldValue();
}

```
##### Example: Field Collection

While the previous example showed how to perform each test, one at a time, it is also possible
to group constraints for each field:

```php

// 1. Instantiate the Molajo Fieldhandler and inject $fieldhandler into class

$fieldhandler = new Molajo\Fieldhandler\Request();

// 2. Enforce Password Constraints using a terse syntax

    $results = $request->ensureFieldConstraints(
        'Display Password',
        $display_password,
        array('verify' => 'date', 'verify' => 'Alphanumeric', 'verify' => 'Length', 'escape' => 'Password'),
        array('LT' => 91, 'Context' => 'Days', 'special_characters' => '-, $, #' );

    if ($results->getSuccessIndicator() === false) {
        $field->messages = $results->getValidateMessages();

    } elseif ($results->getChangeIndicator() === true) {
        $field->value = $results->getFieldValue();
    }

```

##### Example: Data Collection

If you define which fields belong to a data collection and what constraints apply to each field, *Molajo Fieldhandler*
 can manage constraint verification quite simply, as this example shows.

```php

// 1. Instantiate the Molajo Fieldhandler and inject $fieldhandler into class

$fieldhandler = new Molajo\Fieldhandler\Request();

// 2. Process all fields in a loop

foreach ($data_object as $field) {

    $results = $request->ensureFieldConstraints(
        $field->name,
        $field->value,
        $field->tests,
        $field->options);

    if ($results->getSuccessIndicator() === false) {
        $field->messages = $results->getValidateMessages();

    } elseif ($results->getChangeIndicator() === true) {
        $field->value = $results->getFieldValue();
    }
}

```

## Creating Custom Constraints ##

How? Do it.

## Messages ##

Messages are defined for each delivered constraint and available for translating language strings.
 The messages can also be customized .

Messages
Tokens
Localization

$filtered = $request->handleInput('Title', $title, 'string, required');
$escaped = $request->handleOutput('Title', $filtered->getValidateResponse(), 'string');

$title = $escaped->getValidateResponse();

```


## Package Constraints ##

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
    $validated_value = $request->validate('agreement', 1, 'Accepted');

```
Note: The list of `accepted` values can be customized by including an array of desired values
in the `options` array, as shown below:

```php
    $options = array();
    $options['true_array'] = array(true, 1);
    $validated_value = $request->validate('agreement', 1, 'Accepted', $options);

```

### Alias ###
Tests if values are valid for a URL slug. When used with `filter` or `escape`, the value returned can be used as
an alias value.

```php
    // Title 'Jack and Jill' will be returned as 'jack-and-jill' for filter and escape
    // An exception would be thrown for validate
    $alias = $request->handleInput('title', 'Jack and Jill', 'Alias');

```

### Alpha ###
Tests if values are a character of A through Z.

```php
    // Field order_number 'ABC123#' would be returned as 'ABC' for filter and escape
    // An exception would be thrown for validate
    $results = $request->handleInput('order_number', 'ABC123#', 'Alpha');

```


### Arrays ###
Tests if value is an array.

```php
    // Field order_number array('ABC123', 'DEF456') would be returned as same for

    $results = $request->handleInput('order_number', array('ABC123', 'DEF456'), 'Array');

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
    $results = $request->handleInput('on_or_off_field', false, 'Boolean');

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
    $results = $request->handleInput('example_field', 'DOG', 'Callback', $options);

```

### Contains ###
Tests if a value is contained within the input field. If it is not, validate fails and filter and escape
change the input to null.

```php
    // Is the value `bark` contained within the dog_field?
    $options = array();
    $options['contains'] = 'bark';
    $results = $request->handleInput('dog_field', $dog_field, 'Contains');

```

### Date ###
Processes a value to determine if it is a valid date. For Validate, if the resulting value is not a valid
 date, an Exception is thrown. For Filter and Escape, the value returned is NULL if it is not valid.

```php
    // The value of field `date_field` is '2013/04/01 01:00:00' and determined to be valid
    $options = array();
    $options['callback'] = '2013/04/01 01:00:00';
    $results = $request->handleInput('date_field', '2013/04/01 01:00:00', 'Date');

```

### Datetime ###
Processes a value to determine if it is a valid date. For Validate, if the resulting value is not a valid
 date, an Exception is thrown. For Filter and Escape, the value returned is NULL if it is not valid.

```php
    // The value of field `date_field` is '2013/04/01 01:00:00' and determined to be valid
    $options = array();
    $options['callback'] = '2013/04/01 01:00:00';
    $results = $request->handleInput('date_field', '2013/04/01 01:00:00', 'Date');

```

### Defaults ###
Changes a null value to the value provided for default.

```php
    // The value of field `dog_field` is NULL and is set to 'bark'.
    $options = array();
    $options['default'] = 'bark';
    $results = $request->handleInput('dog_field', NULL, 'Default');

```

### Digit ###
Tests that each digit is numeric.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 123.
    // For 'validate', an exception is thrown.

    $results = $request->handleInput('numeric_field', 'ABC123', 'Digit');

```

### Email ###
Tests that a value is a valid email address. When invalid, validate throws exception while
Filter and Escape return null.

```php
    $results = $request->validate('email_address', 'AmyStephen@Molajo.org', 'Email');

```

### Encoded ###
Tests that an encoded value is sanitized.

```php
    // The value of field `encoded_field` is 'my-apples&are green and red'.
    // The filtered and escaped values will be 'my-apples%26are%20green%20and%20red'.

    $results = $request->handleInput('encoded_field', 'my-apples&are green and red', 'Encoded');

```

### Equal ###
Tests that a value is equal to a specified value.

```php
    // The value of field `field1` is 'dog' and is tested to see if it matches 'dog'.
    $results = $request->handleInput('field1', 'dog', 'Equal');

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

    $results = $request->handleInput('extensions_field', $input, 'Extensions');

```

### Float ###
Tests a value to determine if it is a valid Float value.

```php
    // The value of field `numeric_field` is 1234.5678.
    $results = $request->handleInput('numeric_field', 1234.5678, 'Float');

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

    $results = $request->validate($field_name, $field_value, $constraint, $options);

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

    $results = $request->validate($field_name, $field_value, $constraint, $options);

```

### Fullspecialchars ###
Converts special characters to HTML entities. Equivalent to [htmlspecialchars](http://www.php.net/manual/en/function.htmlspecialchars.php)
with with ENT_QUOTES set.

```php
    $field_name              = 'my_field';
    $field_value             = '&';
    $constraint = 'Fullspecialchars';
    $options                 = array();

    $results = $request->validate($field_name, $field_value, $constraint, $options);

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

    $results = $request->validate($field_name, $field_value, $constraint, $options);

```

### Image ###
Tests that the value is an image.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 0.
    // For 'validate', an exception is thrown. The following will return 123.

    $results = $request->handleInput('numeric_field', '123', 'Int');

```

### Integer ###
Tests that the value is an integer.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 0.
    // For 'validate', an exception is thrown. The following will return 123.

    $results = $request->handleInput('numeric_field', '123', 'Int');

```

### Ip ###
Tests that the value is an IP Address.

```php
    // The value of field `input_field` is '127.0.0.1'.
    // Validate, filtered and escaped values will return the same.
    $results = $request->handleInput('input_field', '127.0.0.1', 'Ip');

```

### Lower ###
Validates or filters/escapes each character to be lower case.

```php
    // The value of field `input_field` is 'ABC123'. Validate will fail.
    // Filtered and escaped values will return 'abc123'.
    $results = $request->handleInput('input_field', 'ABC123', 'lower');

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

    $results = $request->validate($field_name, $field_value, $constraint, $options);

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

    $results = $request->validate($field_name, $field_value, $constraint, $options);

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

    $results = $request->validate($field_name, $field_value, $constraint, $options);

```

### Notequal ###
Tests that a value is not equal to a specified value.

```php
    // The value of field `field1` is 'dog' and is tested to ensure it is NOT equal to 'dog'.
    $results = $request->handleInput('field1', 'dog', 'Notequal');

```

### Numeric ###
Tests that the value is an numeric.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 0.
    // For 'validate', an exception is thrown. The following will return 123.

    $results = $request->handleInput('numeric_field', '123', 'Numeric');

```

### Object ###
Tests that a value is an object.

```php
    // The value of field `database` is an object containing the database connection.
    // All will return the object

    $results = $request->handleInput('database', $instance, 'Object');

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


    $results = $request->validate($field_name, $field_value, $constraint, $options);

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

    $results = $request->validate($field_name, $field_value, $constraint);

```

### Required ###
Field is required. Null value is not allowed. Use after Default when used in combination.

```php
    // The value of field `input_field` may not be null
    $field_name              = 'my_field';
    $field_value             = null;
    $constraint = 'Required';

    $results = $request->validate($field_name, $field_value, $constraint);

```

### String ###
Tests that the value is a string.

```php
    // The value of field `input_field` may not be null
    $field_name              = 'my_field';
    $field_value             = 'Lots of stuff in here that is stringy.';
    $constraint = 'String';

    $results = $request->validate($field_name, $field_value, $constraint);
```

### Stringlength ###
Tests that the length of the string is from a specific value and to a second value.
From and To testing includes the from and to values.

```php
    // The value of field `input_field` may not be null
    $options                 = array();
    $options['from']         = 5;
    $options['to']           = 10;

    $results = $request->validate('My Field Name', $field_to_measure, 'Stringlength', $options);
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

    $results = $request->handleInput($field_name, $field_value, $constraint);
```

### Upper ###
Validates or filters/escapes each character to be upper case.

```php
    // The value of field `input_field` is 'abc123'. Validate will value.
    // Filtered and escaped values will return 'ABC123'.
    $results = $request->handleInput('input_field', 'abc123', 'lower');

```

### Url ###
Tests that a value is a valid email address. When invalid, validate throws exception while
Filter and Escape return null.

```php
    $results = $request->validate('url_field', 'http://google.com', 'Url');

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

    $results = $request->validate($field_name, $field_value, $constraint);

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
