<?php

require_once CITYPHP . 'html/blist.php';

$title = 'Word List';
$content = blist(
    array_map(
        function($word) {
            return htmlspecialchars($word['word']);
        },
        $wordModel->get()));

?>
