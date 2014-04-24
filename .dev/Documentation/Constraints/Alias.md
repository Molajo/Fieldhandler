---
title: Alias
author: Amy Stephen
published: 2014-05-01
categories : Fieldhandler, Constraint
tags : url
featured : 0
class : https://github.com/Molajo/Fieldhandler/blob/master/Source/Constraint/Alias.php
namespace : Molajo\Fieldhandler\Constraint\Alias
unit_tests : https://github.com/Molajo/Fieldhandler/blob/master/.dev/Tests/AliasTest.php

constraint_definition: Valid values for the `alias` include upper and lower case alphabetic characters,
numeric values, and the dash ('-').

validate_definition: Returns *true* or *false* indicator as to whether or not `alias` conforms to
constraint definition.

sanitize_definition: Alias is sanitized to remove all non-conforming values.

format_definition: Sanitized, lowercase `Alias` is formatted replacing all non alphabetic or numeric values
with dashes and trimming leading and trailing spaces.

---
