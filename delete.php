<?php

require("SRC/Link.php");

$data;

if(isset($_POST['id'])) {
    $data = DBcommand("SELECT * FROM verjaardagen WHERE `id` = :id", [':id' => $_POST['id']])['output'];
    if(count($data) != 1) {
        header("location: index.php");
    }

    if(isset($_POST['question'])) {
        if($_POST['question'] == "YES") {
            echo DBcommand("DELETE FROM verjaardagen WHERE `id` = :id", [':id' => $_POST['id']])['errorcode'];
        }

        header("location: index.php");
    }
} else {
    header("location: index.php");
}

?>

<form action="" method="post">
    <input type="hidden" name="id" value="<?= $_POST['id'] ?>" id="id">
    <label for="question">Are you sure you want to delete <?= $data[0]['name'] ?>? Type "YES" to continue;</label><input type="text" name="question" id="question">
    <input type="submit" value="Delete">
</form>