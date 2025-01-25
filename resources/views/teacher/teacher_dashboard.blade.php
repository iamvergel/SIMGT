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

            <!-- File input for uploading Excel files -->
            <input type="file" id="file-input" accept=".xlsx, .xls" />

            <!-- Table where the data will be imported -->
            <table id="example" class="display">
                <thead>
                    <!-- Column headers will be dynamic based on Excel -->
                </thead>
                <tbody>
                    <!-- Data rows will be added dynamically -->
                </tbody>
            </table>

            <script>
                $(document).ready(function () {
                    // Initialize an empty DataTable, but don't call it yet
                    var table;

                    // Handle file input
                    $('#file-input').on('change', function (e) {
                        var file = e.target.files[0];
                        if (file && file.name.endsWith('.xlsx')) {
                            var reader = new FileReader();
                            reader.onload = function (event) {
                                var data = event.target.result;
                                var workbook = XLSX.read(data, { type: 'binary' });

                                // Assuming the first sheet is what we want
                                var sheetName = workbook.SheetNames[0];
                                var worksheet = workbook.Sheets[sheetName];

                                // Convert sheet to JSON (array of arrays)
                                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

                                // Clear existing table data (in case there was any before)
                                $('#example thead').empty();
                                $('#example tbody').empty();

                                // Set table headers (first row of the JSON data)
                                var headers = jsonData[0];
                                var headerRow = headers.map(function (header) {
                                    return '<th>' + header + '</th>';
                                }).join('');
                                $('#example thead').html('<tr>' + headerRow + '</tr>');

                                // Add table rows from the JSON data (excluding the header)
                                var rows = jsonData.slice(1);
                                rows.forEach(function (row) {
                                    var rowData = row.map(function (cell) {
                                        return '<td>' + cell + '</td>';
                                    }).join('');
                                    $('#example tbody').append('<tr>' + rowData + '</tr>');
                                });

                                // Now initialize the DataTable (after table data is fully populated)
                                if (!$.fn.DataTable.isDataTable('#example')) {
                                    table = $('#example').DataTable({
                                        responsive: true,
                                        paging: true,
                                        searching: true,
                                        ordering: true
                                    });
                                } else {
                                    table.clear().draw();  // Clear and redraw the table if already initialized
                                    table.rows.add($('#example').find('tbody tr')).draw(); // Add new rows
                                }
                            };

                            // Read the Excel file as binary string
                            reader.readAsBinaryString(file);
                        } else {
                            alert("Please upload a valid Excel file (.xlsx)");
                        }
                    });
                });
            </script>


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