<?php

require_once(CITY_PHP . 'IView.php');

class MessageList implements IView {
    private $messages;

    public function __construct(array $messages) {
        $this->messages = $messages;
    }

    public function draw() {
        if(count($this->messages) > 0) {
            $ob = '<div>';

            foreach($this->messages as $message) {
                $ob .= sprintf('<p><a href="%s?id=%s">%s</a>&nbsp;&nbsp;%s</p>',
                    MESSAGE, $message->message_id,
                    date('M j, Y', strtotime($message->creation_date)),
                    htmlspecialchars($message->message));
            }

            $ob .= '</div>';
            return $ob;
        }
        else {
            return '<div><p>There\'s nothing here.</p></div>';
        }
    }
}

?>
