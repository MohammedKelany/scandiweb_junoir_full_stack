<?php

namespace Src;


abstract class Model
{
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_UNIQUE = "unique";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_MATCH = "match";
    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->$attribute = $value;
            }
        }
    }

    public function prepere($sql)
    {
        return app()->db->pdo->prepare($sql);
    }

    private function addErrorFromRule($attribute, $rule, $params = [])
    {
        $massege = $this->getErrorMasseges()[$rule] ?? "";
        foreach ($params as $key => $param) {
            $massege = str_replace("{{$key}}", $param, $massege);
        }
        $this->errors[$attribute][] = $massege;
    }
    public function addError($attribute, $message)
    {
        $this->errors[$attribute][] = $message;
    }
    public function getErrorMasseges()
    {
        return [
            self::RULE_REQUIRED => "This Field is Required Field",
            self::RULE_EMAIL => "This Field should be valid email",
            self::RULE_UNIQUE => "That record with this {field} already exists",
            self::RULE_MIN => "This Field should be at least {min} chars",
            self::RULE_MAX => "This Field should be at most {max} chars",
            self::RULE_MATCH => "This Field should be as same as {match}",
        ];
    }

    public function hasErrors($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }
    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}
