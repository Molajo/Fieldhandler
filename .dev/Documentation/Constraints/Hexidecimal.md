---
title: Hexidecimal
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Hexidecimal.php
namespace : Molajo\Fieldhandler\Constraint\Hexidecimal
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/HexidecimalTest.php
---

{{ Constraint }}

Field must be of type hexidecimal.

{{ Constraint::Options }}

Two [filter flags](http://us2.php.net/manual/en/filter.filters.flags.php): $options['FILTER_FLAG_ALLOW_OCTAL'],
$options['FILTER_FLAG_ALLOW_HEX'] can be added to the $request command

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Hexidecimal Field', $hexidecimal_value, 'Hexidecimal');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Hexidecimal is sanitized using [ctype_xdigit](http://us2.php.net/manual/en/function.ctype-xdigit.php).
If a field is found to be non-compliant it is returned as a NULL.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['allow_whitespace'] = true;
    $results = $this->request->sanitize('Hexidecimal Field', $hexidecimal_value, 'Hexidecimal', $options);

    if ($results->getChangeIndicator() === true) {
        $hexidecimal_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Hexidecimal` has no special formatting. The value sent in is simply returned without processing.
