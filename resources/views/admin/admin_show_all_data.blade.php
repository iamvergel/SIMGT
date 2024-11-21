<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.0/css/buttons.dataTables.min.css">

    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scrollbar-width: thin;
            transition: all 0.3s ease;
            cursor: default;
        }

        .dataTables_filter input {
            width: 200px;
            font-size: 14px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }

        .dataTables_filter label {
            font-size: 14px;
            margin-right: 10px;
        }

        .dropdown {
            display: none;
        }

        .dropdown-active {
            display: block;
        }
    </style>
</head>

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="">
                @include('admin.includes.header')
            </header>

            <div class="p-5">
                <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                <p class="text-2xl font-bold text-teal-900 ml-5">
                    <span onclick="window.location.href ='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                        class="hover:text-teal-700">Student Management</span> / All Student Data
                </p>
                <div class="w-24 mt-5 ml-5 text-[12px] text-white shadow-lg bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full py-2 text-center"
                    onclick="window.history.back();"><i class="fas fa-arrow-left" style="color: white;"></i> Go Back
                </div>

                <!-- Search Bar -->
                <div class="mt-10 ml-5 flex justify-end items-center">
                    <div class="flex items-center hidden">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-80 shadow-lg focus:outline-none" />
                    </div>

                    <div class="mr-10">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Select Grade<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown"
                            class="z-10 fixed hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="p-2 text-md text-gray-700 dark:text-gray-200 shadow-lg"
                                aria-labelledby="dropdownDefaultButton">
                                <!-- Default placeholder value (empty or custom message) -->
                                <li>
                                    <a href="#" class="dropdown-item text-gray-500">Select a Grade</a>
                                </li>
                                <!-- Dropdown items will be injected here by AJAX -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main modal -->
                @include('admin.includes.add_student_form')

                @if (session('success'))
                    <script>
                        alert("{{ session('success') }}");
                    </script>
                @endif
                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                    <div class="w-full bg-white mb-8 rounded-lg shadow-lg text-[12px]">
                        <div class="w-full h-full overflow-auto border-4 border-teal-50 rounded-lg p-10">
                            @if ($noActiveMessage)
                                <p class="text-red-600 text-center text-md">{{ $noActiveMessage }}</p>
                            @else
                                                    <table id="studentTable" class="display w-full h-full p-5 " style="width: 200rem;">
                                                        <thead class="table-header bg-gray-100">
                                                            <tr class="text-md font-semibold tracking-wide text-left uppercase border">
                                                                <th class="px-4 py-3">Student Number</th>
                                                                <th class="px-4 py-3">LRN</th>
                                                                <th class="px-4 py-3">School Year</th>
                                                                <th class="px-4 py-3">Section</th>
                                                                <th class="px-4 py-3">Status</th>
                                                                <th class="px-4 py-3">Name</th>
                                                                <th class="px-4 py-3">Grade</th>
                                                                <th class="px-4 py-3">Email</th>
                                                                <th class="px-4 py-3">Place of Birth</th>
                                                                <th class="px-4 py-3">Date of Birth</th>
                                                                <th class="px-4 py-3">Sex</th>
                                                                <th class="px-4 py-3">Age</th>
                                                                <th class="px-4 py-3">Contact Number</th>
                                                                <th class="px-4 py-3">Religion</th>
                                                                <th class="px-4 py-3">Address</th>
                                                                <th class="px-4 py-3">Father's Name</th>
                                                                <th class="px-4 py-3">Mother's Name</th>
                                                                <th class="px-4 py-3">Guardian's Name</th>
                                                                <th class="px-4 py-3">Emergency Contact</th>
                                                                <th class="px-4 py-3">Contact Number</th>
                                                                <th class="px-4 py-3">Messenger Account</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white" id="tableBody">
                                                            @foreach ($students as $student)
                                                                                            <tr class="text-gray-700 table-row" onclick="openStudentModal(this)"
                                                                                                data-student-id="{{ $student->id }}"
                                                                                                data-status="{{ $student->status }}"
                                                                                                data-student-number="{{ $student->student_number }}"
                                                                                                data-lrn="{{ $student->lrn }}"
                                                                                                data-school-year="{{ $student->school_year }}"
                                                                                                data-school="{{ $student->School }}"
                                                                                                data-grade="{{ $student->grade }}"
                                                                                                data-section="{{ $student->section }}"
                                                                                                data-last-name="{{ $student->student_last_name }}"
                                                                                                data-first-name=" {{ $student->student_first_name }}"
                                                                                                data-middle-name="{{ $student->student_middle_name }}"
                                                                                                data-suffix-name="{{ $student->student_suffix_name }}"
                                                                                                data-email="{{ $student->email_address_send }}"
                                                                                                data-place-of-birth="{{ $student->place_of_birth }}"
                                                                                                data-birth-date="{{ \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') }}"
                                                                                                data-sex="{{ $student->sex }}"
                                                                                                data-age="{{ $student->age }}"
                                                                                                data-contact-number="{{ $student->contact_number }}"
                                                                                                data-religion="{{ $student->religion }}"
                                                                                                data-house-number="{{ $student->house_number }}"
                                                                                                data-street="{{ $student->street }}"
                                                                                                data-barangay="{{ $student->barangay }}"
                                                                                                data-city="{{ $student->city }}"
                                                                                                data-province="{{ $student->province }}"
                                                                                                @php
                                                                                                    $account = $studentAccount[$student->student_number] ?? null;
                                                                                                    $avatar = $account && $account->avatar ? asset('storage/' . $account->avatar) : null;
                                                                                                    $initials = strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1));
                                                                                                @endphp
                                                                                                data-avatar="{{ $avatar }}"
                                                                                                data-initials="{{ $initials }}"
                                                                                                data-username="{{ $account->username }}"

                                                                                                @php
                                                                                                    $additionalInfo = $studentsAdditional[$student->student_number];
                                                                                                @endphp
                                                                                                
                                                                                                data-father-last-name="{{$additionalInfo ? $additionalInfo->father_last_name : ''}}"
        data-father-first-name="{{ $additionalInfo ? $additionalInfo->father_first_name : '' }}"
        data-father-middle-name="{{ $additionalInfo ? $additionalInfo->father_middle_name : '' }}"
        data-father-suffix="{{ $additionalInfo ? $additionalInfo->father_suffix : '' }}"
        data-father-occupation="{{ $additionalInfo ? $additionalInfo->father_occupation : '' }}"

        data-mother-last-name="{{ $additionalInfo ? $additionalInfo->mother_last_name : '' }}"
        data-mother-first-name="{{ $additionalInfo ? $additionalInfo->mother_first_name : '' }}"
        data-mother-middle-name="{{ $additionalInfo ? $additionalInfo->mother_middle_name : '' }}"
        data-mother-occupation="{{ $additionalInfo ? $additionalInfo->mother_occupation : '' }}"

        data-guardian-last-name="{{ $additionalInfo ? $additionalInfo->guardian_last_name : '' }}"
        data-guardian-first-name="{{ $additionalInfo ? $additionalInfo->guardian_first_name : '' }}"
        data-guardian-middle-name="{{ $additionalInfo ? $additionalInfo->guardian_middle_name : '' }}"
        data-guardian-suffix="{{ $additionalInfo ? $additionalInfo->guardian_suffix : '' }}"
        data-guardian-relationship="{{ $additionalInfo ? $additionalInfo->guardian_relationship : '' }}"
        data-guardian-contact="{{ $additionalInfo ? $additionalInfo->guardian_contact_number : '' }}"
        data-guardian-religion="{{ $additionalInfo? $additionalInfo->guardian_religion : '' }}"

        data-emergency-contact-person="{{ $additionalInfo ? $additionalInfo->emergency_contact_person : '' }}"
        data-emergency-contact-number="{{ $additionalInfo ? $additionalInfo->emergency_contact_number : '' }}"
        data-emergency-email="{{ $additionalInfo ? $additionalInfo->email_address : '' }}"
        data-emergency-messenger="{{ $additionalInfo ? $additionalInfo->messenger_account : '' }}"
        data-birth-certificate="{{ isset($studentDocuments[$student->student_number]) ? asset('storage/' . $studentDocuments[$student->student_number]->birth_certificate) : 'N/A' }}"
    data-proof-of-residency="{{ isset($studentDocuments[$student->student_number]) ? asset('storage/' . $studentDocuments[$student->student_number]->proof_of_residency) : 'N/A' }}">
                                                                                                
                                                                                                <td class="px-4 py-3 h-28 border flex items-center mt-2 w-40">
                                                                                                    <div class="w-12 h-12 rounded-full bg-gray-500 text-white flex items-center justify-center font-bold">
                                                                                                        @if ($avatar)
                                                                                                            <img src="{{ $avatar }}" alt="Student Avatar" class="w-12 h-12 rounded-full object-cover">
                                                                                                        @else
                                                                                                            {{ $initials }}
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <span class="ml-2">{{ $student->student_number }}</span>
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">{{ $student->lrn }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->school_year }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->section }}</td>
                                                                                                <td class="px-4 py-3 text-xs border">
                                                                                                    <span
                                                                                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                                                                        {{ $student->status }}
                                                                                                    </span>
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">{{ $student->student_last_name }}
                                                                                                    {{ $student->student_first_name }} {{ $student->student_middle_name }}
                                                                                                    {{ $student->student_suffix_name }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->grade }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->email_address_send }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->place_of_birth }}</td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->sex }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->age }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->contact_number }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->religion }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->house_number }},
                                                                                                    {{ $student->street }}, {{ $student->barangay }}, {{ $student->city }},
                                                                                                    {{ $student->province }}</td>
                                                                                                @php
                                                                                                    $additionalInfo = $studentsAdditional[$student->student_number] ?? null;
                                                                                                @endphp
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->father_last_name . ', ' . $additionalInfo->father_first_name . $additionalInfo->father_suffix_name : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->mother_last_name . ', ' . $additionalInfo->mother_first_name : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->guardian_last_name . ', ' . $additionalInfo->guardian_first_name . $additionalInfo->guardian_suffix_name : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->emergency_contact_person : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->emergency_contact_number : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->messenger_account : 'N/A' }}</td>
                                                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </main>

        @include('admin.includes.show_student_profile')

    </div>

    <script src="{{ asset('../js/admin/admin.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.print.min.js"></script>
</body>

</html>