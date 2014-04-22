---
title: Alias
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Alias.php
namespace : Molajo\Fieldhandler\Constraint\Alias
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/AliasTest.php
---

{{ Constraint }}

Alias, sometimes called `slug`, is a segment of a URL.

Valid values for the `alias` include upper and lower case alphabetic characters, numeric values, and the dash ('-').

{{ Constraint::Options }}

None.

{{ Constraint::Validate }}

Returns *true* or *false* indicator as to whether or not `alias` conforms to constraint definition.

{{ Constraint::Validate::Usage }}

To test *alias* for validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Alias Field Name', $alias_value, 'Alias');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Alias is sanitized to remove all non-conforming values.

{{ Constraint::Sanitize::Usage }}

```php

    $results = $this->request->sanitize('Alias Field Name', $alias_value, 'Alias');

    if ($results->getChangeIndicator() === true) {
        $alias_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

Sanitized, lowercase `Alias` is formatted replacing all non alphabetic or numeric values with dashes and trimming
leading and trailing spaces.

{{ Constraint::Format::Usage }}

```php

    $results = $this->request->format('Alias Field Name', $alias_value, 'Alias');

    if ($results->getChangeIndicator() === true) {
        $alias_value = $results->getFieldValue();
    }


```
