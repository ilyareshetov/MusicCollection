<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Single Album Page';
require_once 'header.php';

function show($db, $getSong) {
    $getAlbum = $db->query("SELECT a.*, g.genre FROM album a JOIN genres g ON a.genre = g.id WHERE title = '{$_GET['album']}' ORDER BY title");
    $res = $getAlbum->fetch_assoc();
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
                <input type="radio" name="sort" value="writer_up" id="writer_up"><label for="writer_up">Writer ↑</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="writer_down" id="writer_down"><label for="writer_down">Writer ↓</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="rank_up" id="rank_up"><label for="rank_up">BillBoard Ranking ↑</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="rank_down" id="rank_down"><label for="rank_down">BillBoard Ranking ↓</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="length_up" id="length_up"><label for="length_up">Length ↑</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="length_down" id="length_down"><label for="length_down">Length ↓</label><br>
            </div>
        </div>
        <br><br>
        <input type="submit" name="submit" value="Sort" style="width:10vh; padding:6px 0;">
    </form>
    <div class="formBlock">
        <a href="listAlbum.php">Back to Albums page!</a><br><br>
        <table>
            <tr>
                <td>Title:</td>
                <td><?=$res['title'] ?></td>
            </tr>
            <tr>
                <td>Label:</td>
                <td><?=$res['label'] ?></td>
            </tr>
            <tr>
                <td>Genre:</td>
                <td><?=$res['genre'] ?></td>
            </tr>
            <tr>
                <td>Release Date:</td>
                <td><?=$res['releaseDate'] ?></td>
            </tr>
            <tr>
                <td>Notable Fact:</td>
                <td><?=$res['notableFact'] ?></td>
            </tr>
        </table>
        <h3>Song list</h3>
        <?php while ($resSong = $getSong->fetch_assoc()): ?>
            Name: <a href="singleSong.php?song=<?=$resSong['id'] ?>"><?=$resSong['name'] ?></a>
            <p>Writer: <?=$resSong['writerName']?></p>
            <p>BillBoard Ranking: <?=$resSong['highestRank'] ?></p>
            <p>Length: <?=$resSong['length'] ?></p>
        <?php endwhile; ?>
    </div>

    <?php
}

if (isset($_POST['submit'])) {
    if ($_POST['sort'] == 'name_up') {
        $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.name");
    }
    elseif ($_POST['sort'] == 'name_down') {
        $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.name DESC");
    }
    elseif ($_POST['sort'] == 'writer_up') {
        $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.writerName");
    }
    elseif ($_POST['sort'] == 'writer_down') {
        $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.writerName DESC");
    }
    elseif ($_POST['sort'] == 'rank_up') {
        $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.highestRank");
    }
    elseif ($_POST['sort'] == 'rank_down') {
        $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.highestRank DESC");
    }
    elseif ($_POST['sort'] == 'length_up') {
        $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.length");
    }
    elseif ($_POST['sort'] == 'length_down') {
        $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.length DESC");
    }
    show($db, $getSong);
}
else {
    $getSong = $db->query("SELECT s.id, s.name, s.writerName, s.length, s.highestRank FROM song s JOIN album a ON s.album = a.id WHERE a.title = '{$_GET['album']}' ORDER BY s.name");
    show($db, $getSong);
}



require_once 'footer.php';