<?php

require_once(CITY_PHP . 'IView.php');

class SignUp implements IView {
    private $username;
    private $error;

    public function __construct($username = '', $error = '') {
        $this->username = htmlspecialchars($username);
        $this->error = $error;
    }

    public function draw() {
        ob_start();

        if($this->error) {
            printf('<div class="error">%s</div>', $this->error);
        }

?>
<form action="<?=SIGN_UP?>" method="post">
    <div><div>Username</div><div><input type="text" name="xusername" value="<?=$this->username?>"/></div></div>
    <div><div>Password</div><div><input type="password" name="xpassword"/></div></div>
    <div><input type="submit" value="Sign Up"/></div>
</form>
<?php

        return ob_get_clean();
    }
}

?>
