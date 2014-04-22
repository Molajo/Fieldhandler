---
title:
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags :
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Alias.php
namespace : Molajo\Fieldhandler\Constraint\Alias
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/AliasTest.php
---

{{ Constraint }}


{{ Constraint::Definition }}


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
