<?php
/**
 * Plik wczytujący widżety
 * @package includes
 * @author Karol Dzialowski
 */
?>
<aside> 
    <?php
   
    if (logged_in() === true) {
        include 'includes/widgets/loggedin.php';
        echo "<hr style='width:75%'>";
        include 'includes/widgets/admin.php';
        echo "<hr style='width:75%'>";
    } else {
        include 'includes/widgets/login.php';
        echo "<hr style='width:75%'>";
    }
      /*
    
    include 'includes/widgets/loggedin.php';
        echo "<hr style='width:75%'>";
    include 'includes/widgets/login.php';
        echo "<hr style='width:75%'>";*/
    ?>
</aside> 