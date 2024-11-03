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

    .circle {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: #e0e7ef;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .circle::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background-color: transparent;
      clip-path: circle(50% at 50% 50%);
      background: conic-gradient(#38b2ac 0%,
          #38b2ac var(--percentage),
          #e0e7ef var(--percentage),
          #e0e7ef 100%);
    }

    .bg-white {
      background-color: #fff;
    }

    .border-2 {
      border-width: 2px;
    }

    #eventContainer {
      display: flex;
      flex-direction: column;
      gap: 10px;
      padding: 1rem;
    }

    .activity {
      background-color: #0d9488;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .activity h4 {
      margin: 0;
      color: #fff;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .activity p {
      margin: 5px 0 0;
      color: #fff;
      font-size: 13px;
      font-weight: 1px;
      letter-spacing: 1px;
    }

    .announcement-item {
      background-color: #0d9488;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      padding: 10px;
      margin: 5px 0;
      cursor: pointer;
      transition: background-color 0.3s;
      color: #fff;
    }

    .announcement-item:hover {
      background-color: #0f766e;
    }

    .announcement-item strong {
      font-size: 15px;
      color: #fff;
      font-weight: 600;
      letter-spacing: 1px;
    }

    #announcementHistory {
      scrollbar-width: thin;
    }

    .fc-toolbar {
      background-color: #e0f7fa;
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

    @media (min-width: 1024px) {
      .fc-toolbar {
        background-color: #e0f7fa;
        font-size: 15px;
      }
    }
  </style>
</head>

<body class="font-poppins bg-gray-200">
  <div class="flex p-2 w-full h-screen">
    <!-- Sidebar -->
    @include('admin.includes.sidebar')

    <!-- Main Content -->
    <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50"
      id="content">
      <header class="">
        @include('admin.includes.header')
      </header>

      <div class="p-5">
        <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
        <h1 class="text-2xl font-bold text-teal-900 ml-5">Dashboard</h1>

        <div class="grid grid-cols-4 gap-5 mt-10">
          <!---->
          <div class="bg-white rounded-lg p-5 shadow-lg col-span-4 lg:col-span-2 xl:col-span-2 border-2 studentchart">
            <div class="bg-teal-100 p-5 rounded-lg shadow-lg">
              <h2 class="text-md font-bold text-teal-900">
                <i class="fas fa-users text-teal-950 mr-2"></i> Total Number of Students by Grade
              </h2>
              <p class="text-sm text-teal-900 ml-9">Distribution of students in grades 1 to 6</p>
              <div class="flex justify-end mt-3 transition duration-300">
                <button id="barButton"
                  class="bg-teal-600 text-white rounded px-3 py-1 transform transition-all duration-300 hover:bg-teal-800 hover:-translate-y-1">Bar</button>
                <button id="lineButton"
                  class="bg-teal-600 text-white rounded px-3 py-1 mx-3 transform transition-all duration-300 hover:bg-teal-800 hover:-translate-y-1">Line</button>
                <button id="waveButton"
                  class="bg-teal-600 text-white rounded px-3 py-1 transform transition-all duration-300 hover:bg-teal-800 hover:-translate-y-1">Wave</button>
              </div>
            </div>

            @if($studentCounts->isEmpty())
              <p class="mt-5 text-teal-800 text-[12px] text-center">No students found for any grade.</p>
            @else
              <canvas id="studentChart" width="400" height="250"></canvas>
              <div id="totalStudents" class="text-teal-800 my-3 text-[14px]"></div>
              <div id="totalMaleStudent" class="text-teal-800 my-3 text-[14px]"></div>
              <div id="totalFemaleStudent" class="text-teal-800 my-3 text-[14px]"></div>
            @endif
          </div>

          <!---->
          <div class="bg-gray-200 rounded-lg p-5 shadow-lg col-span-4 lg:col-span-2 xl:col-span-2 border-2 staffchart">
            <div class="bg-white p-5 py-7 rounded-lg shadow-lg">
              <div class="bg-yellow-100 p-5 py-7 rounded-lg shadow-lg">
                <h2 class="text-md font-bold text-yellow-900">
                  <i class="fas fa-users text-yellow-950 mr-2"></i> Total Number of Admins
                </h2>
              </div>
              <div class="flex justify-center items-center mt-5">
                <div class="relative">
                  <div class="circle">
                    <span id="percentage"
                      class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-teal-900 font-bold text-2xl">0%</span>
                  </div>
                </div>
              </div>
              <div id="totalStaff" class="mt-10 text-sm text-center text-teal-900 font-normal">
                <span id="currentStaff" class="font-bold">0</span> / <span id="total" class="font-bold mr-3">0</span>
                Total of Admins
              </div>
            </div>
          </div>

          <!---->
          <div
            class="bg-white rounded-lg p-5 shadow-lg border-2 col-span-4 lg:col-span-4 xl:col-span-4 calendar text-teal-900">
            <h2 class="text-start text-md font-bold p-7 shadow-lg bg-teal-100">
              <i class="fa-solid fa-calendar mr-2"></i> Calendar
            </h2>
            <div class="grid grid-cols-4">
              <div class="col-span-4">
                <div id='calendar' class="p-10 bg-white rounded-lg shadow-lg h-auto"></div>
              </div>

              <div class="col-span-4 lg:col-span-2 px-5">
                <h2 class="mt-5 text-sm font-bold bg-teal-700 text-white tracking-wider p-5 py-5 rounded-lg"><i
                    class="fas fa-calendar mr-2"></i>Activities and
                  Events </h2>
                <form id="eventForm" action="{{ route('events.store') }}" method="POST"
                  class="mt-5 bg-white p-5 rounded-lg shadow-lg border-2">
                  @csrf <!-- Include CSRF token for security -->

                  <label for="event_date" class="font-semibold text-[15px] mt-4"><span
                      class="text-red-500">*</span>Event
                    Date</label>
                  <input type="date" name="event_date" id="event_date" required
                    class="w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 font-bold text-[15px]"
                    aria-describedby="eventDateHelp">
                  <small id="eventDateHelp" class="text-gray-500">Please select a date for the event.</small>
                  <br /><br />

                  <label for="activity_name" class="font-semibold text-[15px]"><span class="text-red-500">*</span>Event
                    Name</label>
                  <input type="text" name="activity_name" id="activity_name" required
                    class="w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px]"
                    aria-describedby="activityNameHelp">
                  <small id="activityNameHelp" class="text-gray-500">Enter the name of the event.</small>

                  <input type="hidden" name="_method" id="method" value="POST">

                  <button type="submit"
                    class="mt-3 w-full indent-[-1rem] bg-teal-700 text-white py-2 rounded-lg hover:bg-teal-800 transition py-5 text-[15px] font-bold">Submit
                    Event
                  </button>
                </form>
              </div>

              <div class="col-span-4 lg:col-span-2 px-5">
                <h2 class="mt-5 text-sm text-center font-bold bg-teal-700 text-white tracking-wider p-3 rounded-lg"><i
                    class="fas fa-calendar mr-2"></i>Activities and
                  Events <br>History </h2>
                <div
                  class="eventContainer h-80 xl:h-80 shadow-lg rounded-lg overflow-y-scroll overflow-x-hidden border-2"
                  id="eventContainer"></div>
              </div>
            </div>
          </div>

          <!-- announcement rows -->
          <div class="bg-gray-200 rounded-lg p-4 col-span-4 lg:col-span-4 xl:col-span-4 shadow-lg">
            <div class="bg-gray-200 rounded-lg p-2 col-span-2">
              <div class="grid grid-cols-4 gap-2">
                <div class="bg-white rounded-lg p-5 col-span-4 xl:col-span-2 shadow-lg">
                  <div class="bg-yellow-100 p-5 rounded-lg shadow-lg">
                    <h2 class="text-md font-bold text-yellow-900">
                      <i class="fas fa-bullhorn text-yellow-950 mr-2"></i>Announcements
                    </h2>
                  </div>

                  <div class="col-span-4 lg:col-span-2 px-5 text-teal-900">
                    <form id="announcementForm" action="{{ route('announcements.store') }}" method="POST"
                      class="mt-5 bg-white p-5 rounded-lg shadow-lg border-2">
                      @csrf

                      <label for="announcements_head" class="font-semibold text-[15px] mt-4"><span
                          class="text-red-500">*</span>Announcement Title</label>
                      <input type="text" name="announcements_head" id="announcements_head" required
                        class="w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 font-bold text-[15px]">
                      <small id="titleHelp" class="text-gray-500">Enter the title of the announcement.</small> <br />
                      <br />

                      <label for="announcements_body" class="font-semibold text-[15px] mt-4"> <span
                          class="text-red-500">*</span>Announcement
                        Description</label>
                      <textarea name="announcements_body" id="announcements_body" required
                        class="w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px]"
                        style="resize: none;" rows="15"></textarea>
                      <small id="descriptionHelp" class="text-gray-500">Enter the description of the
                        announcement.</small>

                      <button type="submit"
                        class="mt-3 w-full bg-yellow-700 text-white py-2 rounded-lg hover:bg-yellow-800 transition py-5 ">
                        Add Announcement
                      </button>
                    </form>
                  </div>
                </div>
                <div class="bg-white my-2 rounded-lg p-1 col-span-4 xl:col-span-2 shadow-lg">
                  <div class="bg-yellow-100 p-2 rounded-lg shadow-lg text-center mb-5">
                    <h2 class="text-md font-bold text-yellow-900">
                      <i class="fas fa-bullhorn text-yellow-900 mr-2"></i>Announcements <br /> History
                    </h2>
                  </div>
                  <div
                    class="bg-white h-96 xl:h-[650px] overflow-x-hidden overflow-y-scroll rounded-lg border-2 p-5 shadow-lg"
                    id="announcementHistory"></div>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-lg p-5 col-span-4 lg:col-span-4 xl:col-span-4 border-2 shadow-lg"></div>
          </div>
        </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const studentData = @json($studentCounts);
      const totalStudents = Object.values(studentData).reduce((sum, current) => sum + current, 0);

      const totalMaleStudent = @json($totalMaleStudent);
      const totalMaleStudents = Object.values(totalMaleStudent).reduce((sum, current) => sum + current, 0);

      const totalFemaleStudent = @json($totalFemaleStudent);
      const totalFemaleStudents = Object.values(totalFemaleStudent).reduce((sum, current) => sum + current, 0);

      // Update chart
      const ctx = document.getElementById('studentChart').getContext('2d');

      // Create a gradient
      const gradient = ctx.createLinearGradient(0, 0, 0, 400);
      gradient.addColorStop(1, 'rgba(19,78,74,1)');
      gradient.addColorStop(0.5, 'rgba(15,118,110,0.8)');
      gradient.addColorStop(0, 'rgba(20,184,166,0.5)');

      // Create the initial chart
      let studentChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: Object.keys(studentData),
          datasets: [{
            label: 'Number of Students',
            data: Object.values(studentData),
            backgroundColor: gradient,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Number of Students'
              }
            }
          }
        }
      });

      // Button event listeners
      document.getElementById('barButton').addEventListener('click', () => {
        studentChart.destroy();
        studentChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: Object.keys(studentData),
            datasets: [{
              label: 'Number of Students',
              data: Object.values(studentData),
              backgroundColor: gradient,
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: 'Number of Students'
                }
              }
            }
          }
        });
      });

      document.getElementById('lineButton').addEventListener('click', () => {
        studentChart.destroy();
        studentChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: Object.keys(studentData),
            datasets: [{
              label: 'Number of Students',
              data: Object.values(studentData),
              borderColor: gradient,
              backgroundColor: 'rgba(255, 255, 255, 0)', // Transparent fill
              borderWidth: 2,
              pointBackgroundColor: 'rgba(15,118,110,1)', // Dot color
              pointRadius: 5, // Size of the dots
              fill: false // No fill under the line
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: 'Number of Students'
                }
              }
            }
          }
        });
      });

      // Wave effect using line chart
      document.getElementById('waveButton').addEventListener('click', () => {
        studentChart.destroy();
        studentChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: Object.keys(studentData),
            datasets: [{
              label: 'Number of Students',
              data: Object.values(studentData),
              borderColor: gradient,
              backgroundColor: 'rgba(255, 255, 255, 0)',
              borderWidth: 2,
              pointBackgroundColor: 'rgba(15,118,110,1)', // Dot color
              pointRadius: 5,
              fill: false,
              tension: 0.4 // Makes the line more wave-like
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: 'Number of Students'
                }
              }
            }
          }
        });
      });

      // Update totals
      document.getElementById('totalStudents').innerHTML = `Total Number of Active Students: <span class="font-bold text-md">${totalStudents}</span> Students`;
      document.getElementById('totalMaleStudent').innerHTML = `Total Number of Male Students: <span class="font-bold text-md">${totalMaleStudents}</span> Students`;
      document.getElementById('totalFemaleStudent').innerHTML = `Total Number of Female Students: <span class="font-bold text-md">${totalFemaleStudents}</span> Students`;

      // Staff percentage calculations
      const totalStaff = {{ $totalStaff }};
      const currentStaff = {{ $currentStaff }};
      const percentage = totalStaff > 0 ? (currentStaff / totalStaff) * 100 : 0;

      document.getElementById('percentage').innerText = Math.round(percentage) + '%';
      document.getElementById('currentStaff').innerText = currentStaff;
      document.getElementById('total').innerText = totalStaff;
      document.querySelector('.circle').style.setProperty('--percentage', `${percentage}%`);

      // Fetch events and display them
      function fetchEvents() {
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

              })
              .catch(error => {
                console.error('Error fetching events:', error);
              });
          }
        });

        calendar.render();


        fetch('/events')
          .then(response => response.json())
          .then(events => {
            const eventContainer = document.getElementById('eventContainer');
            eventContainer.innerHTML = ''; // Clear existing events

            events.forEach(event => {
              const eventItem = document.createElement('div');
              eventItem.className = 'announcement-item cursor-pointer p-2 border-b hover:bg-teal-800 text-[13px]';
              eventItem.innerHTML = `<p>${event.activity_name} <br/> ${new Date(event.event_date).toLocaleDateString()}</p>`;

              // Add click event to edit the event
              eventItem.addEventListener('click', () => {
                editEvent(event);
              });

              eventContainer.appendChild(eventItem);
            });
          });
      }
      // Edit event function
      function editEvent(event) {
        // Populate the form with event data
        const eventDateInput = document.getElementById('event_date');
        const activityNameInput = document.getElementById('activity_name');

        const eventDate = new Date(event.event_date);
        const localDateString = eventDate.toLocaleDateString('en-CA'); // 'en-CA' formats as YYYY-MM-DD

        eventDateInput.value = localDateString;
        activityNameInput.value = event.activity_name;

        // Change form to handle updating the event
        const eventForm = document.getElementById('eventForm');
        eventForm.dataset.eventId = event.id; // Store the event ID for updating
        eventForm.querySelector('button').innerText = 'Update Event';
      }

      // Handle event form submission
      const eventForm = document.getElementById('eventForm');
      eventForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(eventForm);
        const eventId = eventForm.dataset.eventId;

        const method = eventId ? 'PUT' : 'POST'; // Determine method based on whether editing or adding

        // Make sure to include the CSRF token if needed
        formData.append('_method', method); // Laravel requires this for PUT

        fetch(`/events${eventId ? '/' + eventId : ''}`, {
          method: 'POST',
          body: formData,
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            fetchEvents(); // Refresh event list
            eventForm.reset(); // Clear the form
            delete eventForm.dataset.eventId; // Remove event ID
            eventForm.querySelector('button').innerText = 'Add Event'; // Reset button text
          })
          .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
          });
      });

      fetchEvents(); // Fetch events on page load

      // Fetch announcements and display them
      function fetchAnnouncements() {
        fetch('/announcements')
          .then(response => response.json())
          .then(announcements => {
            const announcementHistory = document.getElementById('announcementHistory');
            announcementHistory.innerHTML = ''; // Clear existing announcements

            announcements.forEach(announcement => {
              const announcementItem = document.createElement('div');
              const createdAt = new Date(announcement.created_at).toLocaleString();

              announcementItem.className = 'announcement-item cursor-pointer my-4 p-2 border-b hover:bg-teal-800 text-[12px]';
              announcementItem.innerHTML = `<p>${announcement.announcements_head} <br/>
                                            Created at: ${createdAt}</p>`;
              // Add click event to edit the announcement
              announcementItem.addEventListener('click', () => {
                editAnnouncement(announcement);
              });

              announcementHistory.appendChild(announcementItem);
            });
          })
          .catch(error => console.error('Error fetching announcements:', error));
      }

      // Edit announcement function
      function editAnnouncement(announcement) {
        const announcementsHeadInput = document.getElementById('announcements_head');
        const announcementsBodyInput = document.getElementById('announcements_body');

        announcementsHeadInput.value = announcement.announcements_head;
        announcementsBodyInput.value = announcement.announcements_body;

        // Change form to handle updating the announcement
        const announcementForm = document.getElementById('announcementForm');
        announcementForm.dataset.announcementId = announcement.id; // Store the announcement ID
        announcementForm.querySelector('button').innerText = 'Update Announcement';
      }

      // Handle announcement form submission
      const announcementForm = document.getElementById('announcementForm');
      announcementForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(announcementForm);
        const announcementId = announcementForm.dataset.announcementId;

        const method = announcementId ? 'PUT' : 'POST'; // Determine method based on whether editing or adding

        // Make sure to include the CSRF token if needed
        formData.append('_method', method); // Laravel requires this for PUT

        fetch(`/announcements${announcementId ? '/' + announcementId : ''}`, {
          method: 'POST',
          body: formData,
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            fetchAnnouncements(); // Refresh event list
            announcementForm.reset(); // Clear the form
            delete announcementForm.dataset.announcementId; // Remove event ID
            announcementForm.querySelector('button').innerText = 'Add Announcement'; // Reset button text
          })
          .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
          });
      });

      fetchAnnouncements(); // Fetch announcements on page load
    });
  </script>

</body>

</html>