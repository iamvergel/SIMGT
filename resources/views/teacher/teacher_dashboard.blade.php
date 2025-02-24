<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>St. Emilie Learning Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon"
        style="border-radius: 50%;">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/20a0e1e87d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!-- Include SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
            scrollbar-width: thin;
        }

        /* Styling for file input and table */
        #file-input {
            margin: 20px;
        }

        table.dataTable {
            border-collapse: collapse;
            width: 100%;
        }

        table.dataTable th,
        table.dataTable td {
            padding: 12px;
            text-align: left;
        }

        table.dataTable thead {
            background-color: #f1f1f1;
        }

        table.dataTable tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body class="font-poppins bg-gray-200">

    <div class="flex flex-col lg:flex-row lg:p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('teacher.includes.sidebar')

        <!-- Main Content -->
        <main
            class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-hidden overflow-y-scroll">
            @include('teacher.includes.header')

            <div class="p-5 py-3">
                <p class="text-[15px] font-normal text-teal-900 mt-5">Teacher</p>
                <h1 class="text-xl font-bold text-teal-900">Dashboard</h1>
            </div>

            <h2>Import Excel Data into DataTable</h2>

            @if(session('success'))
                <p style="color:green;">{{ session('success') }}</p>
            @endif

            <form action="{{ route('grades.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="teacher_number">Teacher Number:</label>
                <input type="text" id="teacher_number" name="teacher_number" required>
                <br>

                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject">
                <br>

                <label for="grade">Grade:</label>
                <input type="text" id="grade" name="grade">
                <br>

                <label for="section">Section:</label>
                <input type="text" id="section" name="section">
                <br>

                <label for="excelfile">Excel File:</label>
                <input type="file" id="excelfile" name="excelfile" accept=".xlsx,.csv">
                <br><br>

                <button type="submit">Upload Grade</button>
            </form>


            <div class="grid grid-cols-2">
                <div class="col-span-2 lg:col-span-1 p-5">
                    <div class="bg-white rounded-lg col-span-4 lg:col-span-4 xl:col-span-4 border-2 shadow-lg"></div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>