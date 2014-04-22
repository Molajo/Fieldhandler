---
title: Date
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : date
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Date.php
namespace : Molajo\Fieldhandler\Constraint\Date
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/DateTest.php
---

{{ Constraint }}

Must be of a type that can be used to create a PHP Date object.

{{ Constraint::Options }}

To specify the format of the input date, use `$options['create_from_date_format'] = 'Y-m-d'` or
any other [valid PHP date format](http://php.net/manual/en/function.date.php). (Defaults to 'Y-m-d').

To specify the format of the formatted date, use `$options['display_as_date_format'] = 'Y-m-d'` or
any other [valid PHP date format](http://php.net/manual/en/function.date.php). (Defaults to 'Y-m-d').

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To validate:

```php

    $request = new Molajo\Fieldhandler\Request();

    $options = array();
    $options['create_from_date_format'] = 'Y-m-d';
    $results = $request->validate('Birthday', $date_string_here, 'Date', $options);

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

If value is found not to be a date, it is set to NULL and returned.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['create_from_date_format'] = 'Y-m-d';
    $results = $this->request->sanitize('Date Field Name', $date_string_here, 'Date', $options);

    if ($results->getChangeIndicator() === true) {
        $date_string_here = $results->getFieldValue();
    }

```

{{ Constraint::Format }}
`
Format will create a date object from the input value and format it, as requested, returning the results.

{{ Constraint::Format::Usage }}

To specify an output date format, use `$options['display_as_date_format'] = 'Y-m-d'` or
any other [valid PHP date format](http://php.net/manual/en/function.date.php). (Defaults to 'Y-m-d').

```php

    $options = array();
    $options['create_from_date_format'] = 'Y-m-d';
    $options['display_as_date_format'] = 'd-m-Y';
    $results = $this->request->sanitize('Birthdate', $date_string_here, 'Date', $options);

    if ($results->getChangeIndicator() === true) {
        $date_string_here = $results->getFieldValue();
    }

```
