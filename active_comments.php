<?php

/**
 * Plik aktywujacy komentarze
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
 * Aktywujemy komentarz
 */
echo "<div class='news'>";
if (user::user_moderator($user_data['username']) == true) {
    $administrator = new administrator();
    active_comment($_POST);
    header('Location: panel.php?action=comments');
} else {
    echo "Nie masz prawa tu przebywać, won!";
}
echo "</div>";

/*
 * Wyswietlamy dol
 */
$layout->getBottom();
