<?php
require("SRC/Link.php");

$data;

if(isset($_POST['id'])) {
    if(isset($_POST['name']) && isset($_POST['date'])) {
        DBcommand("UPDATE verjaardagen SET `name` = :name, `date` = :date WHERE `id` = :id", [':name' => $_POST['name'], ':date' => $_POST['date'], ':id' => $_POST['id']]);
        header("location: index.php");
    }

    $data = DBcommand("SELECT * FROM verjaardagen WHERE `id` = :id", [':id' => $_POST['id']])['output'];
    if(count($data) != 1) {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}



?>

<form action="" method="post" class="col-11">
    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
    <label for="name">Name:</label><input type="text" name="name" id="name" value="<?= $data[0]['name'] ?>">
    <label for="date">Date:</label><input type="date" name="date" id="date" value="<?= $data[0]['date'] ?>">
    <input type="submit" value="Apply" class="btn btn-outline-primary">
</form>