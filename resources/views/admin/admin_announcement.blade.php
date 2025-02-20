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
            <i class="fa-solid fa-bullhorn mr-2"></i> Announcement
          </h2>
        </div>
        <div class="w-full flex justify-end py-3 px-5">
          <button
            class="indent-[0rem] px-3 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition py-3 text-md font-semibold"
            id="addAnnouncement"> <i class="fa-solid fa-plus me-1"></i> Add Announcement</button>
        </div>
        <!---->
        <div class="bg-gray-200 rounded-lg p-1 col-span-2">
          <div class="">
            <div id="announcementFormModal"
              class="hidden">
              <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[20]">
                <div class=" bg-gray-100 rounded-lg shadow-lg p-5">
                  <div class="flex justify-between items-center p-2 px-4 bg-white shadow-l rounded-md">
                    <p id="announcementFormTitle" class="font-bold text-teal-900"></p>
                    <span id="closeModalForm"
                      class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                        class="fas fa-times fa-lg"></i></span>
                  </div>
                  <div class="px-5 text-teal-900">
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

                      <!-- <button type="submit"
                      class="mt-3 w-full bg-yellow-700 text-white py-2 rounded-lg hover:bg-yellow-800 transition py-5 ">
                      Add Announcement
                    </button> -->

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
            </div>

            <div class="bg-white rounded-lg  shadow-lg">
              <!-- <div class="bg-yellow-100 p-2 rounded-lg shadow-lg text-center mb-5">
                <h2 class="text-md font-bold text-yellow-900">
                  <i class="fas fa-bullhorn text-yellow-900 mr-2"></i>Announcements <br /> History
                </h2>
              </div> -->
              <div
                class="bg-white h-96 xl:h-[650px] overflow-x-hidden overflow-y-scroll rounded-lg border-2 p-5 shadow-lg"
                id="announcementHistory"></div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg p-5 col-span-4 lg:col-span-4 xl:col-span-4 border-2 shadow-lg"></div>
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

  @include('admin.includes.js-link')
  <script src="{{ asset('../js/admin/announcement.js') }}" type="text/javascript"></script>
</body>

</html>