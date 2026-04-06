<?php
include 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : die("No ID provided");

// Update Record
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $query = "UPDATE student SET name='$name', email='$email', mobile='$mobile', department='$department' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating: " . mysqli_error($conn);
    }
}

// Fetch existing data
$result = mysqli_query($conn, "SELECT * FROM student WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Student not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f4f4; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        form { background: #e9e9e9; padding: 20px; border-radius: 10px; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 15px; border: 1px solid #ccc; border-radius: 5px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .cancel { background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-left: 10px; }
        .cancel:hover { background: #5a6268; }
        h2 { color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>✏️ Edit Student Record</h2>
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            
            <label>Mobile:</label>
            <input type="text" name="mobile" value="<?php echo htmlspecialchars($row['mobile']); ?>" required>
            
            <label>Department:</label>
            <select name="department" required>
                <option value="Computer Science" <?php echo ($row['department'] == 'Computer Science') ? 'selected' : ''; ?>>Computer Science</option>
                <option value="Information Technology" <?php echo ($row['department'] == 'Information Technology') ? 'selected' : ''; ?>>Information Technology</option>
                <option value="Electronics" <?php echo ($row['department'] == 'Electronics') ? 'selected' : ''; ?>>Electronics</option>
                <option value="Mechanical" <?php echo ($row['department'] == 'Mechanical') ? 'selected' : ''; ?>>Mechanical</option>
                <option value="Civil" <?php echo ($row['department'] == 'Civil') ? 'selected' : ''; ?>>Civil</option>
            </select>
            
            <button type="submit" name="update">💾 Update Record</button>
            <a href="index.php" class="cancel">Cancel</a>
        </form>
    </div>
</body>
</html>