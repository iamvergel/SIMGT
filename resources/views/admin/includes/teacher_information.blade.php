@include('admin.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex p-2 w-full h-screen">
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
                                                    <!-- <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                                                                                                                        data-target="#documents">Documents</li> -->
                                                    <!-- <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                                                                                                                        data-target="#gradeOne">Grades for Grade One</li>
                                                                                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                                                                                                                        data-target="#gradeTwo">Grades for Grade Two</li>
                                                                                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                                                                                                                        data-target="#gradeThree">Grades for Grade Three</li>
                                                                                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                                                                                                                        data-target="#gradeFour">Grades for Grade Four</li>
                                                                                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                                                                                                                        data-target="#gradeFive">Grades for Grade Five</li>
                                                                                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                                                                                                                        data-target="#gradeSix">Grades for Grade Six</li> -->
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
                                                            <span
                                                                class="text-xs tracking-widest font-normal shadow-text-lg mt-0">{{ $teachers->username ?? 'no username'}}</span>
                                                            <p class="text-xs">
                                                                {{ $teachers->position ?? 'no username'}}
                                                            </p>

                                                            <p>Advisory Class : {{ $teacherAdvisory->grade ?? ''}} |
                                                                {{ $teacherAdvisory->section ?? ''}}
                                                            </p> <button {{ $teachers->status == "Inactive" ? "disabled" : "" }}
                                                                id="editAdvisory"
                                                                class="{{ $teachers->status == "Inactive" ? "bg-gray-400" : "bg-pink-700 hover:bg-pink-600" }} text-white font-medium text-md p-3 text-center inline-flex items-center rounded-full "
                                                                type="button" aria-label="Add Advisory" title="Add Advisory">
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
                                                                                class="fa-solid fa-users mr-2"></i>Add Advisory
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
                                                                                    <select name="grade" id="grade" required
                                                                                        class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize"
                                                                                        onchange="getSections(this.value)">
                                                                                        <option value="">Select Grade</option>
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
                                                                                        value="{{  $teacherAdvisory->section }}"
                                                                                        placeholder="Input School Year" readonly required
                                                                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                                                                </div>
                                                                                <div class="col-span-1 mt-5">
                                                                                    <label
                                                                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                                                        for="section">
                                                                                        <span class="text-red-600 mr-1">*</span>Section
                                                                                    </label>
                                                                                    <select name="section" id="section" required
                                                                                        class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">

                                                                                    </select>

                                                                                    <script>
                                                                                        function getSections(grade) {
                                                                                            const sectionSelect = document.getElementById("section");

                                                                                            fetch(`/api/allsections?grade=${grade}`)
                                                                                                .then(response => response.json())
                                                                                                .then(data => {
                                                                                                    sectionSelect.innerHTML = '<option value="">Select Section</option>';

                                                                                                    if (data.length) {
                                                                                                        data.forEach(section => {
                                                                                                            const option = document.createElement("option");
                                                                                                            option.value = section.section;
                                                                                                            option.textContent = section.section;
                                                                                                            sectionSelect.appendChild(option);
                                                                                                        });
                                                                                                    } else {
                                                                                                        const option = document.createElement("option");
                                                                                                        option.value = "";
                                                                                                        option.textContent = "No Sections Available";
                                                                                                        sectionSelect.appendChild(option);
                                                                                                    }
                                                                                                })
                                                                                                .catch(error => {
                                                                                                    console.error('Error fetching sections:', error);
                                                                                                    const option = document.createElement("option");
                                                                                                    option.value = "";
                                                                                                    option.textContent = "Error loading sections";
                                                                                                    sectionSelect.appendChild(option);
                                                                                                });
                                                                                        }
                                                                                    </script>
                                                                                </div>
                                                                                <div class="col-span-1 flex justify-end mt-5">
                                                                                    <button type="submit"
                                                                                        class="w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="border-1 border-gray-400 mt-10">
                                                    <div
                                                        class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 2xl:grid-cols-2 gap-3 2xl:gap-5 mt-10 text-[13px] text-gray-900">
                                                        <div class="col-span-1 lg:col-span-2 ">
                                                            <label for="modalLrn"
                                                                class="block mb-2 text-[14px] font-bold text-gray-900">Learner
                                                                Reference Number (LRN):</label>
                                                            {{ $teachers->lrn }}
                                                        </div>

                                                        <div>
                                                            <label for="modalStudentNumber"
                                                                class="block text-[14px] font-bold text-gray-900">Student Number
                                                                :</label>
                                                            {{ $teachers->student_number }}
                                                        </div>

                                                        <div class="text-green-500 font-bold">
                                                            <label for="modalStatus"
                                                                class="block text-[14px] font-bold text-gray-900">Status :</label>
                                                            {{ $teachers->status }}
                                                        </div>

                                                        <div>
                                                            <label for="modalGrade"
                                                                class="block text-[14px] font-bold text-gray-900">Grade:</label>
                                                            {{ $teachers->grade }}
                                                        </div>

                                                        <div>
                                                            <label for="modalSection"
                                                                class="block text-[14px] font-bold text-gray-900">Section:</label>
                                                            {{ $teachers->section }}
                                                        </div>

                                                        <div class="col-span-1 lg:col-span-2 mt-5 text-[16px] font-semibold">
                                                            <hr class="border-1 border-gray-400 mb-3">
                                                            <p>Personal Information</p>
                                                        </div>


                                                        <div>
                                                            <label for="modalPlaceOfBirth"
                                                                class="block text-[14px] font-bold text-gray-900">Place of
                                                                Birth:</label>
                                                            {{ $teachers->place_of_birth }}
                                                        </div>

                                                        <div>
                                                            <label for="modalBirthDate"
                                                                class="block text-[14px] font-bold text-gray-900">Birth
                                                                Date:</label>
                                                            {{ $teachers->birth_date }}
                                                        </div>

                                                        <div>
                                                            <label for="modalAge"
                                                                class="block text-[14px] font-bold text-gray-900">Age:</label>
                                                            {{ $teachers->age }}
                                                        </div>

                                                        <div>
                                                            <label for="modalSex"
                                                                class="block text-[14px] font-bold text-gray-900">Sex:</label>
                                                            {{ $teachers->sex }}
                                                        </div>

                                                        <div>
                                                            <label for="modalReligion"
                                                                class="block text-[14px] font-bold text-gray-900">Religion:</label>
                                                            {{ $teachers->religion }}
                                                        </div>

                                                        <div class="col-span-1 lg:col-span-2 mt-5 text-[16px] font-semibold">
                                                            <hr class="border-1 border-gray-400 mb-3">
                                                            <p>Contact Information</p>
                                                        </div>


                                                        <div class="col-span-1 lg:col-span-2">
                                                            <label for="modalEmail"
                                                                class="block text-[14px] font-bold text-gray-900">Email:</label>
                                                            {{ $teachers->email_address_send}}
                                                        </div>

                                                        <div class="col-span-1 lg:col-span-2">
                                                            <label for="modalContactNumber"
                                                                class="block text-[14px] font-bold text-gray-900">Contact
                                                                Number:</label>
                                                            {{ $teachers->contact_number}}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-5 lg:col-span-3 xl:col-span-4 px-5">
                                                <div class="col-span-3 my-5 flex justify-start">
                                                    <button id="btnPrint"
                                                        class="text-[12px] text-white shadow-lg bg-sky-700 rounded-lg shadow hover:bg-sky-600 px-3 mt-3"><i
                                                            class="fas fa-file-pdf mr-2"></i>Download Reports
                                                        Grade</button>
                                                </div>
                                                <!-- Scheduled Table -->
                                                <div class="table-container w-full mt-10 pb-10 " id="Information"
                                                    style="display:block;">
                                                    <div class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                                                        <div class="">
                                                            <label for="modalSchoolYear"
                                                                class="block text-[14px] font-bold text-gray-900">School
                                                                Year:</label>
                                                            {{ $teachers->school_year }}
                                                        </div>

                                                        <div class=" lg:col-span-2 xl:col-span-3 2xl:col-span-4 my-5">
                                                            <p class="text-[16px] font-bold">Address</p>
                                                        </div>

                                                        <div>
                                                            <label for="modalhouseNumber"
                                                                class="block text-[14px] font-bold text-gray-900">House
                                                                No.:</label>
                                                            {{ $teachers->house_number }}
                                                        </div>

                                                        <div>
                                                            <label for="modalStreet"
                                                                class="block text-[14px] font-bold text-gray-900">Street:</label>
                                                            {{ $teachers->street }}
                                                        </div>

                                                        <div>
                                                            <label for="modalBarangay"
                                                                class="block text-[14px] font-bold text-gray-900">Barangay:</label>
                                                            {{ $teachers->barangay }}
                                                        </div>

                                                        <div>
                                                            <label for="modalCity"
                                                                class="block text-[14px] font-bold text-gray-900">City:</label>
                                                            {{ $teachers->city }}
                                                        </div>

                                                        <div>
                                                            <label for="modalProvince"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Province:</label>
                                                            <input type="text" name="address"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                id="modalProvince" value="" readonly>
                                                        </div>


                                                        <!-- Father's Information -->
                                                        <div>
                                                            <p class="text-[16px] font-bold">Father Information </p>
                                                        </div>
                                                        <div>
                                                            <label for="modalFatherLastName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Father's
                                                                Last Name:</label>
                                                            <input type="text" name="fatherLastName" id="modalFatherLastName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Father's Last Name" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalFatherFirstName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Father's
                                                                First Name:</label>
                                                            <input type="text" name="fatherFirstName" id="modalFatherFirstName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Father's First Name" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalFatherMiddleName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Father's
                                                                Middle Name:</label>
                                                            <input type="text" name="fatherMiddleName" id="modalFatherMiddleName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Father's Middle Name" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalFatherSuffix"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Father's
                                                                Suffix (if any):</label>
                                                            <input type="text" name="fatherSuffix" id="modalFatherSuffix"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Father's Suffix" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalFatherOccupation"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Father's
                                                                Occupation:</label>
                                                            <input type="text" name="fatherOccupation" id="modalFatherOccupation"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Father's Occupation" readonly>
                                                        </div>

                                                        <div></div>
                                                        <div></div>
                                                        <div></div>

                                                        <!-- Mother's Information -->
                                                        <div>
                                                            <p class="text-[16px] font-bold">Mother Information </p>
                                                        </div>
                                                        <div>
                                                            <label for="modalMotherLastName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Mother's
                                                                Last Name:</label>
                                                            <input type="text" name="motherLastName" id="modalMotherLastName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Mother's Last Name" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalMotherFirstName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Mother's
                                                                First Name:</label>
                                                            <input type="text" name="motherFirstName" id="modalMotherFirstName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Mother's First Name" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalMotherMiddleName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Mother's
                                                                Middle Name:</label>
                                                            <input type="text" name="motherMiddleName" id="modalMotherMiddleName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Mother's Middle Name" readonly>
                                                        </div>

                                                        <div></div>

                                                        <div>
                                                            <label for="modalMotherOccupation"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Mother's
                                                                Occupation:</label>
                                                            <input type="text" name="motherOccupation" id="modalMotherOccupation"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Mother's Occupation" readonly>
                                                        </div>

                                                        <div></div>
                                                        <div></div>
                                                        <div></div>

                                                        <!-- Guardian's Information -->
                                                        <div>
                                                            <p class="text-[16px] font-bold">Guardian Information </p>
                                                        </div>
                                                        <div>
                                                            <label for="modalGuardianLastName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's
                                                                Last Name:</label>
                                                            <input type="text" name="guardianLastName" id="modalGuardianLastName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Guardian's Last Name" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalGuardianFirstName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's
                                                                First Name:</label>
                                                            <input type="text" name="guardianFirstName" id="modalGuardianFirstName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Guardian's First Name" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalGuardianMiddleName"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's
                                                                Middle Name:</label>
                                                            <input type="text" name="guardianMiddleName" id="modalGuardianMiddleName"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Guardian's Middle Name" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalGuardianSuffix"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's
                                                                Suffix (if
                                                                any):</label>
                                                            <input type="text" name="guardianSuffix" id="modalGuardianSuffix"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Guardian's Suffix" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalGuardianRelationship"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's
                                                                Relationship:</label>
                                                            <input type="text" name="guardianRelationship"
                                                                id="modalGuardianRelationship"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Guardian's Relationship" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalGuardianContact"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's
                                                                Contact
                                                                Number:</label>
                                                            <input type="text" name="guardianContact" id="modalGuardianContact"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Guardian's Contact Number" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalGuardianReligion"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Religion:</label>
                                                            <input type="text" name="guardianReligion" id="modalGuardianReligion"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Guardian's Contact Number" readonly>
                                                        </div>

                                                        <div></div>

                                                        <!-- Emergency Contact Information -->
                                                        <div>
                                                            <p class="text-[16px] font-bold">Emergency Information </p>
                                                        </div>
                                                        <div>
                                                            <label for="modalEmergencyContactPerson"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Emergency
                                                                Contact Person:</label>
                                                            <input type="text" name="emergencyContactPerson"
                                                                id="modalEmergencyContactPerson"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Emergency Contact Person" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalEmergencyContactNumber"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Emergency
                                                                Contact Number:</label>
                                                            <input type="text" name="emergencyContactNumber"
                                                                id="modalEmergencyContactNumber"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Emergency Contact Number" readonly>
                                                        </div>

                                                        <!-- Contact Information -->
                                                        <div>
                                                            <label for="modalEmailAddress"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Email
                                                                Address:</label>
                                                            <input type="email" name="emailAddress" id="modalEmailAddress"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Email Address" readonly>
                                                        </div>

                                                        <div>
                                                            <label for="modalMessengerAccount"
                                                                class="block mb-2 text-[12px] font-bold text-gray-900">Messenger
                                                                Account
                                                                (optional):</label>
                                                            <input type="text" name="messengerAccount" id="modalMessengerAccount"
                                                                class="input-field focus:outline-none focus:ring-none"
                                                                placeholder="Messenger Account (optional)" readonly>
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