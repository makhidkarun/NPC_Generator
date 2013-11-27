<?php

function userAuth($user, $password){

    echo "In userAuth\n";

$users = array( 'alice' => 'dog123',
                'bob' => 'my_pwd',
                'charlie' => '**fun**');

if (! array_key_exists($user, $users)){
    echo "Please enter a valid username and password.";
//    return false;
}
 
if ( $password == $users[$user]) {
    echo "Welcome!\n";
//    return true;
}
}

