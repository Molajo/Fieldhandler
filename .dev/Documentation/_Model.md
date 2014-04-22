---
title:
subtitle:
author: Amy Stephen
published: 2014-05-01
categories : constraint
tags :
featured : 0
class :
namespace :
unit_tests :
---

{{ Constraint }}


{{ Constraint::Definition }}


{{ Constraint::Options }}


{{ Constraint::Validate }}

Values failing to conform to constraint definitions are removed.

{{ Constraint::Validate::Usage }}

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}


{{ Constraint::Sanitize }}

Values failing to conform to constraint definitions are removed.

{{ Constraint::Sanitize::Usage }}

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}


{{ Constraint::Format }}

Values failing to conform to constraint definitions are removed.

{{ Constraint::Format::Usage }}

$employee_name = 'Janet Jackson';
$results       = $request->sanitize('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}
