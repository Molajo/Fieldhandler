---
title: Filesystem
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Filesystem.php
namespace : Molajo\Fieldhandler\Constraint\Filesystem
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/FilesystemTest.php
---

{{ Constraint }}

Field must be the complete file name with the base, path and file. The file extension must be a certain value.

{{ Constraint::Options }}

Provide array of acceptable file extension values as '$this->options['array_valid_extensions']'

{{ Constraint::Validate }}

Returns *true* or *false* indicator of constraint conformance.

{{ Constraint::Validate::Usage }}

To test validity:

```php

    $request = new Molajo\Fieldhandler\Request();

    $options = array();
    $options['array_valid_extensions'] = array('png', 'jpg', 'gif');

    $results = $request->validate('Filesystem Name', $path_filename, 'Filesystem', $options);

    if ($results->getValidateResponse() === true) {
        // all is good
    } else {
        foreach ($results->getValidateMessages() as $error) {
            echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
        }
    }

```

{{ Constraint::Sanitize }}

The file extension must match an entry in `array_valid_extensions` or the input field
is returned as NULL.

{{ Constraint::Sanitize::Usage }}

```php

    $options = array();
    $options['array_valid_extensions'] = array('png', 'jpg', 'gif');

    $results = $request->validate('Filesystem Name', $path_filename, 'Filesystem', $options);

    if ($results->getChangeIndicator() === true) {
        // Sets invalid file name to NULL
        $path_filename = $results->getReturnValue();
    }

```

{{ Constraint::Format }}

`Filesystem` has no formatting. If format is requested, the value sent in is simply returned without processing.
