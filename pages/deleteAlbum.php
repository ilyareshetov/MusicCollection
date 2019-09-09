<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Delete Album Page';
require_once 'header.php';

if (isset($_POST['submit'])) {
    $get = $db->query("SELECT name FROM song WHERE album = {$_POST['album']}");
    ?>
    <div class="formBlock">
        <form method="post">
            <h3>The following songs will also be deleted</h3>
            <ul>
                <?php while ($res = $get->fetch_assoc()): ?>
                    <li><?=$res['name'] ?></li>
                <?php endwhile; ?>
            </ul>
            <h3>Are you sure to continue?</h3>
            <input type="hidden" name="idAlbum" value="<?=$_POST['album'] ?>">
            <input type="submit" name="delete" value="Delete album">
        </form>
    </div>
    <?php
}
elseif (isset($_POST['delete'])) {
    $db->query("DELETE FROM album WHERE id = '{$_POST['idAlbum']}';");
    header("Refresh: 0; url=listAlbum.php");
}
else {
    $get = $db->query("SELECT id, title FROM album");
    ?>
    <div class="formBlock">
        <form method="post">
        <h3>Choose an album</h3>
        <select name="album">
        <?php while ($res = $get->fetch_assoc()): ?>
            <option value="<?=$res['id'] ?>"><?=$res['title'] ?></option>
        <?php endwhile; ?>
        </select><br><br>
        <input type="submit" name="submit" value="Delete">
        </form>
    </div>
    <?php
}



require_once 'footer.php';