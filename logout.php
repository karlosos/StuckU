<?php
/**
 * Plik logout
 * @package exec
 * @author Karol Dzialowski
 */

/*
 * Nastepuje wylogowanie
 */
session_start();
session_destroy();
header('Location: index.php');
