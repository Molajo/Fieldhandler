---
title: Html
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : standard
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Html.php
namespace : Molajo\Fieldhandler\Constraint\Html
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/HtmlTest.php
---

{{ Constraint }}

All Html must be filtered according to a [white list](https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/AbstractConstraint.php#L154)
and escaped before using in the response.

{{ Constraint::Options }}

The whitelist can be overridden by including a new list in the $request as an $options['white_list'] array.

{{ Constraint::Validate }}

HTML is validated by comparing what was input to the validate process to what would be used with a filter.
If any of the HTML would be changed, the validation returns a false and messages.

```php

    $request = new Molajo\Fieldhandler\Request();

    $options = array();
    $options['default'] = $default_value;
    $results = $request->validate('Html Name', $html, 'Html', $options);

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

HTML can be sanitized and the results used safely.


{{ Constraint::Sanitize::Usage }}


```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('Html Name', $html, 'Html', $options);

    if ($results->getChangeIndicator() === true) {
        $filtered_html = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

HTML must be escaped for security purposes. Just pass the body of your rendered output in and
use the escaped results for the body.


{{ Constraint::Sanitize::Usage }}


```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->format('Html Name', $html, 'Html', $options);

    if ($results->getChangeIndicator() === true) {
        $filtered_html = $results->getFieldValue();
    }

```
