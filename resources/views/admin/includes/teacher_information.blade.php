@include('admin.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('admin.includes.topnav')
            </header>


            <div class="p-5">
                @if ($teachers)
                                <div id="studentModal" class="relative w-full min-h-screen bg-gray-100">
                                    <div class="relative">
                                        <div class="w-full h-full bg-white rounded-lg shadow p-5">
                                            <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                                            <p class="text-2xl font-bold text-teal-900 ml-5">
                                                <span
                                                    onclick="window.location.href ='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                                                    class="hover:text-teal-700">Manage Account / </span>{{ $teachers->position }} /
                                                {{ $teachers->last_name }}, {{ $teachers->first_name }}
                                                {{ $teachers->suffix_name }} {{ $teachers->middle_name }}
                                            </p>
                                            <div class="flex justify-start my-8" onclick="window.history.back();"><button
                                                    class="text-[12px] text-white shadow-lg bg-sky-700 rounded-full shadow hover:bg-sky-600 px-3 mt-3"><i
                                                        class="fas fa-arrow-left" style="color: white;"></i>
                                                    Go Back</button>
                                            </div>

                                            <!-- <div class="flex items-center justify-start p-0 px-5 py-2 border-b bg-gray-200 rounded-lg mt-5">
                                                                                                                                                                                                                                        <div class="p-5 mr-5 text-[12px] text-white shadow-lg bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full py-2 text-center"
                                                                                                                                                                                                                                            onclick="window.location.href = '/StEmelieLearningCenter.HopeSci66/admin/student-management/AllStudentData'">
                                                                                                                                                                                                                                            <i class="fas fa-arrow-left" style="color: white;"></i>
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                    </div> -->


                                            <div class="mt-5 text-[12px] w-full">
                                                <ul
                                                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-8 gap-1 xl:gap-1 bg-gray-50 p-0 m-0">
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 active1 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#Information"> Information</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#Advisory"> Advisory</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#Subject"> Subject</li>
                                                </ul>
                                            </div>

                                            <!-- Student Details -->
                                            <div
                                                class="grid grid-cols-5 xl:grid-cols-6 border-0 border-t-4 border-teal-800 h-full pt-5">
                                                <div class="col-span-5 lg:col-span-2 rounded-tl-xl rounded-bl-xl bg-gray-200">
                                                    <!-- Profile Section -->
                                                    <div class=" p-5 h-auto">
                                                        <div class="flex justify-center mt-5">
                                                            @php

                                                                $avatar = $teachers && $teachers->avatar ? asset('storage/' . $teachers->avatar) : null;
                                                                $initials = strtoupper(substr($teachers->last_name, 0, 1) . substr($teachers->first_name, 0, 1));
                                                            @endphp
                                                            <div
                                                                class="w-36 h-36 xl:w-36 xl:h-36 border-[3px] border-white text-[50px] rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2">
                                                                @if ($avatar)
                                                                    <img src="{{ $avatar }}" alt="Student Avatar"
                                                                        class="w-full h-full rounded-full object-cover">
                                                                @else


                                                                    {{ $initials }}
                                                                @endif



                                                            </div>
                                                        </div>
                                                        <div class="text-center mt-5 text-teal-800 ">
                                                            <p
                                                                class="text-md tracking-widest font-semibold  shadow-text-lg mt-2 leading-3">
                                                                {{ $teachers->last_name }},
                                                                {{ $teachers->first_name }}
                                                                {{ $teachers->suffix_name }}
                                                                {{ $teachers->middle_name }}
                                                            </p>
                                                            <p>{{ $teachers->teacher_number }}</p>
                                                            <span
                                                                class="text-xs tracking-widest font-normal shadow-text-lg mt-0">{{ $teachers->username ?? 'no username'}}</span>
                                                            <p class="text-xs">
                                                                {{ $teachers->position ?? 'NO Position'}}
                                                            </p>

                                                            <p class="mt-5">Class Advisory : {{ $teacherAdvisory->grade ?? ''}} |
                                                                {{ $teacherAdvisory->section ?? ''}}
                                                            </p>
                                                            <button {{ $teachers->status == "Inactive" ? "disabled" : "" }}
                                                                id="editAdvisory"
                                                                class="{{ $teachers->status == "Inactive" ? "bg-gray-400" : "bg-pink-700 hover:bg-pink-600" }} text-white font-medium text-md p-3 text-center inline-flex items-center rounded-full mt-3"
                                                                type="button" aria-label="Edit Advisory" title="Edit Advisory">
                                                                <i class="fa-solid fa-chalkboard-user"></i>
                                                            </button>
                                                        </div>
                                                        <div id="editAdvisoryModal"
                                                            class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll">
                                                            <div
                                                                class="relative px-20 py-10 w-screen h-screen flex justify-center items-center">
                                                                <div
                                                                    class="w-full lg:w-1/2 xl:w-1/3 h-96 lg:h-auto bg-white rounded-lg shadow overflow-y-scroll">
                                                                    <div
                                                                        class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg sticky top-0">
                                                                        <h3 class="text-lg font-bold text-teal-800 uppercase"><i
                                                                                class="fa-solid fa-users mr-2"></i>Edit Advisory
                                                                            <br><span class="text-sm">(
                                                                                {{ old('lastName', $teachers->last_name) }},
                                                                                {{ old('lastName', $teachers->first_name) }}
                                                                                {{ old('lastName', $teachers->suffix_name) }}
                                                                                {{ old('lastName', $teachers->middle_name) }})</span>
                                                                        </h3>
                                                                        <button type="button"
                                                                            class="text-white bg-teal-700 hover:bg-teal-800 p-3 py-2 rounded-full text-xl font-bold flex items-center justify-center shadow-lg"
                                                                            aria-label="Close modal" id="closeEditModal">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="mb-5 mt-5 bg-white p-10">
                                                                        <!-- Add Admin Form -->
                                                                        @if($teacherAdvisory == null)
                                                                            No Class Advisory
                                                                        @else
                                                                            <form
                                                                                action="{{ route('advisory.update', $teacherAdvisory->id) }}"
                                                                                method="POST" class="grid grid-cols-1 gap-4">
                                                                                @csrf
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $teacherAdvisory->id }}">

                                                                                <div class="col-span-1 mt-5">
                                                                                    <label
                                                                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                                                        for="grade">
                                                                                        <span class="text-red-600 mr-1">*</span>Grade
                                                                                    </label>
                                                                                    <select name="grade" id="myGrade" required
                                                                                        class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize"
                                                                                        onchange="getSections(this.value)">
                                                                                        <option value="" disabled selected>Select Grade
                                                                                        </option>
                                                                                        <option value="Grade One" {{ $teacherAdvisory->grade == 'Grade One' ? 'selected' : '' }}>Grade One</option>
                                                                                        <option value="Grade Two" {{ $teacherAdvisory->grade == 'Grade Two' ? 'selected' : '' }}>Grade Two</option>
                                                                                        <option value="Grade Three" {{ $teacherAdvisory->grade == 'Grade Three' ? 'selected' : '' }}>Grade Three</option>
                                                                                        <option value="Grade Four" {{ $teacherAdvisory->grade == 'Grade Four' ? 'selected' : '' }}>Grade Four</option>
                                                                                        <option value="Grade Five" {{ $teacherAdvisory->grade == 'Grade Five' ? 'selected' : '' }}>Grade Five</option>
                                                                                        <option value="Grade Six" {{ $teacherAdvisory->grade == 'Grade Six' ? 'selected' : '' }}>Grade Six</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="col-span-1 mt-5">
                                                                                    <label
                                                                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                                                        <span class="text-red-600 mr-1">*</span>Current
                                                                                        Section Advisory
                                                                                    </label>
                                                                                    <input type="text"
                                                                                        value="{{ $teacherAdvisory->section }}"
                                                                                        placeholder="Current Section" readonly required
                                                                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                                                                </div>

                                                                                <div class="col-span-1 mt-5">
                                                                                    <label
                                                                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                                                        for="section">
                                                                                        <span class="text-red-600 mr-1">*</span>Section
                                                                                    </label>
                                                                                    <select name="section" id="mySection" required
                                                                                        class="form-select block w-full text-sm text-normal text-black tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                                                                        <!-- Sections will be loaded here based on grade selection -->
                                                                                    </select>

                                                                                    <script>
                                                                                        function getSections(grade) {
                                                                                            const sectionSelect = document.getElementById("mySection");

                                                                                            // Clear existing options
                                                                                            sectionSelect.innerHTML = '<option value="" disabled selected>Select Section</option>';

                                                                                            // Fetch sections based on the selected grade
                                                                                            fetch(`/api/allsections?grade=${grade}`)
                                                                                                .then(response => response.json())
                                                                                                .then(data => {
                                                                                                    // Check if data is an array and handle accordingly
                                                                                                    if (Array.isArray(data)) {
                                                                                                        data.forEach(section => {
                                                                                                            const option = document.createElement("option");
                                                                                                            option.value = section.section || section; // Use the section if it's an object or string
                                                                                                            option.textContent = section.section || section; // Display the section name
                                                                                                            sectionSelect.appendChild(option);
                                                                                                        });
                                                                                                    } else {
                                                                                                        // If no sections are available
                                                                                                        const option = document.createElement("option");
                                                                                                        option.value = "";
                                                                                                        option.textContent = "No Sections Available";
                                                                                                        sectionSelect.appendChild(option);
                                                                                                    }
                                                                                                })
                                                                                                .catch(error => {
                                                                                                    console.error('Error fetching sections:', error);
                                                                                                    // Handle errors (in case the API fails)
                                                                                                    const option = document.createElement("option");
                                                                                                    option.value = "";
                                                                                                    option.textContent = "Error loading sections";
                                                                                                    sectionSelect.appendChild(option);
                                                                                                });
                                                                                        }

                                                                                        // Preselect the current section when the page loads, based on the current advisory data
                                                                                        document.addEventListener("DOMContentLoaded", function () {
                                                                                            const currentGrade = "{{ $teacherAdvisory->grade }}";
                                                                                            if (currentGrade) {
                                                                                                getSections(currentGrade); // Load sections when the page loads with the current grade

                                                                                                // After fetching, preselect the current section (if any)
                                                                                                const currentSection = "{{ $teacherAdvisory->section }}";
                                                                                                if (currentSection) {
                                                                                                    const sectionSelect = document.getElementById("mySection");
                                                                                                    const options = sectionSelect.querySelectorAll('option');
                                                                                                    options.forEach(option => {
                                                                                                        if (option.textContent === currentSection) {
                                                                                                            option.selected = true;
                                                                                                        }
                                                                                                    });
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    </script>
                                                                                </div>

                                                                                <div class="col-span-1 flex justify-end mt-5">
                                                                                    <button type="submit"
                                                                                        class="w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="border-1 border-gray-400 mt-10">

                                                </div>

                                                <div class="col-span-5 lg:col-span-3 xl:col-span-4 px-5">
                                                    <!-- Scheduled Table -->
                                                    <div class="table-container w-full mt-0 pb-10" id="Information">
                                                        <div class="grid grid-cols-4 gap-4">
                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div
                                                                    class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Teacher Information</p>
                                                                        <p class="text-sm">Address : {{ $teachers->address }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <i
                                                                            class="fa-solid fa-map-location-dot text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="bg-white p-5 mt-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-sm">Email : {{ $teachers->email }}
                                                                        </p>
                                                                        <p class="text-sm">Contact : {{ $teachers->contact_number }}
                                                                        </p>
                                                                        <p class="text-sm">Gender : {{ $teachers->gender }}
                                                                        </p>
                                                                        <p class="text-sm">Birthdate : {{ $teachers->birthdate }}
                                                                        </p>
                                                                        <p class="text-sm">Religion : {{ $teachers->religion }}
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="table-container w-full mt-0 pb-10" id="Advisory" style="display: none;">
                                                        <div class="grid grid-cols-4 gap-4">
                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div
                                                                    class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <table class="min-w-full bg-white border border-gray-200">
                                                                    <thead>
                                                                        <tr class="bg-gray-200">
                                                                        <th
                                                                                class="py-2 px-4 text-left text-sm font-medium text-gray-700">
                                                                                School Year</th>
                                                                            <th
                                                                                class="py-2 px-4 text-left text-sm font-medium text-gray-700">
                                                                                Grade</th>
                                                                            <th
                                                                                class="py-2 px-4 text-left text-sm font-medium text-gray-700">
                                                                                Section</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody style="overflow-y: auto;">
                                                                        @foreach($teacherAdvisoryAll as $adviser)
                                                                            <tr>
                                                                            <td class="py-2 px-4 text-sm text-gray-700">
                                                                            {{ $adviser->school_year }}</td>
                                                                                <td class="py-2 px-4 text-sm text-gray-700">
                                                                                    {{ $adviser->grade }}</td>
                                                                                <td class="py-2 px-4 text-sm text-gray-700">
                                                                                    {{ $adviser->section }}</td>
                                                                                
                                                                                
                                                                                
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="table-container w-full mt-0 pb-10" id="Subject" style="display: none;">
                                                        <div class="grid grid-cols-4 gap-4">
                                                            <div
                                                                class="col-span-4 bg-gray-100 shadow rounded-md p-2 overflow-y-auto h-[500px]">

                                                                <!-- Table to display subjects based on grade, section, and school year -->
                                                                <table class="min-w-full bg-white border border-gray-200">
                                                                    <thead>
                                                                        <tr class="bg-gray-200">
                                                                            <th
                                                                                class="py-2 px-4 text-left text-sm font-medium text-gray-700">
                                                                                Grade</th>
                                                                            <th
                                                                                class="py-2 px-4 text-left text-sm font-medium text-gray-700">
                                                                                Section</th>
                                                                            <th
                                                                                class="py-2 px-4 text-left text-sm font-medium text-gray-700">
                                                                                Subject</th>
                                                                            <th
                                                                                class="py-2 px-4 text-left text-sm font-medium text-gray-700">
                                                                                School Year</th>
                                                                            <th
                                                                                class="py-2 px-4 text-left text-sm font-medium text-gray-700">
                                                                                quarter</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody style="overflow-y: auto;">
                                                                        @foreach($teacherSubjects as $subject)
                                                                            <tr>
                                                                                <td class="py-2 px-4 text-sm text-gray-700">
                                                                                    {{ $subject->grade }}</td>
                                                                                <td class="py-2 px-4 text-sm text-gray-700">
                                                                                    {{ $subject->section }}</td>
                                                                                <td class="py-2 px-4 text-sm text-gray-700">
                                                                                    {{ $subject->subject }}</td>
                                                                                <td class="py-2 px-4 text-sm text-gray-700">
                                                                                    {{ $subject->school_year }}</td>
                                                                                <td class="py-2 px-4 text-sm text-gray-700">
                                                                                    {{ $subject->quarter }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                @else



                    <p>Student not found.</p>
                @endif




    </div>
    </main>
    </div>

    @include('admin.includes.js-link')
    <script>
        const addviserModal = document.getElementById("editAdvisory");
        const adviserModal = document.getElementById("editAdvisoryModal");
        const closeadviserModal = document.getElementById("closeEditModal");


        addviserModal.addEventListener("click", () => {
            if (adviserModal) {
                adviserModal.classList.remove("hidden");
            }
        });

        closeadviserModal.addEventListener("click", () => {
            if (adviserModal) {
                adviserModal.classList.add("hidden");
            }
        });

    </script>
    <script src="{{ asset('../js/admin/admin.js') }}"></script>


</body>

<style>
    option {
        border: none;
    }

    .input-field1,
    .select-field {
        width: 100%;
        border: none;
        border-radius: 0.375rem;
        padding: 0;
    }

    .modal-avatar {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
        object-fit: cover;
    }

    .active1 {
        background-color: #115e59;
        color: white;
        font-weight: bold;
        transform: scale(1.030);
    }

    /* Ensure the table container takes full width */
    .table-container {
        width: 100%;
    }

    /* Prevent hidden columns from affecting table layout */
    .hidden {
        display: none !important;
    }

    /* Ensure the table stretches across the available space */
    #tableGradeOne {
        width: 100% !important;
    }

    .dataTables_empty {
        font-size: 14px !important;
    }
</style>

</html>