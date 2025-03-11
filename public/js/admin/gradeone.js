
$(document).ready(function () {
var table = $("#studentTable").DataTable({
    dom:
        `<'grid grid-cols-12 gap-4 mb-4'<><'col-span-12 md:col-span-10 lg:col-span-8 xl:col-span-6 block xl:hidden'B><>>` +
        `<tr>` +
        `<'grid grid-cols-12 gap-4 mb-4'<'col-span-12 xl:col-span-3 xl:block hidden'l><'col-span-0 xl:col-span-6 xl:block 2xl:me-[15rem] hidden'B><'col-span-12 xl:col-span-3 xl:block hidden'f>>` +
        `<tr>` +
        `<'grid grid-cols-12 gap-4 mb-4'<'col-span-12 md:col-span-6 md:block flex items-center justify-center xl:hidden'l><'col-span-12 md:col-span-6 md:block flex items-center justify-center xl:hidden'f>>` +
        `<tr>` +
        `<'grid grid-cols-12 gap-4'<'col-span-12 lg:block flex items-center justify-center lg:col-span-6'i><'col-span-12 lg:block flex items-center justify-center lg:col-span-6'p>>`,
    paging: true,
    searching: true,
    ordering: true,
    info: true,
    lengthChange: true,
    responsive: true,
    language: {
        search: "_INPUT_",
        searchPlaceholder: "Search",
    },
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
            text: '<i class="fas fa-file-excel"></i> Excel',
            className:
                "!bg-teal-700 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !important !flex !items-center !justify-center",
            titleAttr: "Export to Excel",
            exportOptions: {
                columns: ".export",
            },
        },
        {
            extend: "csvHtml5",
            text: '<i class="fas fa-file-csv"></i> CSV',
            className:
                "!bg-yellow-500 !text-[12px] !text-white !border-none !hover:bg-yellow-400 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
            titleAttr: "Export to CSV",
            exportOptions: {
                columns: ".export",
            },
        },
        {
            extend: "pdfHtml5",
            text: '<i class="fas fa-file-pdf"></i> PDF',
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
            text: '<i class="fas fa-print"></i> Print',
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
            table.column(6).search(selectedSection).draw(); // Filter the table based on the clicked section
            section.innerHTML = 'Section : ' + selectedSection;
        } else {
            table.column(6).search("").draw(); // Clear the filter to show all
            section.innerHTML = 'Section : ';
        }

        $("#dropdown").addClass("hidden"); // Close the dropdown
    });
});