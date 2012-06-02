<?php

//
require_once(GUEST_BOOK_PHP . 'forms/SignUpFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/DisplayMessage.php');
require_once(GUEST_BOOK_PHP . 'html/SignUp.php');

//
$formHandler = new SignUpFormHandler();

if($user) {
    $content = new DisplayMessage('You have already signed up.');
}
else if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $username = $formHandler->getValue('xusername');

    if(count($errors) > 0) {
        $content = new SignUp($username, current($errors));
    }
    else if($databaseApi->getUserWithUsername($username)) {
        $content = new SignUp($username, sprintf('"%s" already in use', $username));
    }
    else {
        $password = $formHandler->getValue('xpassword');
        $passwordHash = getHash($password);
        $databaseApi->addUser($username, $passwordHash);
        $content = new DisplayMessage('Thank you for signing up.');
    }
}
else {
    $content = new SignUp();
}

array_push($headTags, '<title>Sign Up</title>',
   '<meta name="description" content=""/>');

?>
