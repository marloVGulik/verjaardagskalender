<?php
require("SRC/Link.php");

if(isset($_POST['name']) && isset($_POST['date'])) {
    DBcommand("INSERT INTO verjaardagen (`id`, `name`, `date`) VALUES (NULL, :name, :date)", [':name' => $_POST['name'], ':date' => $_POST['date']]);
    header("location: index.php");
}

?>

<form action="" method="post" class="col-11">
    <label for="name">Name:</label><input type="text" name="name" id="name">
    <label for="date">Date:</label><input type="date" name="date" id="date">
    <input type="submit" value="Create new" class="btn btn-outline-primary">
</form>