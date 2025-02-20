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
                            activityEventContent.innerHTML += `<p class="text-md text-teal-900">No events or activity for this date.</p>`;
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
                const deleteEvent = document.getElementById("delete");
                const activityNameInput =
                    document.getElementById("activity_name");

                const eventDate = new Date(event.event_date);
                const localDateString = eventDate.toLocaleDateString("en-CA");

                eventDateInput.value = "";
                activityNameInput.value = "";

                // Change form to handle updating the event
                const eventForm = document.getElementById("eventForm");
                eventForm.dataset.eventId = "";
                document.getElementById("submitUpdate").innerText = "Submit";

                document.querySelector("#eventFormTitle").innerHTML =
                    "Add Event / Activities";
                document.getElementById("EventForm").classList.remove("hidden");

                deleteEvent.classList.add("hidden");
            });

        fetch("/events")
            .then((response) => response.json())
            .then((events) => {
                const eventContainer =
                    document.getElementById("eventContainer");
                eventContainer.innerHTML = "";

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

    function editEvent(event) {
        // Populate the form with event data
        const eventDateInput = document.getElementById("event_date");
        const activityNameInput = document.getElementById("activity_name");
        const deleteEvent = document.getElementById("delete");

        const eventDate = new Date(event.event_date);
        const localDateString = eventDate.toLocaleDateString("en-CA");

        eventDateInput.value = localDateString;
        activityNameInput.value = event.activity_name;

        // Change form to handle updating the event
        const eventForm = document.getElementById("eventForm");
        eventForm.dataset.eventId = event.id;
        document.getElementById("submitUpdate").innerText = "Update";

        // Show delete button
        deleteEvent.classList.remove("hidden");

        // Event listener for the delete button
        deleteEvent.onclick = function () {
            deleteEventHandler(event.id);
        };
    }

    function deleteEventHandler(eventId) {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        if (confirm("Are you sure you want to delete this event?")) {
            fetch(`/events/${eventId}`, {
                method: "DELETE", // Use DELETE method for deleting an event
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken, // Add CSRF token here
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    if (data.message) {
                        alert(data.message);
                        
                        fetchEvents();

                        document
                            .getElementById("EventForm")
                            .classList.add("hidden");
                    }
                })
                .catch((error) => {
                    console.error("Error deleting event:", error);
                    alert("An error occurred while deleting the event.");
                });
        }
    }

    // Handle event form submission
    const eventForm = document.getElementById("eventForm");
    eventForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(eventForm);
        const eventId = eventForm.dataset.eventId;

        const method = eventId ? "PUT" : "POST";

        formData.append("_method", method);

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
                fetchEvents();
                eventForm.reset();
                delete eventForm.dataset.eventId;

                document.getElementById("EventForm").classList.add("hidden");
            })
            .catch((error) => {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            });
    });

    fetchEvents();
});
