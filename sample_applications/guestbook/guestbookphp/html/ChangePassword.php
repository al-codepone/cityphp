<?php

require_once(CITY_PHP . 'IView.php');
require_once(GUEST_BOOK_PHP . 'html/SettingsMenu.php');

class ChangePassword implements IView {
    private $error;

    public function __construct($error = '') {
        $this->error = $error;
    }

    public function draw() {
        ob_start();

        $settingsMenu = new SettingsMenu();
        print $settingsMenu->draw();

        if($this->error) {
            printf('<div class="error">%s</div>', $this->error);
        }

?>
<form action="<?=CHANGE_PASSWORD?>" method="post">
    <div><div>Current Password</div><div><input type="password" name="xcurrpass"/></div></div>
    <div><div>New Password</div><div><input type="password" name="xnewpass"/></div></div>
    <div><div>Retype New Password</div><div><input type="password" name="xrepass"/></div></div>
    <div><input type="submit" value="Submit"/></div>
</form>
<?php

        return ob_get_clean();
    }
}

?>
