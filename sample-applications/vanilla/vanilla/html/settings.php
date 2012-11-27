<?php

require_once(CITYPHP . 'html/error.php');
require_once(CITYPHP . 'html/input.php');

function settings($formData, $error = '') {
    ob_start(); ?>

<form method="post" id="settings_form">
    <input type="hidden" name="delete_flag" value="0"/>
    <div>
        Use this form to edit your account info.
        Email and new password are optional.
        You can delete your account email by submitting a blank email.
        If you change your email, then your account email will be blank
        until you verify the new email.
    </div>
    <?=error($error)?>
    <?=input('Username', 'username', $formData['username'])?>
    <?=input('Email', 'email', $formData['email'], 'email')?>
    <?=input('New Password', 'password', $formData['password'], 'password')?>
    <?=input('Confirm New Password', 'confirm_password', $formData['confirm_password'], 'password')?>
    <?=input('Current Password', 'current_password', $formData['current_password'], 'password')?>
    <div>
        <input type="submit" value="Submit"
        /><input type="button" value="Delete Account" onClick="deleteAccount();"/>
    </div>
</form>

    <?php return ob_get_clean();
}

?>
