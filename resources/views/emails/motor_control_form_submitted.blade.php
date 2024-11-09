<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Controller Form Submission</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>New Motor Controller Form Submission</h2>
    <p>You have received a new message from the motor controller form. Here are the details:</p>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $motor['name'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $motor['email'] }}</td>
        </tr>
        <tr>
            <th>Company Name</th>
            <td>{{ $motor['company_name'] }}</td>
        </tr>
        <tr>
            <th>Contact</th>
            <td>{{ $motor['contact'] }}</td>
        </tr>
    </table>
</body>
</html>
