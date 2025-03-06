@include('admission.includes.header')

<body class="font-poppins bg-gray-200">
  <div class="flex w-full h-screen">
    <!-- Sidebar -->
    @include('admission.includes.sidebar')

    <!-- Main Content -->
    <main class="flex-grow bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50" id="content">
      <header class="sticky top-0 z-[10]">
        @include('admission.includes.topnav')
      </header>

      <div class="p-5">
        <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
        <h1 class="text-2xl font-bold text-teal-900 ml-5">Dashboard</h1>

        <div class="bg-teal-800 p-5 shadow-lg mt-10 rounded-t-lg">
          <h2 class="text-md font-semibold text-white">
            <i class="fas fa-users text-white mr-2"></i> Total Number of Students by Grade
          </h2>
        </div>

        <div class="grid grid-cols-4 gap-5 mt-1 border-t-2 border-teal-800">
          <!---->
          <div class="bg-white rounded-b-lg p-3 shadow-lg col-span-4 lg:col-span-4 xl:col-span-4 border-2 studentchart">
            <div class="grid grid-cols-4 gap-2 mt-5">
              <div class="col-span-4 lg:col-span-2">
                <div class="flex items-center border-t-2 border-teal-700 rounded-lg shadow-lg">
                  <div class="bg-teal-100 rounded-l-lg h-48 flex items-center justify-center w-1/2">
                    <h2 class="text-[50px] font-bold text-teal-900">
                      <i class="fas fa-users"></i>
                    </h2>
                  </div>
                  <div class="px-5 w-full">
                    <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">TOTAL NUMBER OF
                      ACTIVE
                      STUDENTS</h5>
                    <hr>
                    <p class="mb-3 font-bold text-end text-teal-700  text-[3rem] px-3">
                      {{ $studentCounts->sum() }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-span-4 lg:col-span-1">
                <div class="flex items-center border-t-2 border-rose-700 rounded-lg shadow-lg">
                  <div class="bg-rose-100 rounded-l-lg h-48 flex items-center justify-center w-1/2">
                    <h2 class="text-[50px] font-bold text-rose-900">
                      <i class="fa-solid fa-venus"></i>
                    </h2>
                  </div>
                  <div class="px-3 w-full">
                    <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">TOTAL NUMBER
                      OF FEMALE STUDENTS</h5>
                    <hr>
                    <p class="mb-3 font-bold text-end text-rose-700  text-[3rem] px-3">
                      {{ $totalFemaleStudent->sum() }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-span-4 lg:col-span-1">
                <div class="flex items-center border-t-2 border-blue-700 rounded-lg shadow-lg">
                  <div class="bg-blue-100 rounded-l-lg h-48 flex items-center justify-center w-1/2">
                    <h2 class="text-[50px] font-bold text-blue-900">
                      <i class="fa-solid fa-mars"></i>
                    </h2>
                  </div>
                  <div class="px-3 w-full">
                    <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">TOTAL NUMBER
                      OF MALE STUDENTS</h5>
                    <hr>
                    <p class="mb-3 font-bold text-end text-blue-700  text-[3rem] px-3">
                      {{ $totalMaleStudent->sum() }}
                    </p>
                  </div>
                </div>
              </div>

              <hr class="col-span-4 border-0 h-[1px] bg-gray-300 mt-10">

              <div class="col-span-4 mt-10">
                <div class="grid grid-cols-1 xl:grid-cols-6 gap-2">
                  <div class="col-span-4 lg:col-span-1">
                    <div class="flex items-center border-t-2 border-yellow-500 rounded-lg shadow-lg">
                      <div class="p-5 w-full">
                        <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">GRADE ONE</h5>
                        <hr>
                        <p class="mb-3 font-bold text-end text-yellow-700  text-[3rem] px-3">
                          {{ $studentCounts['Grade One'] ?? 0}}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-4 lg:col-span-1">
                    <div class="flex items-center border-t-2 border-teal-500 rounded-lg shadow-lg">
                      <div class="p-5 w-full">
                        <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">GRADE TWO</h5>
                        <hr>
                        <p class="mb-3 font-bold text-end text-teal-700  text-[3rem] px-3">
                          {{ $studentCounts['Grade Two'] ?? 0}}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-4 lg:col-span-1">
                    <div class="flex items-center border-t-2 border-green-500 rounded-lg shadow-lg">
                      <div class="p-5 w-full">
                        <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">GRADE THREE</h5>
                        <hr>
                        <p class="mb-3 font-bold text-end text-green-700  text-[3rem] px-3">
                          {{ $studentCounts['Grade Three'] ?? 0}}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-4 lg:col-span-1">
                    <div class="flex items-center border-t-2 border-rose-500 rounded-lg shadow-lg">
                      <div class="p-5 w-full">
                        <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">GRADE FOUR</h5>
                        <hr>
                        <p class="mb-3 font-bold text-end text-rose-700  text-[3rem] px-3">
                          {{ $studentCounts['Grade Four'] ?? 0}}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-4 lg:col-span-1">
                    <div class="flex items-center border-t-2 border-blue-500 rounded-lg shadow-lg">
                      <div class="p-5 w-full">
                        <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">GRADE FIVE</h5>
                        <hr>
                        <p class="mb-3 font-bold text-end text-blue-700  text-[3rem] px-3">
                          {{ $studentCounts['Grade Five'] ?? 0}}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-4 lg:col-span-1">
                    <div class="flex items-center border-t-2 border-violet-500 rounded-lg shadow-lg">
                      <div class="p-5 w-full">
                        <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">GRADE SIX</h5>
                        <hr>
                        <p class="mb-3 font-bold text-end text-violet-700  text-[3rem] px-3">
                          {{ $studentCounts['Grade Six'] ?? 0 }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <hr class="col-span-4 border-0 h-[1px] bg-gray-300 mt-10">

              <div class="col-span-4 lg:col-span-2 mt-10">
                <div class="flex items-center border-t-2 border-red-700 rounded-lg shadow-lg">
                  <div class="bg-red-100 rounded-l-lg h-48 flex items-center justify-center w-1/2">
                    <h2 class="text-[50px] font-bold text-red-900">
                      <i class="fa-solid fa-user-xmark"></i>
                    </h2>
                  </div>
                  <div class="px-5 w-full">
                    <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">TOTAL NUMBER OF
                      DROPPED
                      STUDENTS</h5>
                    <hr>
                    <p class="mb-3 font-bold text-end text-red-700  text-[3rem] px-3">
                      {{ $studentDroppedCounts->sum() }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-span-4 lg:col-span-2 mt-10">
                <div class="flex items-center border-t-2 border-teal-700 rounded-lg shadow-lg">
                  <div class="bg-teal-100 rounded-l-lg h-48 flex items-center justify-center w-1/2">
                    <h2 class="text-[50px] font-bold text-teal-900">
                      <i class="fa-solid fa-user-graduate"></i>
                    </h2>
                  </div>
                  <div class="px-5 w-full">
                    <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">TOTAL NUMBER OF
                      GRADUATED
                      STUDENTS</h5>
                    <hr>
                    <p class="mb-3 font-bold text-end text-teal-700  text-[3rem] px-3">
                      {{ $studentGraduatedCounts->sum() }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-span-4 lg:col-span-2 mt-5">
                <div class="flex items-center border-t-2 border-yellow-700 rounded-lg shadow-lg">
                  <div class="bg-yellow-100 rounded-l-lg h-48 flex items-center justify-center w-1/2">
                    <h2 class="text-[50px] font-bold text-yellow-900">
                      <i class="fa-solid fa-file"></i>
                    </h2>
                  </div>
                  <div class="px-5 w-full">
                    <h5 class="mb-2 text-md font-semibold tracking-tight text-gray-900 ">APPLICANT STUDENTS</h5>
                    <hr>
                    <p class="mb-3 font-bold text-end text-yellow-700  text-[3rem] px-3">
                      {{ $studentGraduatedCounts->sum() }}
                    </p>
                  </div>
                </div>
              </div>

              <hr class="col-span-4 border-0 h-[1px] bg-gray-300 mt-10">

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
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
  <script src="{{ asset('../js/admin/dashboard.js') }}" type="text/javascript"></script>
  @include('admin.includes.js-link')
</body>

</html>