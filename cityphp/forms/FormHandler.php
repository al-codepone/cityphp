<?php

abstract class FormHandler {
    private $elementValues;

    public function __construct(array $elementValues = array()) {
        $this->elementValues = $elementValues;
    }

    public function getValue($name) {
        return $this->elementValues[$name];
    }

    public function getValues() {
        return $this->elementValues;
    }

    public function isReady() {
        foreach($this->elementValues as $name => $notUsed) {
            if(!isset($_POST[$name])) {
                return false;
            }
        }

        return true;
    }

    public function validate() {
        $errors = array();

        foreach($this->elementValues as $name => $notUsed) {
            $value = $_POST[$name];
            $methodName = 'validate_' . $name;
            $this->elementValues[$name] = $value;
            $error = method_exists($this, $methodName) ? $this->$methodName($value) : '';

            if($error != '') {
                $errors[$name] = $error;
            }
        }

        return $errors;
    }

    protected function addElement($key, $defaultValue) {
        if(!array_key_exists($key, $this->elementValues)) {
            $this->elementValues[$key] = $defaultValue;
        }
    }
}

?>
