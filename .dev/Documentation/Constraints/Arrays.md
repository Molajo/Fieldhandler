---
title: Arrays
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Arrays.php
namespace : Molajo\Fieldhandler\Constraint\Arrays
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/ArraysTest.php
---

{{ Constraint }}

Must conform to array data type.

{{ Constraint::Options }}

*To test array key values against a known list:* populate $options['array_valid_key'] with the array of key values.
*To test array values against a known list:* populate $options['array_valid_values'] with the array of valid values.
*To test minimum array count:* populate $options['array_minimum'] with the minimum number of entries allowed.
*To test maximum array count:* populate $options['array_maximum'] with the maximum number of entries allowed.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Array Field Name', $array, 'Arrays');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

If value sent in is not an array, the field will be set to NULL and returned. Examples of how to use
array_valid_key and array_valid_values are listed below.

For other types of sanitation requirements, for
example, like verifying each value is numeric, simply process the array in a look and use the `Numeric`
constraint for each value.

{{ Constraint::Sanitize::Usage }}

```php

    $results = $this->request->sanitize('Arrays Field Name', $array, 'Arrays');

    if ($results->getChangeIndicator() === true) {
        $array = $results->getFieldValue();
    }

```

In this example, $array entries with keys not matching 1, 2, 3, 4, or 5 are removed from the array.

```php

    $options = array();
    $options['array_valid_key'] = array(1, 2, 3, 4, 5);
    $results = $this->request->sanitize('Arrays Field Name', $array, 'Arrays', $options);

    if ($results->getChangeIndicator() === true) {
        $array = $results->getFieldValue();
    }

```

In this example, $array entries with values not matching 1, 2, 3, 4, or 5 are removed from the array.

```php

    $options = array();
    $options['array_valid_values'] = array(1, 2, 3, 4, 5);
    $results = $this->request->sanitize('Arrays Field Name', $array, 'Arrays', $options);

    if ($results->getChangeIndicator() === true) {
        $array = $results->getFieldValue();
    }

```


{{ Constraint::Format }}

`Arrays` has no special formatting. The value sent in is simply returned without processing.

