---
title: Foreignkey
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : standard
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Foreignkey.php
namespace : Molajo\Fieldhandler\Constraint\Foreignkey
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/ForeignkeyTest.php
---

{{ Constraint }}

Field contains foreign key to another table.

{{ Constraint::Options }}

Provide these addition values for database verification:

    $this->options['database'] = $connection;
    $this->options['table'] = $name_of_table;
    $this->options['key'] = $name_of_key;

{{ Constraint::Validate }}

```php

    $request = new Molajo\Fieldhandler\Request();

    $options = array();
    $options['default'] = $default_value;
    $results = $request->validate('Foreignkey Name', $foreign_key_value, 'Foreignkey', $options);

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

If the value is found to not be a correct foreign key, the input value will be returned as NULL.

{{ Constraint::Sanitize::Usage }}

```php

    $request = new Molajo\Fieldhandler\Request();

    $options = array();
    $options['default'] = $default_value;
    $results = $request->sanitize('Foreignkey Name', $foreign_key_value, 'Foreignkey', $options);

    if ($results->getChangeIndicator() === true) {
        $default_applied_to_this = $results->getFieldValue();
    }

```

{{ Constraint::Format }}

`Foreignkey` has no special formatting. The value sent in is simply returned without processing.
