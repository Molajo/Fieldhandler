---
title: Email
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Email.php
namespace : Molajo\Fieldhandler\Constraint\Email
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/EmailTest.php
---

{{ Constraint }}

Allows only valid email addresses.

{{ Constraint::Options }}

To verify MX Record for Host, use the `$this->options['check_mx']` input option.

To verify the Host DNS Records for at least one (MX, A, AAAA), use the `$this->options['check_host']` input option.

To obfuscate the email address, use the `$this->options['obfuscate_email']` option.

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $results = $request->validate('EmailField', $email_value, 'Email');

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

Email is sanitized using [FILTER_VALIDATE_EMAIL](http://us2.php.net/manual/en/function.ctype-email.php)
to remove non-conforming values.

Additionally, te

{{ Constraint::Sanitize::Usage }}

```php

    $results = $this->request->sanitize('Email Field Name', $email_value, 'Email');

    if ($results->getChangeIndicator() === true) {
        $email_value = $results->getFieldValue();
    }

```

{{ Constraint::Format }}


To obfuscate the displayed email address, use the format method with $this->options['obfuscate_email'], as shown
in this example.


{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['obfuscate_email'] = true;
    $results = $this->request->sanitize('Email Field Name', $email_value, 'Email', $options);

    if ($results->getChangeIndicator() === true) {
        // returns the obfuscated value
        $email_value = $results->getFieldValue();
    }

```
