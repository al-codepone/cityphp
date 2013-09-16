<?php

require_once(CITYPHP . 'html/error.php');
require_once(CITYPHP . 'html/input.php');

function resetPassword($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <div>Use this form to reset your password.</div>
    <?=error($error)?>
    <?=input('New Password', 'password', $formData['password'], 'password')?>
    <?=input('Confirm New Password', 'confirm_password', $formData['confirm_password'], 'password')?>
    <div><input type="submit" value="Reset"/></div>
</form>

    <? return ob_get_clean();
}

?>
