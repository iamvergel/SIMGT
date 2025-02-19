document.addEventListener("DOMContentLoaded", function () {
    // Fetch events and display them
    function fetchEvents() {
        const calendarEl = document.getElementById("calendar");

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",

            events: function (info, successCallback, failureCallback) {
                fetch(`/api/events?start=${info.startStr}&end=${info.endStr}`)
                    .then((response) => response.json())
                    .then((data) => {
                        successCallback(data);
                    })
                    .catch(() => {
                        failureCallback();
                    });
            },
            dateClick: function (info) {
                fetch(`/api/events?date=${info.dateStr}`)
                    .then((response) => response.json())
                    .then((events) => {
                        document.querySelector("#dateEvent").innerHTML =
                            new Date(info.dateStr).toLocaleDateString("en-US", {
                                year: "numeric",
                                month: "long",
                                day: "numeric",
                            });

                        const activityEventContent = document.querySelector(
                            ".activityEventContent"
                        );

                        activityEventContent.innerHTML = `<div class="bg-teal-500 text-white font-semibold hidden">${info.dateStr}</div><br/>`;

                        activityEventContent.innerHTML += `<ul class="text-[14px] text-teal-900">`;

                        if (events.length > 0) {
                            events.forEach((event) => {
                                activityEventContent.innerHTML += `<li class="text-md text-teal-900">${event.activity_name}</li> <br/>`;
                            });
                        } else {
                            activityEventContent.innerHTML += `<p class="text-md text-teal-900">No events for this date.</p>`;
                        }

                        activityEventContent.innerHTML += `</ul>`;

                        document
                            .getElementById("activityModal")
                            .classList.remove("hidden");
                    })
                    .catch((error) => {
                        console.error("Error fetching events:", error);
                        const activityEventContent = document.querySelector(
                            ".activityEventContent"
                        );
                        activityEventContent.innerHTML = `<div>Error fetching events.</div>`;
                        document
                            .getElementById("activityModal")
                            .classList.remove("hidden");
                    });
            },
        });

        calendar.render();

        document
            .getElementById("closeModal")
            .addEventListener("click", function () {
                document
                    .getElementById("activityModal")
                    .classList.add("hidden");
            });
        document
            .getElementById("closeModalForm")
            .addEventListener("click", function () {
                document.getElementById("EventForm").classList.add("hidden");
            });

        document
            .getElementById("addEvent")
            .addEventListener("click", function () {
                const eventDateInput = document.getElementById("event_date");
                const activityNameInput =
                    document.getElementById("activity_name");

                const eventDate = new Date(event.event_date);
                const localDateString = eventDate.toLocaleDateString("en-CA"); // 'en-CA' formats as YYYY-MM-DD

                eventDateInput.value = '';
                activityNameInput.value = '';

                // Change form to handle updating the event
                const eventForm = document.getElementById("eventForm");
                eventForm.dataset.eventId = ''; // Store the event ID for updating
                eventForm.querySelector("button").innerText = "Submit";

                document.querySelector("#eventFormTitle").innerHTML =
                    "Add Event / Activities";
                document.getElementById("EventForm").classList.remove("hidden");
            });

        fetch("/events")
            .then((response) => response.json())
            .then((events) => {
                const eventContainer =
                    document.getElementById("eventContainer");
                eventContainer.innerHTML = ""; // Clear existing events

                events.forEach((event) => {
                    const eventItem = document.createElement("div");
                    eventItem.className =
                        "announcement-item cursor-pointer p-3 border-b hover:bg-teal-800 text-[13px]";
                    eventItem.innerHTML = `<p>${
                        event.activity_name
                    } <br/><br/> ${new Date(
                        event.event_date
                    ).toLocaleDateString()}</p>`;

                    // Add click event to edit the event
                    eventItem.addEventListener("click", () => {
                        editEvent(event);

                        document.querySelector("#eventFormTitle").innerHTML =
                            "Edit Event / Activities";

                        document
                            .getElementById("EventForm")
                            .classList.remove("hidden");
                    });

                    eventContainer.appendChild(eventItem);
                });
            });
    }
    // Edit event function
    function editEvent(event) {
        // Populate the form with event data
        const eventDateInput = document.getElementById("event_date");
        const activityNameInput = document.getElementById("activity_name");

        const eventDate = new Date(event.event_date);
        const localDateString = eventDate.toLocaleDateString("en-CA"); // 'en-CA' formats as YYYY-MM-DD

        eventDateInput.value = localDateString;
        activityNameInput.value = event.activity_name;

        // Change form to handle updating the event
        const eventForm = document.getElementById("eventForm");
        eventForm.dataset.eventId = event.id; // Store the event ID for updating
        eventForm.querySelector("button").innerText = "Update";
    }

    // Handle event form submission
    const eventForm = document.getElementById("eventForm");
    eventForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(eventForm);
        const eventId = eventForm.dataset.eventId;

        const method = eventId ? "PUT" : "POST"; // Determine method based on whether editing or adding

        // Make sure to include the CSRF token if needed
        formData.append("_method", method); // Laravel requires this for PUT

        fetch(`/events${eventId ? "/" + eventId : ""}`, {
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
                fetchEvents(); // Refresh event list
                eventForm.reset(); // Clear the form
                delete eventForm.dataset.eventId; // Remove event ID
                eventForm.querySelector("button").innerText = "Add Event"; // Reset button text

                document.getElementById("EventForm").classList.add("hidden");
            })
            .catch((error) => {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            });
    });

    fetchEvents(); // Fetch events on page load

    // Fetch announcements and display them
    function fetchAnnouncements() {
        fetch("/announcements")
            .then((response) => response.json())
            .then((announcements) => {
                const announcementHistory = document.getElementById(
                    "announcementHistory"
                );
                announcementHistory.innerHTML = ""; // Clear existing announcements

                announcements.forEach((announcement) => {
                    const announcementItem = document.createElement("div");
                    const createdAt = new Date(
                        announcement.created_at
                    ).toLocaleString();

                    announcementItem.className =
                        "announcement-item cursor-pointer my-4 p-2 border-b hover:bg-teal-800 text-[12px]";
                    announcementItem.innerHTML = `<p>${announcement.announcements_head} <br/>
                                          Created at: ${createdAt}</p>`;
                    // Add click event to edit the announcement
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

    // Edit announcement function
    function editAnnouncement(announcement) {
        const announcementsHeadInput =
            document.getElementById("announcements_head");
        const announcementsBodyInput =
            document.getElementById("announcements_body");

        announcementsHeadInput.value = announcement.announcements_head;
        announcementsBodyInput.value = announcement.announcements_body;

        // Change form to handle updating the announcement
        const announcementForm = document.getElementById("announcementForm");
        announcementForm.dataset.announcementId = announcement.id; // Store the announcement ID
        announcementForm.querySelector("button").innerText =
            "Update Announcement";
    }

    // Handle announcement form submission
    const announcementForm = document.getElementById("announcementForm");
    announcementForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(announcementForm);
        const announcementId = announcementForm.dataset.announcementId;

        const method = announcementId ? "PUT" : "POST"; // Determine method based on whether editing or adding

        // Make sure to include the CSRF token if needed
        formData.append("_method", method); // Laravel requires this for PUT

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
                fetchAnnouncements(); // Refresh event list
                announcementForm.reset(); // Clear the form
                delete announcementForm.dataset.announcementId; // Remove event ID
                announcementForm.querySelector("button").innerText =
                    "Add Announcement"; // Reset button text
            })
            .catch((error) => {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            });
    });

    fetchAnnouncements(); // Fetch announcements on page load
});
