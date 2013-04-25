<?php

require_once(CITYPHP . 'html/autofocus.php');
require_once(VANILLA . 'forms/SignUpValidator.php');
require_once(VANILLA . 'html/signUp.php');

$validator = new SignUpValidator();

if($user) {
    $content = 'You are already signed up.';
}
else if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $content = signUp($formData, current($errors));
    }
    else if($error = $userModel->createUser($formData)) {
        $content = signUp($formData, $error);
    }
    else {
        $content = sprintf('Thank you for signing up.'
            . ' You can now <a href="%s">log in</a>. %s',
            LOGIN, $formData['email']
                ? 'We emailed you a link to verify your email.'
                : 'You can assign an email to your account on the edit account page.');
    }
}
else {
    $autofocus = autofocus('username');
    $content = signUp($validator->values());
}

$head = '<title>Sign Up</title>';

?>
