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
    } else {
        include 'includes/widgets/login.php';
        echo "<hr style='width:75%'>";
    }
    ?>   
    <script>
        var min = 8;
        var max = 18;

        function zwiekszCzcionke() {
            var p = document.getElementsByTagName('p');
            for (i = 0; i < p.length; i++) {
                if (p[i].style.fontSize) {
                    var s = parseInt(p[i].style.fontSize.replace("px", ""));
                } else {
                    var s = 12;
                }
                if (s != max) {
                    s += 1;
                }
                p[i].style.fontSize = s + "px"
            }
        }

        function zmniejszCzcionke() {
            var p = document.getElementsByTagName('p');
            for (i = 0; i < p.length; i++) {
                if (p[i].style.fontSize) {
                    var s = parseInt(p[i].style.fontSize.replace("px", ""));
                } else {
                    var s = 12;
                }
                if (s != min) {
                    s -= 1;
                }
                p[i].style.fontSize = s + "px"
            }

        }

        function domyslnaCzcionka() {
            var p = document.getElementsByTagName('p');
            for (i = 0; i < p.length; i++) {
                 var s = 12;
                p[i].style.fontSize = s + "px"
            }
        }

        function zwiekszKontrast() {
            var body = document.getElementById("body");
            body.style.backgroundColor = "black";
            body.style.color = "yellow";
            
            if (document.getElementById("news_separate")) {
                var news_separate = document.getElementById("news_separate");
                news_separate.style.backgroundColor = "black";
                news_separate.style.color = "yellow";
            }
            
            var p = document.getElementsByTagName('p');
            for (i = 0; i < p.length; i++) {
                p[i].style.color = "yellow";
            }
            
            
            var h4 = document.getElementsByTagName('h4');
            for (i = 0; i < h4.length; i++) {
                h4[i].style.color = "yellow";
            }
            
            var h3 = document.getElementsByTagName('h3');
            for (i = 0; i < h3.length; i++) {
                h3[i].style.color = "yellow";
            }   
            
            var news = document.getElementsByTagName('div');
            for (i = 0; i < news.length; i++) {
                news[i].style.backgroundColor = "black";
            } 
        }

        function domyslnyKontrast() {
            var body = document.getElementById("body");
            body.style.backgroundColor = null;
            body.style.color = null;
            
            if (document.getElementById("news_separate")) {
                var news_separate = document.getElementById("news_separate");
                news_separate.style.backgroundColor = null;
                news_separate.style.color = null;
            }
            
            var p = document.getElementsByTagName('p');
            for (i = 0; i < p.length; i++) {
                p[i].style.color = null;
            }
            
            
            var h4 = document.getElementsByTagName('h4');
            for (i = 0; i < h4.length; i++) {
                h4[i].style.color = null;
            }
            
            var h3 = document.getElementsByTagName('h3');
            for (i = 0; i < h3.length; i++) {
                h3[i].style.color = null;
            }   
            
            var news = document.getElementsByTagName('div');
            for (i = 0; i < news.length; i++) {
                news[i].style.backgroundColor = null;
            } 
        }
    </script>
    <button onclick="zwiekszCzcionke()">Zwiększ czcionkę</button>
    <button onclick="zmniejszCzcionke()">Zmniejsz czcionkę</button>
    <button onclick="domyslnaCzcionka()">Domyślna czcionka</button>
    <button onclick="zwiekszKontrast()">Zwiększ kontrast</button>
    <button onclick="domyslnyKontrast()">Przywróć domyślne</button>


</aside> 