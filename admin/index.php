<?php include('admin-head.php'); ?>
<style>
     body {
            background-color: #4e657a;
            font-family: Arial, sans-serif;
            color: #4e657a;
        }
    .container {
            max-width: 1200px;
            margin: auto;
            background-color: #4e657a;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .container h2 {
            text-align: center;
            color: #4e657a;
        }

        .table th, .table td {
            color: white;
        }

        .btn {
            background-color: yellow;
            color: #4e657a;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn:hover {
            background-color: #4e657a;
            color: white;
        }
</style>

<div class="container">
    <h2>User Management</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once('db_connect.php'); // Include your database connection file

            // Fetch user data from the database
            $query = "SELECT * FROM users";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['password'] . '</td>';
                    echo '<td>
                            <a href="edit-user.php?id=' . $row['id'] . '">Edit</a>
                            <a href="delete-user.php?id=' . $row['id'] . '">Delete</a>
                          </td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No users found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('admin-foot.php'); ?>
