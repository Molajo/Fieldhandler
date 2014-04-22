---
title: Alpha
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Alpha.php
namespace : Molajo\Fieldhandler\Constraint\Alpha
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/AlphaTest.php
---

{{ Constraint }}

Allows only alphabetic characters.

{{ Constraint::Options }}

Whitespace can be enabled by passing in the 'allow_whitespace' option value.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Alpha Field Name', $alpha_value, 'Alpha');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Alpha is sanitized using [ctype_alpha](http://us2.php.net/manual/en/function.ctype-alpha.php)
to remove non-conforming values.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['allow_whitespace'] = true;
    $results = $this->request->sanitize('Alpha Field Name', $alpha_value, 'Alpha', $options);

    if ($results->getChangeIndicator() === true) {
        $alpha_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Alpha` has no special formatting. The value sent in is simply returned without processing.
