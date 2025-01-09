<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>All Users</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact info</th>
                <th>Designation</th>
                <th>Status</th>
                <th>Department</th>
                <th>Role</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_users as $user): ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->contact_info; ?></td>
                <td><?php echo $user->designation; ?></td>
                <td><?php echo $user->status; ?></td>
                <td><?php echo $user->dep_name; ?></td>
                <td><?php echo $user->role; ?></td>
                <td><?php echo $user->created_at; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>