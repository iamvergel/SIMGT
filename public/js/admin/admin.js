$(document).ready(function () {
    // Initialize the DataTable
    var table = $("#studentTable").DataTable({
        dom:
            ` 
        <'flex justify-between items-center mb-4'<'flex space-x-4'l><'flex space-x-4'B><'flex space-x-4'f>>` +
            `<tr>` +
            `<'flex justify-between items-center'<'flex-1'i><'flex-1'p>>`,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthChang: true,
                scrollX: true,
                crollY: 'auto',
                scrollCollapse: true,
        buttons: [
            {
                extend: "copyHtml5",
                className:
                    "!bg-sky-800 !text-[12px] !text-white !border-none !hover:bg-sky-700 !px-4 !py-2 !rounded !flex !items-center !justify-center",
                text: '<i class="fas fa-clipboard"></i> Copy',
                titleAttr: "Click to copy data",
            },
            {
                extend: "excelHtml5",
                text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                className:
                    "!bg-teal-700 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !important !flex !items-center !justify-center",
                titleAttr: "Export to Excel",
            },
            {
                extend: "csvHtml5",
                text: '<i class="fas fa-file-csv mr-2"></i> CSV',
                className:
                    "!bg-yellow-500 !text-[12px] !text-white !border-none !hover:bg-yellow-400 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                titleAttr: "Export to CSV",
            },
            {
                extend: "pdfHtml5",
                text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                className:
                    "!bg-red-600 !text-[12px] !text-white !border-none !hover:bg-red-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                orientation: "landscape",
                pageSize: "A4",
                titleAttr: "Export to PDF",
                customize: function (doc) {
                    // Adjust the width of the table in the PDF document
                    doc.content[1].table.widths = Array(
                        doc.content[1].table.body[0].length + 2
                    )
                        .join("*")
                        .split("");

                    doc.content[1].table.styles = {
                        tableWidth: "100%",
                        cellPadding: 0,
                        cellMargin: 0,
                        fontSize: 10,
                        lineHeight: "normal",
                        font: "Arial",
                    };
                },
            },
            {
                extend: "print",
                text: '<i class="fas fa-print mr-2"></i> Print',
                className:
                    "!bg-blue-600 !text-[12px] !text-white !border-none !hover:bg-blue-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                orientation: "landscape",
                autoPrint: true,
                titleAttr: "Print Table",
                customize: function (win) {
                    $(win.document.body).find("table").css("width", "80%");
                    $(win.document.body).find("table").css("font-size", "12px");
                },
            },
        ],
        initComplete: function () {
            $(".dt-buttons").css({
                display: "flex",
                "justify-content": "flex-end",
                width: "100%",
            });
        },
    });

    // When the dropdown button is clicked, make an AJAX call
    $("#dropdownDefaultButton").click(function () {
        // Toggle the dropdown visibility
        $("#dropdown").toggleClass("hidden");

        // Make an AJAX request to get the sections
        $.ajax({
            url: "/get-grade", // The route for fetching sections
            type: "GET",
            success: function (data) {
                // Check if sections are returned
                if (data.length > 0) {
                    // Empty the dropdown list
                    $("#dropdown ul").empty();

                    // Append the default placeholder as the first item
                    $("#dropdown ul").append(
                        '<li class="text-gray-500 hover:text-white hover:bg-teal-600 py-2 rounded-lg"><a href="#" class="dropdown-item" data-section="">Select a Grade</a></li>'
                    );

                    // Append each section as a list item in the dropdown
                    data.forEach(function (section) {
                        $("#dropdown ul").append(
                            '<li class="text-gray-500 hover:text-white hover:bg-teal-600 py-2 rounded-lg"><a href="#" class="dropdown-item" data-section="' +
                                section +
                                '">' +
                                section +
                                "</a></li>"
                        );
                    });
                } else {
                    // If no sections, show a message
                    $("#dropdown ul").html(
                        '<li><a href="#" class="dropdown-item text-gray-500">No Sections Available</a></li>'
                    );
                }
            },
            error: function (xhr, status, error) {
                console.log("Error fetching sections: " + error);
            },
        });
    });

    // Filter table by section when dropdown item is clicked
    $(document).on("click", ".dropdown-item", function (event) {
        event.preventDefault(); // Prevent default anchor click behavior

        const selectedSection = $(this).data("section");

        // Trigger the search function and search the table
        table.search(selectedSection).draw(); // Directly apply the search to the DataTable

        // Close the dropdown after selection
        $("#dropdown").addClass("hidden");
    });

    // Close the dropdown if clicked outside
    $(document).click(function (event) {
        const dropdownButton = $("#dropdownDefaultButton");
        const dropdownMenu = $("#dropdown");

        // Close dropdown if clicked outside the dropdown button or menu
        if (
            !dropdownButton.is(event.target) &&
            !dropdownMenu.is(event.target) &&
            dropdownMenu.has(event.target).length === 0
        ) {
            dropdownMenu.addClass("hidden");
        }
    });
});

