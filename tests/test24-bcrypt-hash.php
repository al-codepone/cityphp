<?php

require 'vendor/autoload.php';

$signUpPassword = 'password';
$loginPassword = 'password';

//store this value in a database
$signUpHash = bcryptHash($signUpPassword, 10);

//get hash using previous hash
$loginHash = bcryptHash($loginPassword, $signUpHash);

$correct = ($signUpHash == $loginHash);

echo implode("<br/>\n", array(
    '$signUpHash = ' . $signUpHash,
    '$loginHash = ' . $loginHash,
    '$correct = ' . var_export($correct, true)));

?>
