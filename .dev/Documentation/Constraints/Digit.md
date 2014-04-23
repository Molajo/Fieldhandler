---
title: Digit
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Digit.php
namespace : Molajo\Fieldhandler\Constraint\Digit
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/DigitTest.php
---

{{ Constraint }}

Allows only digits.

{{ Constraint::Options }}

Whitespace can be enabled by passing in the 'allow_whitespace' option value.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('DigitField', $digit_value, 'Digit');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Digit is sanitized using [ctype_digit](http://us2.php.net/manual/en/function.ctype-digit.php)
to remove non-conforming values.

{{ Constraint::Sanitize::Usage }}

```php

    $results = $this->request->sanitize('Digit Field Name', $digit_value, 'Digit');

    if ($results->getChangeIndicator() === true) {
        $digit_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Digit` has no special formatting. The value sent in is simply returned without processing.
