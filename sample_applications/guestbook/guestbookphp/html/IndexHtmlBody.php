<?php

require_once(CITY_PHP . 'IView.php');

class IndexHtmlBody implements IView {
    private $isAutofocus;
    private $numPages;
    private $currentPageNum;
    private $messages;
    private $formError;
    private $formMessage;

    public function __construct($isAutofocus, $numPages, $currentPageNum,
                                array $messages, $formError, $formMessage) {
        $this->isAutofocus = $isAutofocus;
        $this->numPages = $numPages;
        $this->currentPageNum = $currentPageNum;
        $this->messages = $messages;
        $this->formError = $formError;
        $this->formMessage = $formMessage;
    }

    public function draw() {
        return sprintf('<body><div>%s%s%s</div>%s</body>',
            $this->getForm(),
            $this->getMessageList(),
            $this->getPagination(),
            $this->getAutofocusScript());
    }

    private function getForm() {
        ob_start();
        print '<div>';

        if($this->formError != '') {
            printf('<div class="error">%s</div>', $this->formError);
        }

?>
<form action="<?=ROOT?>" method="post">
    Message<br/><textarea name="xmessage" id="xmessage"><?=htmlspecialchars($this->formMessage)?></textarea><br/>
    <input type="submit" value="Post"/>
</form></div>
<?php

        $ob = ob_get_contents();
        ob_end_clean();
        return $ob;
    }

    private function getMessageList() {
        if(count($this->messages) > 0) {
            $ob = '<div class="messagelist">';

            foreach($this->messages as $message) {
                $ob .= sprintf('<p><a href="%s?id=%s">%s</a>&nbsp;&nbsp;%s</p>',
                    MESSAGE, $message->message_id,
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

    private function getPagination() {
        $ob = '';

        if($this->numPages > 1) {
            $ob .= '<div>';

            for($i = 1; $i <= $this->numPages; ++$i) {
                $isCurrent = ($i == $this->currentPageNum);

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

    private function getAutofocusScript() {
        return $this->isAutofocus
            ? "<script>document.getElementById('xmessage').focus();</script>"
            : '';
    }
}

?>
