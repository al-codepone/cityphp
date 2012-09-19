<?php

require_once(VANILLA . 'forms/LoginFormHandler.php');
require_once(VANILLA . 'html/login.php');

$formHandler = new LoginFormHandler();

if($user) {
    $content = 'You are already logged in.';
}
else if($formHandler->isReady()) {
    $formHandler->validate();
    $formData = $formHandler->getValues();
    $userData = $userModel->getUserWithUsername($formData['username']);

    if(!$userData || $userData['password'] != getHash($formData['password'], $userData['password'])) {
        $content = login($formData, 'Incorrect username and password');
    }
    else {
        if(isset($_POST['rememberme'])) {
            $loginModel->createPersistentLogin($userData['user_id']);
        }

        $_SESSION[SESSION_USER_ID] = $userData['user_id'];
        $_SESSION[SESSION_USERNAME] = $userData['username'];
        header('Location:' . ROOT);
        exit();
    }
}
else {
    $content = login($formHandler->getValues());
}

?>
