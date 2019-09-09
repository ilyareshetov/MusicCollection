<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Delete Artist Page';
require_once 'header.php';

if (isset($_POST['submit'])) {
    $db->query("DELETE FROM artist WHERE id = '{$_POST['idArtist']}';");
    header("Refresh: 0; url=listArtist.php");
}
else {
    $get = $db->query("SELECT id, stageName FROM artist WHERE id NOT IN (SELECT idArtist FROM artist_in_song)");
    ?>
    <div class="formBlock">
        <form method="post">
            <h3>Choose an artist</h3>
            <select name="idArtist">
                <?php while ($res = $get->fetch_assoc()): ?>
                    <option value="<?=$res['id'] ?>"><?=$res['stageName'] ?></option>
                <?php endwhile; ?>
            </select><br><br>
            <input type="submit" name="submit" value="Delete">
        </form>
    </div>
    <?php
}



require_once 'footer.php';