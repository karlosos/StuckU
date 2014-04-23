
<?php
include 'core\init.php';
$layout = new layout();
$layout->getTop();

// Czy moge usunac artykul.
// Tylko autorzy i moderatorzy moga usuwac
if (isset($_GET['id']) === true && empty($_POST) === true) {
    $article_id = $_GET['id'];
     if (user::user_moderator($user_data['username']) !== true) {
            $errors[] = 'Nie masz na to pozwolenia.';
        }
}
?>
<div class="news">
    
<h2 class="news_title">Delete article</h2>

<?php
if (isset($_GET['succes']) && empty($_GET['succes'])) {
    echo 'Usunąłeś komentarz';
} else {
    if (empty($_GET['id']) === false && isset($_GET['id']) === true && empty($errors) === true) {
        $comment_id = $_GET['id'];
        administrator::delete_comment_adm($comment_id);
        header('Location: delete_comment.php?succes');
        exit();
    } else if (empty($errors) === false) {
        echo output_errors($errors);
    }
}
echo "</div>";
$layout->getBottom();
?>
