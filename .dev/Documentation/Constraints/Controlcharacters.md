---
title: Controlcharacters
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Controlcharacters.php
namespace : Molajo\Fieldhandler\Constraint\Controlcharacters
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/ControlcharactersTest.php
---

{{ Constraint }}

String must only have control characters.

{{ Constraint::Options }}

Whitespace can be enabled by passing in the 'allow_whitespace' option value.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Field Name', $test_string, 'Controlcharacters');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Controlcharacters is sanitized using [ctype_cntrl](http://us2.php.net/manual/en/function.ctype-cntrl.php)
to remove non-conforming values.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['allow_whitespace'] = true;
    $results = $this->request->sanitize('Controlcharacters Field Name', $test_string, 'Controlcharacters', $options);

    if ($results->getChangeIndicator() === true) {
        $test_string = $results->getFieldValue();
    }

```
