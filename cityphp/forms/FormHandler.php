<?php

abstract class FormHandler {
    private $elementValues;

    public function __construct(array $elementValues = array()) {
        $this->elementValues = $elementValues;
    }

    public function getValue($key) {
        return $this->elementValues[$key];
    }

    public function getValues() {
        return $this->elementValues;
    }

    public function isReady() {
        foreach(array_keys($this->elementValues) as $key) {
            if(!isset($_POST[$key])) {
                return false;
            }
        }

        return true;
    }

    public function validate() {
        $errors = array();

        foreach(array_keys($this->elementValues) as $key) {
            $value = $_POST[$key];
            $methodName = 'validate_' . $key;
            $this->elementValues[$key] = $value;
            $error = method_exists($this, $methodName)
                ? $this->$methodName($value)
                : null;

            if(!is_null($error)) {
                $errors[$key] = $error;
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
