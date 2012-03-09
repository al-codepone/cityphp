<?php

require_once(GUEST_BOOK_PHP . 'html/MessageHtmlBody.php');

class DefaultMessageHtmlBody extends MessageHtmlBody {
    public function draw() {
        $ob = '<body>';

        if($this->getMessageData()->message_id != -1) {
            $ob .= sprintf('<p class="valid"><span>%s</span>&nbsp;&nbsp;%s</p>',
                date('M j, Y', $this->getMessageData()->creation_date),
                htmlspecialchars($this->getMessageData()->message));
        }
        else {
            $ob .= '<p class="invalid">Invalid message</p>';
        }

        $ob .= '</body>';
        return $ob;
    }
}

?>
