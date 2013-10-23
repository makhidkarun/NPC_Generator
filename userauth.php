<?php

$user = array();

$user['fred']['password'] = 'guido';

$given_password = 'sam';

if ( $given_password == $user['fred']['password']) {
    echo "You answered $given_password, which matches!\n";
} else {
    echo "You answered $given_password, which does not match.\n";
}

$given_password = 'guido';

if ( $given_password == $user['fred']['password']) {
    echo "You answered $given_password, which matches!\n";
} else {
    echo "You answered $given_password, which does not match.\n";
}

