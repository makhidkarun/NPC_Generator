<?php

session_start();

$_SESSION['count'] += 1;

print "You have been here " . $_SESSION['count'] . " times.\n";


