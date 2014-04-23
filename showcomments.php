<?php

$article_id = $_GET['id'];
$result = mysql_query("SELECT MAX(id) as id FROM comments WHERE article_id = '$article_id' AND active = '1'");

$row = mysql_fetch_array($result, MYSQL_ASSOC);
$id = $row["id"];

echo "<div id='news_comments'>";
        
for ($i = $id; $i > 0; $i--) {
    $result = mysql_query("SELECT author, content, date FROM comments WHERE id=" . $i ." AND article_id = '$article_id' AND active = '1'");

    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        echo("
            <div class='news_comment'> 
                <p class='comment_author'>$row[0]</p>
                <p class='comment_date'>$row[2]</p>
                <p class='comment_moderate'><a class='autor' href='delete_comment.php?id=" . $i . "'>Usuń</a></p>
                <div class='comment_content'>$row[1]</div>
                <hr class='comment_separate' />
            </div>
            ");
    }
    mysql_free_result($result);
}
?>
    <form action='add_comment.php' method='get'>
        <ul class="widget_ul">
            <li> <textarea class='ckeditor' name='content' style="width: 99%; height: 60px;" cols='50' rows='10'> </textarea> </li>
            <li> <input type="hidden" name="article_id" value="<?php echo $article_id ?>" </li>
            <li> <input type='submit' value='Skomentuj'> </li>
        </ul>
    </form>

<?php          
echo "</div>";