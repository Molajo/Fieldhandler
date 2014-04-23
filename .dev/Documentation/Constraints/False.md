---
title: False
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/False.php
namespace : Molajo\Fieldhandler\Constraint\False
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/FalseTest.php
---

{{ Constraint }}

Allows only false, 0, no and off values.

{{ Constraint::Options }}

To customize the list of false values, pass in a false_array options entry with an array containing
the preferred values with your $request.

   $options['false_array'] = array('false', 0);

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('FalseField', $false_value, 'False');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

False is sanitized performed by comparing the input value to the entries in the false array. When
there is no array entry matching the input value, the value is returned as NULL.

{{ Constraint::Sanitize::Usage }}

```php

    $results = $this->request->sanitize('FalseField', $not_false_value, 'False');

    if ($results->getChangeIndicator() === true) {
        // Returns NULL
        $not_false_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`False` has no special formatting. The value sent in is simply returned without processing.
