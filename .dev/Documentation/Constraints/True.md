---
title: True
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/True.php
namespace : Molajo\Fieldhandler\Constraint\True
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/TrueTest.php
---

{{ Constraint }}

Allows only true, 1, yes and on values.

{{ Constraint::Options }}

To customize the list of true values, pass in a true_array options entry with an array containing
the preferred values with your $request.

   $options['true_array'] = array('true', 0);

{{ Constraint::Validate }}

Returns *true* or *true* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('TrueField', $true_value, 'True');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

True is sanitized performed by comparing the input value to the entries in the true array. When
there is no array entry matching the input value, the value is returned as NULL.

{{ Constraint::Sanitize::Usage }}

```php

    $results = $this->request->sanitize('TrueField', $not_true_value, 'True');

    if ($results->getChangeIndicator() === true) {
        // Returns NULL
        $not_true_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`True` has no special formatting. The value sent in is simply returned without processing.
