<?php
/**
 * Plik do usuwania artykulow
 * @package exec
 * @author Karol Dzialowski
 */

/*
 * Includujemy inicjalizacyjny pli
 */
include 'core\init.php';

/*
 * Wyswietlamy gore
 */
$layout = new layout();
$layout->getTopAdm();

/*
 * Usuwanie artykulu
 */
// Czy moge usunac artykul.
// Tylko autorzy i moderatorzy moga usuwac
if (isset($_GET['id']) === true && empty($_POST) === true) {
    $article_id = $_GET['id'];
    if (author_from_id($article_id) !== $user_data['username']) {
        if (user::user_moderator($user_data['username']) !== true) {
            $errors[] = 'Nie masz na to pozwolenia.';
        }
    }
}
?>
<div class="news">

    <h2 class="news_title">Delete article</h2>

    <?php
    if (isset($_GET['succes']) && empty($_GET['succes'])) {
        echo 'Usunąłeś artykuł!';
    } else {
        if (empty($_GET['id']) === false && isset($_GET['id']) === true && empty($errors) === true) {
            $article_id = $_GET['id'];
            delete_article($article_id);
            header('Location: delete_article.php?succes');
            exit();
        } else if (empty($errors) === false) {
            echo output_errors($errors);
        }
    }
    echo "</div>";

    /*
     * Wyswietlanie dolu
     */
    $layout->getBottom();
    ?>
