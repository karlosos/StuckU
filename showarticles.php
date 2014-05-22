<?php

/**
 * Plik wyswietlajacy newsy
 * @package exec
 * @author Karol Dzialowski
 */
//Jezeli wyswietlamy pojedynczego newsa
$article_id = $_GET['id'];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $result = mysql_query("SELECT id, title, content, excerpt, author, date, date_pub FROM articles WHERE id=" . $_GET['id']);
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        if ($row[6] >= date('Y-m-d') ) {
        echo ("
                <div id='news_separate'>
                    <h3 class='news_title'> $row[1] </h2>
                    <p class='news_author'> $row[4] </p>
                    <p class='news_date'> $row[5] </p> 
                    <div class='news_content'> $row[2] </div>
                    <p class='news_footer'><a class='autor' href='panel.php?action=edit_article&id=" . $_GET['id'] . "'>Edytuj</a> 
                    <a class='autor' href='delete_article.php?id=" . $_GET['id'] . "'> Usuń </a>
                    </p>
                </div>
			");
         include '/showcomments.php';
        }
    }
    mysql_free_result($result);

   
    ?>

    <?php

}
//Sciana newsow w kolejnosci od najnowszego
else {
    $result = mysql_query("SELECT MAX(id) as id FROM articles");
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $id = $row["id"];

    for ($i = $id; $i > 0; $i--) {
        $result = mysql_query("SELECT id, title, content, excerpt, author, date, date_pub FROM articles WHERE id=" . $i);

        while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
            $small = $row[2];
            if (strlen($small) > 500) {
                $small = substr($row[2], 0, 500) . "... <br> <a href='index.php?id=" . $row[0] . "'>Czytaj więcej</a> ";
            }
            if ($row[6] >= date('Y-m-d') ) {
            echo("
                <div class='news'>
                    <h3 class='news_title'> <a href='index.php?id=" . $row[0] . "'> $row[1] </a> </h2>
                    <p class='news_author'> $row[4] </p>
                    <p class='news_date'> $row[5] </p> 
                    <div class='news_content'> $small </div>
                    <p class='news_footer'><a href='index.php?id=" . $row[0] . "'>Czytaj więcej</a></p>
                </div>
                ");
            }
        }
        mysql_free_result($result);
    }
}
?>


