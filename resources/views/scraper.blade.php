<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
    <style>
        .abc{
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        </style>
</head>

<body>
    <h2>Upload CSV File</h2>

    <form action="{{ route('scraper.search') }}" method="POST">
        @csrf
        <label for="fname">First name:</label><br>
        <input type="text" ><br>
        <label for="lname">Last name:</label><br>
        <input type="text"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>
