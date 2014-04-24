<?php
include 'core\init.php';
$layout = new layout();
$layout->getTopAdm();
echo "<div class='news'>";
if (user::user_moderator($user_data['username']) == true) {
    $administrator = new administrator();

    if (isset ($_GET)) {    
        $title = $_GET['title'];
        $desctiption = $_GET['description'];
        $keywords = $_GET['keywords'];
        
        update_title($title);
        update_description($description);
        update_keywords($keywords);
    }
    header('Location: panel.php?action=meta');
} else {
    echo "Nie masz prawa tu przebywać, won!";
}
echo "</div>";
$layout->getBottom();

