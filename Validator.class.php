<?php

class Validator {

    public $errors;
    public $errorMessages;

    public function __construct() {
        $this->errors = [];
        $this->errorMessages = [
            'min' => 'Text is too short',
            'max' => 'Text is too long'
        ];
    }

    public function validate($value, array $settings) {

        $isValid = FALSE;

        // Goes trough all of the settings
        foreach ($settings as $setting => $setting_value) {


                // Get's the setting
                switch ($setting) {
                    case 'min':
                        try {
                            $this->min($value, $setting_value);
                        }
                        catch(Exception $e) {
                            array_push($this->errors, $e->getMessage());
                        }
                    break;

                    case 'max':
                        try {
                            $this->max($value, $setting_value);
                        }
                        catch(Exception $e) {
                            array_push($this->errors, $e->getMessage());
                        }
                    break;

                    default:
                        echo "unkown setting";
                }
        }

        if(count($this->errors) == 0) { $isValid = TRUE; }

        return $isValid;
    }


    public function min($value, int $limit) {
        $boolean = FALSE;

        if(strlen($value) <= $limit) {
            $boolean = TRUE;
            throw new Exception($this->errorMessages[__FUNCTION__]);
        }

        return $boolean;
    }

    public function max($value, int $limit) {
        $boolean = FALSE;

        if(strlen($value) >= $limit) {
            $boolean = TRUE;
            throw new Exception($this->errorMessages[__FUNCTION__]);
        }

        return $boolean;
    }

}

?>
