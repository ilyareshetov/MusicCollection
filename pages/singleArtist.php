<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Single Artist Page';
require_once 'header.php';

$getArtist = $db->query("SELECT * FROM artist WHERE stageName = '{$_GET['artist']}' ORDER BY stageName");
$res = $getArtist->fetch_assoc();
$getSong = $db->query("SELECT s.id, s.name FROM  song s JOIN artist_in_song ais ON s.id = ais.idSong JOIN artist a ON ais.idArtist = a.id WHERE a.id = '{$res['id']}'");
?>
<div class="formBlock">
    <a href="listArtist.php">Back to Artists page!</a><br><br>
    <table>
        <tr>
            <td>Stage Name:</td>
            <td><?=$res['stageName'] ?></td>
        </tr>
        <tr>
            <td>Birth Name:</td>
            <td><?=$res['birthName'] ?></td>
        </tr>
        <tr>
            <td>Birth Date:</td>
            <td><?=$res['birthDate'] ?></td>
        </tr>
        <tr>
            <td>Hometown:</td>
            <td><?=$res['hometown'] ?></td>
        </tr>
        <tr>
            <td>Death Date:</td>
            <td><?=$res['deathDate'] ?></td>
        </tr>
        <tr>
            <td>Fun Fact:</td>
            <td><?=$res['funNotableFact'] ?></td>
        </tr>
    </table>
    <h3>Song list</h3>
    <?php while ($resSong = $getSong->fetch_assoc()): ?>
        <a href="singleSong.php?song=<?=$resSong['id'] ?>"><?=$resSong['name'] ?></a>
    <?php endwhile; ?>
</div>

<?php
require_once 'footer.php';