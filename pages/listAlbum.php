<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Album\'s List Page';
require_once 'header.php';

function showAlbum($get) {
    ?>
    <form method="post" id="sortedForm">
        <h3>Order by</h3>
        <div class="mainSort">
            <div class="field">
                <input type="radio" name="sort" value="name_up" id="name_up" checked><label for="name_up">Name ↑</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="name_down" id="name_down"><label for="name_down">Name ↓</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="artist_up" id="artist_up"><label for="artist_up">Artist ↑</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="artist_down" id="artist_down"><label for="artist_down">Artist ↓</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="genre_up" id="genre_up"><label for="genre_up">Genre ↑</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="genre_down" id="genre_down"><label for="genre_down">Genre ↓</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="label_up" id="label_up"><label for="label_up">Label ↑</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="label_down" id="label_down"><label for="label_down">Label ↓</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="date_up" id="date_up"><label for="date_up">Release Date ↑</label>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="date_down" id="date_down"><label for="date_down">Release Date ↓</label><br>
            </div>
        </div>
        <br><br>
        <input type="submit" name="submit" value="Sort" style="width:10vh; padding:6px 0;">
    </form>
    <div class="formBlock">
        <?php while ($res = $get->fetch_assoc()): ?>
            Album Name: <a href="singleAlbum.php?album=<?=$res['title'] ?>"> <?=$res['title'] ?></a><br>
            <p>Artist: <?=$res['artist'] ?></p>
            <p>Label: <?=$res['label'] ?></p>
            <p>Genre: <?=$res['genre'] ?></p>
            <p>Release Date: <?=$res['releaseDate'] ?></p>
            <p>Notable Fact: <?=$res['notableFact'] ?></p>
            <hr>
        <?php endwhile; ?>
    </div>
    <?php
}

if (isset($_POST['submit'])) {
    if ($_POST['sort'] == 'name_up') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY a.title");
    }
    elseif ($_POST['sort'] == 'name_down') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY a.title DESC");
    }
    elseif ($_POST['sort'] == 'artist_up') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY artist");
    }
    elseif ($_POST['sort'] == 'artist_down') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName DESC) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY artist DESC");
    }
    elseif ($_POST['sort'] == 'genre_up') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY g.genre");
    }
    elseif ($_POST['sort'] == 'genre_down') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY g.genre DESC");
    }
    elseif ($_POST['sort'] == 'label_up') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY a.label");
    }
    elseif ($_POST['sort'] == 'label_down') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY a.label DESC");
    }
    elseif ($_POST['sort'] == 'date_up') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY a.releaseDate");
    }
    elseif ($_POST['sort'] == 'date_down') {
        $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY a.releaseDate DESC");
    }
    showAlbum($get);
}
else {
    $get = $db->query("SELECT a.*, g.genre, GROUP_CONCAT(ar.stageName ORDER BY ar.stageName) AS artist FROM album a JOIN genres g ON a.genre = g.id JOIN artist_in_album aia ON a.id = aia.idAlbum JOIN artist ar ON aia.idArtist = ar.id GROUP BY a.title ORDER BY a.title");
    showAlbum($get);
}




require_once 'footer.php';