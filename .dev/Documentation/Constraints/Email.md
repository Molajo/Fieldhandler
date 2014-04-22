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


{{ Constraint::Definition }}

Tests if values are valid for a URL slug. When used with filter or escape, the value returned can be used as an alias value.

{{ Constraint::Options }}


{{ Constraint::Validate }}

Values failing to conform to constraint definitions are removed.

{{ Constraint::Validate::Usage }}

Say things...

```php

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}

```


{{ Constraint::Sanitize }}

Values failing to conform to constraint definitions are removed.

{{ Constraint::Sanitize::Usage }}

Say things...

```php

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}

```

{{ Constraint::Format }}

Values failing to conform to constraint definitions are removed.

{{ Constraint::Format::Usage }}

```php

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}

```
