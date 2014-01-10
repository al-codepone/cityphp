<?php

namespace cityphp\forms;

abstract class FormValidator {
    private $inputs;
    private $optionalInputs;
    private $submittedInputs;

    public function __construct(
        array $inputs = array(),
        array $optionalInputs = array(),
        array $submittedInputs = null)
    {
        $this->inputs = $this->normalizeInputs($inputs);
        $this->optionalInputs = $optionalInputs;
        $this->submittedInputs = is_null($submittedInputs)
            ? $_POST
            : $submittedInputs;
    }

    public function values() {
        return $this->inputs;
    }

    public function validate() {
        if($this->isReady()) {
            $values = array();
            $errors = array();

            foreach(array_keys($this->inputs) as $key) {
                $value = isset($this->submittedInputs[$key])
                    ? $this->submittedInputs[$key]
                    : $this->inputs[$key];

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

    protected function addInputs(array $inputs) {
        $this->inputs = array_merge($this->inputs, $this->normalizeInputs($inputs));
    }

    protected function addOptionalInputs(array $inputs) {
        $this->optionalInputs = array_merge($this->optionalInputs, $inputs);
    }

    private function isReady() {
        foreach(array_keys($this->inputs) as $key) {
            if(!isset($this->submittedInputs[$key])
                && !in_array($key, $this->optionalInputs))
            {
                return false;
            }
        }

        return true;
    }

    private function normalizeInputs(array $inputs) {
        $normalizedInputs = array();
        
        foreach($inputs as $i => $v) {
            if(is_int($i)) {
                $normalizedInputs[$v] = '';
            }
            else {
                $normalizedInputs[$i] = $v;
            }
        }

        return $normalizedInputs;
    }
}

?>
