<?php include ("./database/db.config.php") ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $conn->query("INSERT INTO classes (name) VALUES ('$name')");
    header('Location: classes.php');
}

$classes = $conn->query("SELECT * FROM classes");
?>
<?php include("./common/header.php"); ?>
<h1 class="mb-4">Classes</h1>
        <form method="post" class="mb-4">
            <div class="form-group">
                <label for="name">Class Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Class</button>
        </form>
        
        <?php
        if ($classes->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<tr><th>Class Name</th><th>Actions</th></tr>";
            while ($class = $classes->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$class['name']}</td>";
                echo "<td><a href='edit_class.php?id={$class['class_id']}' class='btn btn-warning btn-sm'>Edit</a> ";
                echo "<a href='delete_class.php?id={$class['class_id']}' class='btn btn-danger btn-sm'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No classes found.</p>";
        }
        $conn->close();
        ?>
<?php include("./common/footer.php"); ?>