---
title: Encoded
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Encoded.php
namespace : Molajo\Fieldhandler\Constraint\Encoded
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/EncodedTest.php
---

{{ Constraint }}

URL-encode string, optionally strip or encode special characters.

{{ Constraint::Options }}

Uses [Sanitize Filters](http://www.php.net/manual/en/filter.filters.sanitize.php) and FILTER_SANITIZE_ENCODED
which accepts the following flags:

* FILTER_FLAG_STRIP_LOW
* FILTER_FLAG_STRIP_HIGH
* FILTER_FLAG_ENCODE_LOW
* FILTER_FLAG_ENCODE_HIGH

To enable a flag, pass it in via the options array.

{{ Constraint::Validate }}

Returns *true* or *false* indicator as to whether or not `alias` conforms to constraint definition.

{{ Constraint::Validate::Usage }}

To test *alias* for validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('URL Encoded', $url_string, 'Encoded');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Encoded is sanitized to remove all non-conforming values.

{{ Constraint::Sanitize::Usage }}

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('URL Encoded', $url_string, 'Encoded');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }


```

{{ Constraint::Format }}

Formatting is not relevant for this constraint.
