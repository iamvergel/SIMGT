var table = $("#studentTable").DataTable({
    dom:
        ` 
    <'grid grid-cols-3 mb-4'<'col-span-1 space-x-4'l><'col-span-1 space-x-4'B><'col-span-1 space-x-4'f>>` +
        `<tr>` +
        `<'flex justify-between items-center'<'flex-1'i><'flex-1'p>>`,
    paging: true,
    searching: true,
    ordering: true,
    info: true,
    lengthChange: true,
    responsive: true,
    scrollCollapse: true,
    buttons: [
        {
            extend: "copyHtml5",
            className:
                "!bg-sky-800 !text-[12px] !text-white !border-none !hover:bg-sky-700 !px-4 !py-2 !rounded !flex !items-center !justify-center",
            text: '<i class="fas fa-clipboard"></i> Copy',
            titleAttr: "Click to copy data",
            exportOptions: {
                columns: ".export",
            },
        },
        {
            extend: "excelHtml5",
            text: '<i class="fas fa-file-excel mr-2"></i> Excel',
            className:
                "!bg-teal-700 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !important !flex !items-center !justify-center",
            titleAttr: "Export to Excel",
            exportOptions: {
                columns: ".export",
            },
        },
        {
            extend: "csvHtml5",
            text: '<i class="fas fa-file-csv mr-2"></i> CSV',
            className:
                "!bg-yellow-500 !text-[12px] !text-white !border-none !hover:bg-yellow-400 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
            titleAttr: "Export to CSV",
            exportOptions: {
                columns: ".export",
            },
        },
        {
            extend: "pdfHtml5",
            text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
            className:
                "!bg-green-600 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
            orientation: "landscape",
            pageSize: "A4",
            titleAttr: "Export to PDF",
            exportOptions: {
                columns: ".export",
            },
            customize: function (doc) {
                doc.content[1].table.widths = Array(
                    doc.content[1].table.body[0].length + 1
                )
                    .join("*")
                    .split("");
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
            exportOptions: {
                columns: ".export",
            },
            customize: function (win) {
                $(win.document.body).find("table").css("width", "100%");
                $(win.document.body).find("table").css("font-size", "10px");
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

$(document).ready(function () {
    // When the dropdown button is clicked, make an AJAX call
    $("#dropdownDefaultButton").click(function () {
        // Toggle the dropdown visibility
        $("#dropdown").toggleClass("hidden");

        // Make an AJAX request to get the sections
        $.ajax({
            url: "/get-onesections",
            type: "GET",
            success: function (data) {
                console.log(data); // Debug: Check the data received
                if (data.length > 0) {
                    $("#dropdown ul").empty();
                    $("#dropdown ul").append(
                        '<li class="text-gray-500 hover:text-white hover:bg-teal-600 py-2 rounded-lg"><a href="#" class="dropdown-item"  data-section="">Select a Section</a></li>'
                    );
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

    $(document).on("click", ".dropdown-item", function (event) {
        event.preventDefault(); // Prevent default anchor click behavior

        const selectedSection = $(this).data("section");

        $("#searchInput").val(selectedSection); // Update search input

        table.search(selectedSection).draw(); // Apply the search to DataTable

        $("#dropdown").addClass("hidden"); // Close the dropdown
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

function toggleModal(modalId) {
    const modal = document.getElementById(modalId);
    console.log(modal); // Debugging: Ensure modal is found
    modal.classList.toggle("hidden");
    modal.classList.toggle("flex");
}

// Event listeners for opening modals
document.querySelector('[data-modal-target="addnewstudent"]').onclick =
    function () {
        toggleModal("addnewstudent");
    };

// Event listeners for closing modals
document.getElementById("addnewstudentClose").onclick = function () {
    toggleModal("addnewstudent");
};

// Event listeners for opening modals
document
    .querySelectorAll('[data-modal-toggle^="updatetudentinfo"]')
    .forEach((button) => {
        button.onclick = function () {
            const modalId = button.getAttribute("data-modal-target");
            toggleModal(modalId);
        };
    });

// Event listeners for closing modals
document.querySelectorAll('[id^="updatetudentinfoClose"]').forEach((button) => {
    button.onclick = function () {
        const modalId =
            "updatetudentinfo" + button.id.replace("updatetudentinfoClose", "");
        toggleModal(modalId);
    };
});

// Optional: Close modal when clicking outside of it
window.onclick = function (event) {
    const modalBackdrop = event.target.classList.contains("fixed");
    const isModal = event.target.closest(".modal"); // Assuming your modals have a class 'modal'

    if (modalBackdrop && !isModal) {
        const modals = document.querySelectorAll(".modal");
        modals.forEach((modal) => modal.classList.add("hidden"));
    }
};

document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelector("#birth_certificate")
        .addEventListener("change", function () {
            document.querySelector("#birthFileName").textContent = this.files[0]
                ? this.files[0].name
                : "No file chosen";
        });

    document
        .querySelector("#proof_of_residency")
        .addEventListener("change", function () {
            document.querySelector("#residencyFileName").textContent = this
                .files[0]
                ? this.files[0].name
                : "No file chosen";
        });
});

document.getElementById("birthDate").addEventListener("change", calculateAge);

function calculateAge() {
    const birthDateInput = document.getElementById("birthDate");
    const ageInput = document.getElementById("age");
    const birthDate = new Date(birthDateInput.value);
    const today = new Date();

    if (birthDate) {
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (
            monthDiff < 0 ||
            (monthDiff === 0 && today.getDate() < birthDate.getDate())
        ) {
            age--;
        }
        console.log("Calculated Age:", age); // Debugging: Check the age calculation
        ageInput.value = age;
    } else {
        ageInput.value = "";
    }
}
