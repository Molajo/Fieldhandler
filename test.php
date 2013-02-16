<?php
/**
$test = 'ctype_alpha';

$getValue = 'dDg123@gmail.com';

$filtered = '';
$filter = $getValue;
if (strlen($filter) > 0) {
for ($i = 0; $i < strlen($filter); $i++) {
if ($test(substr($filter, $i, 1)) == 1) {
$filtered .= substr($filter, $i, 1);
}
}
}
echo $filtered;

echo '<br />';

if ($test($getValue)) {
echo 'true';
} else {
echo 'false';
}
 */


if (filter_var('testp,,,,gmail.com', FILTER_SANITIZE_EMAIL)) {
    echo 'true';
} else {
    echo 'false';
}


echo filter_var('test,,,,@gmail.com', FILTER_SANITIZE_EMAIL);
