
# Model Constraint

## Definition

xxx
[Validate]()
[handleInput]()
[handleOutput]()
[View Code](https://github.com/Molajo/Fieldhandler/blob/bd65c83e7705b010555146fa6b2090d7e4bdd25e/Source/Constraint/Model.php)


## Validate

Verify xxx.

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

*Example 2:* Each value does *not* conform.

```php

$employee_name = 'Janet @ Jackson';
$results       = $request->validate('employee_name', $employee_name, 'Alphanumeric');

if ($results->getValidateResponse() === false) {
    // Retrieve error messages and codes
    $messages = $results->getValidateMessages();
}

```

## Handle Input

Values failing to conform to constraint definitions are removed.

### handleInput Example 1

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

### handleInput Example 2

Each value does not conform. Use the new value as the data value.

```php

$employee_name = 'Janet @ Jackson';
$results       = $request->handleInput('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
    // The employee_name value now contains 'Janet Jackson'
}

```


## Handle Output

handleOutput field

### Handle Output Example 1

Each value conforms.

```php

$employee_name = 'Janet Jackson';
$results       = $request->handleOutput('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
} else {
    // Filtering did not change the Employee Name
}

```

### Handle Output Example 2

Each value does not conform. Use the new value as the data value.

```php

$employee_name = 'Janet @ Jackson';
$results       = $request->handleOutput('employee_name', $employee_name, 'Alphanumeric');

if ($results->getChangeIndicator() === true) {
    $employee_name = $results->getFieldValue();
    // The employee_name value now contains 'Janet Jackson'
}

```




Return to:
 * [Constraint List](https://github.com/Molajo/Fieldhandler#constraints)
