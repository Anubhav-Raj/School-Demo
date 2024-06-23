<?php include ("./database/db.config.php") ?>

<?php

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn->query("DELETE FROM classes WHERE class_id = $id");
    header('Location: classes.php');
}
?>
<?php include("./common/header.php"); ?>

<h1 class="mb-4">Delete Class</h1>
        <p>Are you sure you want to delete this class?</p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Yes</button>
            <a href="classes.php" class="btn btn-secondary">No</a>
        </form>
        <?php include("./common/footer.php"); ?>

