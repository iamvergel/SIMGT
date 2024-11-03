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
      scrollbar-width: none;
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
            <div
              class="bg-gradient-to-tr from-teal-700 to-teal-500 py-5 lg:py-20 px-3 text-white rounded-lg shadow-lg text-start">
              <div id="currentDate" class="currentDateMobile font-semibold mb-5 text-[12px] lg:hidden"></div>
              <p class="font-bold text-[20px] lg:text-[30px] 2xl:text-[40px]">Welcome,
                <br class="lg:hidden">{{ session('student_first_name') . ' ' . session('student_last_name')}}!
              </p>
              <p class="font-normal text-[12px] lg:text-[15px]">Always stay updated in your student portal</p>
            </div>

            <div class="bg-white py-5 px-3 text-teal-800 rounded-lg shadow-lg text-start mt-5">
              <p class="font-bold text-[15px]">
                {{ session('student_last_name') . ', ' . session('student_first_name') . ' ' . session('student_middle_name')}}
              </p>
              <p class="font-normal text-[12px]">{{ session('grade') . ' - ' . session('section') }}
              </p>
              </p>
            </div>
          </div>
        </div>
        <div class="col-span-2 lg:col-span-1">
          <div class="p-5">
          <p class="text-[15px] font-normal text-teal-900 my-5"><i class="fas fa-bullhorn text-teal-900 mr-2"></i>Announcement</p>
            <div class="bg-gray-200 p-2 lg:py-5 text-white rounded-lg shadow-lg text-start announcement">
              @if($latestAnnouncements->isEmpty())
                <p class="text-red-500">No announcements available.</>
              @else

              @foreach($latestAnnouncements as $announcement)
                <div x-data="{ open: false }"
                  class="announcement my-3 p-5 bg-white border rounded-lg text-teal-700 leading-4">
                  <div class="py-3 px-2 bg-teal-700 rounded-lg text-white">
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
  </script>

</body>

</html>