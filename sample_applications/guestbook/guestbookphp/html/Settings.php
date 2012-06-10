<?php

require_once(CITY_PHP . 'IView.php');

class Settings implements IView {
    private $username;
    private $error;

    public function __construct($username, $error = '') {
        $this->username = htmlspecialchars($username);
        $this->error = $error;
    }

    public function draw() {
        ob_start();

        if($this->error) {
            printf('<div class="error">%s</div>', $this->error);
        }

?>
<form action="<?=SETTINGS?>" method="post" id="deleteaccount">
    <input type="hidden" name="xdeleteflag" value="0"/>
    <div><div>Username</div><div><input type="text" name="xusername" value="<?=$this->username?>"/></div></div>
    <div><div>New Password</div><div><input type="password" name="xnewpassword"/></div></div>
    <div><div>Confirm New Password</div><div><input type="password" name="xconfirmpassword"/></div></div>
    <div><div>Current Password</div><div><input type="password" name="xcurrentpassword"/></div></div>
    <div><input type="submit" value="Submit"/></div>
    <div><input type="button" value="Delete Account" onClick="deleteAccount();"/></div>
</form>
<?php

        return ob_get_clean();
    }
}

?>