function openStudentModal(row) {
    // Populating basic student info
    document.getElementById("StudentName").innerHTML =
        row.getAttribute("data-last-name") +
        " " +
        row.getAttribute("data-first-name") +
        " " +
        row.getAttribute("data-middle-name") +
        " " +
        row.getAttribute("data-suffix-name") +
        " ";
    document.getElementById("StudentName1").value =
        row.getAttribute("data-last-name") +
        ", " +
        row.getAttribute("data-first-name") +
        " " +
        row.getAttribute("data-middle-name") +
        " " +
        row.getAttribute("data-suffix-name") +
        " ";
    document.getElementById("modalStudentNumber").value = row.getAttribute(
        "data-student-number"
    );
    document.getElementById("modalUsername").value =
        row.getAttribute("data-username");
    document.getElementById("modalStatus").value =
        row.getAttribute("data-status");
    document.getElementById("modalLrn").value = row.getAttribute("data-lrn");
    document.getElementById("modalSchoolYear").value =
        row.getAttribute("data-school-year");
    document.getElementById("modalSchool").value =
        row.getAttribute("data-school");
    document.getElementById("modalGrade").value =
        row.getAttribute("data-grade");
    document.getElementById("modalSection").value =
        row.getAttribute("data-section");
    document.getElementById("modalLastName").value =
        row.getAttribute("data-last-name");
    document.getElementById("modalFirstName").value =
        row.getAttribute("data-first-name");
    document.getElementById("modalMiddleName").value =
        row.getAttribute("data-middle-name");
    document.getElementById("modalSuffixName").value =
        row.getAttribute("data-suffix-name");
    document.getElementById("modalEmail").value =
        row.getAttribute("data-email");
    document.getElementById("modalPlaceOfBirth").value = row.getAttribute(
        "data-place-of-birth"
    );
    document.getElementById("modalBirthDate").value =
        row.getAttribute("data-birth-date");
    document.getElementById("modalSex").value = row.getAttribute("data-sex");
    document.getElementById("modalAge").value = row.getAttribute("data-age");
    document.getElementById("modalContactNumber").value = row.getAttribute(
        "data-contact-number"
    );
    document.getElementById("modalReligion").value =
        row.getAttribute("data-religion");
    document.getElementById("modalhouseNumber").value =
        row.getAttribute("data-house-number");
    document.getElementById("modalStreet").value =
        row.getAttribute("data-street");
    document.getElementById("modalBarangay").value =
        row.getAttribute("data-barangay");
    document.getElementById("modalCity").value = row.getAttribute("data-city");
    document.getElementById("modalProvince").value =
        row.getAttribute("data-province");

    // Populating father info
    document.getElementById("modalFatherLastName").value = row.getAttribute(
        "data-father-last-name"
    );
    document.getElementById("modalFatherFirstName").value = row.getAttribute(
        "data-father-first-name"
    );
    document.getElementById("modalFatherMiddleName").value = row.getAttribute(
        "data-father-middle-name"
    );
    document.getElementById("modalFatherSuffix").value =
        row.getAttribute("data-father-suffix");
    document.getElementById("modalFatherOccupation").value = row.getAttribute(
        "data-father-occupation"
    );

    // Populating mother info
    document.getElementById("modalMotherLastName").value = row.getAttribute(
        "data-mother-last-name"
    );
    document.getElementById("modalMotherFirstName").value = row.getAttribute(
        "data-mother-first-name"
    );
    document.getElementById("modalMotherMiddleName").value = row.getAttribute(
        "data-mother-middle-name"
    );
    document.getElementById("modalMotherOccupation").value = row.getAttribute(
        "data-mother-occupation"
    );

    // Populating guardian info
    document.getElementById("modalGuardianLastName").value = row.getAttribute(
        "data-guardian-last-name"
    );
    document.getElementById("modalGuardianFirstName").value = row.getAttribute(
        "data-guardian-first-name"
    );
    document.getElementById("modalGuardianMiddleName").value = row.getAttribute(
        "data-guardian-middle-name"
    );
    document.getElementById("modalGuardianSuffix").value = row.getAttribute(
        "data-guardian-suffix"
    );
    document.getElementById("modalGuardianRelationship").value =
        row.getAttribute("data-guardian-relationship");
    document.getElementById("modalGuardianContact").value = row.getAttribute(
        "data-guardian-contact"
    );
    document.getElementById("modalGuardianReligion").value = row.getAttribute(
        "data-guardian-religion"
    );

    // Populating emergency contact info
    document.getElementById("modalEmergencyContactPerson").value =
        row.getAttribute("data-emergency-contact-person");
    document.getElementById("modalEmergencyContactNumber").value =
        row.getAttribute("data-emergency-contact-number");
    document.getElementById("modalEmailAddress").value = row.getAttribute(
        "data-emergency-email"
    );
    document.getElementById("modalMessengerAccount").value = row.getAttribute(
        "data-emergency-messenger"
    );

    const birthCertificate = row.getAttribute("data-birth-certificate");
    const proofOfResidency = row.getAttribute("data-proof-of-residency");

    // Display birth certificate (if available)
    if (birthCertificate && birthCertificate !== "N/A") {
        document.getElementById(
            "modalBirthCertificate"
        ).innerHTML = `<a href="${birthCertificate}" target="_blank" class="text-blue-500">View Birth Certificate</a>`;
    } else {
        document.getElementById("modalBirthCertificate").innerHTML = "N/A";
    }

    // Display proof of residency (if available)
    if (proofOfResidency && proofOfResidency !== "N/A") {
        document.getElementById(
            "modalProofOfResidency"
        ).innerHTML = `<a href="${proofOfResidency}" target="_blank" class="text-blue-500">View Proof of Residency</a>`;
    } else {
        document.getElementById("modalProofOfResidency").innerHTML = "N/A";
    }

    // Populating student profile image
    const studentAvatar = row.getAttribute("data-avatar"); // Assuming the student avatar URL is passed in data-avatar attribute

    // Get the element to display the avatar
    const avatarElement = document.getElementById("modalAvatar");

    // Check if avatar exists, otherwise fallback to initials
    if (studentAvatar && studentAvatar !== "N/A") {
        avatarElement.innerHTML = `<img src="${studentAvatar}" alt="Student Avatar" class="modal-avatar bg-gray-500 border-4 border-gray-500 shadow-lg">`;
    } else {
        // Check if data-last-name and data-first-name exist and are not empty
        const lastName = row.getAttribute("data-last-name");
        const firstName = row.getAttribute("data-first-name");

        if (lastName && firstName) {
            // Get the first letter of the last name and first name
            const initials =
                lastName.charAt(0).toUpperCase() +
                firstName.charAt(0).toUpperCase(); // Concatenate the first letters of last and first name
            avatarElement.innerHTML = `<div class="modal-avatar bg-gray-500 text-white text-[3rem] flex items-center justify-center font-bold">${initials}</div>`;
        } else {
            // If either last name or first name is missing, provide a fallback
            console.error(
                "data-last-name or data-first-name attribute is missing or empty"
            );
            avatarElement.innerHTML = `<div class="modal-avatar bg-gray-500 text-white text-[3rem] flex items-center justify-center font-bold">??</div>`;
        }
    }

    // Display the modal
    document.getElementById("studentModal").classList.remove("hidden");
}

