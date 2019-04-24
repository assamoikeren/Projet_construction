<?php 

    function Verification($var)
    {
        $var = trim($var);
        $var = htmlspecialchars($var);
        $var = stripslashes($var);
        return $var;
    }

    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    

?>