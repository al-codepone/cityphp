<?php

namespace cityphp\forms;

abstract class FormValidator {
    private $values;
    private $optionalKeys;
    private $submittedValues;

    public function __construct(
        array $values = array(),
        array $optionalKeys = array(),
        array $submittedValues = null)
    {
        $this->values = $values;
        $this->optionalKeys = $optionalKeys;
        $this->submittedValues = is_null($submittedValues)
            ? $_POST
            : $submittedValues;
    }

    public function values() {
        return $this->values;
    }

    public function validate() {
        if($this->isReady()) {
            $values = array();
            $errors = array();

            foreach(array_keys($this->values) as $key) {
                $value = isset($this->submittedValues[$key])
                    ? $this->submittedValues[$key]
                    : $this->values[$key];

                $methodName = "validate_$key";
                $values[$key] = $value;
                $error = method_exists($this, $methodName)
                    ? $this->$methodName($value)
                    : null;

                if(!is_null($error)) {
                    $errors[$key] = $error;
                }
            }

            if(method_exists($this, 'validateMore')) {
                $moreErrors = $this->validateMore($values);

                if(!is_null($moreErrors)) {
                    $errors = array_merge($errors,
                        is_array($moreErrors) ? $moreErrors : array($moreErrors));
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
            if(!isset($this->submittedValues[$key]) && !in_array($key, $this->optionalKeys)) {
                return false;
            }
        }

        return true;
    }
}

?>
