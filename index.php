<?php
require_once 'connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web application</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <ul class="float menu" id="menuLeft">
        <li>
            <div class="dropdown">
                <button class="dropbtn">Artists</button>
                <div class="dropdown-content">
                    <a href="pages/newArtist.php">New artist</a>
                    <a href="pages/listArtist.php">Artist list page</a>
                    <a href="pages/deleteArtist.php">Delete artist</a>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="dropbtn">Albums</button>
                <div class="dropdown-content">
                    <a href="pages/newAlbum.php">New album</a>
                    <a href="pages/listAlbum.php">Album list page</a>
                    <a href="pages/deleteAlbum.php">Delete album</a>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="dropbtn">Songs</button>
                <div class="dropdown-content">
                    <a href="pages/newSong.php">New song</a>
                    <a href="pages/listSong.php">Song list page</a>
                    <a href="pages/deleteSong.php">Delete song</a>
                </div>
            </div>
        </li>
    </ul>
    <ul class="float menu" id="menu">
        <li><a href="../index.php">Home</a>
    </ul>
</header>
<main>
    <h1>My Music Collection</h1>
    <img src="images/1.jpg" alt="">
    <img src="images/2.jpg" alt="">
    <img src="images/3.png" alt="">
    <img src="images/4.jpg" alt="">
    <img src="images/5.jpg" alt="">
    <img src="images/6.jpg" alt="">
</main>

<?php


require_once 'pages/footer.php';