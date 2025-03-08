@include('student.includes.header')

<body class="font-poppins bg-gray-200">

  <div class="flex w-full h-screen">
    <!-- Sidebar -->
    @include('student.includes.sidebar')

    <!-- Main Content -->
    <main class="flex-grow bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50">
      @include('student.includes.topnav')

      <div class="p-5 py-3">
        <p class="text-[15px] font-normal text-teal-900 mt-5">Student</p>
        <h1 class="text-xl font-bold text-teal-900">Dashboard</h1>
      </div>

      <div class="grid grid-cols-2">
        <div class="col-span-2 lg:col-span-1">
          <div class="p-5">
            <!-- Avatar Section -->
            <div class="flex justify-between items-end mx-10">
              <div class="mt-5 pb-5">
                <button id="colorTeal"
                  class="py-2 px-4 bg-gradient-to-tr from-teal-700 to-teal-500 hover:bg-gradient-to-tr hover:from-teal-900 hover:to-teal-500 text-white rounded-md mr-2">Teal</button>
                <button id="colorSky"
                  class="py-2 px-4 bg-gradient-to-tr from-cyan-700 to-cyan-500 hover:bg-gradient-to-tr hover:from-cyan-900 hover:to-cyan-500 text-white rounded-md mr-2">Sky</button>
                <button id="colorYellow"
                  class="py-2 px-4 bg-gradient-to-tr from-yellow-700 to-yellow-500 hover:bg-gradient-to-tr hover:from-yellow-900 hover:to-yellow-500 text-white rounded-md">Yellow</button>
              </div>
              <!-- Default Avatar -->
              <div id="avatarContainerCharacter" class="avatar-container w-60">
                <img id="currentAvatarCharacter" src="{{ asset('../assets/images/avatar1.png') }}" alt="Default Avatar"
                  class="avatar h-full cursor-pointer" />
              </div>
            </div>
            <div id="dashboard"
              class="bg-gradient-to-tr from-teal-700 to-teal-500 py-0 lg:py-0 pl-3 text-white rounded-lg shadow-lg text-start flex items-center justify-between">
              <div class="flex flex-col py-20">
                <p id="welcomeText" class="font-bold text-[20px] lg:text-[30px] 2xl:text-[40px]">
                  Welcome, <br
                    class="lg:hidden">{{ session('student_first_name') . ' ' . session('student_last_name') }}!
                </p>
                <p id="descriptionText" class="font-normal text-[12px] lg:text-[15px]">Always stay updated in your
                  student portal</p>
              </div>

              <!-- Avatar Selection Modal (Initially Hidden) -->
              <div id="avatarCharacterModal"
                class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-[10]">
                <div class="bg-white p-5 rounded-lg shadow-lg max-w-sm w-full px-2">
                  <h3 class="text-xl font-semibold text-center mb-4">Choose Your Avatar</h3>
                  <div class="flex justify-between overflow-x-scroll">
                    <img src="{{ asset('../assets/images/avatar1.png') }}" alt="Avatar 1"
                      class="avatar-option w-16 h-16 cursor-pointer" data-avatar="../assets/images/avatar1.png" />
                    <img src="{{ asset('../assets/images/avatar2.png') }}" alt="Avatar 2"
                      class="avatar-option w-16 h-16 cursor-pointer" data-avatar="../assets/images/avatar2.png" />
                    <img src="{{ asset('../assets/images/avatar3.png') }}" alt="Avatar 3"
                      class="avatar-option w-16 h-16 cursor-pointer" data-avatar="../assets/images/avatar3.png" />
                    <img src="{{ asset('../assets/images/avatar4.png') }}" alt="Avatar 4"
                      class="avatar-option w-16 h-16 cursor-pointer" data-avatar="../assets/images/avatar4.png" />
                    <img src="{{ asset('../assets/images/avatar5.png') }}" alt="Avatar 5"
                      class="avatar-option w-16 h-16 cursor-pointer" data-avatar="../assets/images/avatar5.png" />
                    <img src="{{ asset('../assets/images/avatar6.png') }}" alt="Avatar 3"
                      class="avatar-option w-16 h-16 cursor-pointer" data-avatar="../assets/images/avatar6.png" />
                    <img src="{{ asset('../assets/images/avatar7.png') }}" alt="Avatar 4"
                      class="avatar-option w-16 h-16 cursor-pointer" data-avatar="../assets/images/avatar7.png" />
                    <img src="{{ asset('../assets/images/avatar8.png') }}" alt="Avatar 5"
                      class="avatar-option w-16 h-16 cursor-pointer" data-avatar="../assets/images/avatar8.png" />
                  </div>
                  <div class="mt-4 flex justify-center">
                    <button id="closeModalCharacterBtn"
                      class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-full text-sm">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-span-2 lg:col-span-1 px-5 lg:px-20 relative overflow-hidden">
          <div class="bg-white text-teal-800 rounded-lg shadow-lg text-start mt-5 p-10 border">
            <p class="font-bold text-[20px] leading-5 mb-3">
              <span class="text-[12px] font-normal">Name :</span> <br/>
              {{ session('student_first_name') . ' ' . session('student_middle_name') . ' ' . session('student_last_name') }}
            </p>
            <p class="font-normal text-[15px] mb-3"><span class="text-[12px]">Grade :</span> <br/> {{ session('gradea') . ' | Section : ' . session('sectiona') }}
            </p>
            <p class="font-normal text-[15px]"><span class="text-[12px]">School Year:</span> <br/> {{ session('school_yeara') }}</p>
          </div>
          <i class="fa-solid fa-school text-[100px] text-teal-700/20 absolute top-20 right-10 lg:right-24"></i>

          @php
      $firstNameTeacher = session('adviser_first_name', '');
      $middleNameTeacher = session('adviser_middle_name', '');
      $lastNameTeacher = session('adviser_last_name', '');
      $initialsTeacher = strtoupper(substr($firstNameTeacher, 0, 1) . substr($lastNameTeacher, 0, 1));

      $avatarPathTeacher = session('avatarAdviser') ? asset('storage/' . session('avatarAdviser')) : null;
      @endphp

          <div class="flex items-end justify-center">
            <div
              class="mt-10 w-48 h-48 border-4 border-white bg-teal-600 rounded-full flex items-center justify-center text-white text-4xl font-semibold transition-all duration-300 shadow-lg"
              id="profile">
              @if ($avatarPathTeacher !== null)
          <img id="avatar-img2" src="{{ $avatarPathTeacher }}" alt="{{ $firstNameTeacher }}'s Profile Picture"
          class="rounded-full w-full h-full object-cover">
        @else
        <div class="flex items-center justify-center w-full h-full bg-teal-600 rounded-full">
        <span class="text-white">{{ $initialsTeacher }}</span>
        </div>
      @endif

            </div>
            <p class="font-bold text-[20px] mb-10 text-teal-800 ml-5"><span class="text-[15px]"> Adviser :</span> <br />
              {{ session('adviser_first_name') . ' ' . session('adviser_middle_name') . ' ' . session('adviser_last_name') }}
            </p>
          </div>
        </div>

        <div class="col-span-2 lg:col-span-1 px-5 lg:px-20 mt-10">
          <div class="p-0">
            <p class="text-[25px] font-semibold text-teal-900 my-5"><i
                class="fas fa-bullhorn text-teal-900 mr-2 text-bold text-[40px]"></i>Announcement</p>
            <div class="bg-gray-200 p-2 lg:py-1 text-white rounded-lg shadow-lg text-start announcement bg-teal-700">

              @if($latestAnnouncements->isEmpty())
          <p class="text-white text-[14px] text-center">No announcements available.</p>
        @else
        @foreach($latestAnnouncements as $announcement)
      <div x-data="{ open: false }"
      class="announcement my-1 p-2 bg-teal-700 border rounded-lg text-teal-700 leading-4">
      <div class="py-1 px-2 bg-teal-700 rounded-lg text-white" id="announcementa">
        <div class="flex justify-between items-center">
        <h5 class="font-bold mb-0 text-[15px]">{{ $announcement->announcements_head }}</h5>
        <button @click="open = !open" class="bg-transparent text-white rounded px-2 py-1 text-sm">
        <span x-show="!open"><i class="fas fa-angle-right"></i></span>
        <span x-show="open"><i class="fas fa-angle-down"></i></span>
        </button>
        </div>
      </div>
      <div x-show="open" x-transition class="mt-1 px-2 py-2 text-[15px]">
        <textarea name="announcements_body" id="announcements_body_{{ $announcement->id }}" required
        class="w-full p-5 rounded-md focus:outline-none focus:ring-none focus:ring-teal-500 text-[13px]"
        style="resize: none;" rows="20" readonly>{{ $announcement->announcements_body }}</textarea>
      </div>
      <small
        class="text-muted text-[12px] text-white">{{ $announcement->created_at->format('F j, Y, g:i a') }}</small>
      </div>
    @endforeach
      @endif
            </div>
          </div>
        </div>

        <div class="col-span-2 lg:col-span-1 p-5 mt-0 lg:mt-[7.5rem]">
          <div class="bg-white h-96 xl:h-[700px] shadow-lg border-t-4 border-b-4 border-teal-700"
            id="announcementPicture">
            <div class="w-full h-full border-4 border-teal-50 rounded-lg">
              <div class="table-responsive">
                @if($pictureAnnouncements->isEmpty())
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
        </tr>
        </thead>
        <tbody class="bg-white" id="tableBody">
        @foreach ($pictureAnnouncements as $announcement)
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
      </tr>
    @endforeach
        </tbody>
      </table>
    @endif
              </div>
            </div>
          </div>
        </div>


        <div class="col-span-2 lg:col-span-1 p-5">
          <div class="bg-white rounded-lg col-span-4 lg:col-span-4 xl:col-span-4 border-2 shadow-lg"></div>
        </div>
      </div>
    </main>
  </div>

  @include('admin.includes.js-link')
  <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
  <script>
    var table = $("#announcementTable").DataTable({
      dom:
        `<'flex justify-between items-center hidden'>` +
        `<tr>` +
        `<'flex justify-between items-center'<'flex-1'l><'flex-1'p>>`,
      paging: true,
      searching: false,
      ordering: true,
      info: true,
      scroller: true,
    });

    @foreach ($latestAnnouncements as $announcement)
    $("#announcements_body_{{ $announcement->id }}").summernote({
      placeholder: "Enter Announcement...",
      tabsize: 2,
      height: 200,
      zIndex: 500,
      toolbar: [],
      editable: false, // Disable editing
      callbacks: {
      onInit: function () {
        $(".note-editor").css("background-color", "white");
      }
      },
    });
  @endforeach


    document.addEventListener('DOMContentLoaded', () => {
      const dashboard = document.getElementById('dashboard');

      // Change background color based on the selected button
      document.getElementById('colorTeal').addEventListener('click', () => {
        dashboard.style.background = 'linear-gradient(to top right, #0f766e, #14b8a6)';
      });

      document.getElementById('colorSky').addEventListener('click', () => {
        dashboard.style.background = 'linear-gradient(to top right, #0e7490, #06b6d4)';
      });

      document.getElementById('colorYellow').addEventListener('click', () => {
        dashboard.style.background = 'linear-gradient(to top right, #713f12, #eab308)';
      });
    });

    // Get elements
    const changeAvatarBtnCharacter = document.getElementById("changeAvatarCharacterBtn");
    const avatarModalCharacter = document.getElementById("avatarCharacterModal");
    const closeModalBtnCharacter = document.getElementById("closeModalCharacterBtn");
    const avatarOptionsCharacter = document.querySelectorAll(".avatar-option");
    const currentAvatarCharacter = document.getElementById("currentAvatarCharacter");

    // Open the modal when the change avatar button is clicked
    currentAvatarCharacter.addEventListener("click", function () {
      avatarModalCharacter.classList.remove("hidden");  // Show modal
    });

    // Close the modal when the close button is clicked
    closeModalBtnCharacter.addEventListener("click", function () {
      avatarModalCharacter.classList.add("hidden");  // Hide modal
    });

    // Change the avatar when an avatar option is clicked
    avatarOptionsCharacter.forEach(option => {
      option.addEventListener("click", function () {
        const selectedAvatar = this.getAttribute("data-avatar");
        currentAvatarCharacter.src = `../${selectedAvatar}`;  // Update the avatar image source
        avatarModalCharacter.classList.add("hidden");  // Close the modal after selecting
      });
    });
  </script>

</body>

</html>