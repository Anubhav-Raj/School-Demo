<?php include ("./database/db.config.php"); ?>

<?php
$errors = [];

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
        }
    } else {
        $errors[] = "Image is required.";
    }

    if (empty($errors)) {
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $address = $conn->real_escape_string($address);
        $class_id = $conn->real_escape_string($class_id);
        $image = $conn->real_escape_string($image);

        $stmt = $conn->prepare("INSERT INTO student (name, email, address, class_id, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $name, $email, $address, $class_id, $image);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php');
    }
}

$classes = $conn->query("SELECT * FROM classes");
?>
<?php include("./common/header.php"); ?>
<h1 class="mb-4">Create Student</h1>

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
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name ?? ''); ?>">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea name="address" class="form-control"><?php echo htmlspecialchars($address ?? ''); ?></textarea>
    </div>
    <div class="form-group">
        <label for="class_id">Class:</label>
        <select name="class_id" class="form-control">
            <?php while ($class = $classes->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($class['class_id']); ?>" <?php echo (isset($class_id) && $class_id == $class['class_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($class['name']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" class="form-control-file" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
<?php include("./common/footer.php"); ?>
