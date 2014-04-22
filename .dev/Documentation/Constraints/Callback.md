---
title: Callback
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Callback.php
namespace : Molajo\Fieldhandler\Constraint\Callback
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/CallbackTest.php
---

{{ Constraint }}

Allows only callable methods or functions.

{{ Constraint::Options }}

None.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Callback Field Name', $callable, 'Callback');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Callback is sanitized using [PHP Callbacks](http://www.php.net/manual/en/filter.filters.misc.php)
 and setting non-conforming values to `null`.

{{ Constraint::Sanitize::Usage }}

```php

    $results = $this->request->sanitize('Callback Field Name', $boolean_value, 'Callback', $options);

    if ($results->getChangeIndicator() === true) {
        $boolean_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Callback` has no special formatting. The value sent in is simply returned without processing.

