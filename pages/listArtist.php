<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'Artist\'s List Page';
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
                <input type="radio" name="sort" value="age_up" id="age_up"><label for="age_up">Age ↑</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="age_down" id="age_down"><label for="age_down">Age ↓</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="songs_up" id="songs_up"><label for="songs_up">Number of Songs ↑</label><br>
            </div>
            <div class="field">
                <input type="radio" name="sort" value="songs_down" id="songs_down"><label for="songs_down">Number of Songs ↓</label><br>
            </div>
        </div>
        <br><br>
        <input type="submit" name="submit" value="Sort" style="width:10vh; padding:6px 0;">
    </form>
    <div class="formBlock">
        <?php while ($res = $get->fetch_assoc()): ?>
            Stage Name: <a href="singleArtist.php?artist=<?=$res['stageName'] ?>"> <?=$res['stageName'] ?></a>
            <p>Age: <?php $now = new DateTime(); print($now->diff(new DateTime($res['birthDate']))->y); ?></p>
            <p>Number of Songs: <?=$res['number'] ?></p>
            <hr>
        <?php endwhile; ?>
    </div>
    <?php
}

if (isset($_POST['submit'])) {
    if ($_POST['sort'] == 'name_up') {
        $get = $db->query("SELECT a.id, a.stageName, a.birthDate, count(s.name) AS number FROM artist a LEFT JOIN artist_in_song ais ON a.id = ais.idArtist LEFT JOIN song s ON ais.idSong = s.id GROUP BY a.id, a.stageName, a.birthDate ORDER BY a.stageName");
    }
    elseif ($_POST['sort'] == 'name_down') {
        $get = $db->query("SELECT a.id, a.stageName, a.birthDate, count(s.name) AS number FROM artist a LEFT JOIN artist_in_song ais ON a.id = ais.idArtist LEFT JOIN song s ON ais.idSong = s.id GROUP BY a.id, a.stageName, a.birthDate ORDER BY a.stageName DESC");
    }
    elseif ($_POST['sort'] == 'age_up') {
        $get = $db->query("SELECT a.id, a.stageName, a.birthDate, count(s.name) AS number FROM artist a LEFT JOIN artist_in_song ais ON a.id = ais.idArtist LEFT JOIN song s ON ais.idSong = s.id GROUP BY a.id, a.stageName, a.birthDate ORDER BY a.birthDate DESC");
    }
    elseif ($_POST['sort'] == 'age_down') {
        $get = $db->query("SELECT a.id, a.stageName, a.birthDate, count(s.name) AS number FROM artist a LEFT JOIN artist_in_song ais ON a.id = ais.idArtist LEFT JOIN song s ON ais.idSong = s.id GROUP BY a.id, a.stageName, a.birthDate ORDER BY a.birthDate");
    }
    elseif ($_POST['sort'] == 'songs_up') {
        $get = $db->query("SELECT a.id, a.stageName, a.birthDate, count(s.name) AS number FROM artist a LEFT JOIN artist_in_song ais ON a.id = ais.idArtist LEFT JOIN song s ON ais.idSong = s.id GROUP BY a.id, a.stageName, a.birthDate ORDER BY number");
    }
    elseif ($_POST['sort'] == 'songs_down') {
        $get = $db->query("SELECT a.id, a.stageName, a.birthDate, count(s.name) AS number FROM artist a LEFT JOIN artist_in_song ais ON a.id = ais.idArtist LEFT JOIN song s ON ais.idSong = s.id GROUP BY a.id, a.stageName, a.birthDate ORDER BY number DESC");
    }
    showArtist($get);
}
else {
    $get = $db->query("SELECT a.id, a.stageName, a.birthDate, count(s.name) AS number FROM artist a LEFT JOIN artist_in_song ais ON a.id = ais.idArtist LEFT JOIN song s ON ais.idSong = s.id GROUP BY a.id, a.stageName, a.birthDate ORDER BY a.stageName");
    showArtist($get);
}




require_once 'footer.php';