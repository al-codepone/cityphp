<?php

require_once(CITY_PHP . 'IView.php');

class SettingsMenu implements IView {
    public function draw() {
        return sprintf('<div id="settingsmenu"><ul>
            <li><a href="%s">General Settings</a></li>
            <li><a href="%s">Change Password</a></li>
            <li><a href="%s">Delete Account</a></li>
            </ul></div>',
            SETTINGS, CHANGE_PASSWORD, DELETE_ACCOUNT);
    }
}

?>
