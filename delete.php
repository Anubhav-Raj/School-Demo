<?php include("./database/db.config.php"); ?>

<?php
$id = $_GET['id'];
$id = $conn->real_escape_string($id); 

$errors = [];

$result = $conn->query("SELECT * FROM student WHERE id = $id");
$student = $result->fetch_assoc();

if (!$student) {
    die('Student not found!');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
        // Delete image from the server
        if (file_exists("uploads/" . $student['image'])) {
            unlink("uploads/" . $student['image']);
        }

        $stmt = $conn->prepare("DELETE FROM student WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        header('Location: index.php');
        exit;
    } else {
        header('Location: index.php');
        exit;
    }
}
?>

<?php include("./common/header.php"); ?>
<h1 class="mb-4">Delete Student</h1>

<p>Are you sure you want to delete the student: <strong><?php echo htmlspecialchars($student['name']); ?></strong>?</p>

<form method="post">
    <div class="form-group">
        <button type="submit" name="confirm" value="yes" class="btn btn-danger">Yes, Delete</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<?php include("./common/footer.php"); ?>
