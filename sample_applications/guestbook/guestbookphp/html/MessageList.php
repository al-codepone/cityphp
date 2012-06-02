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
                $ob .= sprintf('<div class="message"><a href="%s%s">%s</a> %s</div>',
                    MESSAGE, $message['message_id'],
                    date('M j, Y', strtotime($message['creation_date'])),
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
