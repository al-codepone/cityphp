<?php

require_once(CITY_PHP . 'IView.php');

class MessageList implements IView {
    private $messages;

    public function __construct(array $messages) {
        $this->messages = $messages;
    }

    public function draw() {
        if($this->messages) {
            $ob = '<div>';

            foreach($this->messages as $message) {
                $ob .= sprintf('<div class="message">
                    <div><a href="%s%s">%s</a> on %s | <a href="%s%s">link</a></div>
                    <div>%s</div></div>',
                    USER, $message['username'], $message['username'],
                    date('M j, Y', strtotime($message['creation_date'])),
                    MESSAGE, $message['message_id'],
                    htmlspecialchars($message['message']));
            }

            $ob .= '</div>';
            return $ob;
        }
        else {
            return "<div>There's nothing here.</div>";
        }
    }
}

?>
