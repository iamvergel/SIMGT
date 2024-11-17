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

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
      scroll-behavior: smooth;
      scrollbar-width: thin;
    }
  </style>
</head>

<body class="font-poppins bg-gray-200">
  <div class="flex lg:p-2 w-full h-screen">
    <!-- Sidebar -->
    @include('student.includes.sidebar')

    <!-- Main Content -->
    <main
      class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50"
      id="content">
      @include('student.includes.header')


      <div class="p-5 py-3">
        <p class="text-[15px] font-normal text-teal-900 mt-5">Student</p>
        <h1 class="text-xl font-bold text-teal-900">Dashboard</h1>
      </div>
      <div class="grid grid-cols-2">
        <div class="col-span-2 lg:col-span-1">
          <div class="p-5">
            <div id="dashboard"
              class="bg-gradient-to-tr from-teal-700 to-teal-500 py-0 lg:py-0 pl-3 text-white rounded-lg shadow-lg text-start flex items-center justify-between">
              <div class="flex flex-col">
                <p id="welcomeText" class="font-bold text-[20px] lg:text-[30px] 2xl:text-[40px]">
                  Welcome, <br
                    class="lg:hidden">{{ session('student_first_name') . ' ' . session('student_last_name') }}!
                </p>
                <p id="descriptionText" class="font-normal text-[12px] lg:text-[15px]">Always stay updated in your
                  student portal</p>
              </div>

              <!-- Avatar Section -->
              <div class="w-1/2">
                <!-- Default Avatar -->
                <div id="avatarContainerCharacter" class="avatar-container">
                  <img id="currentAvatarCharacter" src="{{ asset('../assets/images/avatar1.png') }}"
                    alt="Default Avatar" class="avatar w-full h-full cursor-pointer" />
                </div>
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

            <div class="mt-5">
              <button id="colorTeal"
                class="py-2 px-4 bg-gradient-to-tr from-teal-700 to-teal-500 hover:bg-gradient-to-tr hover:from-teal-900 hover:to-teal-500 text-white rounded-md mr-2">Teal</button>
              <button id="colorSky"
                class="py-2 px-4 bg-gradient-to-tr from-cyan-700 to-cyan-500 hover:bg-gradient-to-tr hover:from-cyan-900 hover:to-cyan-500 text-white rounded-md mr-2">Sky</button>
              <button id="colorYellow"
                class="py-2 px-4 bg-gradient-to-tr from-yellow-700 to-yellow-500 hover:bg-gradient-to-tr hover:from-yellow-900 hover:to-yellow-500 text-white rounded-md">Yellow</button>
            </div>

            <div class="bg-white py-5 px-3 text-teal-800 rounded-lg shadow-lg text-start mt-5">
              <p class="font-bold text-[15px]">
                @php
          $middleName = session('student_middle_name', '');
        @endphp
                {{ session('student_last_name') . ', ' . session('student_first_name') . ' ' . strtoupper(substr($middleName, 0, 1)) . '.'}}
              </p>
              <p class="font-normal text-[12px]">{{ session('grade') . ' - ' . session('section') }}
              </p>
              </p>
            </div>
          </div>
        </div>
        <div class="col-span-2 lg:col-span-1">
          <div class="p-5">
            <p class="text-[15px] font-normal text-teal-900 my-5"><i
                class="fas fa-bullhorn text-teal-900 mr-2"></i>Announcement</p>
            <div class="bg-gray-200 p-2 lg:py-5 text-white rounded-lg shadow-lg text-start announcement">
              @if($latestAnnouncements->isEmpty())
          <p class="text-red-500">No announcements available.</>
      @else

      @foreach($latestAnnouncements as $announcement)
      <div x-data="{ open: false }"
      class="announcement my-3 p-5 bg-white border rounded-lg text-teal-700 leading-4">
      <div class="py-3 px-2 bg-teal-700 rounded-lg text-white" id="announcementa">
      <div class="flex justify-between items-center">
      <h5 class="font-bold mb-0 text-[15px]">{{ $announcement->announcements_head }}</h5>
      <button @click="open = !open" class="bg-transparent text-white rounded px-2 py-1 text-sm">
        <span x-show="!open"><i class="fas fa-angle-right"></i></span>
        <span x-show="open"><i class="fas fa-angle-down"></i></span>
      </button>
      </div>
      <small class="text-muted text-[12px]">{{ $announcement->created_at->format('F j, Y, g:i a') }}</small>
      </div>

      <div x-show="open" x-transition class="mt-3 px-2 py-2 text-[15px]">
      <textarea name="announcements_body" id="announcements_body" required
      class="w-full p-3 rounded-md focus:outline-none focus:ring-none focus:ring-teal-500 text-[13px]"
      style="resize: none;" rows="20" readonly>{{ $announcement->announcements_body }}</textarea>
      </div>
      </div>
    @endforeach
    @endif
            </div>
          </div>
        </div>
        <div class="col-span-2 lg:col-span-1 p-5">
          <div class="bg-white rounded-lg col-span-4 lg:col-span-4 xl:col-span-4 border-2 shadow-lg"></div>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
  <script>
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