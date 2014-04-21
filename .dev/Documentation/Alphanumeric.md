
# Alphanumeric Constraint

## Definition

Each character must be a value of A through Z (upper or lowercase) or a digit ranging from 0 to 9.

[Source Code](https://github.com/Molajo/Fieldhandler/blob/bd65c83e7705b010555146fa6b2090d7e4bdd25e/Source/Constraint/Alphanumeric.php)

## Escape

Escape field

### Escape Example 1

Each value conforms.

```php

$employee_name = 'Janet Jackson';
$results       = $request->handleInput('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}

```

### Escape Example 2

Each value does not conform. Use the returned value as the data value.

```php

$employee_name = 'Janet @ Jackson';
$results       = $request->handleInput('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
    // The employee_name value now contains 'Janet Jackson'
}

```


## Filter

Values failing to conform to constraint definitions are removed.

### Filter Example 1

Each value conforms.

```php

$employee_name = 'Janet Jackson';
$results       = $request->handleInput('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}

```

### Filter Example 2

Each value does not conform. Use the returned value as the data value.

```php

$employee_name = 'Janet @ Jackson';
$results       = $request->handleInput('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
    // The employee_name value now contains 'Janet Jackson'
}

```

## Validate

Verify each value conforms to the defined constraint.

### Validate Example 1

Each value conforms.

```php

$employee_name = 'Janet Jackson';
$results       = $request->validate('employee_name', $employee_name, 'Alphanumeric');

if ($results->getValidateResponse() === true) {
    // Yea! Each value conforms to the defined constraint!
}

```

### Validate Example 2

*Example 2:* Each value does not conform.

```php

$employee_name = 'Janet @ Jackson';
$results       = $request->validate('employee_name', $employee_name, 'Alphanumeric');

if ($results->getValidateResponse() === false) {
    // Retrieve error messages and codes
    $messages = $results->getValidateMessages();
}


```

Return to:
 * [Constraint List](https://github.com/Molajo/Fieldhandler#constraints)
