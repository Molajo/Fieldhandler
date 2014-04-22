---
title :
subtitle:
author: Amy Stephen
published: 2014-05-01
categories : constraint
tags :
featured : 0
class :
unit_tests :
---

{{ Constraint::Definition }}

{{ Constraint::Options }}


{{ Validate }}

Values failing to conform to constraint definitions are removed.

{{ Validate::Usage }}

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}


{{ Sanitize }}

Values failing to conform to constraint definitions are removed.

{{ Sanitize::Usage }}

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}


{{ Format }}

Values failing to conform to constraint definitions are removed.

{{ Format::Usage }}

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}

### Format Example: Success

Each value conforms.

