<?php

require_once CITYPHP . 'html/blist.php';
require_once CITYPHP . 'html/input.php';

function forgotPassword(array $formData, $errors = array()) {
    ob_start(); ?>

<form method="post">
    <div>Submit your account email and we'll send you directions for resetting your password.</div>
    <?=blist($errors, array('class' => 'error'))?>

    <?=input(array(
        'id' => 'email',
        'value' => $formData['email'],
        'type' => 'email'),
        'Email')?>

    <div><input type="submit" value="Submit"/></div>
</form>

    <?php return ob_get_clean();
}

?>
