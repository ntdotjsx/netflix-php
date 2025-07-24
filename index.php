<script src="package/browser@4.js"></script>
<script src="package/jquery-3.7.1.min.js"></script>
<script src="package/mustache.min.js"></script>
<script src="package/anime.min.js"></script>
<script src="src/main.js"></script>
<link rel="stylesheet" href="styles/global.css">
<?php
require_once 'class/route.php';
$ROUTE->route('/', fn() => include 'views/home.php');
$ROUTE->route('/test', fn() => include 'views/movie/[play]/route.php');
$ROUTE->route('/play', fn() => include 'views/movie/[play]/route.php');
$ROUTE->route('/movie', fn() => include 'views/movie/[list]/route.php');
$ROUTE->run();
?>