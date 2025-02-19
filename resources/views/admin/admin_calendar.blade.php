@include('admin.includes.header')


<body class="font-poppins bg-gray-200">
  <div class="flex w-full h-screen">
    <!-- Sidebar -->
    @include('admin.includes.sidebar')

    <!-- Main Content -->
    <main class="flex-grow bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50" id="content">
      <header class="sticky top-0 z-[10]">
        @include('admin.includes.topnav')
      </header>

      <div class="p-5">
        <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
        <h1 class="text-2xl font-bold text-teal-900 ml-5">Dashboard</h1>

        <div class="bg-teal-700 p-5 shadow-lg mt-10 rounded-t-lg">
          <h2 class="text-md font-semibold text-white">
            <i class="fa-solid fa-calendar mr-2"></i> Calendar
          </h2>
        </div>
        <!---->
        <div
          class="bg-white rounded-b-lg p-5 shadow-lg border-t-2 border-teal-700 mt-1 col-span-4 lg:col-span-4 xl:col-span-4 calendar text-teal-900">
          <div class="grid grid-cols-4 gap-4">
            <div class="col-span-4 lg:col-span-3">
              <div id="calendar" class="mt-5 bg-white rounded-lg shadow-lg h-auto"></div>
            </div>

            <div class="col-span-4 lg:col-span-1">
              <h2 class="mt-5 text-sm text-center rounded-t-lg font-bold bg-teal-700 text-white tracking-wider p-3">
                Activities and Events
              </h2>
              <div
                class="eventContainer h-[30rem] xl:h-[40rem] 2xl:h-[50rem] border-2 shadow-lg rounded-b-lg overflow-y-scroll overflow-x-hidden"
                id="eventContainer"></div>
            </div>
          </div>
        </div>

        <!-- Modal for Event Submission -->
        <div id="eventModal"
          class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-[12] hidden">
          <div class="bg-white rounded-lg p-5 w-1/2">
            <div class="flex justify-between items-center py-2 px-1">
              <h3 class="text-sm font-normal text-teal-900">Submit Event / Activity for <br /> <span
                  class="text-sm font-bold" id="modalDate"></span></h3>
              <button id="btn-toggle"
                class="closeModal text-sm flex justify-center items-center bg-teal-800 text-white shadow-lg ml-0 py-1 px-1 transition-all duration-300 hover:bg-teal-700 rounded-full"><i
                  class="fa-solid fa-xmark text-normal p-2"></i></button>
            </div>
            <form id="eventFormModal" action="{{ route('events.store') }}" method="POST">
              @csrf
              <div class="form-group my-5">
                <label for="event_date" class="font-semibold text-[14px]"><span class="text-red-500">*</span> Event /
                  Activity
                  Date</label>
                <input type="date" name="event_date" id="event_date_modal" required readonly
                  class="form-control w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 font-normal text-[12px]" />
              </div>

              <div class="form-group mb-5">
                <label for="activity_name" class="font-semibold text-[14px]"><span class="text-red-500">*</span>
                  Event / Activity</label>
                <!-- <textarea name="activity_name" id="activity_name_modal"
                  class=""
                  required></textarea> -->
                <textarea name="activity_name" id="summernote"
                  class="form-control w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 font-normal text-[12px]"></textarea>
                <!-- <textarea id="activity_name_modal" required></textarea> -->
              </div>

              <button type="submit" class="mt-3 w-full bg-teal-700 text-white py-2 rounded-lg hover:bg-teal-800">Submit
                Event</button>
            </form>

            <button class="closeModal mt-4 w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">Close</button>
          </div>
        </div>

        <!-- Edit Event Modal -->
        <div id="editeventModal"
          class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-[12] hidden">
          <div class="bg-white rounded-lg p-5 w-1/2">
            <div class="flex justify-between items-center py-2 px-1">
              <h3 class="text-sm font-normal text-teal-900">
                Edit Event / Activity for <br />
                <span class="text-sm font-bold" id="edit_modalDate"></span>
              </h3>
              <button id="btn-toggle"
                class="closeModal text-sm flex justify-center items-center bg-teal-800 text-white shadow-lg ml-0 py-1 px-1 transition-all duration-300 hover:bg-teal-700 rounded-full">
                <i class="fa-solid fa-xmark text-normal p-2"></i>
              </button>
            </div>

            <!-- Event Edit Form -->
            <form id="editeventFormModal" action="{{ route('events.store') }}" method="POST">
              @csrf
              <div class="form-group my-5">
                <label for="event_date_modal" class="font-semibold text-[14px]">
                  <span class="text-red-500">*</span> Event / Activity Date
                </label>
                <input type="date" name="event_date" id="edit_event_date_modal" required readonly
                  class="form-control w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 font-normal text-[12px]" />
              </div>

              <div class="form-group mb-5">
                <label for="activity_name_modal" class="font-semibold text-[14px]">
                  <span class="text-red-500">*</span> Event / Activity
                </label>
                <textarea name="activity_name" id="edit_activity_name_modal"
                  class="form-control w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 font-normal text-[12px]"
                  required></textarea>
              </div>

              <button type="submit" class="mt-3 w-full bg-teal-700 text-white py-2 rounded-lg hover:bg-teal-800">
                Update Event
              </button>
            </form>

            <!-- Close Button -->
            <button class="closeModal mt-4 w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">Close</button>
          </div>
        </div>

        <div class="bg-white rounded-lg p-5 col-span-4 lg:col-span-4 xl:col-span-4 border-2 shadow-lg">
          <!-- <form method="post">
            <textarea id="summernote" name="editordata"></textarea>
          </form>
          Run summernote -->
        </div>
      </div>
    </main>
  </div>

  <script>

    $(document).ready(function () {
      //   $('#summernote').summernote({
      //     placeholder: 'Type Event or Activity...',
      //     tabsize: 2,
      //     height: 120,
      //     toolbar: [
      //       ['style', ['style']],
      //       ['font', ['bold', 'underline', 'clear']],
      //       ['color', ['color']],
      //       ['para', ['ul', 'ol', 'paragraph']],
      //       ['table', ['table']],
      //       ['insert', ['link']],
      //       ['view', ['fullscreen', 'help']]
      //     ]
      //   });

      const calendarEl = document.getElementById('calendar');

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: function (info, successCallback, failureCallback) {
          fetch(`/api/events?start=${info.startStr}&end=${info.endStr}`)
            .then(response => response.json())
            .then(data => successCallback(data))
            .catch(() => failureCallback());
        },
        dateClick: function (info) {
          openModal(info.dateStr);
        }
      });

      calendar.render();

      // Modal handling
      const modal = document.getElementById('eventModal');
      const closeModalBtn = document.querySelectorAll('.closeModal');
      const modalDateSpan = document.getElementById('modalDate');
      const eventDateInput = document.getElementById('event_date_modal');
      const eventFormModal = document.getElementById('eventFormModal');

      // Open the modal and set the clicked date

      function openModal(date) {
        modalDateSpan.innerText = date;
        eventDateInput.value = date; // Pre-fill the event date
        modal.classList.remove('hidden'); // Show modal
      }

      // Close the modal
      closeModalBtn.forEach(item => {
        item.addEventListener('click', () => {
          modal.classList.add('hidden');
        });
      });

      // Handle event submission via the modal
      eventFormModal.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(eventFormModal);
        fetch(eventFormModal.action, {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            // After submission, hide the modal
            modal.classList.add('hidden');
            window.location.reload();
          })
          .catch(error => {
            console.error('Error submitting event:', error);
          });
      });

      // Fetch events and display them in the container
      fetch('/events')
        .then(response => response.json())
        .then(events => {
          const eventContainer = document.getElementById('eventContainer');
          eventContainer.innerHTML = ''; // Clear existing events

          events.forEach(event => {
            const eventItem = document.createElement('div');
            eventItem.className = 'announcement-item cursor-pointer p-3 border-b hover:bg-teal-800 text-[13px]';
            eventItem.innerHTML = `<p>${event.activity_name} <br/><br/> ${new Date(event.event_date).toLocaleDateString()}</p>`;

            // Add click event to edit the event
            eventItem.addEventListener('click', () => {
              editEvent(event);  // Show modal for editing the event
            });

            eventContainer.appendChild(eventItem);
          });
        });

      // Function to open the modal and populate the fields with the event data for editing
      function editEvent(event) {
        const modal = document.getElementById('editeventModal');
        const modalDateSpan = document.getElementById('edit_modalDate');
        const eventDateInput = document.getElementById('edit_event_date_modal');
        const activityNameInput = document.getElementById('edit_activity_name_modal');

        // Populate the modal with the event details
        modalDateSpan.innerText = new Date(event.event_date).toLocaleDateString();  // Display event date
        eventDateInput.value = event.event_date;  // Set the event date in the input
        activityNameInput.value = event.activity_name;  // Set the activity name in the textarea

        // Set the event ID on the form for updating
        const editeventFormModal = document.getElementById('editeventFormModal');
        eventFormModal.dataset.eventId = event.id;

        // Show the modal
        modal.classList.remove('hidden');
      }

      // Handle form submission for editing or updating the event
      const editeventFormModal = document.getElementById('editeventFormModal');
      eventFormModal.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(eventFormModal);
        const eventId = eventFormModal.dataset.eventId;

        // Send the form data to the server to update the event
        fetch(`/events/${eventId}`, {
          method: 'PUT',  // PUT request for updating the event
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            // After successful update, hide the modal and refresh the event list
            const modal = document.getElementById('editeventModal');
            modal.classList.add('hidden');
            window.location.reload();  // Refresh the page to reflect changes
          })
          .catch(error => {
            console.error('Error submitting event:', error);
          });
      });

      // Close modal when the close button is clicked
      const editcloseModalBtn = document.querySelectorAll('.closeModal');
      closeModalBtn.forEach(item => {
        item.addEventListener('click', () => {
          const modal = document.getElementById('editeventModal');
          modal.classList.add('hidden');
        });
      });


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
    });
  </script>
</body>

</html>

<!-- @include('admin.includes.js-link') -->