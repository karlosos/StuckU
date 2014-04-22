<?php
include 'core\init.php';
$layout = new layout();
$layout->getTop();
echo "<div class='news'>";
//Jezeli mamy podane dane
if (empty($_POST) === false) {
    //Tworzy tablice z wymaganymi danymi. Mozna to edytowac w zaleznosci od potrzeb
    $required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
    //Jezeli ktoras dana jest pusta i jest ona wymagana zwroc blad
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Pola z gwiazdą są wymagane.';
            break 1;
        }
    }

    //Zaawansowana walidacja
    if (empty($errors) === true) {
        if (userExists($_POST['username']) === true) {
            $errors[] = 'Przepraszamy, nazwa \'' . $_POST['username'] . '\' jest zajęta.';
        }
        
        ifSpaces($_POST['username']);
        
        longerThan($_POST['password'], 2);
 
        ifPasswdMatch($_POST['password'], $_POST['password_again']);
        
        checkMail($_POST['email']);
        
        if (emailExists($_POST['email']) === true) {
            $errors[] = 'Przepraszamy, email \'' . $_POST['email'] . '\' jest już w użyciu.';
        }
    }
}
?>

<h2 class="widget">Register</h2>

<?php
//Zwraca komunikat o sukcesie
if (isset($_GET['succes']) && empty($_GET['succes'])) {
    echo 'Zostałeś pomyślnie zarejestrowany!';
} else {
    //Zabezpiecza dane i rejestruje uzytkownika
    if (empty($_POST) === false && empty($errors) === true) {
        $register_data = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
        );
        user::registerUser($register_data);
        header('Location: register.php?succes');
        exit();
    } else if (empty($errors) === false) {
        //Wyswietla bledy
        echo output_errors($errors);
    }
    ?>

    <form action="" method="post">
        <li>
            Username*: <br>
            <input type="text" name="username">		
        </li>
        <li>
            Password*: <br>
            <input type="password" name="password">		
        </li>
        <li>
            Password again*: <br>
            <input type="password" name="password_again">		
        </li>
        <li>
            First name*: <br>
            <input type="text" name="first_name">		
        </li>
        <li>
            Last name: <br>
            <input type="text" name="last_name">		
        </li>
        <li>
            E-mail*: <br>
            <input type="text" name="email">		
        </li>
        <li>
            <input type="submit" value="Register">
        </li>
    </form>
    <?php
}
echo "</div>";
$layout->getBottom();
?>