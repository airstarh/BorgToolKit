<?php
require_once __DIR__ . '/../index.php';
?>
<?= BorgTemplate::allCss(); ?>
<?= BorgTemplate::allJs(); ?>

<pre>
    <?php
    print_r($_SERVER);
    ?>
</pre>

