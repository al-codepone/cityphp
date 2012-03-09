<?php

require_once(CITY_PHP . 'IView.php');

class GalleryView implements IView {
    private $imageUris;

    public function __construct(array $imageUris) {
        $this->imageUris = $imageUris;
    }

    public function draw() {
        $ob = '<div class="gallery">';

        foreach($this->imageUris as $imageUri) {
            $ob .= sprintf('<img src="%s"/>', $imageUri);
        }

        $ob .= '</div>';
        return $ob;
    }
}

?>
