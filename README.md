**NOT COMPLETE**

=======
FieldHandler
=======

[![Build Status](https://travis-ci.org/Molajo/FieldHandler.png?branch=master)](https://travis-ci.org/Molajo/FieldHandler)

Validates and filters input. Escapes and formats output. Supports standard data type and PHP filters and validation, verification to value lists, callbacks, regex checking and more.
  When used with rendering process can be used to ensure data to escaped for security and format output, as needed.

## System Requirements ##

* PHP 5.3.3, or above
* [PSR-0 compliant Autoloader](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* PHP Framework independent
* [optional] PHPUnit 3.5+ to execute the test suite (phpunit --version)

## What is FieldHandler? ##

**FieldHandler** provides a common API to create validation, filter, escape, and formatting processes that can be associated with fields and used to ensure data integrity and security within your data collections.

## Basic Usage ##

Each field is processed by one, or many, field handlers for validation, filtering, or escaping.

```php
    $fhObject = new Molajo/FieldHandler/Adapter
        ->($method, $field_name, $field_value, $fieldhandler_type_chain, $options);
```

There are five parameters:

1. **$method** can be 'validate', 'filter', or 'escape';
2. **$field_name** name of the field containing the data value to be verified or filtered;
3. **$field_value** contains the data value to be verified or filtered;
4. **$fieldhandler_type_chain** one or more field handlers, separated by a comma, processed in left-to-right order;
5. **$options** Associative array of named pair values needed for field handlers.

### Example Usage ###

The following example processes the 'id' field using the 'int', 'default', and 'required' field handlers.
The 'options' associative array defines two data elements: 'default' is the default value for the field, if needed;
the 'required' element with a 'true' value is used by the 'required' field handler to verify a value has been
 provided.

Chaining is supported and field handlers are processed in left-to-right order. The example shows how to sequence
 the default before the required check in the field handler chain.

```php
    $fieldhandler_type_chain = array('int', 'default', 'required');

    $options = array('default' => 14, 'required' => true);

    $adapter = new Molajo/FieldHandler/Adapter
        ->('Validate', 'id', 12, $fieldhandler_type_chain, $options);
```

#### Example Results ####

An object is returned and the field value can be retrieved like this:

```php
try {
    $fieldhandler_type_chain = array('int', 'default', 'required');

    $options = array('default' => 14, 'required' => true);

    $fhObject = new Molajo/FieldHandler/Adapter
        ->('Validate', 'id', 12, $fieldhandler_type_chain, $options);

    } catch (Exception $e) {

        //handle the exception here
    }

    // Success!
    echo $adapter->field_value;

```
**Action Results:**

Two results can occur. If the method was success, retrieve the field from the resulting object.
If the method was not successful, for example, validation discovered a problem, an Exception
is thrown. Use a Try/Catch pattern, as presented above, to retrieve the error condition.

```php
    echo $adapter->field_value;
```

### FieldHandlers ###

1. Accepted
2. Alias
3. Alpha
4. Alphanumeric
5. Arrays
6. Boolean
7. Callback
8. Date
9. Defaults
10. Digit
11. Email
12. Encoded
13. Equals
14. Extensions
15. Float
16. Extensions
17. Float
18. Fullspecialchars
19. Int
20. Lower
21. Maximum
22. Mimetypes
23. Minimum
24. Numeric
25. Raw
26. Regex
27. Required
28. String
29. Trim
30. Upper
31. Url
32. Values

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
- [Usage](/FieldHandler/.dev/Doc/Extend.md)
- [Install](/FieldHandler/.dev/Doc/Install.md)
