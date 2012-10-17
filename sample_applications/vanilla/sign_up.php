<?php

require_once(VANILLA . 'forms/SignUpValidator.php');
require_once(VANILLA . 'html/autofocus.php');
require_once(VANILLA . 'html/signUp.php');

$validator = new SignUpValidator();

if($user) {
    $content = 'You are already signed up.';
}
else if(list($formData, $errors) = $validator->validate()) {
    if(count($errors) > 0) {
        $content = signUp($formData, current($errors));
    }
    else if($userModel->getUserWithUsername($formData['username'])) {
        $content = signUp($formData,
            sprintf('Username "%s" already in use', $formData['username']));
    }
    else if($userModel->getUserWithEmail($formData['email'])) {
        $content = signUp($formData,
            sprintf('Email "%s" already in use', $formData['email']));
    }
    else {
        $userID = $userModel->createUser($formData);

        if($formData['email']) {
            $verifyEmailModel = MyModelFactory::getModel('VerifyEmailModel');
            $verifyEmailModel->sendEmail($userID, $formData['username'],
                $formData['email']);
        }

        $emailSentence = $formData['email']
            ? 'We emailed you a link to verify your email.'
            : 'You can assign an email to your account on the settings page.';

        $content = sprintf('Thank you for signing up.'
            . ' You can now <a href="%s">log in</a>. %s',
            LOGIN, $emailSentence);
    }
}
else {
    $autofocus = autofocus('username');
    $content = signUp($validator->values());
}

?>
