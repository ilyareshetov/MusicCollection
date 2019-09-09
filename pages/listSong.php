<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Songs\'s List Page';
require_once 'header.php';

function showArtist($get) {
    ?>
    <form method="post" id="sortedForm">
        <h3>Order by</h3>
        <div class="mainSort">
            <div class="field">
                <input type="radio" name="sort" value="name_up" id="name_up" checked><label for="name_up">Name ↑</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="name_down" id="name_down"><label for="name_down">Name ↓</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="album_up" id="album_up"><label for="album_up">Album ↑</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="album_down" id="album_down"><label for="album_down">Album ↓</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="writer_up" id="writer_up"><label for="writer_up">Writer ↑</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="writer_down" id="writer_down"><label for="writer_down">Writer ↓</label><br>
            </div>
        </div>
        <br><br>
        <input type="submit" name="submit" value="Sort" style="width:10vh; padding:6px 0;">
    </form>
    <div class="formBlock">
        <?php while ($res = $get->fetch_assoc()): ?>
            Name: <a href="singleSong.php?song=<?=$res['name'] ?>"> <?=$res['name'] ?></a><br><br>
            Album: <a href="singleAlbum.php?album=<?=$res['title'] ?>"> <?=$res['title'] ?></a><br><br>
            Writer: <?=$res['writerName'] ?>
            <hr>
        <?php endwhile; ?>
    </div>
    <?php
}

if (isset($_POST['submit'])) {
    if ($_POST['sort'] == 'name_up') {
        $get = $db->query("SELECT s.name, s.writerName, a.title FROM song s JOIN album a ON s.album = a.id ORDER BY s.name");
    }
    elseif ($_POST['sort'] == 'name_down') {
        $get = $db->query("SELECT s.name, s.writerName, a.title FROM song s JOIN album a ON s.album = a.id ORDER BY s.name DESC");
    }
    elseif ($_POST['sort'] == 'album_up') {
        $get = $db->query("SELECT s.name, s.writerName, a.title FROM song s JOIN album a ON s.album = a.id ORDER BY a.title");
    }
    elseif ($_POST['sort'] == 'album_down') {
        $get = $db->query("SELECT s.name, s.writerName, a.title FROM song s JOIN album a ON s.album = a.id ORDER BY a.title DESC");
    }
    elseif ($_POST['sort'] == 'writer_up') {
        $get = $db->query("SELECT s.name, s.writerName, a.title FROM song s JOIN album a ON s.album = a.id ORDER BY s.writerName");
    }
    elseif ($_POST['sort'] == 'writer_down') {
        $get = $db->query("SELECT s.name, s.writerName, a.title FROM song s JOIN album a ON s.album = a.id ORDER BY s.writerName DESC");
    }
    showArtist($get);
}
else {
    $get = $db->query("SELECT s.name, s.writerName, a.title FROM song s JOIN album a ON s.album = a.id ORDER BY s.name");
    showArtist($get);
}




require_once 'footer.php';