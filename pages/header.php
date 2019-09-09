<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <ul class="float menu" id="menuLeft">
        <li>
            <div class="dropdown">
                <button class="dropbtn">Artists</button>
                <div class="dropdown-content">
                    <a href="newArtist.php">New artist</a>
                    <a href="listArtist.php">Artist list page</a>
                    <a href="deleteArtist.php">Delete artist</a>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="dropbtn">Albums</button>
                <div class="dropdown-content">
                    <a href="newAlbum.php">New album</a>
                    <a href="listAlbum.php">Album list page</a>
                    <a href="deleteAlbum.php">Delete album</a>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="dropbtn">Songs</button>
                <div class="dropdown-content">
                    <a href="newSong.php">New song</a>
                    <a href="listSong.php">Song list page</a>
                    <a href="deleteSong.php">Delete song</a>
                </div>
            </div>
        </li>
    </ul>
    <ul class="float menu" id="menu">
        <li><a href="../index.php">Home</a>
    </ul>
</header>
<div class="clear"></div>