<?php

require_once(GUEST_BOOK_PHP . 'forms/SignUpFormHandler.php');
require_once(GUEST_BOOK_PHP . 'html/signUp.php');

$formHandler = new SignUpFormHandler();

if($user) {
    $content = 'You are already signed up.';
}
else if($formHandler->isReady()) {
    $errors = $formHandler->validate();
    $formData = $formHandler->getValues();

    if(count($errors) > 0) {
        $content = signUp($formData, current($errors));
    }
    else if($userModel->getUserWithUsername($formData['username'])) {
        $content = signUp($formData,
            sprintf('Username "%s" already in use', $formData['username']));
    }
    else {
        $userModel->createUser($formData);
        $content = 'Thank you for signing up. '
            . 'Now try to <a href="' . LOGIN . '">log in</a>.';
    }
}
else {
    $content = signUp($formHandler->getValues());
}

?>
