<?php

require_once(VANILLA . 'html/error.php');
require_once(VANILLA . 'html/input.php');

function settings($formData, $error = '') {
    ob_start(); 
    print(error($error)); ?>

<form action="<?=SETTINGS?>" method="post" id="settings_form">
    <input type="hidden" name="delete_flag" value="0"/>
    <?=input('Username', 'username', $formData['username'])?>
    <?=input('New Password', 'new_password', $formData['new_password'], 'password')?>
    <?=input('Confirm New Password', 'confirm_password', $formData['confirm_password'], 'password')?>
    <?=input('Current Password', 'current_password', $formData['current_password'], 'password')?>
    <div><input type="submit" value="Submit"/></div>
    <div><input type="button" value="Delete Account" onClick="deleteAccount();"/></div>
</form>

    <?php return ob_get_clean();
}

?>
