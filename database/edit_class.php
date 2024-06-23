<?php include ("./database/db.config.php") ?>

<?php

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM classes WHERE class_id = $id");
$class = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $conn->query("UPDATE classes SET name = '$name' WHERE class_id = $id");
    header('Location: classes.php');
}
?>
<?php include("./common/header.php"); ?>
<h1 class="mb-4">Edit Class</h1>
        <form method="post">
            <div class="form-group">
                <label for="name">Class Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $class['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Update Class</button>
        </form>
        <?php include("./common/footer.php"); ?>