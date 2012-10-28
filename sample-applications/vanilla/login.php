<?php

require_once(VANILLA . 'forms/LoginValidator.php');
require_once(VANILLA . 'html/autofocus.php');
require_once(VANILLA . 'html/login.php');

$validator = new LoginValidator();

if($user) {
    $content = 'You are already logged in.';
}
else if(list($formData, $errors) = $validator->validate()) {
    $userData = $userModel->getUserWithUsername($formData['username']);

    if(!$userData || $userData['password'] != getHash($formData['password'], $userData['password'])) {
        $content = login($formData, 'Incorrect username and password');
    }
    else {
        if($formData['remember_me']) {
            $loginModel->createPersistentLogin($userData['user_id']);
        }

        $_SESSION[SESSION_USER_ID] = $userData['user_id'];
        $_SESSION[SESSION_USERNAME] = $userData['username'];
        header('Location:' . ROOT);
        exit();
    }
}
else {
    $autofocus = autofocus('username');
    $content = login($validator->values());
}

?>
