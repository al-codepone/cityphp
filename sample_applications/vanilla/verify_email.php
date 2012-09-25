<?php

$verifyEmailModel = MyModelFactory::getModel('VerifyEmailModel');
$data = $verifyEmailModel->getToken($_GET['id'], $_GET['token']);

if($data) {
    $email = $data['data'];

    if(!$userModel->getUserWithEmail($email)) {
        $userModel->updateEmail($data['user_id'], $email);
        $content = 'Thank you, your email has been verified.';
    }
    else {
        $content = 'The email you are trying to verify is already in use.';
    }

    $verifyEmailModel->deleteToken($data['token_id']);
}
else {
    $content = 'Invalid verification.';
}

?>
