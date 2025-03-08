@include('student.includes.header')

<body class="font-poppins bg-gray-200">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('student.includes.sidebar')

        <!-- Main Content -->
        <main
            class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-hidden overflow-y-scroll">
            @include('student.includes.topnav')

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


    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
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