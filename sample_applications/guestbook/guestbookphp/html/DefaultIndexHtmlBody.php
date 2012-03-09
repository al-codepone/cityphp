<?php

require_once(GUEST_BOOK_PHP . 'html/IndexHtmlBody.php');

class DefaultIndexHtmlBody extends IndexHtmlBody {
    public function draw() {
        return sprintf('%s<div>%s%s%s</div></body>',
            $this->getBodyTag(),
            $this->getForm(),
            $this->getMessageList(),
            $this->getPagination());
    }

    protected function getForm() {
        ob_start();
        print '<div>';

        if($this->getFormError() != '') {
            printf('<div class="error">%s</div>', $this->getFormError());
        }


?>
<form action="<?php echo ROOT; ?>" method="post">
    Message<br/><textarea name="xmessage" id="xmessage"><?php echo htmlspecialchars($this->getFormMessage()); ?></textarea><br/>
    <input type="submit" value="Post"/>
</form></div>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }

    protected function getMessageList() {
        if(count($this->getMessages()) > 0) {
            $ob = '<div class="messagelist">';

            foreach($this->getMessages() as $message) {
                $ob .= sprintf('<p><a href="%s?id=%s">%s</a>&nbsp;&nbsp;%s</p>',
                    MESSAGE,
                    $message->message_id,
                    date('M j, Y', $message->creation_date),
                    htmlspecialchars($message->message));
            }

            $ob .= '</div>';
            return $ob;
        }
        else {
            return '<div class="emptylist"><p>There\'s nothing here.</p></div>';
        }
    }

    protected function getPagination() {
        $ob = '';

        if($this->getPaginator()->getNumPages() > 1) {
            $ob .= '<div>';

            for($i = 1; $i <= $this->getPaginator()->getNumPages(); ++$i) {
                $isCurrent = ($i == $this->getPaginator()->getCurrentPageNum());

                if($isCurrent) {
                    $ob .= $i;
                }
                else {
                    $queryString = $i > 1 ? '?p=' . $i : '';
                    $ob .= sprintf('<a href="%s%s">%s</a>',
                        ROOT, $queryString, $i);
                }

                $ob .= ' ';
            }

            $ob .= '</div>';
        }

        return $ob;
    }
}

?>
