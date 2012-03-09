<?php

require_once(CITY_PHP . 'html/HtmlBody.php');

class FormHtmlBody extends HtmlBody {
    public function draw() {
        ob_start();
        echo $this->getBodyTag();

?>
<form action="<?php echo ROOT; ?>" method="post">
    <div><input type="text" id="xinput"/></div>
    <div><input type="submit" value="Submit"/></div>
</form></body>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }
}

?>
