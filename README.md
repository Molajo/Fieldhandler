**NOT COMPLETE**

=======
FieldHandler
=======

[![Build Status](https://travis-ci.org/Molajo/FieldHandler.png?branch=master)](https://travis-ci.org/Molajo/FieldHandler)

Simple, uniform File and Directory Services API for PHP applications enabling interaction with multiple FieldHandler types
(ex., Local, FTP, Github, LDAP, etc.).


## System Requirements ##

* PHP 5.3.3, or above
* [PSR-0 compliant Autoloader](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* PHP Framework independent
* [optional] PHPUnit 3.5+ to execute the test suite (phpunit --version)

## What is FieldHandler? ##

**FieldHandler** provides a common API to

## Basic Usage ##

There are three methods for each filter:

1. **validate** - verifies if the value meets the conditions defined in the parameters, throws an
    exception when not true;
2. **filter** - ensures the value meets the conditions by filtering;
3. **escape** - prepares the value for output rendering;

The **escape** method only has the **value** parameter.

The **validate** and **filter** methods each have the following parameters:
1. **$field_value** contains the data value to be verified or filtered;
2. **$required** true or false value indicating if a value is required or if null is allowed;
3. **$default** if a null value is found, default value to use;
4. **$min** if needed, the minimum value allowed, if not needed, pass in a null value;
5. **$max** if needed, the maximum value allowed, if not needed, pass in a null value;
6. **$field_values** if needed, an array of valid values;
7. **$callback** Associative array of named pair values for custom filters.
7. **$options** Associative array of named pair values for custom filters.

Validate and FieldHandler have the same set of parameters:

### FieldHandler Request ###

```php
    $result = new Molajo/FieldHandler/Adapter($filter)
        ->($field_value, $required, $default, $max, $max, $field_values, $options);
```
#### Parameters ####

- **$field_value** valid values: Read, List, Write, Delete, Rename, Copy, Move, GetRelativePath, Chmod, Touch, Metadata;
- **$required** contains an absolute path from the filesystem root to be used to fulfill the action requested;
- **$default** Identifier for the file system. Examples include Local (default), Ftp, Virtual, Dropbox, etc.;
- **$min** Associative array of named pair values needed for the specific Action (examples below);
- **$max** Associative array of named pair values needed for the specific Action (examples below);
- **$field_values** Associative array of named pair values needed for the specific Action (examples below);
- **$options** Associative array of named pair values needed for the specific Action (examples below).

     * @param   mixed    $field_value
     * @param   bool     $required
     * @param   null     $default
     * @param   null     $min
     * @param   null     $max
     * @param   array    $field_values
     * @param   array    $options

$field_value,
        $required = true,
        $default = null,
        $min = null,
        $max = null,
        $field_values = array(),
        $options
- **$field_value** valid values: Read, List, Write, Delete, Rename, Copy, Move, GetRelativePath, Chmod, Touch, Metadata;
- **$required** contains an absolute path from the filesystem root to be used to fulfill the action requested;
- **$default** Identifier for the file system. Examples include Local (default), Ftp, Virtual, Dropbox, etc.;
- **$min** Associative array of named pair values needed for the specific Action (examples below);
- **$max** Associative array of named pair values needed for the specific Action (examples below);
- **$field_values** Associative array of named pair values needed for the specific Action (examples below);
- **$options** Associative array of named pair values needed for the specific Action (examples below).

#### Results ####

The output from the filesystem action request, along with relevant metadata, can be accessed from the returned
object, as follows:

**Action Results:** For any request where data is to be returned, this example shows how to retrieve the output:

```php
    echo $adapter->fs->data;
```

### FieldHandler Commands ###

#### Read ####

To read a specific file from a filesystem:

```php
    $adapter = new \Molajo\FieldHandler\Adapter('Read', 'location/of/file.txt');
    echo $adapter->fs->data;
```

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

**Step 4** Add this line to your application’s **index.php** file:

```php
    require 'vendor/autoload.php';
```

This instructs PHP to use Composer’s autoloader for **FieldHandler** project dependencies.

#### Or, Install Manually

Download and extract **FieldHandler**.

Copy the Molajo folder (first subfolder of src) into your Vendor directory.

Register Molajo\FieldHandler\ subfolder in your autoload process.

About
=====

Molajo Project adopted the following:

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

Pull requests [GitHub](https://github.com/Molajo/Fileservices/pulls)

Features [GitHub](https://github.com/Molajo/Fileservices/issues)

Author
------

Amy Stephen - <AmyStephen@gmail.com> - <http://twitter.com/AmyStephen><br />
See also the list of [contributors](https://github.com/Molajo/Fileservices/contributors) participating in this project.

License
-------

**Molajo FieldHandler** is licensed under the MIT License - see the `LICENSE` file for details

Acknowledgements
----------------

**W3C File API: Directories and System** [W3C Working Draft 17 April 2012 → ](http://www.w3.org/TR/file-system-api/)
specifications were followed, as closely as possible.

More Information
----------------
- [Usage](/FieldHandler/doc/usage.md)
- [Extend](/FieldHandler/doc/extend.md)
- [Specifications](/FieldHandler/doc/specifications.md)
