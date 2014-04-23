---
title: Float
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Float.php
namespace : Molajo\Fieldhandler\Constraint\Float
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/FloatTest.php
---

{{ Constraint }}

Field must be of type float.

{{ Constraint::Options }}

Whitespace can be enabled by passing in the 'allow_whitespace' option value.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Float Field Name', $float_value, 'Float');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Float is sanitized using [FILTER_VALIDATE_FLOAT](http://www.php.net/manual/en/filter.filters.validate.php).
If a field is found to be non-compliant it is returned as a NULL.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['allow_whitespace'] = true;
    $results = $this->request->sanitize('Float Field', $float_value, 'Float', $options);

    if ($results->getChangeIndicator() === true) {
        $float_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Float` has no special formatting. The value sent in is simply returned without processing.
