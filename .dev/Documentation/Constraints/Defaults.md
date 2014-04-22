---
title: Defaults
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : standard
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Defaults.php
namespace : Molajo\Fieldhandler\Constraint\Defaults
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/DefaultsTest.php
---

{{ Constraint }}

Establishes a value for a null input string if default value is provided.

{{ Constraint::Options }}

Define the value to use as a default value in `$this->options['default'] = $value;`

{{ Constraint::Validate }}

Not useful for validate.

{{ Constraint::Sanitize }}

Sanitize applies the default to the input field if the input value is null.

{{ Constraint::Sanitize::Usage }}

```php


    $request = new Molajo\Fieldhandler\Request();

    $opions = array();
    $options['default'] = $default_value;
    $results = $request->sanitize('Defaults Field Name', $default_applied_to_this, 'Defaults', $options);

    if ($results->getChangeIndicator() === true) {
        $default_applied_to_this = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Defaults` has no special formatting. The value sent in is simply returned without processing.
