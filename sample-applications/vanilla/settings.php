<?php

require_once(VANILLA . 'forms/SettingsValidator.php');
require_once(VANILLA . 'html/accountUpdated.php');
require_once(VANILLA . 'html/settings.php');

$validator = new SettingsValidator();

if(!$user) {
    $content = 'Log in to access the settings page.';
}
else if(list($formData, $errors) = $validator->validate()) {
    if($errors) {
        $content = settings($formData, current($errors));
    }
    else if($formData['delete_flag']) {
        $content = ($error = $userModel->deleteUser($user['user_id'], $formData))
            ? settings($formData, $error)
            : 'Your account was successfully deleted.';

        $user = $error ? $user : null;
    }
    else {
        $content = is_array($result = $userModel->updateUser($user['user_id'], $formData))
            ? accountUpdated($result, $formData)
            : settings($formData, $result);

        $user['username'] = is_array($result) ? $formData['username'] : $user['username'];
    }
}
else {
    $userData = $userModel->getUserWithUID($user['user_id']);
    $formData = $validator->values();
    $formData['username'] = $userData['username'];
    $formData['email'] = $userData['email'];
    $content = settings($formData);
}

$head = '<script src="' . JS . 'settings.js"></script>';

?>
