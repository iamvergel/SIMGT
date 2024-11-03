<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grades Report</title>
    <style>
        body { font-family: "Poppins", sans-serif; }
        h1, h2 { text-align: center; }
        ul { list-style-type: none; }
    </style>
</head>
<body>
    <h1>St. Emilie Learning Center</h1>
    <p>Student Number: {{ $student->student_number }}</p>
    <p>Name: {{ $student->student_last_name . ' ' . $student->student_first_name }}</p>
    <p>Grade Section: {{ $student->grade . ' ' . $student->section }}</p>
    <p>Date: {{ now()->format('Y-m-d') }}</p>
    <h2>Grades for {{ $gradeRecord->grade }} - {{ $gradeRecord->quarter }}</h2>
    <ul>
        <li>Subject 1: {{ $gradeRecord->subject_one ?? 'N/A' }}</li>
        <li>Subject 2: {{ $gradeRecord->subject_two ?? 'N/A' }}</li>
        <li>Subject 3: {{ $gradeRecord->subject_three ?? 'N/A' }}</li>
        <li>Subject 4: {{ $gradeRecord->subject_four ?? 'N/A' }}</li>
        <li>Subject 5: {{ $gradeRecord->subject_five ?? 'N/A' }}</li>
        <li>Subject 6: {{ $gradeRecord->subject_six ?? 'N/A' }}</li>
        <li>Subject 7: {{ $gradeRecord->subject_seven ?? 'N/A' }}</li>
        <li>Subject 8: {{ $gradeRecord->subject_eight ?? 'N/A' }}</li>
        <li>Subject 9: {{ $gradeRecord->subject_nine ?? 'N/A' }}</li>
    </ul>
</body>
</html>
