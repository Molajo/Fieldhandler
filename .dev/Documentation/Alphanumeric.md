
# Alphanumeric Constraint

## Definition

Each character must be a value of A through Z (upper or lowercase) or a digit value ranging from 0 to 9.

[Source Code]()

## Filter

Values failing to conform to constraint definitions are removed.

### Filter Example 1

Each value conforms.

```php

$employee_name = 'Janet Jackson';
$results       = $request->filter('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFilteredValue();
} else {
    // Filtering did not change the Employee Name
}

```

### Filter Example 2

Each value does not conform. Use the filtered value as the data value.

```php

$employee_name = 'Janet @ Jackson';
$results       = $request->filter('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFilteredValue();
    // The employee_name value now contains 'Janet Jackson'
}

```

## Validate

Verify each value conforms to the defined constraint.

### Filter Example 1

Each value conforms.

```php

$employee_name = 'Janet Jackson';
$results       = $request->validate('employee_name', $employee_name, 'Alphanumeric');

if ($results->getValidationResponse() === true) {
    // Yea! Each value conforms to the defined constraint!
}

```

### Filter Example 2

*Example 2:* Each value does not conform.

```php

$employee_name = 'Janet @ Jackson';
$results       = $request->validate('employee_name', $employee_name, 'Alphanumeric');

if ($results->getValidationResponse() === false) {
    // Retrieve error messages and codes
    $messages = $results->getValidationMessages();
}


```

Return to:
 * [Constraint List](https://github.com/Molajo/Fieldhandler#constraints)
