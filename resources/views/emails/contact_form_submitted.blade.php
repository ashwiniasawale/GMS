<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
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

    <h2>New Contact Form Submission</h2>
    <p>You have received a new message from the contact form. Here are the details:</p>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $contact['name'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $contact['email'] }}</td>
        </tr>
        <tr>
            <th>Subject</th>
            <td>{{ $contact['subject'] }}</td>
        </tr>
        <tr>
            <th>Message</th>
            <td>{{ $contact['message'] }}</td>
        </tr>
    </table>
</body>
</html>
