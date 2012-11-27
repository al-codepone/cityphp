<?php

require_once(VANILLA . 'emailStates.php');

function accountUpdated($userData, $formData) {
    $emailStates = emailStates($userData, $formData);
    $emailSentence =
        !$emailStates['is_changed'] ? !$emailStates['is_new'] ? !$emailStates['is_deleted'] ? ''
        : ' Your email was removed from your account.'
        : ' We emailed you a link to verify your email.'
        : ' We emailed you a link to verify your updated email.
                Your old email was removed from your account.';

    return "Your settings have been updated.$emailSentence";
}

?>
