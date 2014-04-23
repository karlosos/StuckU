<?php
/**
 * Klasa odpowiada za wczytywanie layoutu
 *
 * @package classes
 * @author Karol
 */
class layout {
    public function getTop() {
        include 'includes/overlay/top.php';
    }
    
    public function getTopAdm() {
        include 'includes/overlay/top_adm.php';
    }
    
    public function getBottom() {
        include 'includes/overlay/bottom.php';
    }
    
    public function getContent() {
    }
    
    static public function getKeywords() {
        $query = mysql_query("SELECT `keywords` FROM `info` WHERE `id` = '0'");
        return mysql_result($query, 0, 'keywords');
    }
    
    static public function getDescription() {
        $query = mysql_query("SELECT `description` FROM `info` WHERE `id` = '0'");
        return mysql_result($query, 0, 'description');
    }
    
    static public function getTitle() {
        $query = mysql_query("SELECT `title` FROM `info` WHERE `id` = '0'");
        return mysql_result($query, 0, 'title');
    }

    static public function getMenu() {
        $query = mysql_query("SELECT `menu` FROM `info` WHERE `id` = '0'");
        return mysql_result($query, 0, 'menu');
    }
    
    public function getArticles() {
        include 'showarticles.php';
    }
    
    public function getArticleTop($id) {
        $news = Array();
        $news["title"] = title_from_id($id);
        $news["date"] = date_from_id($id);
        $news["author"] = author_from_id($id);
        
        return $news;
    }
    
    public function getArticleContent($id) {
        return content_from_id($id);
    }
    
    public function getSidebar() {
        
    }
    
}
