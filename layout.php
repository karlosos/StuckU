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
        
    }
    
    public function getArticleContent($id) {
        
    }
    
    public function getSidebar() {
        
    }
    
}
