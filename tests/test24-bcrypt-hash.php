<?php

require_once 'const.php';
require_once CITYPHP . 'bcryptHash.php';

$signUpPassword = 'password';
$loginPassword = 'password';

//store in database
$signUpHash = bcryptHash($signUpPassword, 10);

//get hash using previous hash
$loginHash = bcryptHash($loginPassword, $signUpHash);

$correct = ($signUpHash == $loginHash);

echo 
    '<pre>',

    implode("\n\n", array(
        '$signUpHash = ' . $signUpHash,
        '$loginHash = ' . $loginHash,
        '$correct = ' . var_export($correct, true))),

    '</pre>';

?>
