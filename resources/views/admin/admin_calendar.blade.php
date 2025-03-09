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

        <div class="flex justify-between items-center bg-teal-700 p-5 shadow-lg mt-10 rounded-t-lg">
          <h2 class="text-md font-semibold text-white">
            <i class="fa-solid fa-calendar mr-2"></i> Calendar
          </h2>
        </div>
        <!---->
        <div
          class="bg-white rounded-b-lg p-5 shadow-lg mt-3 border-t-2 border-teal-700 col-span-4 lg:col-span-4 xl:col-span-4 calendar ">
          <div class="w-full flex justify-end py-2 px-5">
            <button
              class="indent-[0rem] px-3 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition py-3 text-md font-semibold"
              id="addEvent"> <i class="fa-solid fa-plus me-1"></i> Add Event & Activities</button>
          </div>

          <div class="grid grid-cols-4 gap-4">
            <div class="col-span-4 lg:col-span-3">
              <div id='calendar' class="mt-5 bg-white rounded-lg h-auto"></div>
            </div>


            <div class="col-span-4 lg:col-span-1">
              <h2 class="mt-5 text-md text-center rounded-t-lg font-bold bg-teal-700 text-white tracking-wider p-3">
                Activities and
                Events</h2>
              <div
                class="eventContainer h-[30rem] xl:h-[55rem] border-2 shadow-lg rounded-b-lg overflow-y-scroll overflow-x-hidden"
                id="eventContainer"></div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div id="activityModal"
          class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
          <div class="bg-gray-100 rounded-lg shadow-lg p-5 w-11/12 max-w-md">
            <div class="flex justify-between items-center p-2 px-4 bg-white  shadow-lg">
              <p id="dateEvent" class="font-bold text-teal-900"></p>
              <span id="closeModal"
                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                  class="fas fa-times fa-lg"></i></span>
            </div>
            <div class="activityEventContent mt-1 p-3 rounded shadow-lg border border-gray-100 bg-white"></div>
          </div>
        </div>

        <!-- Modal -->
        <div id="EventForm" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
          <div class="bg-gray-100 rounded-lg shadow-lg p-5 w-11/12 max-w-md">
            <div class="flex justify-between items-center p-2 px-4 bg-white shadow-l rounded-md">
              <p id="eventFormTitle" class="font-bold text-teal-900"></p>
              <span id="closeModalForm"
                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                  class="fas fa-times fa-lg"></i></span>
            </div>
            <div class="">
              <!-- <h2 class="mt-5 text-sm font-bold bg-teal-700 text-white tracking-wider p-5 py-5 rounded-lg"><i
                  class="fas fa-calendar mr-2"></i>Activities and
                Events </h2> -->
              <form id="eventForm" action="{{ route('events.store') }}" method="POST"
                class="mt-1 bg-white p-5 rounded-lg shadow-lg border-2">
                @csrf

                <label for="event_date" class="font-semibold text-[15px] mt-4"><span class="text-red-500">*</span>Event
                  Date</label>
                <input type="date" name="event_date" id="event_date" required
                  class="w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 font-normal text-md"
                  aria-describedby="eventDateHelp">
                <small id="eventDateHelp" class="text-gray-500">Please select a date for the event.</small>
                <br /><br />

                <label for="activity_name" class="font-semibold text-[15px]"><span class="text-red-500">*</span>Event /
                  Activities
                </label>
                <input type="text" name="activity_name" id="activity_name" required
                  class="w-full p-3 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-md"
                  aria-describedby="activityNameHelp">
                <small id="activityNameHelp" class="text-gray-500">Enter the name of the event.</small>

                <input type="hidden" name="_method" id="method" value="POST">

                <div class="flex justify-end">
                  <button type="submit" id="delete"
                    class="mt-10 w-1/4 indent-[-2rem] bg-red-700 text-white rounded-lg hover:bg-red-800 transition py-2 text-md font-semibold me-2 hidden">Delete
                  </button>
                  <button type="submit" id="submitUpdate"
                    class="mt-10 w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit
                  </button>
                </div>
              </form>
            </div>
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

  <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
  <script src="{{ asset('../js/admin/dashboard.js') }}" type="text/javascript"></script>
  @include('admin.includes.js-link')
</body>

</html>