<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Delete Song Page';
require_once 'header.php';

if (isset($_POST['submit'])) {
    $get = $db->query("SELECT a.title FROM song s JOIN album a ON s.album = a.id WHERE s.id = '{$_POST['idSong']}' ;");
    $res = $get->fetch_assoc();
    $album = $res['title'];
    $db->query("DELETE FROM song WHERE id = '{$_POST['idSong']}';");
    header("Refresh: 0; url=singleAlbum.php?album={$album}");
}
else {
    $get = $db->query("SELECT s.id, s.name, a.title FROM song s JOIN album a ON s.album = a.id;");
    ?>
    <div class="formBlock">
        <form method="post">
            <h3>Choose a song</h3>
            <select name="idSong">
                <?php while ($res = $get->fetch_assoc()): ?>
                    <option value="<?=$res['id'] ?>"><?=$res['name'] ?> (<?=$res['title'] ?>)</option>
                <?php endwhile; ?>
            </select><br><br>
            <input type="submit" name="submit" value="Delete">
        </form>
    </div>
    <?php
}



require_once 'footer.php';