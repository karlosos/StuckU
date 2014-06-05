<?php
/**
 * Plik wczytujący nav
 * @package includes
 * @author Karol Dzialowski
 */
?>
<script>
    /**
    * Funkcja odkrywa/ukrywa widok kalkulatora delty
    */
   function odkryj_div()
   {    
//       if (document.getElementById("nav").style.visibility == "hidden") {
//           document.getElementById("nav").style.visibility = "visible";
//       }
//       else if (document.getElementById("nav").style.visibility == "visible") {
//           document.getElementById("nav").style.visibility = "hidden";
//       }
       
       document.getElementById("nav").style.backgroundColor == "#02343F";
       
       if (document.getElementById("nav").style.visibility == "hidden") {
           document.getElementById("nav").style.visibility = "visible";
        }
       else if (document.getElementById("nav").style.visibility == "visible") {
           document.getElementById("nav").style.visibility = "hidden";
        }
       
       console.log("test");

   }
   
</script>
<nav id="nav"> 
        <?php echo layout::getMenu() ?>
</nav>
    <button onclick="odkryj_div();">Ukryj/Odkryj menu</button>