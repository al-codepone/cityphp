<?php

require_once(CITY_PHP . 'IView.php');
require_once(GUEST_BOOK_PHP . 'database/MessageData.php');

class MessageHtmlBody implements IView {
    private $messageData;

    public function __construct(MessageData $messageData) {
        $this->messageData = $messageData;
    }

    public function draw() {
        $ob = '<body>';

        if($this->messageData->message_id != -1) {
            $ob .= sprintf('<p class="valid"><span>%s</span>&nbsp;&nbsp;%s</p>',
				date('M j, Y', strtotime($this->messageData->creation_date)),
                htmlspecialchars($this->messageData->message));
        }
        else {
            $ob .= '<p class="invalid">Invalid message</p>';
        }

        $ob .= '</body>';
        return $ob;
    }
}

?>
