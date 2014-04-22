<?php
/**
 * Plik widżetu logowania
 * @package widgets
 * @author Karol Dzialowski
 */
?>
<div class="widget">
    <h4 class="news_title"> Log In/Register </h2>
        <form action="login.php" method="post">
            <ul class="widget_ul">
                <li class="widget_li">
                    Username: <br>
                    <input type="text" name="username">
                </li>	
                <li class="widget_li">
                    Password: <br>
                    <input type="password" name="password">
                </li>
                <li class="widget_li">
                    <input type="submit" value="Zaloguj">
                </li>
            </ul>
        </form>
</div>