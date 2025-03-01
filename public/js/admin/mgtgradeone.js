var table = $("#studentTable").DataTable({
    dom:
        ` <'flex justify-center items-center mb-4'<><'block xl:hidden'B><>>` +
        `<tr>` +
        `<'flex justify-center items-center mb-4'<'flex-3'l><'flex-1 xl:block hidden'B><'flex-1'f>>` +
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
                        '<li class="text-gray-500 hover:text-white hover:bg-teal-600 py-2 rounded-lg"><a href="#" class="dropdown-item" data-section="">Select a Section</a></li>'
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

    // Handle section click to filter table
    $(document).on("click", ".dropdown-item", function (event) {
        event.preventDefault();

        const selectedSection = $(this).data("section");
        let section = document.getElementById('section');

        if (selectedSection) {
            table.column(5).search(selectedSection).draw(); // Filter the table based on the clicked section
            section.innerHTML = 'Section : ' + selectedSection;
        } else {
            table.column(5).search("").draw(); // Clear the filter to show all
            section.innerHTML = 'Section : ';
        }

        $("#dropdown").addClass("hidden"); // Close the dropdown
    });
});

    // $(document).on("click", ".dropdown-item", function (event) {
    //     event.preventDefault(); // Prevent default anchor click behavior

    //     const selectedSection = $(this).data("section");

    //     if (selectedSection) {
    //         table.search(selectedSection).draw(); // Apply the search to DataTable
    //     } else {
    //         table.search("").draw(); // Clear the search to show all
    //     }

    //     $("#dropdown").addClass("hidden"); // Close the dropdown
    // });

    // Close the dropdown if clicked outside
    // $(document).click(function (event) {
    //     const dropdownButton = $("#dropdownDefaultButton");
    //     const dropdownMenu = $("#dropdown");

    //     // Close dropdown if clicked outside the dropdown button or menu
    //     if (
    //         !dropdownButton.is(event.target) &&
    //         !dropdownMenu.is(event.target) &&
    //         dropdownMenu.has(event.target).length === 0
    //     ) {
    //         dropdownMenu.addClass("hidden");
    //     }
    // });

