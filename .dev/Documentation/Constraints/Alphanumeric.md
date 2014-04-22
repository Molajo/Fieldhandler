---
title: Alphanumeric
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Alphanumeric.php
namespace : Molajo\Fieldhandler\Constraint\Alphanumeric
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/AlphanumericTest.php
---

{{ Constraint }}

Allows only alphanumeric characters.

{{ Constraint::Options }}

Whitespace can be enabled by passing in the 'allow_whitespace' option value.


{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Alphanumeric Field Name', $alphanumeric_value, 'Alphanumeric');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Alphanumeric is sanitized using [ctype_alnum](http://us2.php.net/manual/en/function.ctype-alnum.php)
to remove non-conforming values.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['allow_whitespace'] = true;
    $results = $this->request->sanitize('Alphanumeric Field Name', $alphanumeric_value, 'Alphanumeric', $options);

    if ($results->getChangeIndicator() === true) {
        $alphanumeric_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Alphanumeric` has no special formatting. The value sent in is simply returned without processing.

{{ Constraint::Format::Usage }}

```php

    $results = $this->request->format('Alphanumeric Field Name', $alphanumeric_value, 'Alphanumeric');

    if ($results->getChangeIndicator() === true) {
        // it will never be true :)
    }


```
