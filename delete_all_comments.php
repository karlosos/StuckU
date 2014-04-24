<?php

/**
 * Plik do usuwanie wszystkich nieaktywnych komentarzy
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
 * Usuwamy komentarze
 */
echo "<div class='news'>";
if (user::user_moderator($user_data['username']) == true) {
    $administrator = new administrator();
    delete_all_comments();
    header('Location: panel.php?action=comments');
} else {
    echo "Nie masz prawa tu przebywać, won!";
}
echo "</div>";

/*
 * Wyswietlamy dol
 */
$layout->getBottom();
