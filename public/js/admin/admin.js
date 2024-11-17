function searchTable() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const tableBody = document.getElementById("tableBody");
    const rows = tableBody.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let displayRow = false;

        if (cells.length > 0) {
            const nameText = cells[5].textContent.toLowerCase(); // Name column
            const numberText = cells[0].textContent.toLowerCase(); // Student Number column
            const sectionText = cells[3].textContent.toLowerCase(); // Student Section column
            const gradeText = cells[6].textContent.toLowerCase(); // Student Grade column

            // Check if any cell includes the filter text
            displayRow =
                nameText.includes(filter) ||
                numberText.includes(filter) ||
                sectionText.includes(filter) ||
                gradeText.includes(filter);
        }

        rows[i].style.display = displayRow ? "" : "none";
    }
}

$(document).ready(function () {
    // Initialize DataTable
    $("#studentTable").DataTable({
        paging: true,
        searching: false,
        ordering: true,
        order: [[0, "asc"]], // Default order by first column (Student Number)
        scrollY: "auto",
        scrollX: "auto",
        scrollCollapse: true,
        language: {
            search: "Search by name or other fields:",
        },
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
    document.getElementById("modalStudentNumber").value = row.getAttribute(
        "data-student-number"
    );
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

function filterTable() {
    const searchValue = document.getElementById("modalStudentNumber1").value.toLowerCase();
    const rows = document.querySelectorAll("table[id^='tableGrade'] tbody tr"); // All rows from tables with IDs starting with 'tableGrade'

    rows.forEach(row => {
        const studentNumber = row.getAttribute("data-student-number").toLowerCase();
        if (studentNumber.includes(searchValue)) {
            row.style.display = ""; // Show row
        } else {
            row.style.display = "none"; // Hide row
        }
    });

    // Filter the copied tables as well
    const targetRows = document.querySelectorAll("table[id^='tableGrade'][id$='Copy'] tbody tr");
    targetRows.forEach(row => {
        const studentNumber = row.cells[0].textContent.toLowerCase();
        if (studentNumber.includes(searchValue)) {
            row.style.display = ""; // Show row
        } else {
            row.style.display = "none"; // Hide row
        }
    });
}

// Add event listener to each row to set the search bar value and trigger the filter
const rows = document.querySelectorAll("table tbody tr");
rows.forEach((row) => {
    row.addEventListener("click", function () {
        // Get the student number from the data attribute
        const studentNumber = row.getAttribute("data-student-number");

        // Set the value of the search bar to the clicked student's number
        document.getElementById("modalStudentNumber1").value = studentNumber;

        // Trigger the filter function to filter the table based on this value
        filterTable();
    });
});
