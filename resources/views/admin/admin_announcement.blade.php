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
        <!---->
        <div class="bg-white p-1 col-span-2 mt-3 border-t-2 border-teal-700  ">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 pb-5">
            <div id="announcementFormModal"
              class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
              <div class="absolute bg-gray-100 rounded-lg shadow-lg p-5">
                <div class="flex justify-between items-center p-2 px-4 bg-white shadow-l rounded-md">
                  <p id="announcementFormTitle" class="font-bold text-teal-900"></p>
                  <span id="closeModalForm"
                    class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                      class="fas fa-times fa-lg"></i></span>
                </div>
                <div class="">
                  <form id="announcementForm" action="{{ route('announcements.store') }}" method="POST"
                    class="mt-5 bg-white p-5 rounded-lg shadow-lg border-2">
                    @csrf

                    <label for="announcements_head" class="font-semibold text-[15px] mt-4"><span
                        class="text-red-500">*</span>Announcement Title</label>
                    <input type="text" name="announcements_head" id="announcements_head" required
                      class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 font-bold text-[15px]">
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
            <div class="bg-white col-span-3 lg:col-span-2">
              <div class="w-full flex justify-end py-3 px-5">
                <!-- @if(session('success'))
                  <div class="alert alert-success text-teal-900 text-semibold bg-green-500">
                    {{ session('success') }}
                  </div>
                @endif -->

                <button
                  class="indent-[0rem] px-3 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition py-3 text-md font-semibold"
                  id="addAnnouncementPicture">
                  <i class="fa-solid fa-plus me-1"></i> Add Picture Announcement
                </button>
              </div>

              <div class="bg-white h-96 xl:h-[700px] shadow-lg border-t-4 border-b-4 border-teal-700" id="announcementPicture">
                <div class="w-full h-full border-4 border-teal-50 rounded-lg">
                    <div class="table-responsive">
                        @if($announcements->isEmpty())
                            <div class="text-center text-lg text-gray-600">
                              <table id="announcementTable" class="display">
                                <thead class="table-header bg-gray-100">
                                    <tr class="text-sm tracking-wide text-left uppercase">
                                        <th class="">Announcement</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white" id="tableBody">
                                  <tr class="text-gray-700 table-row">
                                    <td class="px-4 py-3 border text-sm"> No Announcements Available.</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                        @else
                            <table id="announcementTable" class="display">
                                <thead class="table-header bg-gray-100">
                                    <tr class="text-sm tracking-wide text-left uppercase">
                                        <th class="">Announcement</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white" id="tableBody">
                                    @foreach ($announcements as $announcement)
                                        <tr class="text-gray-700 table-row">
                                            <td class="px-4 py-3 border" width="90%">
                                                <div class="w-full bg-gray-100 p-2">
                                                    <div class="w-full flex justify-center items-center">
                                                        <img src="/storage/announcements/{{ $announcement->image }}" alt="Image"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                    <div class="flex justify-between align-end px-10 text-sm bg-gray-200 py-5">
                                                        <p class="text-center">{{ $announcement->date }}</p>
                                                        <p class="text-center">{{ $announcement->updated_at }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-4 py-3 border flex justify-end align-center">
                                                <button type="button"
                                                    onclick="openUpdateModal({{ $announcement->id }}, '{{ $announcement->date }}', '{{ $announcement->image }}')"
                                                    class="tindent-[0rem] py-3 px-3 text-white bg-teal-700 shadow rounded-full hover:bg-teal-600 me-1">
                                                    <i class="fa-solid fa-pen text-lg"></i>
                                                </button>

                                                <button type="submit"
                                                    onclick="opendeletemodal({{ $announcement->id }}, '{{ $announcement->date }}', '{{ $announcement->image }}')"
                                                    class="indent-[0rem] py-3 px-[0.8rem] text-white bg-red-700 shadow rounded-full hover:bg-red-800">
                                                    <i class="fa-solid fa-trash text-lg"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
              </div>

              <div id="deleteAnnouncementModal"
                class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
                <div class="absolute bg-gray-100 rounded-lg shadow-lg p-5">
                  <div class="flex justify-between items-center p-2 px-4 bg-white shadow-l rounded-md">
                    <p class="font-bold text-teal-900">Are you sure to delete this announcement?</p>
                    <span id="closeDeleteModal"
                      class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                        class="fas fa-times fa-lg"></i></span>
                  </div>
                  <div class="">
                    <form id="deleteAnnouncementForm"
                      action="{{ route('pictureannouncements.delete', $announcement->id) }}" method="POST"
                      class="mt-5 bg-white p-5 rounded-lg shadow-lg border-2">
                      @csrf
                      @method('DELETE')

                      <div class="mb-2">
                        <div class="w-[550px] h-[400px]">
                          <img id="currentImageDelete" src="" alt="" width="100%" class="w-full h-full object-cover">
                        </div>
                      </div>

                      <!-- <button type="submit"
                        class="mt-3 w-full bg-yellow-700 text-white py-2 rounded-lg hover:bg-yellow-800 transition py-5 ">
                        Add Announcement
                      </button> -->

                      <div class="flex justify-end">
                        <button id="cancel" type="button"
                          class="mt-2 w-1/4 indent-[-2rem] bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition py-2 text-md font-semibold me-2">Cancel
                        </button>
                        <button type="submit"
                          class="mt-2 w-1/4 indent-[-2rem] bg-red-700 text-white rounded-lg hover:bg-red-800 transition py-2 text-md font-semibold ">Yes
                        </button>
                      </div>
                    </form>
                    @endif
                  </div>
                </div>
              </div>
              

              <!-- Modal or Form for Adding a New Announcement -->
              <div id="addAnnouncementModal"
                class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
                <div class="absolute bg-gray-100 rounded-lg shadow-lg p-5">
                  <div class="flex justify-between items-center p-2 px-4 bg-white shadow-l rounded-md">
                    <p class="font-bold text-teal-900">Add Picture Announcement</p>
                    <span id="closeModalFormAnnouncement"
                      class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                        class="fas fa-times fa-lg"></i></span>
                  </div>
                  <div class="">
                    <form id="addAnnouncementForm" action="{{ route('announcementspicture.store') }}" method="POST"
                      enctype="multipart/form-data" class="mt-5 bg-white p-5 rounded-lg shadow-lg border-2">
                      @csrf

                      <div class="mb-4">
                        <label for="announcementDate" class="font-semibold text-[15px] mt-4"><span
                            class="text-red-500">*</span>Date</label>
                        <input type="date" id="announcementDate" name="date"
                          class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px]"
                          required readonly>
                        <small id="descriptionHelp" class="text-gray-500">Date</small>
                      </div>

                      <div class="mb-4">
                        <label for="announcementImage" class="font-semibold text-[15px] mt-4"><span
                            class="text-red-500">*</span>Announcement</label>
                        <input type="file" id="announcementImage" name="image"
                          class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px]"
                          required>
                        <small id="descriptionHelp" class="text-gray-500">Enter picture (jpeg, png anf jpg) size
                          ()</small>
                      </div>

                      <!-- <button type="submit"
                        class="mt-3 w-full bg-yellow-700 text-white py-2 rounded-lg hover:bg-yellow-800 transition py-5 ">
                        Add Announcement
                      </button> -->

                      <div class="flex justify-end">
                        <!-- <button type="submit" id="delete"
                          class="mt-10 w-1/4 indent-[-2rem] bg-red-700 text-white rounded-lg hover:bg-red-800 transition py-2 text-md font-semibold me-2 hidden">Delete
                        </button> -->
                        <button type="submit"
                          class="mt-10 w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div id="updateAnnouncementModal"
                class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
                <div class="absolute bg-gray-100 rounded-lg shadow-lg p-5">
                  <div class="flex justify-between items-center p-2 px-4 bg-white shadow-l rounded-md">
                    <p class="font-bold text-teal-900">Update Announcement</p>
                    <span id="closeUpdateModal"
                      class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                        class="fas fa-times fa-lg"></i></span>
                  </div>
                  <div class="">
                    <form id="updateAnnouncementForm" action="{{ route('announcements.update', '') }}" method="POST"
                      enctype="multipart/form-data" class="mt-5 bg-white p-5 rounded-lg shadow-lg border-2">
                      @csrf
                      @method('POST')

                      <div class="mb-4">
                        <label for="updateAnnouncementDate" class="font-semibold text-[15px] mt-4"><span
                            class="text-red-500">*</span>Date</label>
                        <input type="date" id="updateAnnouncementDate" name="date"
                          class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px]"
                          required readonly>
                      </div>

                      <div class="mb-4">
                        <label for="updateAnnouncementImage" class="font-semibold text-[15px] mt-4"><span
                            class="text-red-500">*</span>Image</label>
                        <input type="file" id="updateAnnouncementImage" name="image"
                          class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px]">
                      </div>

                      <div class="mb-4 ">
                        <label for="currentAnnouncement" class="font-semibold text-[15px] mt-4">Current
                          Announcement</label>
                        <div class="w-[550px] h-[400px]">
                          <img id="currentImage" src="" alt="" width="100%" class="w-full h-full object-cover">
                        </div>
                      </div>

                      <!-- <button type="submit"
                        class="mt-3 w-full bg-yellow-700 text-white py-2 rounded-lg hover:bg-yellow-800 transition py-5 ">
                        Add Announcement
                      </button> -->

                      <div class="flex justify-end">
                        <!-- <button type="submit" id="delete"
                          class="mt-10 w-1/4 indent-[-2rem] bg-red-700 text-white rounded-lg hover:bg-red-800 transition py-2 text-md font-semibold me-2 hidden">Delete
                        </button> -->
                        <button type="submit"
                          class="mt-10 w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Modal for Update -->
              <!-- <div id="updateAnnouncementModal"
                class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg w-96">
                  <h3 class="text-xl mb-4">Update Announcement</h3>
                  <form id="updateAnnouncementForm" action="{{ route('announcements.update', '') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-4">
                      <label for="updateAnnouncementDate" class="block text-sm font-medium text-gray-700">Date</label>
                      <input type="date" id="updateAnnouncementDate" name="date"
                        class="mt-1 block w-full border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                      <label for="updateAnnouncementImage" class="block text-sm font-medium text-gray-700">Image</label>
                      <input type="file" id="updateAnnouncementImage" name="image"
                        class="mt-1 block w-full border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                      <label for="currentAnnouncement" class="block text-sm font-medium text-gray-700">Current Announcement</label>
                      <img id="currentImage" src="" alt="">
                    </div>
                    <div class="flex justify-between">
                      <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md">Update</button>
                      <button type="button" id="closeUpdateModal"
                        class="bg-gray-400 text-white py-2 px-4 rounded-md">Cancel</button>
                    </div>
                  </form>
                </div>
              </div> -->
            </div>


            <div class="bg-white col-span-3 lg:col-span-1">
              <!-- <div class="bg-yellow-100 p-2 rounded-lg shadow-lg text-center mb-5">
                <h2 class="text-md font-bold text-yellow-900">
                  <i class="fas fa-bullhorn text-yellow-900 mr-2"></i>Announcements <br /> History
                </h2>
              </div> -->
              <div class="w-full flex justify-end py-3 px-5">
                <button
                  class="indent-[0rem] px-3 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition py-3 text-md font-semibold"
                  id="addAnnouncement"> <i class="fa-solid fa-plus me-1"></i> Add Announcement</button>
              </div>
              <div
                class="bg-white h-96 xl:h-[700px] overflow-x-hidden overflow-y-scroll border-b-4 border-t-4 border-teal-700"
                id="announcementHistory">
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </main>
  </div>

  @include('admin.includes.js-link')
  <script src="{{ asset('../js/admin/announcement.js') }}" type="text/javascript"></script>
  <script>
    function openUpdateModal(id, date, image) {
      document
        .getElementById("updateAnnouncementModal")
        .classList.remove("hidden");  // Show the modal

      document.getElementById("updateAnnouncementDate").value = date;

      document.getElementById("updateAnnouncementForm").action = "/announcements/" + id;

      document.getElementById("currentImage").src = "/storage/announcements/" + image;
      document.getElementById("currentImage").style.display = "block";
    }

    function opendeletemodal(id, date, image) {
      document
        .getElementById("deleteAnnouncementModal")
        .classList.remove("hidden");  // Show the modal

      // Set the existing data in the modal form
      // document.getElementById("updateAnnouncementDate").value = date;

      // Set the form action dynamically to the correct route
      document.getElementById("deleteAnnouncementForm").action = "/StEmelieLearningCenter.HopeSci66/admin/announcement/" + id;

      // Set the image source in the modal
      document.getElementById("currentImageDelete").src = "/storage/announcements/" + image;  // Corrected here
      document.getElementById("currentImageDelete").style.display = "block";  // Make the image visible (if necessary)
    }

  </script>
</body>

</html>