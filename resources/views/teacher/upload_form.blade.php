<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel</title>
</head>
<body>

    <h1>Upload Excel File</h1>

    <form action="{{ route('grade.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx,.xls,.csv" required>
        <button type="submit">Upload</button>
    </form>

</body>
</html>
