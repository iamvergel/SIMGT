@include('admin.includes.header')

<body class="font-poppins bg-gray-200">
  <div class="flex p-2 w-full h-screen">
    <!-- Sidebar -->
    @include('admin.includes.sidebar')

    <!-- Main Content -->
    <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50"
      id="content">
      <header class="">
        @include('admin.includes.topnav')
      </header>

      <div class="p-5">
        <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
        <h1 class="text-2xl font-bold text-teal-900 ml-5">Dashboard</h1>

        <div class="grid grid-cols-4 gap-5 mt-10">
          <!---->
          <div class="bg-white rounded-lg p-5 shadow-lg col-span-4 lg:col-span-4 xl:col-span-4 border-2 studentchart">
            <div class="bg-teal-100 p-5 rounded-lg shadow-lg">
              <h2 class="text-md font-bold text-teal-900">
                <i class="fas fa-users text-teal-950 mr-2"></i> Total Number of Students by Grade
              </h2>
              <p class="text-sm text-teal-900 ml-9">Distribution of students in grades 1 to 6</p>
              <!-- <div class="flex justify-end mt-3 transition duration-300">
                <button id="barButton"
                  class="bg-teal-600 text-white rounded px-3 py-1 transform transition-all duration-300 hover:bg-teal-800 hover:-translate-y-1">Bar</button>
                <button id="lineButton"
                  class="bg-teal-600 text-white rounded px-3 py-1 mx-3 transform transition-all duration-300 hover:bg-teal-800 hover:-translate-y-1">Line</button>
                <button id="waveButton"
                  class="bg-teal-600 text-white rounded px-3 py-1 transform transition-all duration-300 hover:bg-teal-800 hover:-translate-y-1">Wave</button>
              </div> -->
            </div>

            <div class="grid grid-cols-3">
              <div>
                <a href="#"
                  class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                  <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                    src="/docs/images/blog/image-4.jpg" alt="">
                  <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                      technology
                      acquisitions 2021</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise
                      technology acquisitions of 2021 so far, in reverse chronological order.</p>
                  </div>
                </a>
              </div>
            </div>

            <!-- @if($studentCounts->isEmpty())
              <p class="mt-5 text-teal-800 text-[12px] text-center">No students found for any grade.</p>
            @else
              <canvas id="studentChart" width="400" height="250"></canvas>
              <div id="totalStudents" class="text-teal-800 my-3 text-[14px]"></div>
              <div id="totalMaleStudent" class="text-teal-800 my-3 text-[14px]"></div>
              <div id="totalFemaleStudent" class="text-teal-800 my-3 text-[14px]"></div>
            @endif -->
          </div>

          <!---->
          <!-- <div class="bg-gray-200 rounded-lg p-5 shadow-lg col-span-4 lg:col-span-2 xl:col-span-2 border-2 staffchart">
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
          </div> -->

          <!---->
          <div
            class="bg-white rounded-lg p-5 shadow-lg border-2 col-span-4 lg:col-span-4 xl:col-span-4 calendar text-teal-900">
            <h2 class="text-start text-md font-bold p-7 shadow-lg bg-teal-100">
              <i class="fa-solid fa-calendar mr-2"></i> Calendar
            </h2>
            <div class="grid grid-cols-4">
              <div class="col-span-2">
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
</body>

</html>

@include('admin.includes.js-link')