<?php

require_once(CITY_PHP . 'html/HtmlBody.php');
require_once(CITY_PHP . 'pagination/Paginator.php');

abstract class IndexHtmlBody extends HtmlBody {
    private $paginator;
    private $messages;
    private $formError;
    private $formMessage;

    public function __construct($bodyTag, Paginator $paginator, $messages, $formError = '', $formMessage = '') {
        parent::__construct($bodyTag);
        $this->paginator = $paginator;
        $this->messages = $messages;
        $this->formError = $formError;
        $this->formMessage = $formMessage;
    }

    protected function getPaginator() {
        return $this->paginator;
    }

    protected function getMessages() {
        return $this->messages;
    }

    protected function getFormError() {
        return $this->formError;
    }

    protected function getFormMessage() {
        return $this->formMessage;
    }
}

?>
