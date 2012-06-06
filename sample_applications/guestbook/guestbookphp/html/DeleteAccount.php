<?php

require_once(CITY_PHP . 'IView.php');
require_once(GUEST_BOOK_PHP . 'html/SettingsMenu.php');

class DeleteAccount implements IView {
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
<form action="<?=DELETE_ACCOUNT?>" method="post" id="deleteaccount">
    <div><div>Password</div><div><input type="password" name="xpassword"/></div></div>
    <div><input type="button" value="Delete" onClick="deleteAccount();"/></div>
</form>
<?php

        return ob_get_clean();
    }
}

?>
