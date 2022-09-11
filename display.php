<?php
session_start();
?>

<ul>
    <?php foreach ($_SESSION['json-array'] as $key => $data ) {?>
    <li> <strong><?php echo $key;?></strong> : <?php echo $data;?> </li>
    <?php }?>
</ul>
