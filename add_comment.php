<?php

/**
 * Plik dodajacy komentarz
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

// Jeżeli są ustawione dane komentarza dodaj go
if (isset($_GET['content']) && isset($_GET['article_id'])) {
    $comment_data = array(
        'article_id' => $_GET['article_id'],
        'author' => $user_data['username'],
        'content' => $_GET['content'],
    );

    add_comment($comment_data);
    header('Location: index.php?id=' . $article_id);
} else {
    echo "<div id='news'> Coś poszło nie tak... </div>";
}

/*
 * Wyswietlamy dol strony
 */
$layout->getBottom();
?>