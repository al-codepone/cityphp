<?php

require_once(CITY_PHP . 'IView.php');

class Settings implements IView {
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
<form action="<?=SETTINGS?>" method="post">
    <div><div>Username</div><div><input type="text" name="xusername" value="<?=$this->username?>"/></div></div>
    <div><input type="submit" value="Submit"/></div>
</form>
<?php

        return ob_get_clean();
    }
}

?>
