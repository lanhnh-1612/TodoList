<?php

class Request
{
    private $__rule = [];
    private $__messages = [];
    public $errors = [];

    public function getMethod()
    {
        return  strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost()
    {
        if ($this->getMethod() == 'post') {
            return true;
        }

        return false;
    }

    public function isGet()
    {
        if ($this->getMethod() == 'get') {
            return true;
        }

        return false;
    }

    public function getFields()
    {
        $dataFields = [];
        if ($this->isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if (is_array($value)) {
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if ($this->isPost()) {

            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        return $dataFields;
    }

    public function rules($rules = [])
    {
        $this->__rule = $rules;
    }

    public function message($message)
    {
        $this->__messages = $message;
    }

    public function validate()
    {
        $this->__rule = array_filter($this->__rule);

        $checkValidate = true;

        if (!empty($this->__rule)) {
            $dataFields = $this->getFields();

            foreach ($this->__rule as $fieldName => $ruleItem) {
                $ruleItemArr = explode('|', $ruleItem);

                foreach ($ruleItemArr as $rules) {
                    $ruleName = null;
                    $ruleValue = null;

                    $rulesArr = explode(':', $rules);
                    $ruleName = reset($rulesArr);

                    if (count($rulesArr) > 1) {
                        $ruleValue = end($rulesArr);
                    }

                    if ($ruleName == 'required') {
                        if (empty(trim($dataFields[$fieldName]))) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'min') {
                        if (strlen(trim($dataFields[$fieldName])) < $ruleValue) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'max') {
                        if (strlen(trim($dataFields[$fieldName])) > $ruleValue) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'in') {
                        if (!in_array(trim($dataFields[$fieldName]), explode(',', $ruleValue))) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'date_format') {
                        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dataFields[$fieldName])) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }
                }
            }
        }

        return $checkValidate;
    }

    public function errors($fieldName = '')
    {
        if (!empty($this->errors)) {
            if (empty($fieldName)) {
                $errorArr = [];
                foreach ($this->errors as $key => $error) {
                    $errorArr[$key] = reset($error);
                }

                return $errorArr;
            }

            return reset($this->errors[$fieldName]);
        }

        return false;
    }

    public function setErrors($fieldName, $ruleName)
    {
        $this->errors[$fieldName][$ruleName] = $this->__messages[$fieldName . '.' . $ruleName];
    }
}
