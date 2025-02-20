$(document).ready(function () {
    $("#announcements_body").summernote({
        placeholder: "Enter Announcement...",
        tabsize: 2,
        height: 120,
        zIndex: 500,
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "codeview", "help"]],
        ],
        callbacks: {
            onInit: function() {
                $('.note-editor').css('background-color', '#fff'); // Background color for editor
            },
            onFullscreen: function(isFullscreen) {
                if (isFullscreen) {
                    // Add background color when fullscreen is activated
                    $('.note-editor').css('background-color', '#fff');
                } else {
                    // Revert the background when exiting fullscreen (if needed)
                    $('.note-editor').css('background-color', '');
                }
            }
        }
    });
    

    function fetchAnnouncements() {
        fetch("/announcements")
            .then((response) => response.json())
            .then((announcements) => {
                const announcementHistory = document.getElementById(
                    "announcementHistory"
                );
                announcementHistory.innerHTML = "";

                announcements.forEach((announcement) => {
                    const announcementItem = document.createElement("div");
                    const createdAt = new Date(
                        announcement.created_at
                    ).toLocaleString();

                    announcementItem.className =
                        "announcement-item cursor-pointer my-4 p-2 border-b hover:bg-teal-800 text-[12px]";
                    announcementItem.innerHTML = `<p>${announcement.announcements_head} <br/>
                                      Created at: ${createdAt}</p>`;
                    announcementItem.addEventListener("click", () => {
                        editAnnouncement(announcement);
                    });

                    announcementHistory.appendChild(announcementItem);
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
        announcementsBodyInput.value = announcement.announcements_body;

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
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

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
});
