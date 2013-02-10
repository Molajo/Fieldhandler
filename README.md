**NOT COMPLETE**

=======
Filters
=======

[![Build Status](https://travis-ci.org/Molajo/Filters.png?branch=master)](https://travis-ci.org/Molajo/Filters)

Simple, uniform File and Directory Services API for PHP applications enabling interaction with multiple Filters types
(ex., Local, FTP, Github, LDAP, etc.).

## System Requirements ##

* PHP 5.3.3, or above
* [PSR-0 compliant Autoloader](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* PHP Framework independent
* [optional] PHPUnit 3.5+ to execute the test suite (phpunit --version)

## What is Filters? ##

**Filters** provides a common API to

## Basic Usage ##

Each **Filters** command shares the same syntax and the same four parameters:

### Filters Request ###

```php
    $adapter = new Molajo/Filters/Adapter($action, $path, $filesystem_type, $options);
```
#### Parameters ####

- **$action** valid values: Read, List, Write, Delete, Rename, Copy, Move, GetRelativePath, Chmod, Touch, Metadata;
- **$path** contains an absolute path from the filesystem root to be used to fulfill the action requested;
- **$filesystem_type** Identifier for the file system. Examples include Local (default), Ftp, Virtual, Dropbox, etc.;
- **$options** Associative array of named pair values needed for the specific Action (examples below).

#### Results ####

The output from the filesystem action request, along with relevant metadata, can be accessed from the returned
object, as follows:

**Action Results:** For any request where data is to be returned, this example shows how to retrieve the output:

```php
    echo $adapter->fs->data;
```

### Filters Commands ###

#### Read ####

To read a specific file from a filesystem:

```php
    $adapter = new \Molajo\Filters\Adapter('Read', 'location/of/file.txt');
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
        "Molajo/Filters": "1.*"
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

This instructs PHP to use Composer’s autoloader for **Filters** project dependencies.

#### Or, Install Manually

Download and extract **Filters**.

Copy the Molajo folder (first subfolder of src) into your Vendor directory.

Register Molajo\Filters\ subfolder in your autoload process.

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

**Molajo Filters** is licensed under the MIT License - see the `LICENSE` file for details

Acknowledgements
----------------

**W3C File API: Directories and System** [W3C Working Draft 17 April 2012 → ](http://www.w3.org/TR/file-system-api/)
specifications were followed, as closely as possible.

More Information
----------------
- [Usage](/Filters/doc/usage.md)
- [Extend](/Filters/doc/extend.md)
- [Specifications](/Filters/doc/specifications.md)
