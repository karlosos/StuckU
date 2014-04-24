<?php
/**
 * Plik z klasa administratora
 */

/**
 * Klasa administratora
 *
 * @package class
 * @author Karol Dzialowski
 */
class administrator extends user {

    /**
     * Usuwaj komentarz 
     * @param int $comment_id
     */
    static public function delete_comment_adm($comment_id) {
        delete_comment($comment_id);
    }
    
    /**
     * Pokaz menu administratora
     */
    static public function show_menu_adm() {
        include '/includes/widgets/admin.php';
    }

    /**
     * Dodaj artykul
     * 
     * @param array $article_data
     */
    public function add_article($article_data) {
        array_walk($article_data, 'array_sanitize');

        $fields = '`' . implode('`, `', array_keys($article_data)) . '`';
        $data = '\'' . implode('\', \'', $article_data) . '\'';

        mysql_query("INSERT INTO `articles` ($fields) VALUES ($data)");
    }

    /**
     * Aktualizuj artykul
     * 
     * @param int $article_id
     * @param array $article_data
     */
    public function update_article($article_id, $article_data) {
        array_walk($article_data, 'array_sanitize');
        $title = $article_data['title'];
        //$excerpt = $article_data['excerpt'];
        $content = $article_data['content'];
        mysql_query("UPDATE articles SET `title`='$title', `content`='$content' WHERE `id` = '$article_id'");
    }

    /**
     * Usun artykul
     * 
     * @param int $article_id
     */
    public function delete_article($article_id) {
        $article_id = sanitize($article_id);
        //echo "DELETE FROM `articles` WHERE `id` = '$article_id'";
        mysql_query("DELETE FROM `articles` WHERE `id` = '$article_id'");
    }

}
