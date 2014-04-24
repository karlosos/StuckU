<?php
include 'core\init.php';
$layout = new layout();
$layout->getTopAdm();
echo "<div class='news'>";
if (user::user_moderator($user_data['username']) == true) {
    $administrator = new administrator();
    delete_all_comments();
    header('Location: panel.php?action=comments');
} else {
    echo "Nie masz prawa tu przebywać, won!";
}
echo "</div>";
$layout->getBottom();