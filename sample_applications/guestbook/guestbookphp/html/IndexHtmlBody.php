<?php

require_once(CITY_PHP . 'IView.php');

abstract class IndexHtmlBody implements IView {
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

    protected function getIsAutofocus() {
        return $this->isAutofocus;
    }

    protected function getNumPages() {
        return $this->numPages;
    }

    protected function getCurrentPageNum() {
        return $this->currentPageNum;
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
