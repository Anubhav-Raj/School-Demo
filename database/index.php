
<?php include("./common/header.php"); ?>
<?php include ("./database/db.config.php") ?>
<h1 class="mb-4">Student List</h1>
        <a href='create.php' class="btn btn-primary mb-3">Create Student</a>
        <a href='classes.php' class="btn btn-secondary mb-3">Manage Classes</a>

        <?php
        $result = $conn->query("SELECT student.*, classes.name AS class_name FROM student JOIN classes ON student.class_id = classes.class_id");

        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<tr><th>Name</th><th>Email</th><th>Class</th><th>Image</th><th>Actions</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['class_name']}</td>";
                echo "<td><img src='uploads/{$row['image']}' class='img-thumbnail' width='50'></td>";
                echo "<td><a href='view.php?id={$row['id']}' class='btn btn-info btn-sm'>View</a> ";
                echo "<a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a> ";
                echo "<a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No students found.</p>";
        }

        $conn->close();
        ?>
        <?php include("./common/footer.php"); ?>
