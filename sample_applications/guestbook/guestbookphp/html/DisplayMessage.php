<?php

require_once(CITY_PHP . 'IView.php');
require_once(GUEST_BOOK_PHP . 'html/SettingsMenu.php');

class DisplayMessage implements IView {
    private $message;
    private $isSettings;

    public function __construct($message, $isSettings = false) {
        $this->message = $message;
        $this->isSettings = $isSettings;
    }

    public function draw() {
        $ob = '';

        if($this->isSettings) {
            $settingsMenu = new SettingsMenu();
            $ob .= $settingsMenu->draw();
        }

        $ob .= sprintf('<div>%s</div>', $this->message);
        return $ob;
    }
}

?>
