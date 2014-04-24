<?php
/**
 * Plik dodajacy artykul
 * 
 * @package exec
 * @author Karol Dzialowski
 */
/*
 * Includujemy plik inicjalizacyjny
 */
include 'core\init.php';

/*
 * Tworzymy layout
 */
$layout = new layout();
$layout->getTopAdm();
?>

<h2 class="widget">Add article</h2>

<?php
//Jezeli jestem zalogowany.
if (isset($_SESSION['user_id']) && user::user_moderator($user_data['username']) == true) {
    //Jezeli zwrocono sukces wyswietl komunikat
    if (isset($_GET['succes']) && empty($_GET['succes'])) {
        echo 'Dodałeś artykuł';
    } else {
        //Jezeli mamy dane i nie bylo bledow dodaj artykul z danymi zabezpieczonymi
        if (empty($_POST) === false && empty($errors) === true) {
            $article_data = array(
                'title' => $_POST['title'],
                //'excerpt' 		=> $_POST['excerpt'],
                'content' => $_POST['content'],
                'author' => $user_data['username'],
            );

            add_article($article_data);
            header('Location: add_article.php?succes');
            exit();
        } else if (empty($errors) === false) {
            echo output_errors($errors);
        }
    }
} else {
    echo('Nie masz praw');
}

/*
 * Wyswietlamy dol strony
 */
$layout->getBottom();
?>
