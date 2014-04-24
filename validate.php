<?php
/**
 * Plik z funkcjami walidacyjnymi
 * @package functions
 * @author Karol Dzialowski
 */

/**
 * Sql-injection array
 * @param array $item
 */
function array_sanitize(&$item) {
    $item = mysql_real_escape_string($item);
}

/**
 * Sql-injection
 * @param type $data
 * @return type
 */
function sanitize($data) {
    return mysql_real_escape_string($data);
}

/**
 * Funkcja sprawdza czy sa spacje
 * 
 * @param string $data
 * @return boolean
 */
function ifSpaces($data) {
    if (preg_match("/\\s/", $data) == true) 
            return false;
    else  {
        return true;
        $errors[] = 'Twój login nie może zawierać spacji.';
    }            
}

/**
 * Funkcja sprawdza dlugosc znakow
 * @param string $data
 * @param int $number
 * @return boolean
 */
function longerThan($data, $number) {
    if(strlen($data) <= $number) {
        return false;
    } 
    else {
        return true;
        $errors[] = 'Hasło musi być dłuższe niż '.$number.' znaki';
    }
}

/**
 * Funkcja sprawdza czy stringi sa takie same
 * 
 * @param string $passwd
 * @param string $passwd2
 * @return boolean
 */
function ifPasswdMatch($passwd, $passwd2) {
    if($passwd === $passwd2) 
        return false;
    else {
        return true;
        $errors[] = 'Podane hasła nie pasują do siebie.';
    }
}

/**
 * Funkcja sprawdza email
 * 
 * @param string $email
 * @return boolean
 */
function checkMail($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
        return false;
    else {
        return true;
        $errors[] = 'Nieprawidłowy email.'; 
    }
}

/**
 * Czy nazwa zajeta
 * 
 * @param string $username
 * @return bool
 */
function userExists($username) {
    $username = sanitize($username);
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'");
    return (mysql_result($query, 0) == 1) ? true : false;
}

/**
 * Czy email zajety
 * 
 * @param string $email
 * @return bool
 */
function emailExists($email) {
    $email = sanitize($email);
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'");
    return (mysql_result($query, 0) == 1) ? true : false;
}