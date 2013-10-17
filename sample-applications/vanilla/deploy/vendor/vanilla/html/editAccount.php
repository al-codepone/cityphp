<?php

require_once CITYPHP . 'html/input.php';
require_once CITYPHP . 'html/ulist.php';

function editAccount($formData, $errors = array()) {
    ob_start(); ?>

<form method="post" id="edit_account_form">
    <input type="hidden" name="delete_flag" value="0"/>
    <div>
        Use this form to edit your account info.
        Email and new password are optional.
        You can delete your account email by submitting a blank email.
        If you change your email, then your account email will be blank
        until you verify the new email.
    </div>
    <?=ulist($errors, array('class' => 'error'))?>
    <?=input(array('id' => 'username', 'value' => $formData['username']), 'Username')?>
    <?=input(array('id' => 'email', 'value' => $formData['email'], 'type' => 'email'), 'Email')?>
    <?=input(array('id' => 'password', 'value' => $formData['password'], 'type' => 'password'), 'New Password')?>
    <?=input(array('id' => 'confirm_password', 'value' => $formData['confirm_password'], 'type' => 'password'), 'Confirm New Password')?>
    <?=input(array('id' => 'current_password', 'value' => $formData['current_password'], 'type' => 'password'), 'Current Password')?>
    <div>
        <input type="submit" value="Submit"
        /><input type="button" value="Delete Account" onClick="deleteAccount();"/>
    </div>
</form>

    <?php return ob_get_clean();
}

?>
