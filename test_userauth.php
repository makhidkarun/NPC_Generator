<?php

require_once 'userauth.php';

if (array_key_exists('_submit_check', $_POST)) {
    echo "About to userAuth.\n";
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "About to userAuth with $username and $password.\n";
    userAuth($_POST['username'], $_POST['password']);
}

print<<<_HTML_

<html>
<body>
<form method="POST" action="$_SERVER[PHP_SELF]">
<p>Name: <input type="text" name="username">
<p>Password: <input type="text" name="password">
<input type="hidden" name="_submit_check" value="1">
<input type="submit" value="Who are you?">
</form>
</body>
</html>
_HTML_;



