---
title: Contains
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : string
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Contains.php
namespace : Molajo\Fieldhandler\Constraint\Contains
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/ContainsTest.php
---

{{ Constraint }}

The string must contain the defined value.

{{ Constraint::Options }}

Use `options['contains']` to define the value to search for in the input string.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    #options['contains'] = 'search for';
    $results = $request->validate('Contains Field Name', $search_in_here, 'Contains');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

If the `contains` value is not found within the input string, the string will be set to `NULL` and returned.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['contains'] = 'search for';
    $search_in_here = 'but you will not find it.';
    $results = $this->request->sanitize('Contains Field Name', $search_in_here, 'Contains', $options);

    if ($results->getChangeIndicator() === true) {
        // $search_in_here will be NULL
        $search_in_here = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Contains` has no special formatting. The value sent in is simply returned without processing.
