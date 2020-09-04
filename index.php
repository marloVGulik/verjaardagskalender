<?php

require("SRC/Link.php");

$bdays = DBcommand("SELECT * FROM verjaardagen ORDER BY `date`")['output'];



?>



<table style="width:90%; margin: 2rem auto">
    <tr>
        <th>Name</th>
        <th>Birthday</th>
        <th>Actions</th>
    </tr>
    <?php foreach($bdays as $bday) { ?><tr>
        <td><?= $bday['name'] ?></td>  
        <td><?= date("F d", strtotime($bday['date'])) ?></td>  
        <td>
            <form action="edit.php" method="post" class="d-inline">
                <input type="hidden" name="id" value="<?= $bday['id'] ?>">
                <input type="submit" value="Edit" class="btn btn-outline-warning">
            </form>
            <form action="delete.php" method="post" class="d-inline">
                <input type="hidden" name="id" value="<?= $bday['id'] ?>">
                <input type="submit" value="Delete" class="btn btn-outline-danger">
            </form>
        </td>
    <?php } ?></tr>
</table> 

</body>
</html>