// Function to close the modal
function closeStudentModal() {
    document.getElementById("studentModal").classList.add("hidden");
}

$(document).ready(function () {
    // Initialize DataTables for all grade tables with common configuration
    function initializeDataTable(tableId, options) {
        return $(tableId).DataTable({
            dom:
                ` 
<'flex justify-between items-center mb-4'<'flex space-x-4'l><'flex space-x-4'B>>` +
                `<tr>` +
                `<'flex justify-between items-center'<'flex-1'i><'flex-1'p>>`,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    className:
                        "!bg-sky-800 !text-[12px] !text-white !border-none !hover:bg-sky-700 !px-4 !py-2 !rounded !flex !items-center !justify-center",
                    text: '<i class="fas fa-clipboard"></i> Copy',
                    titleAttr: "Click to copy data",
                },
                {
                    extend: "excelHtml5",
                    text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                    className:
                        "!bg-teal-700 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !important !flex !items-center !justify-center",
                    titleAttr: "Export to Excel",
                },
                {
                    extend: "csvHtml5",
                    text: '<i class="fas fa-file-csv mr-2"></i> CSV',
                    className:
                        "!bg-yellow-500 !text-[12px] !text-white !border-none !hover:bg-yellow-400 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                    titleAttr: "Export to CSV",
                },
                {
                    extend: "pdfHtml5",
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    className:
                        "!bg-red-600 !text-[12px] !text-white !border-none !hover:bg-red-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                    orientation: "landscape",
                    pageSize: "A4",
                    titleAttr: "Export to PDF",
                    customize: function (doc) {
                        doc.content[1].table.widths = Array(
                            doc.content[1].table.body[0].length + 2
                        )
                            .join("*")
                            .split("");
                        doc.content[1].table.styles = {
                            tableWidth: "100%",
                            cellPadding: 0,
                            cellMargin: 0,
                            fontSize: 10,
                            lineHeight: "normal",
                            font: "Arial",
                        };
                    },
                },
                {
                    extend: "print",
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    className:
                        "!bg-blue-600 !text-[12px] !text-white !border-none !hover:bg-blue-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                    orientation: "landscape",
                    autoPrint: true,
                    titleAttr: "Print Table",
                    customize: function (win) {
                        $(win.document.body).find("table").css("width", "80%");
                        $(win.document.body)
                            .find("table")
                            .css("font-size", "12px");
                    },
                },
            ],
            ...options,
            initComplete: function () {
                $(".dt-buttons").css({
                    display: "flex",
                    "justify-content": "flex-end",
                    width: "100%",
                });
            },
        });
    }

    // Initialize DataTables for all grade tables with common configuration
    const tableGradeOne = initializeDataTable("#tableGradeOne", {
        paging: false,
        searching: true,
        ordering: false,
        info: false,
    });
    const tableGradeTwo = initializeDataTable("#tableGradeTwo", {
        paging: false,
        searching: true,
        ordering: false,
        info: false,
    });
    const tableGradeThree = initializeDataTable("#tableGradeThree", {
        paging: false,
        searching: true,
        ordering: false,
        info: false,
    });
    const tableGradeFour = initializeDataTable("#tableGradeFour", {
        paging: false,
        searching: true,
        ordering: false,
        info: false,
    });
    const tableGradeFive = initializeDataTable("#tableGradeFive", {
        paging: false,
        searching: true,
        ordering: false,
        info: false,
    });
    const tableGradeSix = initializeDataTable("#tableGradeSix", {
        paging: false,
        searching: true,
        ordering: false,
        info: false,
    });

    // Function to automatically filter tables based on student number entered in the search bar
    function filterTablesByStudentNumber(studentNumber) {
        // Loop through all the tables and apply the search filter based on student number
        tableGradeOne.search(studentNumber).draw();
        tableGradeTwo.search(studentNumber).draw();
        tableGradeThree.search(studentNumber).draw();
        tableGradeFour.search(studentNumber).draw();
        tableGradeFive.search(studentNumber).draw();
        tableGradeSix.search(studentNumber).draw();
    }

    // Add event listener to each row to set the search bar value and trigger the filter for all tables
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach((row) => {
        row.addEventListener("click", function () {
            const studentNumber = row.getAttribute("data-student-number");

            // Trigger the filter function to filter the tables based on this value
            filterTablesByStudentNumber(studentNumber);
        });
    });

    // Optionally, add a global search for all tables based on the value in the search input field
    $("#modalStudentNumber1").on("input", function () {
        const studentNumber = $(this).val();
        filterTablesByStudentNumber(studentNumber);
    });


    // When the "Generate PDF" button is clicked
    $("#btnPrint").on("click", function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.setFontSize(12);
    
        const name = document.getElementById("StudentName1").value;
        const logoUrl = '/assets/images/SELC.png';
        const logoWidth = 15; // width of the logo
        const logoHeight = 15; // height of the logo
    
        // Set top margin and starting Y offset
        const topMargin = 5;
        let yOffset = topMargin + 20; // Initial Y position for content after logo
    
        // Add logo and name to the PDF
        doc.addImage(logoUrl, 'PNG', 10, topMargin, logoWidth, logoHeight);
    
        // Title for PDF (Centering the text)
        const title = "St. Emilie Learning Center";
        doc.setFontSize(20);
        doc.setTextColor(40, 40, 40);
        const titleWidth = doc.getTextWidth(title);
        const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
        doc.text(title, titleX, 10);
    
        // Center the address
        const address = "Amparo Village, 18 Bangkal, Caloocan, Metro Manila";
        doc.setFontSize(10);
        doc.setTextColor(0, 0, 0);
        const addressWidth = doc.getTextWidth(address);
        const addressX = (doc.internal.pageSize.width - addressWidth) / 2;
        doc.text(address, addressX, 15);
    
        // Title for PDF
        doc.text("Grades Report : " + name, 10, 25);
    
        // Function to add tables to the PDF
        function addTableToPDF(table, title) {
            doc.text(title, 5, yOffset);  // Title for the table
            yOffset += 5; // Add space before the table
    
            // Get filtered data from the DataTable
            const filteredData = table.rows({ search: "applied" }).data();
    
            // Prepare an array to store the subject-wise grades and remarks
            const subjectsData = [];
            for (let i = 1; i <= 9; i++) {
                subjectsData.push({
                    subject: `Subject ${i}`,
                    grades: [0, 0, 0, 0], // For storing grades for each quarter
                    finals: 0, // For storing the final grade
                    remarks: "", // For storing the remark (Passed/Failed)
                });
            }
    
            // Loop through the filtered data and fill the subjectsData array
            filteredData.each(function (row) {
                const quarterIndex = [
                    "1st Quarter",
                    "2nd Quarter",
                    "3rd Quarter",
                    "4th Quarter",
                ].indexOf(row[1]);
    
                for (let i = 2; i <= 10; i++) {
                    subjectsData[i - 2].grades[quarterIndex] = row[i];
                }
            });
    
            // Calculate the final grade and remarks for each subject
            subjectsData.forEach(function (subjectData) {
                const totalGrade = subjectData.grades.reduce(
                    (sum, grade) => sum + parseFloat(grade),
                    0
                );
                subjectData.finals = totalGrade / 4;
                subjectData.remarks =
                    subjectData.finals >= 75 ? "Passed" : "Failed";
            });
    
            // Table headers and body preparation
            const tableHeaders = [
                "Subject",
                "1st Quarter",
                "2nd Quarter",
                "3rd Quarter",
                "4th Quarter",
                "Finals",
                "Remarks",
            ];
    
            const tableBody = subjectsData.map(function (subjectData) {
                return [
                    subjectData.subject, 
                    subjectData.grades[0], // 1st Quarter
                    subjectData.grades[1], // 2nd Quarter
                    subjectData.grades[2], // 3rd Quarter
                    subjectData.grades[3], // 4th Quarter
                    subjectData.finals.toFixed(2), // Finals (Average)
                    subjectData.remarks, // Remarks (Passed/Failed)
                ];
            });
    
            // Create the table using autoTable
            doc.autoTable({
                startY: yOffset,
                head: [tableHeaders],
                body: tableBody,
                theme: 'grid',
                columnStyles: {
                    0: { cellWidth: 40 }, // Adjust width of Subject column
                    1: { cellWidth: 20 }, // Adjust width of 1st Quarter column
                    2: { cellWidth: 20 }, // Adjust width of 2nd Quarter column
                    3: { cellWidth: 20 }, // Adjust width of 3rd Quarter column
                    4: { cellWidth: 20 }, // Adjust width of 4th Quarter column
                    5: { cellWidth: 20 }, // Adjust width of Finals column
                    6: { cellWidth: 25 }, // Adjust width of Remarks column
                },
                margin: { top: 10 },
                didDrawPage: function (data) {
                    yOffset = data.cursor.y;  // Update yOffset to handle page breaks
                },
            });
        }
    
        // Add each table's data to the PDF (using the existing tables)
        addTableToPDF(tableGradeOne, "");
        addTableToPDF(tableGradeTwo, "");
        addTableToPDF(tableGradeThree, "");
        addTableToPDF(tableGradeFour, "");
        addTableToPDF(tableGradeFive, "");
        addTableToPDF(tableGradeSix, "");
    
        // Save the PDF with the student's name in the filename
        doc.save("grades_report(" + name + ").pdf");
    });
    
});

// function filterTable() {
//     const searchValue = document
//         .getElementById("modalStudentNumber1")
//         .value.toLowerCase();
//     const rows = document.querySelectorAll("table[id^='tableGrade'] tbody tr"); // All rows from tables with IDs starting with 'tableGrade'

//     rows.forEach((row) => {
//         const studentNumber = row
//             .getAttribute("data-student-number")
//             .toLowerCase();
//         if (studentNumber.includes(searchValue)) {
//             row.style.display = ""; // Show row
//         } else {
//             row.style.display = "none"; // Hide row
//         }
//     });

//     // Filter the copied tables as well
//     const targetRows = document.querySelectorAll(
//         "table[id^='tableGrade'][id$='Copy'] tbody tr"
//     );
//     targetRows.forEach((row) => {
//         const studentNumber = row.cells[0].textContent.toLowerCase();
//         if (studentNumber.includes(searchValue)) {
//             row.style.display = ""; // Show row
//         } else {
//             row.style.display = "none"; // Hide row
//         }
//     });
// }
