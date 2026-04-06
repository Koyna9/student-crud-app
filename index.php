<?php
include 'db.php';

// Insert Record
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $query = "INSERT INTO student (name, email, mobile, department) VALUES ('$name', '$email', '$mobile', '$department')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f4f4; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        form { background: #e9e9e9; padding: 20px; width: 450px; border-radius: 10px; margin-bottom: 20px; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 15px; border: 1px solid #ccc; border-radius: 5px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #007bff; color: white; }
        .edit { background: #ffc107; color: #333; padding: 5px 10px; text-decoration: none; border-radius: 3px; margin-right: 5px; }
        .delete { background: #dc3545; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .edit:hover { background: #e0a800; }
        .delete:hover { background: #c82333; }
        h2 { color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📚 Student Details Entry Form </h2>
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Mobile:</label>
            <input type="text" name="mobile" required>
            
            <label>Department:</label>
            <select name="department" required>
                <option value="">Select Department</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Electronics">Electronics</option>
                <option value="Mechanical">Mechanical</option>
                <option value="Civil">Civil</option>
            </select>
            
            <button type="submit" name="submit">➕ Add Student</button>
        </form>

        <h2>📋 Student Records</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM student ORDER BY id DESC");
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['mobile']}</td>
                            <td>{$row['department']}</td>
                            <td>
                                <a class='edit' href='edit.php?id={$row['id']}'>✏️ Edit</a>
                                <a class='delete' href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")'>🗑️ Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
