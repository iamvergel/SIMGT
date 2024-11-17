<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>St. Emilie Learning Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/20a0e1e87d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #f3f4f6;
            /* Tailwind gray-200 */
        }
    </style>
</head>

<body>
    <div class="flex flex-col lg:flex-row lg:p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('student.includes.sidebar')

        <!-- Main Content -->
        <main
            class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-hidden overflow-y-scroll">
            @include('student.includes.header')

            <div class="p-5 py-3">
                <p class="text-[15px] font-normal text-teal-900 mt-5">Student</p>
                <h1 class="text-xl font-bold text-teal-900">Your Grades</h1>
            </div>

            <div class="p-2 lg:p-10">
                <div class="p-2 lg:p-10 bg-gray-100 rounded-lg shadow-lg">
                    <div class="my-3">
                        <label for="gradesSelect" class="text-gray-900 text-[15px] font-semibold">Select Your Quarterly
                            Grade:</label>
                        <div class="mt-3">
                            <select id="gradesSelect"
                                class="border text-gray-900 text-[15px] p-2 px-5 border-gray-500 rounded-md mb-4 w-full lg:w-1/2">
                                <option value="">Select Your Quarterly Grade</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <div id="gradesContainer" class="mt-4 hidden">
                        <div id="grades" class="space-y-4"></div>
                        <button id="downloadHtmlButton" class="bg-teal-700 hover:bg-teal-800 text-white py-2 px-4 rounded mt-4">Download
                            As
                            PDF</button>
                    </div>

                    <p class="text-red-900 text-[14px] mt-5 bg-red-300 rounded-md" id="alert"></p>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const studentNumber = '{{ session("student_id") }}';
            const studentName = '{{ session("student_last_name") . ' ' . session("student_first_name") . ' ' . session("student_middle_name") }}';
            const gender = '{{ session("sex") }}';
            const grade = '{{ session("grade")  }}';
            const section = '{{ session("section")}}';
            const schoolYear = '{{ session("school_year")  }}';
            const status = '{{ session("status") }}';
            const currentDate = new Date().toLocaleDateString();

            fetchGrades();

            $('#gradesSelect').on('change', function () {
                const selectedValue = $(this).val();
                if (selectedValue) {
                    const [gradeKey, quarter] = selectedValue.split('|');
                    displayGradeDetails(window.gradeData[gradeKey][quarter]);
                } else {
                    $('#gradesContainer').hide();
                }
            });

            $('#downloadHtmlButton').on('click', function () {
                const selectedValue = $('#gradesSelect').val();
                if (selectedValue) {
                    const [gradeKey, quarter] = selectedValue.split('|');
                    const gradeRecord = window.gradeData[gradeKey][quarter];

                    if (gradeRecord) {
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();
                        const logoUrl = '{{ asset("../assets/images/SELC.png") }}';
                        const topMargin = 5;

                        // Add logo and name to the PDF
                        const logoWidth = 15; // width of the logo
                        const logoHeight = 15; // height of the logo
                        doc.addImage(logoUrl, 'PNG', 10, 10, logoWidth, logoHeight);

                        // Center the title
                        const title = "St. Emilie Learning Center";
                        doc.setFontSize(20);
                        doc.setTextColor(40, 40, 40);
                        const titleWidth = doc.getTextWidth(title);
                        const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
                        doc.text(title, titleX, 18);

                        // Center the address
                        const address = "Amparo Village, 18 Bangkal, Caloocan, Metro Manila";
                        doc.setFontSize(10);
                        doc.setTextColor(0, 0, 0);
                        const addressWidth = doc.getTextWidth(address);
                        const addressX = (doc.internal.pageSize.width - addressWidth) / 2;
                        doc.text(address, addressX, 23);

                        // Center the address
                        const quarterschoolYear = `${quarter}, School Year ${schoolYear}`;
                        doc.setFontSize(10);
                        doc.setTextColor(0, 0, 0);
                        const quarterschoolYearWidth = doc.getTextWidth(quarterschoolYear);
                        const quarterschoolYearX = (doc.internal.pageSize.width - quarterschoolYearWidth) / 2;
                        doc.text(quarterschoolYear, quarterschoolYearX, 28);

                        // Center the address
                        const report = "UNOFFICIAL REPORT OF GRADES";
                        doc.setFontSize(22);
                        doc.setTextColor(0, 0, 0);
                        const reportWidth = doc.getTextWidth(report);
                        const reportX = (doc.internal.pageSize.width - reportWidth) / 2;
                        doc.text(report, reportX, 43);

                        const leftColumnX = 10;
                        const rightColumnX = 150; // Adjust this value as needed for spacing
                        const astartY = 55; // Fixed starting Y position

                        doc.setFontSize(10);

                        // Left column
                        doc.text(`Fullname       :  ${studentName}`, leftColumnX, astartY);
                        doc.text(`Gender          :  ${gender}`, leftColumnX, astartY + 5);
                        doc.text(`Grade            :  ${grade}`, leftColumnX, astartY + 10);
                        doc.text(`Section          :  ${section}`, leftColumnX, astartY + 15);

                        // Right column
                        doc.text(`Student No        :  ${studentNumber}`, rightColumnX, astartY);
                        doc.text(`Academic Year  :  ${schoolYear}`, rightColumnX, astartY + 5);
                        doc.text(`Date                   :  ${currentDate}`, rightColumnX, astartY + 10);
                        doc.text(`Status                :  ${status}`, rightColumnX, astartY + 15);

                        // Create a new Date object
                        const currentDateTime = new Date();

                        // Format the date and time (e.g., "YYYY-MM-DD HH:mm:ss")
                        const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
                        const datePrinted = currentDateTime.toLocaleString('en-GB', options).replace(',', '');

                        doc.text(`Grade for ${gradeKey}, ${quarter}`, leftColumnX, astartY + 23);
                        doc.text(`Date Printed : ${datePrinted} [${studentName}]`, leftColumnX, astartY + 155);

                        // Function to get subjects based on grade key
                        function getSubjectsForGrade(gradeKey, gradeRecord) {
                            const gradeLevels = {
                                'grade_one': [
                                    { name: 'Basic Math', grade: gradeRecord.subject_one || 'N/A' },
                                    { name: 'Reading Fundamentals', grade: gradeRecord.subject_two || 'N/A' },
                                    { name: 'Simple Science', grade: gradeRecord.subject_three || 'N/A' },
                                    { name: 'Art and Craft', grade: gradeRecord.subject_four || 'N/A' },
                                    { name: 'Social Skills', grade: gradeRecord.subject_five || 'N/A' },
                                    { name: 'Storytelling', grade: gradeRecord.subject_six || 'N/A' },
                                    { name: 'Health and Nutrition', grade: gradeRecord.subject_seven || 'N/A' },
                                    { name: 'Music and Rhythm', grade: gradeRecord.subject_eight || 'N/A' },
                                    { name: 'Physical Education', grade: gradeRecord.subject_nine || 'N/A' },
                                ],
                                'grade_two': [
                                    { name: 'Addition and Subtraction', grade: gradeRecord.subject_one || 'N/A' },
                                    { name: 'Reading Comprehension', grade: gradeRecord.subject_two || 'N/A' },
                                    { name: 'Introduction to Science', grade: gradeRecord.subject_three || 'N/A' },
                                    { name: 'Creative Writing', grade: gradeRecord.subject_four || 'N/A' },
                                    { name: 'Community Helpers', grade: gradeRecord.subject_five || 'N/A' },
                                    { name: 'Basic Geography', grade: gradeRecord.subject_six || 'N/A' },
                                    { name: 'Art Techniques', grade: gradeRecord.subject_seven || 'N/A' },
                                    { name: 'Music Appreciation', grade: gradeRecord.subject_eight || 'N/A' },
                                    { name: 'Physical Fitness', grade: gradeRecord.subject_nine || 'N/A' },
                                ],
                                'grade_three': [
                                    { name: 'Multiplication and Division', grade: gradeRecord.subject_one || 'N/A' },
                                    { name: 'Reading Fluency', grade: gradeRecord.subject_two || 'N/A' },
                                    { name: 'Life Science', grade: gradeRecord.subject_three || 'N/A' },
                                    { name: 'Creative Writing', grade: gradeRecord.subject_four || 'N/A' },
                                    { name: 'History Basics', grade: gradeRecord.subject_five || 'N/A' },
                                    { name: 'Geometry', grade: gradeRecord.subject_six || 'N/A' },
                                    { name: 'Art History', grade: gradeRecord.subject_seven || 'N/A' },
                                    { name: 'Music Theory', grade: gradeRecord.subject_eight || 'N/A' },
                                    { name: 'Team Sports', grade: gradeRecord.subject_nine || 'N/A' },
                                ],
                                'grade_four': [
                                    { name: 'Fractions and Decimals', grade: gradeRecord.subject_one || 'N/A' },
                                    { name: 'Reading Analysis', grade: gradeRecord.subject_two || 'N/A' },
                                    { name: 'Physical Science', grade: gradeRecord.subject_three || 'N/A' },
                                    { name: 'Research Skills', grade: gradeRecord.subject_four || 'N/A' },
                                    { name: 'World Geography', grade: gradeRecord.subject_five || 'N/A' },
                                    { name: 'Civics', grade: gradeRecord.subject_six || 'N/A' },
                                    { name: 'Art Projects', grade: gradeRecord.subject_seven || 'N/A' },
                                    { name: 'Music Composition', grade: gradeRecord.subject_eight || 'N/A' },
                                    { name: 'Fitness and Health', grade: gradeRecord.subject_nine || 'N/A' },
                                ],
                                'grade_five': [
                                    { name: 'Advanced Math', grade: gradeRecord.subject_one || 'N/A' },
                                    { name: 'Literature Study', grade: gradeRecord.subject_two || 'N/A' },
                                    { name: 'Earth Science', grade: gradeRecord.subject_three || 'N/A' },
                                    { name: 'Writing Essays', grade: gradeRecord.subject_four || 'N/A' },
                                    { name: 'U.S. History', grade: gradeRecord.subject_five || 'N/A' },
                                    { name: 'Map Skills', grade: gradeRecord.subject_six || 'N/A' },
                                    { name: 'Art Critique', grade: gradeRecord.subject_seven || 'N/A' },
                                    { name: 'Cultural Music', grade: gradeRecord.subject_eight || 'N/A' },
                                    { name: 'Sports Science', grade: gradeRecord.subject_nine || 'N/A' },
                                ],
                                'grade_six': [
                                    { name: 'Pre-Algebra', grade: gradeRecord.subject_one || 'N/A' },
                                    { name: 'Advanced Literature', grade: gradeRecord.subject_two || 'N/A' },
                                    { name: 'Biology', grade: gradeRecord.subject_three || 'N/A' },
                                    { name: 'Creative Non-Fiction', grade: gradeRecord.subject_four || 'N/A' },
                                    { name: 'World History', grade: gradeRecord.subject_five || 'N/A' },
                                    { name: 'Geography Skills', grade: gradeRecord.subject_six || 'N/A' },
                                    { name: 'Art Techniques', grade: gradeRecord.subject_seven || 'N/A' },
                                    { name: 'Music History', grade: gradeRecord.subject_eight || 'N/A' },
                                    { name: 'Health Education', grade: gradeRecord.subject_nine || 'N/A' },
                                ],
                            };

                            return gradeLevels[gradeKey] || [];
                        }

                        // Use the function to get subjects based on gradeKey
                        const subjects = getSubjectsForGrade(gradeKey, gradeRecord);


                        const margin = 10;
                        const bstartX = 10;
                        const bstartY = 80;
                        const bcellHeight = 10;
                        const bcolumnWidth = (doc.internal.pageSize.width - (margin * 2)) / 3;

                        // Define table headers and positions
                        const headers = ['Subject', 'Grade', 'Remarks'];
                        const headerHeight = 10; // Height for header row
                        const startY = bstartY; // Starting Y position for the table
                        const cellHeight = 5; // Height for each cell
                        const columnWidth = (doc.internal.pageSize.width - (margin * 2)) / headers.length; // Adjusted width based on headers

                        // Draw table header background
                        doc.setFontSize(10);
                        doc.setTextColor(0, 0, 0); // Black text for header
                        doc.setFillColor(255, 255, 255); // White fill for header background
                        doc.rect(bstartX, startY, columnWidth * headers.length, headerHeight, 'F'); // Draw header rectangle

                        // Draw header border
                        doc.setTextColor(0, 0, 0); // Reset text color for headers
                        doc.setLineWidth(0.5);
                        doc.rect(bstartX, startY, columnWidth * headers.length, headerHeight); // Draw border around header

                        headers.forEach((header, index) => {
                            doc.text(header, bstartX + index * columnWidth + margin, startY + 8); // Center the header text
                        });

                        // Reset color for content
                        doc.setTextColor(0, 0, 0); // Black text for body
                        doc.setLineWidth(0.1);

                        // Add subjects and grades to the table
                        let totalGrades = 0; // Initialize total grades
                        subjects.forEach((subject, index) => {
                            const yPosition = startY + headerHeight + (index + 1) * cellHeight;

                            // Subject
                            doc.text(subject.name, bstartX + margin, yPosition);

                            // Grade
                            const gradeValue = parseFloat(subject.grade);
                            doc.text(isNaN(gradeValue) ? 'N/A' : gradeValue.toString(), bstartX + columnWidth + margin, yPosition);

                            // Add to total grades if valid
                            if (!isNaN(gradeValue)) {
                                totalGrades += gradeValue;
                            }

                            // Remarks based on grade
                            const remarks = (gradeValue >= 75) ? 'Passed' : 'Failed';
                            doc.text(remarks, bstartX + 2 * columnWidth + margin, yPosition);
                        });

                        // Define the grading system as an array
                        const gradingSystem = [
                            { range: '98.00 - 100.00', remark: 'With High Honor' },
                            { range: '95.00 - 97.99', remark: 'With Honor' },
                            { range: '75.00 - 94.99', remark: 'Passed' },
                            { range: '0.00 - 74.99', remark: 'Failed' },
                        ];

                        // Starting position for the grading system table
                        const gradingSystemStartY = startY + 10 + headerHeight + (subjects.length + 3) * cellHeight;

                        // Draw Grading System Header
                        doc.setFontSize(10);
                        doc.setTextColor(0, 0, 0);
                        doc.text("Grading System : ", bstartX - 10 + margin, gradingSystemStartY + 3);

                        // Define header for grading system
                        const gradingHeaders = ['Grade Range', 'Remarks'];
                        const gradingHeaderHeight = 10;
                        const gradingColumnWidth = (doc.internal.pageSize.width - (margin * 2)) / gradingHeaders.length;

                        // Draw grading system header background
                        doc.setFillColor(255, 255, 255);
                        doc.rect(bstartX, gradingSystemStartY + 5, gradingColumnWidth * gradingHeaders.length, gradingHeaderHeight, 'F'); // Background
                        doc.rect(bstartX, gradingSystemStartY + 5, gradingColumnWidth * gradingHeaders.length, gradingHeaderHeight); // Border

                        gradingHeaders.forEach((header, index) => {
                            doc.text(header, bstartX + index * gradingColumnWidth + margin, gradingSystemStartY + 13); // Center header text
                        });

                        // Draw the grading system content
                        gradingSystem.forEach((gradeInfo, index) => {
                            const yPosition = gradingSystemStartY + 15 + (index + 1) * cellHeight;

                            // Grade Range
                            doc.text(gradeInfo.range, bstartX + margin, yPosition);

                            // Remarks
                            doc.text(gradeInfo.remark, bstartX + gradingColumnWidth + margin, yPosition);
                        });

                        // Optional: Draw a border around the grading system table
                        const gradingBottomY = gradingSystemStartY + 15 + (gradingSystem.length + 1) * cellHeight;
                        doc.setLineWidth(0.5);
                        doc.rect(bstartX, gradingSystemStartY + 5, gradingColumnWidth * gradingHeaders.length, gradingBottomY - (gradingSystemStartY + 5));


                        // Calculate average and remark
                        const average = (totalGrades / subjects.length).toFixed(2);
                        const remark = (average >= 75) ? 'Passed' : 'Failed';

                        // Add average and remark to the PDF
                        const averageStartY = startY + headerHeight + (subjects.length + 2) * cellHeight; // Position below the table
                        doc.setFontSize(10);
                        doc.text(`${gradeKey}, ${quarter} Average: ${average}`, leftColumnX, astartY + 95);
                        doc.text(`Remark: ${remark}`, rightColumnX, astartY + 95); // Positioned 10 units below the average

                        // Draw the bottom border of the table
                        const bottomY = startY + headerHeight + (subjects.length + 1) * cellHeight;
                        doc.setLineWidth(0.5);
                        doc.rect(bstartX, startY, columnWidth * headers.length, bottomY - startY);

                        // Save the PDF
                        doc.save(`grades_report-${gradeKey}-${quarter}.pdf`);
                    } else {
                        alert('No grade record found for this selection.');
                    }
                } else {
                    const alert = document.getElementById('alert');

                    alert.classList.add('p-3');
                    alert.classList.add('border');
                    alert.classList.add('border-red-500');
                    alert.innerHTML = 'Please select a grade and quarter before downloading.';

                    setTimeout(function () {
                        alert.innerHTML = '';
                        alert.classList.remove('p-3');
                        alert.classList.remove('border');
                        alert.classList.remove('border-red-500');
                    }, 3000);
                }
            });
        });

        function fetchGrades() {
            $.ajax({
                url: '{{ route("showGrades") }}',
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function (response) {
                    const gradesSelect = $('#gradesSelect');
                    gradesSelect.empty().append('<option value="">Select Your Quarterly Grade</option>');

                    window.gradeData = {};
                    $.each(response, function (gradeKey, gradeRecords) {
                        const gradeTitle = gradeKey.replace(/_/g, ' ').replace(/grade /i, 'Grade ');
                        window.gradeData[gradeKey] = {};

                        $.each(gradeRecords, function (index, grade) {
                            const quarter = grade.quarter;
                            const optionValue = `${gradeKey}|${quarter}`;
                            const cgradeKey = `${gradeKey}`;
                            gradesSelect.append(`<option value="${optionValue}">${gradeTitle} ${quarter}</option>`);
                            // Store the full grade record along with optionValue
                            window.gradeData[gradeKey][quarter] = { ...grade, optionValue, cgradeKey };
                        });
                    });

                    $('#gradesContainer').show();
                },
                error: function (xhr) {
                    const error = xhr.responseJSON.error || 'An error occurred. Please try again.';
                    alert(error);
                }
            });
        }

        function displayGradeDetails(gradeRecord) {
            let gradesHtml = '';

            if (!gradeRecord) {
                gradesHtml += '<p class="text-red-500 text-[15px]">No grades found for this grade and quarter.</p>';
            } else {
                // Get the cgradeKey (e.g., 'grade_one', 'grade_two')
                const cgradeKey = gradeRecord.cgradeKey;

                // Map of subjects for each grade
                // Map of subjects for each grade
                const subjectsMap = {
                    'grade_one': [
                        { name: 'Basic Math', grade: gradeRecord.subject_one || 'N/A' },
                        { name: 'Reading Fundamentals', grade: gradeRecord.subject_two || 'N/A' },
                        { name: 'Simple Science', grade: gradeRecord.subject_three || 'N/A' },
                        { name: 'Art and Craft', grade: gradeRecord.subject_four || 'N/A' },
                        { name: 'Social Skills', grade: gradeRecord.subject_five || 'N/A' },
                        { name: 'Storytelling', grade: gradeRecord.subject_six || 'N/A' },
                        { name: 'Health and Nutrition', grade: gradeRecord.subject_seven || 'N/A' },
                        { name: 'Music and Rhythm', grade: gradeRecord.subject_eight || 'N/A' },
                        { name: 'Physical Education', grade: gradeRecord.subject_nine || 'N/A' },
                    ],
                    'grade_two': [
                        { name: 'Addition and Subtraction', grade: gradeRecord.subject_one || 'N/A' },
                        { name: 'Reading Comprehension', grade: gradeRecord.subject_two || 'N/A' },
                        { name: 'Introduction to Science', grade: gradeRecord.subject_three || 'N/A' },
                        { name: 'Creative Writing', grade: gradeRecord.subject_four || 'N/A' },
                        { name: 'Community Helpers', grade: gradeRecord.subject_five || 'N/A' },
                        { name: 'Basic Geography', grade: gradeRecord.subject_six || 'N/A' },
                        { name: 'Art Techniques', grade: gradeRecord.subject_seven || 'N/A' },
                        { name: 'Music Appreciation', grade: gradeRecord.subject_eight || 'N/A' },
                        { name: 'Physical Fitness', grade: gradeRecord.subject_nine || 'N/A' },
                    ],
                    'grade_three': [
                        { name: 'Multiplication and Division', grade: gradeRecord.subject_one || 'N/A' },
                        { name: 'Reading Fluency', grade: gradeRecord.subject_two || 'N/A' },
                        { name: 'Life Science', grade: gradeRecord.subject_three || 'N/A' },
                        { name: 'Creative Writing', grade: gradeRecord.subject_four || 'N/A' },
                        { name: 'History Basics', grade: gradeRecord.subject_five || 'N/A' },
                        { name: 'Geometry', grade: gradeRecord.subject_six || 'N/A' },
                        { name: 'Art History', grade: gradeRecord.subject_seven || 'N/A' },
                        { name: 'Music Theory', grade: gradeRecord.subject_eight || 'N/A' },
                        { name: 'Team Sports', grade: gradeRecord.subject_nine || 'N/A' },
                    ],
                    'grade_four': [
                        { name: 'Fractions and Decimals', grade: gradeRecord.subject_one || 'N/A' },
                        { name: 'Reading Analysis', grade: gradeRecord.subject_two || 'N/A' },
                        { name: 'Physical Science', grade: gradeRecord.subject_three || 'N/A' },
                        { name: 'Research Skills', grade: gradeRecord.subject_four || 'N/A' },
                        { name: 'World Geography', grade: gradeRecord.subject_five || 'N/A' },
                        { name: 'Civics', grade: gradeRecord.subject_six || 'N/A' },
                        { name: 'Art Projects', grade: gradeRecord.subject_seven || 'N/A' },
                        { name: 'Music Composition', grade: gradeRecord.subject_eight || 'N/A' },
                        { name: 'Fitness and Health', grade: gradeRecord.subject_nine || 'N/A' },
                    ],
                    'grade_five': [
                        { name: 'Advanced Math', grade: gradeRecord.subject_one || 'N/A' },
                        { name: 'Literature Study', grade: gradeRecord.subject_two || 'N/A' },
                        { name: 'Earth Science', grade: gradeRecord.subject_three || 'N/A' },
                        { name: 'Writing Essays', grade: gradeRecord.subject_four || 'N/A' },
                        { name: 'U.S. History', grade: gradeRecord.subject_five || 'N/A' },
                        { name: 'Map Skills', grade: gradeRecord.subject_six || 'N/A' },
                        { name: 'Art Critique', grade: gradeRecord.subject_seven || 'N/A' },
                        { name: 'Cultural Music', grade: gradeRecord.subject_eight || 'N/A' },
                        { name: 'Sports Science', grade: gradeRecord.subject_nine || 'N/A' },
                    ],
                    'grade_six': [
                        { name: 'Pre-Algebra', grade: gradeRecord.subject_one || 'N/A' },
                        { name: 'Advanced Literature', grade: gradeRecord.subject_two || 'N/A' },
                        { name: 'Biology', grade: gradeRecord.subject_three || 'N/A' },
                        { name: 'Creative Non-Fiction', grade: gradeRecord.subject_four || 'N/A' },
                        { name: 'World History', grade: gradeRecord.subject_five || 'N/A' },
                        { name: 'Geography Skills', grade: gradeRecord.subject_six || 'N/A' },
                        { name: 'Art Techniques', grade: gradeRecord.subject_seven || 'N/A' },
                        { name: 'Music History', grade: gradeRecord.subject_eight || 'N/A' },
                        { name: 'Health Education', grade: gradeRecord.subject_nine || 'N/A' },
                    ],
                };


                // Fetch subjects based on cgradeKey
                const subjects = subjectsMap[cgradeKey] || [];

                gradesHtml += `
                    <div class="rounded-lg p-4 bg-white">
                        <p class="text-gray-900 font-semibold text-[14px]">Quarter: (${cgradeKey} ${gradeRecord.quarter})</p>
                        <table class="min-w-full mt-2 border-collapse text-gray-900 text-[13px] shadow-lg">
                            <thead class="text-start">
                                <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-start ">Subject</th>
                                <th class="border px-4 py-2 text-start ">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
        `;

                subjects.forEach(({ name, grade }) => {
                    gradesHtml += `
                <tr>
                    <td class="border px-4 py-2">${name}</td>
                    <td class="border px-4 py-2">${grade || 'N/A'}</td>
                </tr>
            `;
                });

                gradesHtml += `
                </tbody>    
            </table>
        </div>
        `;
            }

            $('#grades').html(gradesHtml);
            $('#gradesContainer').show();
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
</body>

</html>