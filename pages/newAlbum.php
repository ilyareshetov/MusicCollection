<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'New Album Page';


if (isset($_POST['submit'])) {
    require_once 'header.php';
    if ($_POST['album'] == 'New') {
        ?>
        <div class="formBlock">
            <form method="post">
                <label for="title">Write an Album name:</label>
                <input type="text" name="title" id="title"><br>
                <label for="artist">Choose an Artist(s):</label>
                <select name="artist[]" multiple id="genre">
                    <?php
                    $get = $db->query("SELECT * FROM artist;");
                    while ($res = $get->fetch_assoc()):
                        ?>
                        <option value="<?=$res['id'] ?>"><?=$res['stageName'] ?></option>
                    <?php endwhile; ?>
                </select><br>
                <p>Is your artist not on the list? <a href="newArtist.php">Add him!</a></p>
                <label for="label">Write a Label:</label>
                <input type="text" name="label" id="label"><br>
                <label for="genre">Choose a Genre:</label>
                <select name="genre" id="genre">
                    <?php
                    $get = $db->query("SELECT * FROM genres;");
                    while ($res = $get->fetch_assoc()):
                    ?>
                    <option value="<?=$res['id'] ?>"><?=$res['genre'] ?></option>
                    <?php endwhile; ?>
                </select><br>
                <label for="release">Write a Release Date:</label>
                <input type="date" name="releaseDate" id="release"><br>
                <label for="fact">Write a Notable Fact:</label>
                <textarea name="notableFact" id="fact"></textarea>

                <input type="submit" name="addNew" value="Add new album">
            </form>
        </div>
        <?php
    }
    else {
        $get = $db->query("SELECT a.*, g.genre, g.id AS idGenre FROM album a JOIN genres g ON a.genre = g.id WHERE a.title = '{$_POST['album']}'");
        $res = $get->fetch_assoc();
        ?>
        <div class="formBlock">
            <form method="post">
                <label for="title">Album name:</label>
                <input type="text" name="title" id="title" value="<?=$res['title'] ?>"><br>
                <label for="artist">Artist(s):</label>
                <div class="artistBox">
                    <?php
                    $getAlbumArtist = $db->query("SELECT a.stageName FROM artist a JOIN artist_in_album aia ON a.id = aia.idArtist JOIN album al ON aia.idAlbum = al.id WHERE al.title = '{$_POST['album']}';");
                    $albumArtist = [];
                    while ($artist = $getAlbumArtist->fetch_assoc()) {$albumArtist[] = $artist['stageName'];}
                    $get = $db->query("SELECT id, stageName FROM artist;");
                    while ($resA = $get->fetch_assoc()):
                    ?>
                    <input class="artist" type="checkbox" name="artist[]" value="<?=$resA['id'] ?>" <?=$ch = (in_array($resA['stageName'], $albumArtist)) ? 'checked' : ''?>><label><?=$resA['stageName'] ?></label><br>
                    <?php endwhile; ?>
                </div><br>
                <label for="label">Label:</label>
                <input type="text" name="label" id="label" value="<?=$res['label'] ?>"><br>
                <label for="genre">Genre:</label>
                <select name="genre" id="genre">
                    <?php
                    $getGenres = $db->query("SELECT * FROM genres;");
                    ?>
                    <option value="<?=$res['idGenre'] ?>" selected disabled><?=$res['genre'] ?></option>
                    <?php
                    while ($resGenres = $getGenres->fetch_assoc()):
                        ?>
                        <option value="<?=$resGenres['id'] ?>"><?=$resGenres['genre'] ?></option>
                    <?php endwhile; ?>
                </select><br>
                <label for="release">Release Date:</label>
                <input type="date" name="releaseDate" id="release" value="<?=$res['releaseDate'] ?>"><br>
                <label for="fact">Notable Fact:</label>
                <input type="text" name="notableFact" id="fact" value="<?=$res['notableFact'] ?>"><br>

                <input type="hidden" name="oldTitle" value="<?=$res['title'] ?>">
                <input type="hidden" name="idAlbum" value="<?=$res['id'] ?>">
                <input type="submit" name="update" value="Update information">
            </form>
        </div>
        <?php
    }
}
elseif (isset($_POST['addNew'])) {
    $title = $db->real_escape_string($_POST['title']);
    $label = $db->real_escape_string($_POST['label']);
    $note = $db->real_escape_string($_POST['notableFact']);
    $db->query("INSERT INTO album (title, label, genre, releaseDate, notableFact) VALUES ('{$title}', '{$label}', '{$_POST['genre']}', '{$_POST['releaseDate']}', '{$note}');");
    $idAlbum = $db->insert_id;
    foreach ($_POST['artist'] as $artist) {
        $db->query("INSERT INTO artist_in_album (idArtist, idAlbum) VALUES ('{$artist}', '{$idAlbum}');");
    }
    header('Refresh: 2; url=listAlbum.php' );
    print('Album successfully added! Redirect to Album\'s page');
}
elseif (isset($_POST['update'])) {
    $title = $db->real_escape_string($_POST['title']);
    $label = $db->real_escape_string($_POST['label']);
    $note = $db->real_escape_string($_POST['notableFact']);
    if (!isset($_POST['genre'])) $_POST['genre'] = 'genre';
    $db->query("UPDATE album SET title = '{$title}', label = '{$label}', genre = '{$_POST['genre']}', releaseDate = '{$_POST['releaseDate']}', notableFact = '{$note}' WHERE title = '{$_POST['oldTitle']}';");
    $db->query("DELETE FROM artist_in_album WHERE idAlbum = {$_POST['idAlbum']};");
    foreach ($_POST['artist'] as $idArtist) {
        $db->query("INSERT INTO artist_in_album(idArtist, idAlbum) VALUES ('{$idArtist}', '{$_POST['idAlbum']}');");
    }
    header("Refresh: 2; url=singleAlbum.php?album={$_POST['title']}" );
    print('Album information successfully changed! Redirect to Album page');
}
else {
    require_once 'header.php';
    $get = $db->query("SELECT title FROM album;");
    ?>
    <div class="formBlock" style="padding-top: 5px;">
        <h3>Now you can choose create new album or edit already exist!</h3>
        <form method="post">
            <label for="album">Choose album</label><br><br>
            <select name="album" id="album">
                <option selected value="New">New</option>
                <?php while ($res = $get->fetch_assoc()): ?>
                    <option value="<?=$res['title'] ?>"><?=$res['title'] ?></option>
                <?php endwhile; ?>
            </select><br><br>
            <input type="submit" name="submit" value="Select">
        </form>
    </div>
    <?php
}

require_once 'footer.php';