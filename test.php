<?php

$foo = 'my-apples&are green and red';

$email = 'AmyStephen@gmail.com';

echo (boolean) filter_var($email, FILTER_VALIDATE_EMAIL);
