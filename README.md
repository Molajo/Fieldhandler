=======
Molajo Fieldhandler [Alpha]
=======

[![Build Status](https://travis-ci.org/Molajo/Fieldhandler.png?branch=master)](https://travis-ci.org/Molajo/Fieldhandler)

*Molajo Fieldhandler* is an integrated data integrity assurance package for PHP applications.
The approach validation and sanitation
functionality very specifically as specialised tools. In unifying tool usage around a focus
on field-level rule compliance, applications ensure data
collection processes provide clean, verified, and useful information.

Mission critical applications rely on well designed and carefully implemented cleansing, formatting and verification
routines. The goal of the *Molajo Fieldhandler* is to make it easier for PHP developers not only to accomplish
this goal but as importantly to be able to communicate exactly how the application enforcing
integrity constraints in terms that the client can understand.

## Overview of the Methodology ##

At the most basic level, *constraints* define data collection and usage rules by describing qualities of the data.
These rules might include specifications about the minimum and maximum values, number of occurrences for an array,
whether or not a field is required or if there is a list or data range
that can be used to confirm data values.

A critical step in application development associates specific integrity
constraints with each field in the collection. It is simply not possible to ensure clean data
if the rules defining that state are not articulated.

### Define Integrity Constraints

As an example, assume these constraints for the `password` field:

1. Passwords can contain alphanumeric characters, the underscore (_), dollar sign ($), and pound sign (#).
2. Passwords must be from 8 to 30 characters in length.
3. Passwords expire every 90 days.
4. The new password cannot match the existing value.
4. Passwords should never be displayed and must be masked as asterisks.

### Design enforcement strategy

Review the existing *Molajo Fieldhandler* Constraint classes to define enforcement.
Custom Constraints can be created when delivered constraints are not enough.

1. Validate the password 'last change date' using the *Date Constraint* to verify the date is not over 90 days previous.
2. Validate the field data using the *Alphanumeric Constraint* and values (_), ($), and (#).
3. Validate the field data using the *Length Constraint* to ensure a length of 8 to 30 characters.
4. Escape the password using the *Password Constraint* class to replace password values with asterisks.

### Write code to deploy enforcement strategy



#### Example: Verbose

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
#### Example: Field Collection

While the previous example showed how to perform each test, one at a time, it is also possible
to group constraints for each field:

```php

// 1. Instantiate the Molajo Fieldhandler and inject $fieldhandler into class

$fieldhandler = new Molajo\Fieldhandler\Request();

// 2. Enforce Password Constraints using a terse syntax

    $results = $request->ensureFieldConstraints(
        'Display Password', $display_password,
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

INCOMPLETE

## Messages ##

INCOMPLETE

## Package Constraints ##

The examples in this section assume the *Fieldhandler* has been instantiated, as follows:

```php

    $fieldhandler = new Molajo/Fieldhandler/Driver();

```

### Alias ###
Each character in the alias URL slug must be alphanumeric or a dash.

**Validate**
Verifies value against constraint and provides messages with false test.

```php
$response = $request->validate('alias_field', 'This will not validate', 'Alias');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**
Converts the value to a usable URL slug. In this example, `$field_value` will contain `jack-and-jill`.

```php
$response = $request->sanitize('alias_field', 'Jack and Jill', 'Alias');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**
For `alias`, the `format` method produces the same results as `sanitize`.


### Alpha ###
Each character in the alias URL slug must be alphabetic. To allow the 'space character', use the
`allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('employee_name', 'Pat 3Nelson', 'Alpha', $options);

if ($response->getValidateResponse() === true) {
    // all is well
} else {
   foreach ($response->getValidateMessages as $code => $message) {
      echo $code . ': ' . $message . '/n';
   }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
`$field_value` will contain `Pat Nelson`.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('employee_name', 'Pat 3Nelson', 'Alpha');

if ($response->getChangeIndicator() === true) {
   $field_value = $response->getFieldValue();
}

```

**Format**
For this constraint, the `format` method is not implemented and simply returns the value unchanged.

### Alphanumeric ###
Each character in the alias URL slug must be a character or a digit. To allow the 'space character', use the
`allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('description', '4 dogs and #3 cats', 'Alphanumeric', $options);

if ($response->getValidateResponse() === true) {
    // all is well
} else {
   foreach ($response->getValidateMessages as $code => $message) {
      echo $code . ': ' . $message . '/n';
   }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
`$field_value` will contain `4 dogs and 3 cats`.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('description', '4 dogs and #3 cats', 'Alphanumeric', $options);

if ($response->getChangeIndicator() === true) {
   $field_value = $response->getFieldValue();
}

```

**Format**
For this constraint, the `format` method is not implemented and simply returns the value unchanged.

### Arrays ###
Tests if value is an array.

```php
    // Field order_number array('ABC123', 'DEF456') would be returned as same for

    $results = $request->sanitize('order_number', array('ABC123', 'DEF456'), 'Array');

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
    $results = $request->sanitize('on_or_off_field', false, 'Boolean');

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
    $results = $request->sanitize('example_field', 'DOG', 'Callback', $options);

```

### Contains ###
Tests if a value is contained within the input field. If it is not, validate fails and filter and escape
change the input to null.

```php
    // Is the value `bark` contained within the dog_field?
    $options = array();
    $options['contains'] = 'bark';
    $results = $request->sanitize('dog_field', $dog_field, 'Contains');

```
### Controlcharacters ###
Each character must be a control character (ex. line feed, tab, escape).
To allow the 'space character', use the `allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('text_field', '\n\r\t', 'Controlcharacters', $options);

if ($response->getValidateResponse() === true) {
    // all is well
} else {
   foreach ($response->getValidateMessages as $code => $message) {
      echo $code . ': ' . $message . '/n';
   }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
`$field_value` will contain `\n \r \t`.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('text_field', 'N\n \r \t', 'Alpha');

if ($response->getChangeIndicator() === true) {
   $field_value = $response->getFieldValue();
}

```

**Format**
For this constraint, the `format` method is not implemented and simply returns the value unchanged.


### Date ###
Processes a value to determine if it is a valid date. For Validate, if the resulting value is not a valid
 date, an Exception is thrown. For Filter and Escape, the value returned is NULL if it is not valid.

```php
    // The value of field `date_field` is '2013/04/01 01:00:00' and determined to be valid
    $options = array();
    $options['callback'] = '2013/04/01 01:00:00';
    $results = $request->sanitize('date_field', '2013/04/01 01:00:00', 'Date');

```

### Datetime ###
Processes a value to determine if it is a valid date. For Validate, if the resulting value is not a valid
 date, an Exception is thrown. For Filter and Escape, the value returned is NULL if it is not valid.

```php
    // The value of field `date_field` is '2013/04/01 01:00:00' and determined to be valid
    $options = array();
    $options['callback'] = '2013/04/01 01:00:00';
    $results = $request->sanitize('date_field', '2013/04/01 01:00:00', 'Date');

```

### Defaults ###
Changes a null value to the value provided for default.

```php
    // The value of field `dog_field` is NULL and is set to 'bark'.
    $options = array();
    $options['default'] = 'bark';
    $results = $request->sanitize('dog_field', NULL, 'Default');

```


### Digit ###

Each character must be a numeric digit.
To allow the 'space character', use the `allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('digit_fieldname', '1 2 3 4 5', 'Digit', $options);

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
  `$field_value` will contain `1 2 3 4 5`.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('text_field', '1x 2x 3x 4x 5x', 'Digit');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

For this constraint, the `format` method is not implemented and simply returns the value unchanged.

### Email

Only letters, digits and `!#$%&'*+-/=?^_`{|}~@.[]`.

Can be used with the following flags by defining $option entries for each flag desired:

**Validate**
Verifies value against constraint and provides messages with false test.

This example returns true.

```php
$response = $request->validate('email_field', 'AmyStephen@gmail.com', 'Email');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**
Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will result in NULL.

```php
$response = $request->sanitize('email_field', 'AmyStephen@gmail.com', 'Email');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**
Set the `obfuscate_email` option to format the email in that manner.

```php
$options = array();
$options['obfuscate_email'] = true;
$response = $request->sanitize('email_field', 'AmyStephen@gmail.com', 'Email', $options);

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

### Encoded ###
Tests that an encoded value is sanitized.

```php
    // The value of field `encoded_field` is 'my-apples&are green and red'.
    // The filtered and escaped values will be 'my-apples%26are%20green%20and%20red'.

    $results = $request->sanitize('encoded_field', 'my-apples&are green and red', 'Encoded');

```

### Equal ###
Tests that a value is equal to a specified value.

```php
    // The value of field `field1` is 'dog' and is tested to see if it matches 'dog'.
    $results = $request->sanitize('field1', 'dog', 'Equal');

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

    $results = $request->sanitize('extensions_field', $input, 'Extensions');

```

### Float ###

Remove all characters except digits, +- and optionally .,eE.

Can be used with the following flags by defining $option entries for each flag desired:

```php
$options = array();
$options[FILTER_FLAG_ALLOW_FRACTION]   = true;
$options[FILTER_FLAG_ALLOW_THOUSAND]   = true;
$options[FILTER_FLAG_ALLOW_SCIENTIFIC] = true;

```

**Validate**

Verifies value against constraint and provides messages with false test.

This example returns true.

```php
$options = array();
$options[FILTER_FLAG_ALLOW_FRACTION]   = true;
$response = $request->validate('float_field', 0.2345, 'Float');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will result in NULL.

```php
$response = $request->sanitize('float_field', 'Dog', 'Float');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**
For this constraint, the `format` method is not implemented and simply returns the value unchanged.

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

### Graph

Each character must be a visible, printable character.
To allow the 'space character', use the `allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('space_field', 'This is visible.\n\r\t', 'Graph', $options);

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will contain `This is visible.`.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('space_field', 'This is visible.\n\r\t', 'Graph', $options);

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

For this constraint, the `format` method is not implemented and simply returns the value unchanged.

### Hexidecimal ###

Each character must be a numeric digit.
To allow the 'space character', use the `allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('digit_fieldname', '1 2 3 4 5', 'Digit', $options);

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
  `$field_value` will contain `1 2 3 4 5`.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('text_field', '1x 2x 3x 4x 5x', 'Digit');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

For this constraint, the `format` method is not implemented and simply returns the value unchanged.

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

    $results = $request->sanitize('numeric_field', '123', 'Int');

```

### Integer
Includes only digits, plus and minus sign.

**Validate**

Verifies value against constraint and provides messages with false test.

This example returns true.

```php
$response = $request->validate('integer_field', 100, 'Integer');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will result in NULL.

```php
$response = $request->sanitize('integer_field', 'AmyStephen@gmail.com', 'Integer');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

Not implemented, simply returns the value sent in.

### Ip ###
Tests that the value is an IP Address.

```php
    // The value of field `input_field` is '127.0.0.1'.
    // Validate, filtered and escaped values will return the same.
    $results = $request->sanitize('input_field', '127.0.0.1', 'Ip');

```

### Lower

Each character must be an lowercase character.
To allow the 'space character', use the `allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

This example returns false due to the inclusion of non lowercase characters.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('lower_field', 'This is lower', 'Lower');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will only contain the lowercase letter `his is lower` since the `T` and `.` are not lowercase.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('lower_field', 'This is lower.', 'Lower');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

Lowercase all character values.  In this example, `$field_value` will contain `this is lower.`.

```php
$response = $request->format('lower_field', 'This is lower.', 'Lower');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

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
    $results = $request->sanitize('field1', 'dog', 'Notequal');

```

### Numeric ###
Tests that the value is an numeric.

```php
    // The value of field `numeric_field` is 'ABC123'. The filtered and escaped values will be 0.
    // For 'validate', an exception is thrown. The following will return 123.

    $results = $request->sanitize('numeric_field', '123', 'Numeric');

```

### Object ###
Tests that a value is an object.

```php
    // The value of field `database` is an object containing the database connection.
    // All will return the object

    $results = $request->sanitize('database', $instance, 'Object');

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
    $options[FILTER_FLAG_ENCODE_AMP]      = true;


    $results = $request->validate($field_name, $field_value, $constraint, $options);

```

### Printable ###
Each character must be a printable character.

**Validate**

Verifies value against constraint and provides messages with false test.

This example returns false due to the inclusion of control characters which cannot be displayed.

```php
$response = $request->validate('printable_field', 'asdf\n\r\t', 'Printable');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will contain `asdf`.

```php
$response = $request->sanitize('printable_field', 'asdf\n\r\t', 'Printable');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**
For this constraint, the `format` method is not implemented and simply returns the value unchanged.

### Punctuation Constraint

Each character must be a punctuation character.
To allow the 'space character', use the `allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('punctuation_field', 'ABasdk! @ ! $ #', 'Punctuation', $options);
 *
if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will contain `* & $ ( )`.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('punctuation_field', '* & $ ( )ABC', 'Punctuation', $options);
 *
if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

For this constraint, the `format` method is not implemented and simply returns the value unchanged.

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
### Space Constraint

Each character must be a whitespace character.
Besides the blank character this also includes tab, vertical tab, line feed, carriage return
and form feed characters.

**Validate**

Verifies value against constraint and provides messages with false test.

```php
$response = $request->validate('space_field', '\n \r \t', 'Space');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will contain `\n \r \t`.

```php
$response = $request->sanitize('space_field', '*\n \r \t', 'Space');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

For this constraint, the `format` method is not implemented and simply returns the value unchanged.

### Tel ###
Tests that the value is a string.

### Time ###

### Trim
The text must not have spaces before or after the last visible character.

**Validate**

Verifies value against constraint and provides messages with false test.

This example returns false due to the inclusion of spaces before and after the text string.

```php
$response = $request->validate('upper_field', ' This is not trimmed. ', 'Upper');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will result in 'This is trimmed.' and the spaces preceding and following
 the text literal will be removed.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('upper_field', ' This is trimmed. ', 'Upper');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

Performs sanitize.

### Upper

Each character must be an lowercase character.
To allow the 'space character', use the `allow_space_character` $option.

**Validate**

Verifies value against constraint and provides messages with false test.

This example returns false due to the inclusion of non uppercase characters.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->validate('upper_field', 'This is upper', 'Upper');

if ($response->getValidateResponse() === true) {
    // all is well
} else {
    foreach ($response->getValidateMessages as $code => $message) {
        echo $code . ': ' . $message . '/n';
    }
}

```

**Sanitize**

Removes characters not conforming to the definition of the constraint. In this example,
 `$field_value` will only contain the uppercase letter `T` since no other characters meet
 the constraint definition.

```php
$options = array();
$options['allow_space_character'] = true;
$response = $request->sanitize('upper_field', 'This is upper.', 'Upper');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

```

**Format**

Uppercase all character values.  In this example, `$field_value` will contain `THIS IS UPPER.`.

```php
$response = $request->format('upper_field', 'This is upper.', 'Upper');

if ($response->getChangeIndicator() === true) {
    $field_value = $response->getFieldValue();
}

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
PHP framework independent, no dependencies
Requires PHP 5.4, or above
[Semantic Versioning](http://semver.org/)
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
