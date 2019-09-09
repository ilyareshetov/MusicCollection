<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'New Song Page';


if (isset($_POST['submit'])) {
    require_once 'header.php';
    if (!isset($_POST['exist'])) {
        $getAlbum = $db->query("SELECT id, title FROM album;");
        $getArtist = $db->query("SELECT id, stageName FROM artist;");
        $artists = [];
        while ($res = $getArtist->fetch_assoc()) {
           $artists[$res['id']] = $res['stageName'];
        }
        ?>
        <div class="formBlock">
            <form method="post">
                <label for="album">Choose an Album of Song(s):</label>
                <select name="album" id="album">
                    <?php while ($res = $getAlbum->fetch_assoc()): ?>
                        <option value="<?=$res['id'] ?>"><?=$res['title'] ?></option>
                    <?php endwhile; ?>
                </select><br><br>
                <?php for ($i = 1; $i <= $_POST['number']; $i++): ?>
                    <label for="name<?=$i ?>">Write a Name of Song:</label>
                    <input type="text" name="name<?=$i ?>" id="name<?=$i ?>"><br>
                    <label for="artist<?=$i ?>">Write an Artist(s) of Song:</label>
                    <select name="artist<?=$i ?>[]" id="artist<?=$i ?>" multiple>
                        <?php foreach ($artists as $id => $artist): ?>
                            <option value="<?=$id ?>"><?=$artist ?></option>
                        <?php endforeach; ?>
                    </select><br><br>
                    <p>Is your artist not on the list? <a href="newArtist.php">Add him!</a></p>
                    <label for="length<?=$i ?>">Write a length:</label>
                    <input type="text" name="length<?=$i ?>" id="length<?=$i ?>" pattern="[0-9]*:[0-9]*"><br>
                    <label for="comment<?=$i ?>">Write a comment:</label>
                    <input type="text" name="comment<?=$i ?>" id="comment<?=$i ?>"><br>
                    <label for="rank<?=$i ?>">Write a Highest Rank:</label>
                    <input type="number" name="highestRank<?=$i ?>" id="rank<?=$i ?>"><br>
                    <label for="dateRank<?=$i ?>">Write a Date Rank:</label>
                    <input type="date" name="dateRank<?=$i ?>" id="dateRank<?=$i ?>"><br>
                    <label for="writerName<?=$i ?>">Write a Writer Name:</label>
                    <input type="text" name="writerName<?=$i ?>" id="writerName<?=$i ?>"><hr><br>
                <?php endfor; ?>
                <input type="hidden" name="songNumber" value="<?=$_POST['number'] ?>">
                <input type="submit" name="addNew" value="Add new song(s)">
            </form>
        </div>
        <?php
    }
    else {
        $get = $db->query("SELECT s.*, a.id as idAlbum, a.title FROM song s JOIN album a ON s.album = a.id WHERE s.id = '{$_POST['exist']}'");
        $res = $get->fetch_assoc();
        ?>
        <div class="formBlock">
            <form method="post">
                <label for="name">Song name:</label>
                <input type="text" name="name" id="name" value="<?=$res['name'] ?>"><br>
                <label for="album">Album:</label>
                <select name="album" id="album">
                    <?php
                    $getAlbums = $db->query("SELECT * FROM album;");
                    ?>
                    <option value="<?=$res['idAlbum'] ?>" selected disabled><?=$res['title'] ?></option>
                    <?php
                    while ($resAlbums = $getAlbums->fetch_assoc()):
                        ?>
                        <option value="<?=$resAlbums['id'] ?>"><?=$resAlbums['title'] ?></option>
                    <?php endwhile; ?>
                </select><br>
                <label for="artist">Artist(s):</label>
                <div class="artistBox">
                    <?php
                    $getSongArtist = $db->query("SELECT a.stageName FROM artist a JOIN artist_in_song ais ON a.id = ais.idArtist JOIN song s ON ais.idSong = s.id WHERE s.id = '{$_POST['exist']}';");
                    $songArtist = [];
                    while ($artist = $getSongArtist->fetch_assoc()) {$songArtist[] = $artist['stageName'];}
                    $get = $db->query("SELECT id, stageName FROM artist;");
                    while ($resA = $get->fetch_assoc()):
                        ?>
                        <input class="artist" type="checkbox" name="artist[]" value="<?=$resA['id'] ?>" <?=$ch = (in_array($resA['stageName'], $songArtist)) ? 'checked' : ''?>><label><?=$resA['stageName'] ?></label><br>
                    <?php endwhile; ?>
                </div><br>
                <label for="length">Length:</label>
                <input type="text" name="length" id="length" value="<?=$res['length'] ?>" pattern="[0-9]*:[0-9]*"><br>
                <label for="comment">Comment:</label>
                <input type="text" name="comment" id="comment" value="<?=$res['comment'] ?>"><br>
                <label for="highestRank">Highest Rank:</label>
                <input type="number" name="highestRank" id="highestRank" value="<?=$res['highestRank'] ?>"><br>
                <label for="dateRank">Date Rank:</label>
                <input type="date" name="dateRank" id="dateRank" value="<?=$res['dateRank'] ?>"><br>
                <label for="writerName">Writer Name:</label>
                <input type="text" name="writerName" id="writerName" value="<?=$res['writerName'] ?>"><br>

                <input type="hidden" name="idSong" value="<?=$res['id'] ?>">
                <input type="submit" name="update" value="Update information">
            </form>
        </div>
        <?php
    }
}
elseif (isset($_POST['addNew'])) {
    for ($i = 1; $i <= $_POST['songNumber']; $i++) {
        $db->query("INSERT INTO song (name, album, length, comment, highestRank, dateRank, writerName) VALUES ('{$_POST["name$i"]}', '{$_POST["album"]}', '{$_POST["length$i"]}', '{$_POST["comment$i"]}', '{$_POST["highestRank$i"]}', '{$_POST["dateRank$i"]}', '{$_POST["writerName$i"]}');");
        $idSong = $db->insert_id;
        foreach ($_POST["artist$i"] as $idArtist) {
            $db->query("INSERT INTO artist_in_song (idArtist, idSong) VALUES ('{$idArtist}', '{$idSong}');");
        }
    }
    $get = $db->query("SELECT a.title FROM album a JOIN song s ON a.id = s.album WHERE s.album = '{$_POST['album']}'");
    $res = $get->fetch_assoc();
    header("Refresh: 2; url=singleAlbum.php?album={$res['title']}" );
    print('Song(s) successfully added! Redirect to Album\'s page');
}
elseif (isset($_POST['update'])) {
    if (!isset($_POST['album'])) $_POST['album'] = 'album';
    $db->query("UPDATE song SET name = '{$_POST['name']}', album = '{$_POST['album']}', length = '{$_POST['length']}', comment = '{$_POST['comment']}', highestRank = '{$_POST['highestRank']}', dateRank = '{$_POST['dateRank']}', writerName = '{$_POST['writerName']}' WHERE id = '{$_POST['idSong']}';");
    $db->query("DELETE FROM artist_in_song WHERE idSong = {$_POST['idSong']};");
    foreach ($_POST['artist'] as $idArtist) {
        $db->query("INSERT INTO artist_in_song (idArtist, idSong) VALUES ('{$idArtist}', '{$_POST['idSong']}');");
    }
    header("Refresh: 2; url=singleSong.php?song={$_POST['name']}" );
    print('Song information successfully changed! Redirect to Song page...');
}
else {
    require_once 'header.php';
    $get = $db->query("SELECT s.id, s.name, a.title FROM song s JOIN album a ON s.album = a.id;");
    ?>
    <div class="formBlock" style="padding-top: 5px;">
        <h3>Now you can choose how many new songs you want to add!</h3>
        <form method="post">
            <label for="number">Choose number of songs</label><br><br>
            <select name="number" id="number">
                <option selected value="1">1</option>
                <?php for ($i=2; $i<11; $i++): ?>
                    <option value="<?=$i ?>"><?=$i ?></option>
                <?php endfor; ?>
            </select><br><br>
            <label for="artist">Or you can edit exist song!</label><br><br>
            <select name="exist" id="exist">
                <option selected disabled>Choose song</option>
                <?php while ($res = $get->fetch_assoc()): ?>
                    <option value="<?=$res['id'] ?>"><?=$res['name'] ?> (<?=$res['title'] ?>)</option>
                <?php endwhile; ?>
            </select><br><br>
            <input type="submit" name="submit" value="Select">
        </form>
    </div>
    <?php
}

require_once 'footer.php';