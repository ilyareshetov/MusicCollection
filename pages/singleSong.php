<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Single Song Page';
require_once 'header.php';

$get = $db->query("SELECT s.*, a.title FROM song s JOIN album a ON s.album = a.id WHERE name = '{$_GET['song']}';");
$getArtist = $db->query("SELECT a.stageName FROM artist a JOIN artist_in_song ais ON a.id = ais.idArtist JOIN song s ON ais.idSong = s.id WHERE s.name = '{$_GET['song']}';");
$res = $get->fetch_assoc();
?>
    <div class="formBlock">
        <a href="listSong.php">Back to Songs page!</a><br><br>
        <table>
            <tr>
                <td>Name:</td>
                <td><?=$res['name'] ?></td>
            </tr>
            <tr>
                <td>Album:</td>
                <td><?=$res['title'] ?></td>
            </tr>
            <tr>
                <td>Artist:</td>
                <td>
                    <?php while($resArtist = $getArtist->fetch_assoc()): ?>
                        <p><?=$resArtist['stageName'] ?></p>
                    <?php endwhile; ?>
                </td>
            </tr>
            <tr>
                <td>Length:</td>
                <td><?=$res['length'] ?></td>
            </tr>
            <tr>
                <td>Comment:</td>
                <td><?=$res['comment'] ?></td>
            </tr>
            <tr>
                <td>Highest Rank</td>
                <td><?=$res['highestRank'] ?></td>
            </tr>
            <tr>
                <td>Rank Date:</td>
                <td><?=$res['dateRank'] ?></td>
            </tr>
            <tr>
                <td>Writer:</td>
                <td><?=$res['writerName'] ?></td>
            </tr>
        </table>
    </div>

<?php
require_once 'footer.php';