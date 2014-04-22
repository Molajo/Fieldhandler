---
title: Boolean
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Boolean.php
namespace : Molajo\Fieldhandler\Constraint\Boolean
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/BooleanTest.php
---

{{ Constraint }}

Allows only boolean values.

{{ Constraint::Options }}

None.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Boolean Field Name', $boolean_value, 'Boolean');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Boolean is sanitized using simple `=== true` and `=== false` tests and setting non-conforming values to `null`.

{{ Constraint::Sanitize::Usage }}

```php

    $results = $this->request->sanitize('Boolean Field Name', $boolean_value, 'Boolean', $options);

    if ($results->getChangeIndicator() === true) {
        $boolean_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Boolean` has no special formatting. The value sent in is simply returned without processing.

