<?php
require_once '../connection.php';
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$title = 'New Artist Page';


if (isset($_POST['submit'])) {
    require_once 'header.php';
    if ($_POST['artist'] == 'New') {
        ?>
        <div class="formBlock">
            <form method="post">
                <label for="stage">Write a Stage Name:</label>
                <input type="text" name="stageName" id="stage"><br>
                <label for="birth">Write a Birth Name:</label>
                <input type="text" name="birthName" id="birth"><br>
                <label for="date">Write a Birth Date:</label>
                <input type="date" name="birthDate" id="date"><br>
                <label for="home">Write a Hometown:</label>
                <input type="text" name="hometown" id="home"><br>
                <label for="death">Write a Death Date (if it is):</label>
                <input type="date" name="deathDate" id="death"><br>
                <label for="fun">Write a Fun Notable Fact:</label>
                <input type="text" name="funNotableFact" id="fun"><br>

                <input type="submit" name="addNew" value="Add new artist">
            </form>
        </div>
        <?php
    }
    else {
        $get = $db->query("SELECT * FROM artist WHERE stageName = '{$_POST['artist']}'");
        $res = $get->fetch_assoc();
        ?>
        <div class="formBlock">
            <form method="post">
                <label for="stage">Stage Name:</label>
                <input type="text" name="stageName" id="stage" value="<?=$res['stageName'] ?>"><br>
                <label for="birth">Birth Name:</label>
                <input type="text" name="birthName" id="birth" value="<?=$res['birthName'] ?>"><br>
                <label for="date">Birth Date:</label>
                <input type="date" name="birthDate" id="date" value="<?=$res['birthDate'] ?>"><br>
                <label for="home">Hometown:</label>
                <input type="text" name="hometown" id="home" value="<?=$res['hometown'] ?>"><br>
                <label for="death">Death Date (if it is):</label>
                <input type="date" name="deathDate" id="death" value="<?=$res['deathDate'] ?>"><br>
                <label for="fun">Fun Notable Fact:</label>
                <input type="text" name="funNotableFact" id="fun" value="<?=$res['funNotableFact'] ?>"><br>

                <input type="hidden" name="oldName" value="<?=$res['stageName'] ?>">
                <input type="submit" name="update" value="Update information">
            </form>
        </div>
        <?php
    }
}
elseif (isset($_POST['addNew'])) {
    $db->query("INSERT INTO artist (stageName, birthName, birthDate, hometown, deathDate, funNotableFact) VALUES ('{$_POST['stageName']}', '{$_POST['birthName']}', '{$_POST['birthDate']}', '{$_POST['hometown']}', '{$_POST['deathDate']}', '{$_POST['funNotableFact']}');");
    header('Refresh: 2; url=listArtist.php' );
    print('Artist successfully added! Redirect to Artist\'s page');
}
elseif (isset($_POST['update'])) {
    $db->query("UPDATE artist SET stageName = '{$_POST['stageName']}', birthName = '{$_POST['birthName']}', birthDate = '{$_POST['birthDate']}', hometown = '{$_POST['hometown']}', deathDate = '{$_POST['deathDate']}', funNotableFact = '{$_POST['funNotableFact']}' WHERE stageName = '{$_POST['oldName']}';");
    header("Refresh: 2; url=listArtist.php?artist={$_POST['stageName']}" );
    print('Artist information successfully changed! Redirect to Artist page');
}
else {
    require_once 'header.php';
    $get = $db->query("SELECT stageName FROM artist;");
    ?>
    <div class="formBlock" style="padding-top: 5px;">
        <h3>Now you can choose create new artist or edit already exist!</h3>
        <form method="post">
            <label for="artist">Choose artist</label><br><br>
            <select name="artist" id="artist">
                <option selected value="New">New</option>
                <?php while ($res = $get->fetch_assoc()): ?>
                    <option value="<?=$res['stageName'] ?>"><?=$res['stageName'] ?></option>
                <?php endwhile; ?>
            </select><br><br>
            <input type="submit" name="submit" value="Select">
        </form>
    </div>
<?php
}

require_once 'footer.php';