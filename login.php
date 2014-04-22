<?php

include 'core/init.php';
if (empty($_POST) === false) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) === true || empty($password) === true) {
        $errors[] = 'Musisz wprowadzic login i haslo';
    } else if (userExists($username) === false) {
        $errors[] = 'Nie ma takiego uztkownika';
    } else if (user_active($username) === false) {
        $errors[] = 'Konto nie aktywowane';
    } else {
        $login = user::login($username, $password);
        if ($login === false) {
            $errors[] = 'That username/password combination is incorrect';
        } else {
            $_SESSION['user_id'] = $login;
            header('Location: index.php');
            exit();
        }
    }
} else {
    $erros[] = 'Brak danych';
}
include 'includes/overall/header.php';

if (empty($errors) === false) {
    ?>
    <h2> Próbowaliśmy cię zalogować, ale... </h2>
    <?php
    echo output_errors($errors);
}

include 'includes/overall/footer.php';
?>

