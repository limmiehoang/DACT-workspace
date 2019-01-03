<?php
$page = 'group';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <div class="well">
            <h2>Add a group</h2>
            <?php // print display_errors(); ?>
            <form class="form-horizontal" method="post" action="../controllers/addGroup.php">
                <?php include __DIR__ . '/inc/groupForm.php' ?>
            </form>
        </div>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>