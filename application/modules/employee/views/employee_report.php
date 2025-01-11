<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Report</title>
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
    <h2>Employee Report</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($employees): ?>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo $employee->id; ?></td>
                        <td><?php echo $employee->name; ?></td>
                        <td><?php echo $employee->email; ?></td>
                        <td><?php echo $employee->status; ?></td>
                        <td><?php echo $employee->dep_name; ?></td>
                        <td><?php echo $employee->designation; ?></td>
                        <td><?php echo $employee->created_at; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
