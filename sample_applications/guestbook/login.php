<?php

require_once(GUEST_BOOK_PHP . 'forms/LoginFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/logIn.php');

$formHandler = new LoginFormHandler();

if($user) {
    $content = 'You are already logged in.';
}
else if($formHandler->isReady()) {
    $formHandler->validate();
    $formData = $formHandler->getValues();
    $userData = $userModel->getUserWithUsername($formData['username']);

    if(!$userData || $userData['password'] != getHash($formData['password'], $userData['password'])) {
        $content = logIn($formData, 'Incorrect username and password');
    }
    else {
        if(isset($_POST['rememberme'])) {
            $userModel->setPersistentLogin($userData['user_id']);
        }

        $_SESSION[SESSION_USER_ID] = $userData['user_id'];
        $_SESSION[SESSION_USERNAME] = $userData['username'];
        header('Location:' . ROOT);
        exit();
    }
}
else {
    $content = logIn($formHandler->getValues());
}

?>
