<?php include ("./database/db.config.php") ?>

<?php

$id = $_GET['id'];
$result = $conn->query("SELECT student.*, classes.name AS class_name FROM student JOIN classes ON student.class_id = classes.class_id WHERE student.id = $id");
$student = $result->fetch_assoc();
?>
<?php include("./common/header.php"); ?>
<div class="container mt-5">
        <h1 class="mb-4"><?php echo $student['name']; ?></h1>
        <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
        <p><strong>Address:</strong> <?php echo $student['address']; ?></p>
        <p><strong>Class:</strong> <?php echo $student['class_name']; ?></p>
        <p><strong>Created At:</strong> <?php echo $student['created_at']; ?></p>
        <p><img src='uploads/<?php echo $student['image']; ?>' class='img-thumbnail' width='100'></p>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>
    <?php include("./common/footer.php"); ?>