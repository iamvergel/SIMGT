@include('teacher.includes.header')

<body class="font-poppins bg-gray-200">
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('teacher.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('teacher.includes.topnav')
            </header>

            <div class="p-5">
                <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Teacher</p>
                <h1 class="text-2xl font-bold text-teal-900 ml-5">Dashboard</h1>

                <div class="grid grid-cols-4 gap-5 mt-10 border-t-2 border-teal-800">
                    <div id="dashboard"
                        class="col-span-2 bg-gradient-to-tr from-teal-700 to-teal-500 py-0 mt-5 lg:py-0 pl-3 text-white rounded-lg shadow-lg text-start flex items-center justify-between">
                        <div class="flex flex-col py-10">
                            <p id="welcomeText" class="font-bold text-[20px] lg:text-[30px] 2xl:text-[40px]">
                                Welcome, Teacher <br />{{ session('teacher_fname') . ' ' . session('teacher_lname') }}!
                            </p>
                            <p id="descriptionText" class="font-normal text-[12px] lg:text-[15px]">Always stay updated
                                in
                                your
                                student portal</p>
                        </div>
                    </div>

                    <div
                        class="col-span-2 bg-white text-teal-800 rounded-lg shadow-lg text-start mt-5 p-5 flex justify-center items-center">
                        <div class="p-5 bg-gray-100 shadow-lg rounded-lg">
                            <p class="text-sm font-semibold">My Advisory Class<br />
                                <span
                                    class="font-bold text-teal-700 text-xl uppercase">{{session('grade') . ' - ' . session('section') }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-span-2 px-1 mt-10">
                        <div class="p-0">
                            <p class="text-[25px] font-semibold text-teal-900 my-5"><i
                                    class="fas fa-bullhorn text-teal-900 mr-2 text-bold text-[40px]"></i>Announcement
                            </p>
                            <div
                                class="bg-gray-200 p-2 lg:py-1 text-white rounded-lg shadow-lg text-start announcement bg-teal-700">

                                @if($latestAnnouncements->isEmpty())
                                    <p class="text-white text-[14px] text-center">No announcements available.</p>
                                @else
                                    @foreach($latestAnnouncements as $announcement)
                                        <div x-data="{ open: false }"
                                            class="announcement my-1 p-2 bg-teal-700 border rounded-lg text-teal-700 leading-4">
                                            <div class="py-1 bg-teal-700 rounded-lg text-white" id="announcementa">
                                                <div
                                                    class="flex justify-between items-center bg-teal-800 px-5 py-2 rounded-full mb-2">
                                                    <h5 class="font-bold mb-0 text-[15px] ">
                                                        {{ $announcement->announcements_head }}</h5>
                                                    <button @click="open = !open"
                                                        class="bg-transparent text-white rounded px-2 py-1 text-sm">
                                                        <span x-show="!open"><i class="fas fa-angle-right"></i></span>
                                                        <span x-show="open"><i class="fas fa-angle-down"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div x-show="open" class="text-[15px] bg-white p-5 text-gray-800 rounded-md overflow-scroll">
                                                {!! $announcement->announcements_body !!}</div>
                                            <small
                                                class="text-muted text-[12px] text-white">{{ $announcement->created_at->format('F j, Y, g:i a') }}</small>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-2 bg-white text-teal-800 rounded-lg shadow-lg text-start mt-5 p-5 flex justify-center items-center">
                        <div class="p-5 bg-gray-100 shadow-lg rounded-lg">
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
                                <table id="announcementTable" class="p-3 display responsive nowrap" width="100%">
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
                                                            <img src="/storage/announcements/{{ $announcement->image }}"
                                                                alt="Image" class="w-full h-full object-cover">
                                                        </div>
                                                        <div
                                                            class="flex justify-between align-end px-10 text-sm bg-gray-200 py-5">
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
        </main>
    </div>

    <script src="{{ asset('../js/admin/admin.js') }}"></script>
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
            scrollY: 600,
            scroller: true,
            responsive: true,
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
    </script>
</body>

</html>