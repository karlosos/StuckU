<?php

/**
 * Panel komentarzy
 * 
 * @package comments
 * @author Karol Dzialowski
 * @copyright (c) 2014, Karol Działowski https://github.com/karlosos/SharU
 */

include 'core/init.php';
include 'includes/overall/header.php';

// Jeżeli użytkownik jest moderatorem wyświetl komentarze do zatwierdzenia lub
// zatwierdzaj komentarze
if (user_moderator($user_data['username']) !== true) {
    $errors[] = 'You do not have permissions.';
    echo output_errors($errors);
} else {

    // Jeżeli są ustawione w tablicy POST komentarze do zatwierdzenia to je
    // zatwierdzaj.
    if (isset($_POST)) {
        active_comment($_POST);
    }

    // Zapytanie zwracające wszystkie niezatwierdzone komentarze
    $result = mysql_query("SELECT MAX(id) as id FROM comments WHERE active = '0'");
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $id = $row["id"];

    // Wyświetlaj formularz z komentarzami do zatwiedzenia.
    if ($id != 0) {
        echo "<form name='comment_update' action='' method='post'>";

        for ($i = $id; $i > 0; $i--) {
            $result = mysql_query("SELECT author, content, date, id, article_id FROM comments WHERE id=" . $i . " AND active = '0'");


            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $article_title = title_from_id($row[4]);
                echo("
                        <div class='comment'>
                            <li> Artykuł: $article_title </li>
                            <li> Autor: $row[0] </li>
                            <li> Data: $row[2] </li>
                            <li> $row[1] </li>
                            <li> <input type='radio' name='" . $row[3] . "' value='" . $row[3] . "'>Zatwierdź </li>
                        ");
                echo "<hr width='30%'>";
            }
            mysql_free_result($result);
        }

        echo "<input type='submit' value='Submit'/>";
    } else {
        echo "Nie ma żadnych komentarzy do zatwierdzenia";
    }
}
include 'includes/overall/footer.php';
?>