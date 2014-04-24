<?php
include 'core\init.php';
$layout = new layout();
$layout->getTopAdm();

if (user::user_moderator($user_data['username']) == true) {
    $administrator = new administrator();

echo "<div class='news'>";

if ($_GET['succes']) {
    echo "<h3 class='news_title'>Pomyślne wykonanie akcji</h3>";
}

else if ($_GET['action'] == "add_article" || empty($_GET['action'])) {
    ?>
    <h3 class="news_title">Dodaj artykuł</h3>
    <script src="ckeditor/ckeditor.js"></script>
    <form method="post" action="add_article.php" name="add_article">
        <li>
            Tytuł<br>
            <input type="text" name="title" style="width: 99%;"/>
        </li>
        <li>
            Treść<br>
            <textarea class="ckeditor" cols="80" name="content" rows="10"> </textarea>
        </li>
        <li>
            <input type="submit" value="Send"/>  
        </li>
    </form>
    <?php
} else if ($_GET['action'] == "edit_article" && isset($_GET['id'])) {
    if (isset($_GET['succes']) && empty($_GET['succes'])) {
        echo 'You\'ve editted article!';
    } else if (empty($_POST) === false && empty($errors) === true) {
        $article_data = array(
            'title' => $_POST['title'],
            'content' => $_POST['content'],
        );
        update_article($_POST['article_id'], $article_data);
        header('Location: panel.php?action=edit_article&succes');
        exit();
    } else if (empty($errors) === false) {
        echo output_errors($errors);
    } else {
        ?>

        <script src="ckeditor/ckeditor.js"></script>

        <form method="post" action="" name="edit_article">
            <li>
                Title<br>
                <input type="text" name="title" style="width: 99%;" value="<?php echo title_from_id($_GET['id']); ?>"/>
            </li>
            <li>
                Content<br>
                <textarea class="ckeditor" cols="80" name="content" rows="10"> <?php echo content_from_id($_GET['id']) ?> </textarea>
            </li>
            <li>
                <input type="hidden" name="article_id" value="<?php echo $_GET['id']; ?>">
    </li>
    <li>
        <input type="submit" value="Send"/>  
    </li>
</form>
<?php
}
} else if ($_GET['action'] == "comments") {
     if (isset($_POST)) {
        active_comment($_POST);
    }
    ?>
        <script type="text/javascript">
            function AlertIt() {
                var answer = confirm ("Czy napewno chcesz usunąć wszystkie nieaktywowane komentarze?")
                if (answer)
                window.location="delete_all_comments.php";
            }
        </script>
    <?php
    echo "<h3 class='news_title'>Komentarze do zatwierdzenia</h3>";
    // Zapytanie zwracające wszystkie niezatwierdzone komentarze
    $result = mysql_query("SELECT MAX(id) as id FROM comments WHERE active = '0'");
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $id = $row["id"];

    // Wyświetlaj formularz z komentarzami do zatwiedzenia.
    if ($id != 0) {
        echo "<form name='comment_update' action='active_comments.php' method='post'>";

        for ($i = $id; $i > 0; $i--) {
            $result = mysql_query("SELECT author, content, date, id, article_id FROM comments WHERE id=" . $i . " AND active = '0'");


            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                echo("
                     <div class='news_comment'> 
                            <p class='comment_author'>$row[0]</p>
                            <p class='comment_date'>$row[2]</p>
                            <div class='comment_content'> $row[1] </div>
                            <li> <input type='radio' name='$row[3]' value='$row[3]'>Zatwierdź</li>
                            <hr class='comment_separate' />
                        </div>
                        ");
            }
            mysql_free_result($result);
        }

        echo "<input type='submit' value='Submit'/> </form>";
        echo "<a href='javascript:AlertIt();'> <button type='button'>Usuń wszystkie niezatwierdzone</button> </a>";
    } else {
        echo "Nie ma żadnych komentarzy do zatwierdzenia";
    }
    
} else if ($_GET['action'] == "meta") {
    
    if(isset($_GET['title']) && isset($_GET['description']) && isset($_GET['keywords'])) {
            echo "<h3 class='news_title'>Zaktualizowałeś metadane (prawie)</h3>";
    } else {
?>
        <h3 class='news_title'>Metadane</h3>
        <form action="meta_update.php" method="get">
            <ul>
                <li> Tytuł: <input type="text" name="title" value="<?php echo layout::getTitle(); ?>" /> </li>
                <li> Opis: <input type="text" name="description" value="<?php echo layout::getDescription(); ?>" /> </li>
                <li> Słowa kluczowe: <input type="text" name="keywords" value="<?php echo layout::getKeywords(); ?>" /> </li>
                <input type="hidden" name="action" value="meta">
                <li> <input type="submit" value="Aktualizuj"/>  </li>
            </ul>
        </form>  
        
        
<?php
    }
} else if ($_GET['action'] == "edit_articles_adm") {
    $result = mysql_query("SELECT MAX(id) as id FROM articles");
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $id = $row["id"];

    echo "<h3 class='news_title'>Artykuły</h3>";
    echo "<ul>";
    for ($i = $id; $i > 0; $i--) {
        $result = mysql_query("SELECT id, title, content, excerpt, author, date FROM articles WHERE id=" . $i);

        while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
            echo "<li style='list-style-type: square;'><a href='panel.php?action=edit_article&id=$row[0]'> $row[1] </a> </li>";
        }
    }
    echo "</ul>";
}
echo "</div>";

} else {
    echo "<div class='news'>";
    $errors[] = 'Nie masz na to pozwolenia.';
    echo output_errors($errors);
    echo "</div>";
}

$layout->getBottom();

