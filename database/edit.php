<?php include ("./database/db.config.php"); ?>

<?php
$id = $_GET['id'];
$errors = [];

$id = $conn->real_escape_string($id); 
$result = $conn->query("SELECT * FROM student WHERE id = $id");
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $class_id = $_POST['class_id'];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            $errors[] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
        }

        if (empty($errors)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $image = $conn->real_escape_string($image); // Sanitize image name
            $conn->query("UPDATE student SET image = '$image' WHERE id = $id");
        }
    }

    if (empty($errors)) {
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $address = $conn->real_escape_string($address);
        $class_id = $conn->real_escape_string($class_id);

        $stmt = $conn->prepare("UPDATE student SET name = ?, email = ?, address = ?, class_id = ? WHERE id = ?");
        $stmt->bind_param("sssii", $name, $email, $address, $class_id, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php');
    }
}

$classes = $conn->query("SELECT * FROM classes");
?>
<?php include("./common/header.php"); ?>
<h1 class="mb-4">Edit Student</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($student['name']); ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($student['email']); ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea name="address" class="form-control" required><?php echo htmlspecialchars($student['address']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="class_id">Class:</label>
        <select name="class_id" class="form-control">
            <?php while ($class = $classes->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($class['class_id']); ?>" <?php if ($student['class_id'] == $class['class_id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($class['name']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" class="form-control-file" accept="image/*">
        <p><img src='uploads/<?php echo htmlspecialchars($student['image']); ?>' class='img-thumbnail' width='100'></p>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>
<?php include("./common/footer.php"); ?>
