**NOT COMPLETE**

=======
FieldHandler
=======

[![Build Status](https://travis-ci.org/Molajo/FieldHandler.png?branch=master)](https://travis-ci.org/Molajo/FieldHandler)

Validates input. Filters input. Escapes (and can format) output.

Supports standard data type and PHP-specific filters and validation, value list verification, callbacks,
regex checking, and more. Used with rendering process to ensure proper escaping of output data and for
special field-level formatting needs.

## Basic Usage ##

Each field is processed by field handler(s) for validation, filtering, or escaping.

```php
    try {
        $adapter = new Molajo/FieldHandler/Adapter();
        $field_value = $adapter->filter($field_name, $field_value, $fieldhandler_type_chain, $options);

    } catch (Exception $e) {
        //handle the exception here
    }

    // Success!
    echo $field_value;
```


###Three methods:###

1. **validate** Validate the field value using field handlers requested.
2. **filter** Filter the field value using field handlers requested.
3. **escape** Escape (or format) the field for rendering, given the field handlers requested.

###Four parameters:###

1. **$field_name** name of the field containing the data value (used in exception messages);
2. **$field_value** contains the data value to be processed;
3. **$fieldhandler_type_chain** one or more field handlers, separated by a comma, processed in left-to-right order;
4. **$options** associative array of named pair values required by field handlers.

###Two possible results:###

1. **Success** field value returned.
2. **Failure** Handle the exception.

####Example Usage####

The following example processes:

* The `id` field
* A chain of field handlers: `int`, `default`, and `required` which will be processed in this order.
* The `options` associative array with two elements:
    1. `default` and the default value for the field;
    2. `required` element and the value `true`.

```php

    $fieldhandler_type_chain = array('int', 'default', 'required');
    $options = array('default' => 14, 'required' => true);

    try {
        $adapter = new Molajo/FieldHandler/Adapter();
        $validated_value = $adapter->validate('id', 12, $fieldhandler_type_chain, $options);

    } catch (Exception $e) {
        //handle the exception here
    }

    // Success!
    echo $validated_value;

```
**Results:**

If the method was a success, simply retrieve the field value from the resulting object.

Use the Try/Catch pattern, as presented above, to catch thrown exceptions for errors.

## Available FieldHandlers ##

### Accepted ###

* **Validate:** True if field value is true, 1, 'yes', or 'on.'
* **Filter:** If not true, 1, 'yes', or 'on', value is set to NULL.
* **Escape:** If not true, 1, 'yes', or 'on', value is set to NULL.

```php
    try {
        $fieldhandler_type_chain = array('accepted');
        $adapter = new Molajo/FieldHandler/Adapter();
        $validated_value = $adapter->validate('agreement', 1, $fieldhandler_type_chain);
```

* Accepted
* Alias
* Alpha
* Alphanumeric
* Arrays
* Boolean
* Callback
* Css
* Date
* Defaults
* Digit
* Email
* Encoded
* Equals
* Extensions
* Float
* Extensions
* Float
* FromTo
* Fullspecialchars
* Html
* Int
* Ip
* Js
* Lower
* Maximum
* Mimetypes
* Minimum
* NotEqual
* Numeric
* Raw
* Regex
* Required
* String
* Trim
* Upper
* Url
* Values (Inarray) (Inlist)



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
