<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>St. Emilie Learning Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon"
        style="border-radius: 50%;">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/20a0e1e87d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
            scrollbar-width: none;
        }

        .fc-toolbar {
            background-color: #fff;
            font-size: 9px;
            font-weight: 700;
            color: #134e4a;
        }

        .fc-daygrid-day {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .fc-daygrid-event {
            background-color: #0f766e;
            color: #134e4a;
            border-radius: 4px;
            border: none;
            padding: 5px;
        }

        .fc-daygrid-event:hover {
            background-color: #115e59;
        }

        #activityModal {
            transition: all 0.3s ease;
        }

        @media (min-width: 1024px) {
            .fc-toolbar {
                background-color: #fff;
                font-size: 15px;
            }
        }
    </style>
</head>

<body class="font-poppins bg-gray-200">
    <div class="flex flex-col lg:flex-row lg:p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('student.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-x-hidden overflow-y-auto w-full bg-zinc-50">
            @include('student.includes.header')

            <div class="p-5 py-3">
                <p class="text-[15px] font-normal text-teal-900 mt-5">Student</p>
                <h1 class="text-xl font-bold text-teal-900">Calendar</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-2">
                <div class="col-span-2 lg:col-span-3 lg:p-5 z-[1]">
                    <div id='calendar' class="p-5 lg:p-10 bg-white rounded-lg shadow-lg h-screen lg:h-auto"></div>
                </div>
                <div class="col-span-2 lg:col-span-1 p-5">
                    <p class="text-teal-800 font-bold text-[15px] mb-5"><i class="fa-solid fa-calendar mr-2"></i>All
                        Activity and Events</p>
                    <div class="bg-white rounded-lg border-2 shadow-lg h-56 lg:h-1/2 px-5 py-5 overflow-y-scroll">
                        <div class="activityEventList" id="activityEventList">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal -->
    <div id="activityModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
        <div class="bg-white rounded-lg shadow-lg p-5 w-11/12 max-w-md">
            <div class="flex justify-between items-center p-5 shadow-lg">
                <h2 class="text-lg font-bold text-teal-900">Activity and Events Details</h2>
                <span id="closeModal"
                    class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded"><i
                        class="fas fa-times fa-lg"></i></span>
            </div>
            <div class="activityEventContent mt-5 p-5 shadow-lg"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',

                events: function (info, successCallback, failureCallback) {
                    fetch(`/api/events?start=${info.startStr}&end=${info.endStr}`)
                        .then(response => response.json())
                        .then(data => {
                            successCallback(data);
                        })
                        .catch(() => {
                            failureCallback();
                        });
                },
                dateClick: function (info) {
                    fetch(`/api/events?date=${info.dateStr}`)
                        .then(response => response.json())
                        .then(events => {
                            const activityEventContent = document.querySelector('.activityEventContent');
                            activityEventContent.innerHTML = `<p class="text-teal-900 font-semibold">${info.dateStr}</p><br/>`;

                            activityEventContent.innerHTML += `<ul class="text-[12px] text-teal-900">`;

                            if (events.length > 0) {
                                events.forEach(event => {
                                    activityEventContent.innerHTML += `<li class="text-[12px] text-teal-900">${event.activity_name}</li>`;
                                });
                            } else {
                                activityEventContent.innerHTML += `<p class="text-[12px] text-teal-900">No events for this date.</p>`;
                            }

                            // Close the unordered list
                            activityEventContent.innerHTML += `</ul>`;
                            // Show the modal
                            document.getElementById('activityModal').classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error fetching events:', error);
                            const activityEventContent = document.querySelector('.activityEventContent');
                            activityEventContent.innerHTML = `<div>Error fetching events.</div>`;
                            document.getElementById('activityModal').classList.remove('hidden');
                        });
                }
            });

            calendar.render();

            // Close modal event
            document.getElementById('closeModal').addEventListener('click', function () {
                document.getElementById('activityModal').classList.add('hidden');
            });

            // Fetch events and display them
            function fetchEvents() {
                fetch('/events')
                    .then(response => response.json())
                    .then(events => {
                        const eventContainer = document.getElementById('activityEventList');
                        eventContainer.innerHTML = ''; // Clear existing events

                        events.forEach(event => {
                            const eventItem = document.createElement('div');
                            eventItem.className = 'announcement-item cursor-pointer p-2 border-b text-[13px] my-2 bg-teal-600 text-white hover:bg-teal-800';
                            eventItem.innerHTML = `<p>${event.activity_name} <br/> ${new Date(event.event_date).toLocaleDateString()}</p>`;

                            eventContainer.appendChild(eventItem);
                        });
                    });
            }

            fetchEvents(); // Fetch events on page load
        });
    </script>
</body>

</html>