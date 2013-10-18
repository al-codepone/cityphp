<?php

namespace cityphp\forms;

abstract class FormValidator {
    private $values;
    private $optionalKeys;

    public function __construct(array $values = array(),
                                array $optionalKeys = array()) {
        $this->values = $values;
        $this->optionalKeys = $optionalKeys;
    }

    public function values() {
        return $this->values;
    }

    public function validate() {
        if($this->isReady()) {
            $values = array();
            $errors = array();

            foreach(array_keys($this->values) as $key) {
                $value = isset($_POST[$key]) ? $_POST[$key] : $this->values[$key];
                $methodName = 'validate_' . $key;
                $values[$key] = $value;
                $error = method_exists($this, $methodName)
                    ? $this->$methodName($value)
                    : null;

                if(!is_null($error)) {
                    $errors[$key] = $error;
                }
            }

            if(method_exists($this, 'validateOther')) {
                $otherErrors = $this->validateOther($values);

                if(!is_null($otherErrors)) {
                    $errors = array_merge($errors,
                        is_array($otherErrors) ? $otherErrors : array($otherErrors));
                }
            }

            return array($values, $errors);
        }
    }

    protected function addValues(array $values) {
        $this->values = array_merge($this->values, $values);
    }

    protected function addOptionalKeys(array $keys) {
        $this->optionalKeys = array_merge($this->optionalKeys, $keys);
    }

    private function isReady() {
        foreach(array_keys($this->values) as $key) {
            if(!isset($_POST[$key]) && !in_array($key, $this->optionalKeys)) {
                return false;
            }
        }

        return true;
    }
}

?>
