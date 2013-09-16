<?php

require_once(CITYPHP . 'html/error.php');
require_once(CITYPHP . 'html/input.php');

function forgotPassword($formData, $error = '') {
    ob_start(); ?>

<form method="post">
    <div>Submit your account email and we'll send you directions for resetting your password.</div>
    <?=error($error)?>
    <?=input('Email', 'email', $formData['email'], 'email')?>
    <div><input type="submit" value="Submit"/></div>
</form>

    <?php return ob_get_clean();
}

?>
