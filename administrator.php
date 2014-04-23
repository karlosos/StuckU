<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administrator
 *
 * @author Karol
 */
class administrator extends user {

    static public function delete_comment_adm($comment_id) {
        delete_comment($comment_id);
    }

    public function panel_comments_adm() {
        include 'comment_panel.php';
    }

    public function activate_comments_adm($comments) {
        foreach($comments as $comment){
            active_comment($comment);
        }
    }

    public function delete_comments_adm() {
        foreach($comments as $comment){
            delete_comment($comment);
        }
    }

    static public function show_menu_adm() {
        include '/includes/widgets/admin.php';
    }

    public function add_article($article_data) {
        array_walk($article_data, 'array_sanitize');

        $fields = '`' . implode('`, `', array_keys($article_data)) . '`';
        $data = '\'' . implode('\', \'', $article_data) . '\'';

        mysql_query("INSERT INTO `articles` ($fields) VALUES ($data)");
    }

    public function update_article($article_id, $article_data) {
        array_walk($article_data, 'array_sanitize');
        $title = $article_data['title'];
        //$excerpt = $article_data['excerpt'];
        $content = $article_data['content'];
        mysql_query("UPDATE articles SET `title`='$title', `content`='$content' WHERE `id` = '$article_id'");
    }

    public function delete_article($article_id) {
        $article_id = sanitize($article_id);
        //echo "DELETE FROM `articles` WHERE `id` = '$article_id'";
        mysql_query("DELETE FROM `articles` WHERE `id` = '$article_id'");
    }

}
