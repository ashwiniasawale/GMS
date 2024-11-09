<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrer Form Submission</title>
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

    <h2>New Career Form Submission</h2>
    <p>You have received a new message from the career form. Here are the details:</p>
    <table>
        <tr>
            <th>Job Position</th>
            <td>{{ $career['jobapply'] }}</td>
            <th>Name</th>
            <td>{{ $career['name'] }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $career['email'] }}</td>
            <th>Contact</th>
            <td>{{ $career['contact'] }}</td>
        </tr>
        <tr>
            <th>Reason</th>
            <td>{{ $career['reason'] }}</td>
            <th>CV</th>
            <td>{{ $career['cv'] }}</td>
        </tr>
        <tr>
            <th>Notice Period(Month)</th>
            <td>{{ $career['notice_period'] }}</td>
            <th>Current CTC</th>
            <td>{{ $career['current_ctc'] }}</td>
        </tr>
        <tr>
            <th>Expected CTC</th>
            <td>{{ $career['expected_ctc'] }}</td>
            <th>Total Experience(Year)</th>
            <td>{{ $career['total_experience'] }}</td>
        </tr>
        <tr>
            <th>Note</th>
            <td>{{ $career['note'] }}</td>
            <th>Relevant Experience(Year)</th>
            <td>{{ $career['tech_experience'] }}</td>
        </tr>
    </table>
</body>
</html>
