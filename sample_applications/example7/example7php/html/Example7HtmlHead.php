<?php

require_once(CITY_PHP . 'IView.php');

class Example7HtmlHead implements IView {
    private $title;

    public function __construct($title) {
        $this->title = $title;
    }

    public function draw() {
        ob_start();

?>
<head>
    <title><?php echo $this->title; ?></title>
    <meta name="description" content=""/>
    <link type="text/css" rel="stylesheet" href="<?php echo CSS; ?>styles.css"/>
</head>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }
}

?>
