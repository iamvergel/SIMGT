$(document).ready(function () {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    var table = $("#announcementTable").DataTable({
        dom:
            ` 
            <'flex justify-between items-center hidden'>` +
            `<tr>` +
            `<'flex justify-between items-center'<'flex-1'l><'flex-1'p>>`,
        paging: true,
        searching: false,
        ordering: true,
        info: true,
        scrollY: "600px",
    });

    $("#announcements_body").summernote({
        placeholder: "Enter Announcement...",
        tabsize: 2,
        height: 200,
        zIndex: 500,
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["view", ["fullscreen"]],
        ],
        callbacks: {
            onInit: function () {
                $(".note-editor").css("background-color", "#fff");
            },
            onFullscreen: function (isFullscreen) {
                if (isFullscreen) {
                    $(".note-editor").css("background-color", "#fff");
                } else {
                    $(".note-editor").css("background-color", "");
                }
            },
        },
    });

    function fetchAnnouncements() {
        fetch("/announcements")
            .then((response) => response.json())
            .then((announcements) => {
                const announcementHistory = document.getElementById(
                    "announcementHistory"
                );
                announcementHistory.innerHTML = ""; 

                if (announcements.length === 0) {
                    const noAnnouncementMessage = document.createElement("div");
                    noAnnouncementMessage.className =
                        "text-center text-sm text-gray-600 py-5";
                    noAnnouncementMessage.innerHTML =
                        "No Announcements Available";
                    announcementHistory.appendChild(noAnnouncementMessage);
                    return; 
                }

                announcements.forEach((announcement) => {
                    const announcementItem = document.createElement("div");
                    const createdAt = new Date(
                        announcement.created_at
                    ).toLocaleString();

                    const textareaId = `announcementsbody_${announcement.id}`;

                    announcementItem.className =
                        "announcement-item cursor-pointer border-b hover:bg-teal-800 text-[12px]";
                    announcementItem.innerHTML = `
                        <p class="text-lg font-bold uppercase my-3"> <small class="font-normal mr-2">TITLE : </small> ${announcement.announcements_head} </p>
                        <textarea name="announcements_body" id="${textareaId}" required
                        class="w-full bg-teal-700 p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px]"
                        style="resize: none;" rows="15"></textarea>
                        <p class="mt-5">${createdAt}</p>
                    `;

                    announcementHistory.appendChild(announcementItem);

                    $("#" + textareaId).summernote({
                        placeholder: "Enter Announcement...",
                        tabsize: 2,
                        height: 250,
                        toolbar: [
                            ["style", ["style"]],
                            [
                                "font",
                                [
                                    "bold",
                                    "underline",
                                    "clear",
                                    "superscript",
                                    "subscript",
                                ],
                            ],
                            ["fontsize", ["fontsize"]],
                            ["color", ["color"]],
                            ["para", ["ul", "ol", "paragraph"]],
                        ],
                        callbacks: {
                            onInit: function () {
                                $(".note-editor").css(
                                    "background-color",
                                    "#fff"
                                );
                                $(".note-editor").css("font-size", "15px");
                            },
                        },
                    });

                    $("#" + textareaId).summernote(
                        "code",
                        announcement.announcements_body
                    );

                    announcementItem.addEventListener("click", () => {
                        editAnnouncement(announcement);
                    });
                });
            })
            .catch((error) =>
                console.error("Error fetching announcements:", error)
            );
    }

    function editAnnouncement(announcement) {
        const announcementsHeadInput =
            document.getElementById("announcements_head");
        const announcementsBodyInput =
            document.getElementById("announcements_body");

        announcementsHeadInput.value = announcement.announcements_head;

        $("#announcements_body").summernote(
            "code",
            announcement.announcements_body
        );

        const announcementForm = document.getElementById("announcementForm");
        announcementForm.dataset.announcementId = announcement.id;

        document
            .getElementById("announcementFormModal")
            .classList.remove("hidden");

        document.getElementById("announcementFormTitle").innerHTML =
            "Update Announcement";
        document.getElementById("submitUpdate").innerHTML = "Update";

        document.getElementById("delete").classList.remove("hidden");

        document.getElementById("delete").onclick = function () {
            deleteAnnouncementHandler(announcement.id);
        };
    }

    function deleteAnnouncementHandler(announcementId) {
        if (confirm("Are you sure you want to delete this Announcement?")) {
            fetch(`/announcements/${announcementId}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.message) {
                        alert(data.message);
                        fetchAnnouncements();
                        document
                            .getElementById("announcementFormModal")
                            .classList.add("hidden");
                    }
                })
                .catch((error) => {
                    console.error("Error deleting announcement:", error);
                    alert("An error occurred while deleting the announcement.");
                });
        }
    }

    const announcementForm = document.getElementById("announcementForm");
    announcementForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(announcementForm);
        const announcementId = announcementForm.dataset.announcementId;

        const method = announcementId ? "PUT" : "POST";

        formData.append("_method", method);

        fetch(`/announcements${announcementId ? "/" + announcementId : ""}`, {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                fetchAnnouncements();
                announcementForm.reset();
                delete announcementForm.dataset.announcementId;
                // announcementForm.querySelector("button").innerText = "Add Announcement";
                document
                    .getElementById("announcementFormModal")
                    .classList.add("hidden");
            })
            .catch((error) => {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            });
    });

    document
        .getElementById("addAnnouncement")
        .addEventListener("click", function () {
            const announcementForm =
                document.getElementById("announcementForm");
            announcementForm.reset();
            delete announcementForm.dataset.announcementId;
            // announcementForm.querySelector("button").innerText = "Add Announcement";

            document
                .getElementById("announcementFormModal")
                .classList.remove("hidden");

            $("#announcements_body").summernote("code", "");

            document.getElementById("delete").classList.add("hidden");

            document.getElementById("announcementFormTitle").innerHTML =
                "Add Announcement";
            document.getElementById("submitUpdate").innerHTML = "Submit";
        });

    document
        .getElementById("closeModalForm")
        .addEventListener("click", function () {
            document
                .getElementById("announcementFormModal")
                .classList.add("hidden");
        });

    fetchAnnouncements();

    document
        .getElementById("addAnnouncementPicture")
        .addEventListener("click", function () {
            let date = new Date().toISOString().split("T")[0];

            document.getElementById("announcementDate").value = date;

            document
                .getElementById("addAnnouncementModal")
                .classList.remove("hidden");
        });

    document
        .getElementById("closeModalFormAnnouncement")
        .addEventListener("click", function () {
            document
                .getElementById("addAnnouncementModal")
                .classList.add("hidden");
        });

    document
        .getElementById("closeUpdateModal")
        .addEventListener("click", function () {
            document
                .getElementById("updateAnnouncementModal")
                .classList.add("hidden");
        });

    document
        .getElementById("closeDeleteModal")
        .addEventListener("click", function () {
            document
                .getElementById("deleteAnnouncementModal")
                .classList.add("hidden");
        });

    document.getElementById("cancel").addEventListener("click", function () {
        document
            .getElementById("deleteAnnouncementModal")
            .classList.add("hidden");
    });
});
