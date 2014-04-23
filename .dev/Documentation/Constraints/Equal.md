---
title: Equal
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Equal.php
namespace : Molajo\Fieldhandler\Constraint\Equal
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/EqualTest.php
---

{{ Constraint }}

Constraint stipulates two values must be the same type and value.

{{ Constraint::Options }}

Provide comparison value via the options array as '$this->options['equals']'

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $options = array();
    $options['equals'] = 'dog';
    $input_field       = 'dog';
    $results = $request->validate('Equal Field Name', $input_field, 'Equal', $options);

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

For Equal Sanitize: if the two values are not the same value, the input field
will be returned as NULL.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['equals'] = 'dog';
    $input_field       = 'cat';
    $results = $request->sanitize('EqualField', $input_field, 'Equal', $options);

    if ($results->getChangeIndicator() === true) {
        // cat is replaced with NULL
        $input_field = $results->getReturnValue();
    }

```

{{ Constraint::Format }}

`Equal` has no formatting. If format is requested, the value sent in is simply returned without processing.
