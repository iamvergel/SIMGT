@include("includes.header")
<div class="2xl:max-w-[1600px] w-full h-full overflow-hidden overflow-y-scroll bg-gray-100">
    <div class="p-0 lg:p-5">
        @if (session('success'))
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-5 max-w-sm">
                    <div class="flex items-center text-green-700 text-md font-normal">
                        <i class="fa-solid fa-check text-green-700 mr-2"></i>
                        <span>Registration Submitted Successfully!</span>
                    </div>
                    <hr class="border-1 border-teal-700 mt-5">
                    <div class="mt-5 text-sm">
                        <span class="text-justify">
                            Please proceed to the Admissions Office to claim three (3) copies of your registration form.
                            Next, submit them to the following offices:
                        </span>
                        <p class="font-seminormal mt-3 pl-5">Next Steps:</p>
                        <ul class="list-disc pl-5 mt-2">
                            <li class="list-item">Registrar’s Office – Submit one copy along with the required documents.
                            </li>
                            <li class="list-item">Accounting Office – Submit one copy for payment and financial processing.
                            </li>
                            <li class="list-item">Student Copy – Keep one copy for your personal reference.</li>
                        </ul>
                        <span class="block mt-5 bg-gray-200 p-2">
                            <i class="fa-solid fa-circle-exclamation me-2 text-green-700 text-justify"></i><span
                                class="font-normal">Important:</span> Your registration will only be fully processed once
                            all required documents have been submitted.
                        </span>
                        <p class="font-seminormal pl-5 mt-3">Required Documents to Submit to the Registrar:</p>
                        <ul class="list-disc pl-5 mt-2">
                            <li class="list-item">Birth Certificate (PSA/NSO Copy)</li>
                            <li class="list-item">Form 137 (SF10)</li>
                            <li class="list-item">Form 138 (SF9) – (For Transferees)</li>
                        </ul>
                    </div>
                    <div class="flex justify-end mt-5">
                        <button class="cursor-pointer bg-teal-700 hover:bg-teal-800 px-5 py-1 rounded text-white"
                            onclick="this.parentElement.parentElement.parentElement.style.display='none';">
                            Close</button>
                    </div>
                </div>
            </div>
        @endif


        @if ($errors->any())
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-5 max-w-sm">
                    <div class="flex items-center text-red-700 text-md font-normal">
                        <i class="fa-solid fa-circle-exclamation text-red-500 mr-2"></i>
                        <span>Error</span>
                    </div>
                    <hr class="border-1 border-red-500 mt-5">
                    <div class="mt-5 text-sm">
                        <ul class="list-disc pl-5 mt-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="flex justify-end mt-5">
                        <button class="cursor-pointer bg-red-500 hover:bg-red-700 px-5 py-1 rounded text-white"
                            onclick="this.parentElement.parentElement.parentElement.style.display='none';">
                            Close</button>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-center items-center my-5" id="top">
            <img src="{{ asset('../assets/images/SELC.png') }}" alt=""
                class="me-2 w-[50px] md:w-[60px] lg:w-[70px] xl:w-[90px] rounded-full">
            <p class="text-[15px] md:text-[30px] lg:text-[40px] xl:text-[50px] font-normal text-teal-900">St. Emelie
                Learning Center</p>
        </div>

        <div class="flex justify-center items-center my-5">
            <p
                class="text-[15px] leading-[1.5rem] text-center md:text-[15px] lg:text-[20px] xl:text-[30px] font-normal text-teal-900">
                Registration <br /><span class="text-[15px]">For School Year {{ date('Y') }}-{{ date('Y') + 1 }}</span>
            </p>
        </div>

        <div class="bg-gray-100">
            <!-- Modal body -->
            <form class="p-2 lg:p-3 " onsubmit="return validateForm()" id="myform"
                action="{{ route('student.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-2 rounded-lg shadow-lg border my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">
                        <div
                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                            <p class="text-[20px] font-normal"><i class="fas fa-user mr-2 mb-5"></i>Primary Information
                            </p>
                        </div>

                        <!-- School Year -->
                        <div class="mb-5 hidden">
                            <label for="schoolYear"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                <span class="text-red-600 mr-1">*</span>School Year
                            </label>
                            <input type="text" name="school_year" id="schoolYear" readonly
                                value="{{ date('Y') }}-{{ date('Y') + 1}}"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none "
                                required />
                            <div class="text-red-600 text-xs hidden" id="alert">This field is required</div>
                        </div>

                        <!-- Admission Type -->
                        <div class="mb-5">
                            <label for="status" class="text-[12px]">
                                <span class="text-red-600 mr-1">*</span>Admission Type
                            </label>
                            <select name="status" id="status" required
                                class="px-3 block py-2.5 px-0 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer ">
                                <option value="" disabled selected>Select Admission Type</option>
                                <option value="New Student">New Student</option>
                                <option value="Transferee">Transferee</option>
                            </select>
                            <div class="text-red-600 text-xs hidden" id="statusAlert">Admission Type is required</div>
                        </div>

                        <!-- Grade -->
                        <div class="mb-5">
                            <label for="grade" class="text-[12px]">
                                <span class="text-red-600 mr-1">*</span>Grade
                            </label>
                            <select id="grade" name="grade" required
                                class="px-3 block py-2.5 px-0 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer ">
                                <option value="" disabled selected>Select Grade</option>
                                <option value="Grade One">Grade One</option>
                                <option value="Grade Two">Grade Two</option>
                                <option value="Grade Three">Grade Three</option>
                                <option value="Grade Four">Grade Four</option>
                                <option value="Grade Five">Grade Five</option>
                                <option value="Grade Six">Grade Six</option>
                            </select>
                            <div class="text-red-600 text-xs hidden" id="gradeAlert">Grade is required</div>
                        </div>
                    </div>

                    <!-- Next Button -->
                    <div class="flex justify-end">
                        <button
                            class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-normal rounded-md text-sm w-full sm:w-auto px-10 py-2 text-center"
                            id="nextButton" onclick="showNextStep()" type="button">
                            Next
                        </button>
                    </div>
                </div>

                <script>
                    function checkValidity() {
                        var isValid = true;

                        var gradeSelect = document.getElementById('grade');
                        var gradeAlert = document.getElementById('gradeAlert');
                        if (gradeSelect.value === '') {
                            gradeSelect.classList.add('border-red-500');
                            gradeAlert.classList.remove('hidden');
                            isValid = false;
                        } else {
                            gradeSelect.classList.remove('border-red-500');
                            gradeAlert.classList.add('hidden');
                        }

                        var statusSelect = document.getElementById('status');
                        var statusAlert = document.getElementById('statusAlert');
                        if (statusSelect.value === '') {
                            statusSelect.classList.add('border-red-500');
                            statusAlert.classList.remove('hidden');
                            isValid = false;
                        } else {
                            statusSelect.classList.remove('border-red-500');
                            statusAlert.classList.add('hidden');
                        }

                        return isValid;
                    }

                    function showNextStep() {
                        if (checkValidity()) {
                            document.getElementById('basicinfo').classList.remove('hidden');
                        }
                    }

                    document.getElementById('grade').addEventListener('change', function () {
                        if (this.value) {
                            document.getElementById('gradeAlert').classList.add('hidden');
                            this.classList.remove('border-red-500');
                        }
                    });

                    document.getElementById('status').addEventListener('change', function () {
                        if (this.value) {
                            document.getElementById('statusAlert').classList.add('hidden');
                            this.classList.remove('border-red-500');
                        }
                    });
                </script>

                <div class="p-5 lg:p-10 bg-white rounded-sm shadow-lg border my-5 hidden" id="basicinfo">
                    <div class="">
                        <ol class="col-span-4 relative border-s border-teal-800" id="steps">
                            <div>
                                <span
                                    class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                    <i class="fa-solid fa-file text-teal-700"></i>
                                </span>
                                <p class="ml-5 text-sm font-normal">Basic Information</p>
                            </div>

                            <li class="mb-10 ms-2">
                                <div
                                    class="p-0 lg:p-5 col-span-4 p-2 rounded-sm shadow-lg border my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                                    <div
                                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-0 lg:px-3">

                                        <!-- LRN Input Field -->
                                        <div class="mb-5 py-5">
                                            <label for="lrn" class="text-[12px] font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>LRN
                                            </label>
                                            <input type="text" name="lrn" id="lrn" maxlength="12" inputmode="numeric"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Learner Reference Number (LRN)"
                                                onkeydown="return event.key != 'ArrowUp' && event.key != 'ArrowDown'"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)" />
                                            <small class="text-gray-500 text-[12px]">(LRN is 12 digits) <span
                                                    class="text-red-600 text-xs hidden" id="lrnAlert">LRN is
                                                    required</span></small>
                                        </div>

                                        <!-- Personal Information Section -->
                                        <div
                                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                            <p class="text-[20px] font-normal"><i
                                                    class="fas fa-user mr-2 mb-5"></i>Personal Information</p>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="mb-5">
                                            <label for="lastName" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Last Name
                                            </label>
                                            <input type="text" name="lastName" id="lastName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Last Name" required>
                                            <small class="text-red-600 text-xs hidden" id="lastNameAlert">Last Name is
                                                required</small>
                                        </div>

                                        <!-- First Name -->
                                        <div class="mb-5">
                                            <label for="firstName" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>First Name
                                            </label>
                                            <input type="text" name="firstName" id="firstName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter First Name" required>
                                            <small class="text-red-600 text-xs hidden" id="firstNameAlert">First Name is
                                                required</small>
                                        </div>

                                        <!-- Middle Name -->
                                        <div class="mb-5">
                                            <label for="middleName" class="text-sm font-normal text-gray-900">Middle
                                                Name</label>
                                            <input type="text" name="middleName" id="middleName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Middle Name">
                                            <small class="text-red-600 text-xs hidden" id="middleNameAlert">Middle Name
                                                is optional</small>
                                        </div>

                                        <!-- Suffix Name -->
                                        <div class="mb-5">
                                            <label for="suffixName" class="text-sm font-normal text-gray-900">Suffix
                                                Name</label>
                                            <select id="suffixName" name="suffixName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer">
                                                <option value="">Select an option</option>
                                                <option value="Jr.">Jr.</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden" id="suffixNameAlert">Suffix is
                                                optional</small>
                                        </div>

                                        <!-- Birthplace -->
                                        <div class="mb-5">
                                            <label for="birthplace" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Birthplace
                                            </label>
                                            <input type="text" name="birthplace" id="birthplace"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Birthplace" required>
                                            <small class="text-red-600 text-xs hidden" id="birthplaceAlert">Birthplace
                                                is required</small>
                                        </div>

                                        <!-- Birth Date -->
                                        <div class="mb-5">
                                            <label for="birthDate" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Birth Date
                                            </label>
                                            <input type="text" name="birthDate" id="birthDate" placeholder="MM/DD/YYYY"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                required>
                                            <small class="text-red-600 text-xs hidden" id="birthDateAlert">Birth Date is
                                                required</small>
                                        </div>

                                        <!-- Age -->
                                        <div class="mb-5">
                                            <label for="age" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Age
                                            </label>
                                            <input type="number" name="age" id="ageStudent"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Age" min="0" required readonly>
                                            <small class="text-red-600 text-xs hidden" id="ageAlert">Age is
                                                required</small>
                                        </div>

                                        <!-- Gender -->
                                        <div class="mb-5">
                                            <label for="gender" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Gender
                                            </label>
                                            <select name="gender" id="gender"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                required>
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden" id="genderAlert">Gender is
                                                required</small>
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-5">
                                            <label for="email" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Email
                                            </label>
                                            <input type="email" name="email" id="email"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Ex. StEmilieLearningCenter@gmail.com" required
                                                pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                                title="Please enter a valid Gmail address.">
                                            <small class="text-red-600 text-xs hidden" id="emailAlert">Email is
                                                required</small>
                                        </div>

                                        <!-- Contact Number -->
                                        <div class="mb-5">
                                            <label for="contactNo" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Contact No.
                                            </label>
                                            <input type="tel" name="contactNo" id="contactNo" maxlength="11"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Contact Number" required pattern="^09\d{9,11}$"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                value="" onfocus="if (this.value == '') { this.value = '09'; }"
                                                onblur="if (this.value == '09') { this.value = ''; }" required>
                                            <small class="text-gray-500 text-xs">(Parents, guardian or Personal
                                                Number)<br /><span class="text-red-600 hidden"
                                                    id="contactNoAlert">Contact Number is required</span></small>
                                        </div>
                                        <!-- Religion -->
                                        <div class="mb-5">
                                            <label for="religion" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Religion
                                            </label>

                                            <!-- Custom dropdown with search -->
                                            <div class="relative">
                                                <input type="text" id="religion" name="religion"
                                                    placeholder="Select or type your religion"
                                                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                    oninput="filterReligionOptions()" onclick="showReligionList()"
                                                    required>

                                                <ul id="religionList"
                                                    class="hidden absolute w-full bg-white border border-gray-300 mt-1 rounded shadow-lg max-h-60 overflow-y-auto z-10">
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Christianity')">Christianity</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Islam')">Islam</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Hinduism')">Hinduism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Buddhism')">Buddhism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Judaism')">Judaism</li>
                                                </ul>
                                            </div>

                                            <small class="text-red-600 text-xs hidden" id="religionAlert">Religion is
                                                required</small>
                                        </div>

                                        <script>
                                            // Function to show the list when clicked
                                            function showReligionList() {
                                                const list = document.getElementById('religionList');
                                                list.classList.remove('hidden');
                                            }

                                            // Function to filter options based on input
                                            function filterReligionOptions() {
                                                const input = document.getElementById('religion');
                                                const filter = input.value.toLowerCase();
                                                const list = document.getElementById('religionList');
                                                const options = list.getElementsByTagName('li');

                                                // Show the list when typing
                                                list.classList.remove('hidden');
                                                let matchFound = false;

                                                for (let i = 0; i < options.length; i++) {
                                                    const option = options[i];
                                                    const text = option.textContent || option.innerText;
                                                    if (text.toLowerCase().indexOf(filter) > -1) {
                                                        option.style.display = "";
                                                        matchFound = true;
                                                    } else {
                                                        option.style.display = "none";
                                                    }
                                                }

                                                // If no matches, hide the dropdown list
                                                if (!matchFound) {
                                                    list.classList.add('hidden');
                                                }
                                            }

                                            // Function to select a religion option
                                            function selectReligion(religion) {
                                                const input = document.getElementById('religion');
                                                const list = document.getElementById('religionList');

                                                input.value = religion;
                                                list.classList.add('hidden'); // Hide dropdown after selection

                                                // Optionally, validate religion
                                                validateReligion();
                                            }

                                            // Validation to check if a religion is selected
                                            function validateReligion() {
                                                const religionInput = document.getElementById('religion');
                                                const religionAlert = document.getElementById('religionAlert');

                                                if (religionInput.value === "") {
                                                    religionAlert.classList.remove('hidden');
                                                } else {
                                                    religionAlert.classList.add('hidden');
                                                }
                                            }

                                            // Close the dropdown when clicked outside
                                            document.addEventListener('click', function (event) {
                                                const list = document.getElementById('religionList');
                                                const input = document.getElementById('religion');

                                                if (!input.contains(event.target) && !list.contains(event.target)) {
                                                    list.classList.add('hidden');
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>

                                <!-- Permanent Address Section -->
                                <div
                                    class="col-span-4 p-0 lg:p-5 rounded-lg shadow-lg border my-5 bg-gradient-to-tr from-sky-50 via-white to-white mb-5">
                                    <div
                                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-2 lg:px-3">
                                        <div
                                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                            <p class="text-[20px] font-normal"><i
                                                    class="fa-solid fa-map-location-dot mr-2 mb-5"></i>Permanent Address
                                            </p>
                                        </div>

                                        <!-- Region Dropdown -->
                                        <div class="mb-5">
                                            <label for="region" class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Region:
                                            </label>
                                            <input type="hidden" name="home_number" id="regionValue">
                                            <select id="region"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                required>
                                                <option value="">Select Region</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden" id="regionAlert">Region is
                                                required</small>
                                        </div>

                                        <!-- Province Dropdown -->
                                        <div class="mb-5">
                                            <label for="province" class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Province:
                                            </label>
                                            <input type="hidden" name="province" id="provinceValue">
                                            <select id="province"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                required>
                                                <option value="">Select Province</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden" id="provinceAlert">Province is
                                                required</small>
                                        </div>

                                        <!-- City Dropdown -->
                                        <div class="mb-5">
                                            <label for="city" class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>City:
                                            </label>
                                            <input type="hidden" name="city" id="cityValue">
                                            <select id="city"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                required>
                                                <option value="">Select City</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden" id="cityAlert">City is
                                                required</small>
                                        </div>

                                        <!-- Barangay Dropdown -->
                                        <div class="mb-5">
                                            <label for="barangay" class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Barangay:
                                            </label>
                                            <input type="hidden" name="barangay" id="barangayValue">
                                            <select  id="barangay"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                required>
                                                <option value="">Select Barangay</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden" id="barangayAlert">Barangay is
                                                required</small>
                                        </div>

                                        <!-- Street -->
                                        <div class="mb-5">
                                            <label for="street" class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Home/Building/Street:
                                            </label>
                                            <input type="text" name="street" id="street"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Home/building/Street" required>
                                            <small class="text-red-600 text-xs hidden" id="streetAlert">Street is
                                                required</small>
                                        </div>
                                    </div>
                                    <div class="flex justify-end p-2">
                                        <button
                                            class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-normal rounded-md text-sm w-full sm:w-auto px-10 py-2 text-center"
                                            onclick="showMotherInfoStep()" type="button">Next</button>
                                    </div>
                                </div>
                            </li>

                            <script>
                                function checkParentInfoValidity() {
                                    var isValid = true;

                                    // Validate LRN
                                    var lrnInput = document.getElementById('lrn');
                                    var lrnAlert = document.getElementById('lrnAlert');
                                    if (lrnInput.value === '') {
                                        // If LRN is empty, show 'LRN is required' message
                                        lrnInput.classList.add('border-red-500');
                                        lrnAlert.classList.remove('hidden');
                                        lrnAlert.innerHTML = 'LRN is required';
                                        isValid = false;
                                    } else if (lrnInput.value.length !== 12) {
                                        // If LRN is not exactly 12 digits, show 'LRN must be 12 digits' message
                                        lrnInput.classList.add('border-red-500');
                                        lrnAlert.classList.remove('hidden');
                                        lrnAlert.innerHTML = 'LRN must be 12 digits';
                                        isValid = false;
                                    } else {
                                        // If LRN is valid, remove the error message
                                        lrnInput.classList.remove('border-red-500');
                                        lrnAlert.classList.add('hidden');
                                        lrnAlert.innerHTML = 'LRN is required';
                                    }

                                    // Validate Last Name
                                    var lastNameInput = document.getElementById('lastName');
                                    var lastNameAlert = document.getElementById('lastNameAlert');
                                    if (lastNameInput.value === '') {
                                        lastNameInput.classList.add('border-red-500');
                                        lastNameAlert.classList.remove('hidden');
                                        isValid = false;
                                    } else {
                                        lastNameInput.classList.remove('border-red-500');
                                    }

                                    // Validate First Name
                                    var firstNameInput = document.getElementById('firstName');
                                    var firstNameAlert = document.getElementById('firstNameAlert');
                                    if (firstNameInput.value === '') {
                                        firstNameAlert.classList.remove('hidden');
                                        firstNameInput.classList.add('border-red-500');
                                        isValid = false;
                                    } else {
                                        firstNameInput.classList.remove('border-red-500');
                                    }

                                    // Validate Birthplace
                                    var birthplaceInput = document.getElementById('birthplace');
                                    var birthplaceAlert = document.getElementById('birthplaceAlert');
                                    if (birthplaceInput.value === '') {
                                        birthplaceAlert.classList.remove('hidden');
                                        birthplaceInput.classList.add('border-red-500');
                                        isValid = false;
                                    } else {
                                        birthplaceInput.classList.remove('border-red-500');
                                    }

                                    // Validate Birth Date
                                    var birthDateInput = document.getElementById('birthDate');
                                    var birthDateAlert = document.getElementById('birthDateAlert');
                                    var ageAlert = document.getElementById('ageAlert');
                                    if (birthDateInput.value === '') {
                                        birthDateAlert.classList.remove('hidden');
                                        ageAlert.classList.remove('hidden');
                                        birthDateInput.classList.add('border-red-500');
                                        isValid = false;
                                    } else {
                                        birthDateInput.classList.remove('border-red-500');
                                    }


                                    // Validate Gender
                                    var genderSelect = document.getElementById('gender');
                                    var genderAlert = document.getElementById('genderAlert');
                                    if (genderSelect.value === '') {
                                        genderAlert.classList.remove('hidden');
                                        genderSelect.classList.add('border-red-500');
                                        isValid = false;
                                    } else {
                                        genderSelect.classList.remove('border-red-500');
                                    }

                                    // Validate Email
                                    var emailInput = document.getElementById('email');
                                    var emailAlert = document.getElementById('emailAlert');
                                    if (emailInput.value === '') {
                                        emailAlert.classList.remove('hidden');
                                        emailInput.classList.add('border-red-500');
                                        isValid = false;
                                    } else {
                                        emailInput.classList.remove('border-red-500');
                                    }

                                    // Validate Contact Number
                                    var contactNoInput = document.getElementById('contactNo');
                                    var contactNoAlert = document.getElementById('contactNoAlert');
                                    if (contactNoInput.value === '') {
                                        contactNoAlert.classList.remove('hidden');
                                        contactNoInput.classList.add('border-red-500');
                                        isValid = false;
                                    } else {
                                        contactNoInput.classList.remove('border-red-500');
                                    }

                                    // Validate Religion
                                    var religionInput = document.getElementById('religion');
                                    var religionAlert = document.getElementById('religionAlert');
                                    if (religionInput.value === '') {
                                        religionAlert.classList.remove('hidden');
                                        religionInput.classList.add('border-red-500');
                                        isValid = false;
                                    } else {
                                        religionInput.classList.remove('border-red-500');
                                    }

                                    var regionInput = document.getElementById('region');  // Corrected to 'region'
                                    var streetInput = document.getElementById('street');
                                    var barangayInput = document.getElementById('barangay');
                                    var cityInput = document.getElementById('city');
                                    var provinceInput = document.getElementById('province');
                                    var regionAlert = document.getElementById('regionAlert');  // Corrected to 'regionAlert'
                                    var streetAlert = document.getElementById('streetAlert');
                                    var barangayAlert = document.getElementById('barangayAlert');
                                    var cityAlert = document.getElementById('cityAlert');
                                    var provinceAlert = document.getElementById('provinceAlert');

                                    // Validation logic
                                    if (
                                        regionInput.value === '' ||
                                        streetInput.value === '' ||
                                        barangayInput.value === '' ||
                                        cityInput.value === '' ||
                                        provinceInput.value === ''
                                    ) {
                                        var isValid = false;
                                        // Check if each field is empty and show validation messages
                                        if (regionInput.value === '') {
                                            regionInput.classList.add('border-red-500');
                                            regionAlert.classList.remove('hidden');
                                        }
                                        if (streetInput.value === '') {
                                            streetInput.classList.add('border-red-500');
                                            streetAlert.classList.remove('hidden');
                                        }
                                        if (barangayInput.value === '') {
                                            barangayInput.classList.add('border-red-500');
                                            barangayAlert.classList.remove('hidden');
                                        }
                                        if (cityInput.value === '') {
                                            cityInput.classList.add('border-red-500');
                                            cityAlert.classList.remove('hidden');
                                        }
                                        if (provinceInput.value === '') {
                                            provinceInput.classList.add('border-red-500');
                                            provinceAlert.classList.remove('hidden');
                                        }
                                    } else {
                                        // Remove error styling if fields are filled
                                        regionInput.classList.remove('border-red-500');
                                        streetInput.classList.remove('border-red-500');
                                        barangayInput.classList.remove('border-red-500');
                                        cityInput.classList.remove('border-red-500');
                                        provinceInput.classList.remove('border-red-500');

                                        // Optionally, hide alerts when validation passes
                                        regionAlert.classList.add('hidden');
                                        streetAlert.classList.add('hidden');
                                        barangayAlert.classList.add('hidden');
                                        cityAlert.classList.add('hidden');
                                        provinceAlert.classList.add('hidden');
                                    }

                                    return isValid;
                                }

                                function showMotherInfoStep() {
                                    if (checkParentInfoValidity()) {
                                        document.getElementById('paraentsInfo').classList.remove('hidden'); // Show parentsInfo section
                                        document.getElementById('paraentsInfo').classList.remove('hidden'); // Show addressInfo section
                                    }
                                }

                                // Event listeners for dynamic validation
                                const fields = [
                                    { id: 'lrn', alertId: 'lrnAlert' },
                                    { id: 'lastName', alertId: 'lastNameAlert' },
                                    { id: 'firstName', alertId: 'firstNameAlert' },
                                    { id: 'birthplace', alertId: 'birthplaceAlert' },
                                    { id: 'birthDate', alertId: 'birthDateAlert' },
                                    { id: 'birthDate', alertId: 'ageAlert' },
                                    { id: 'ageStudent', alertId: 'ageAlert' },
                                    { id: 'gender', alertId: 'genderAlert' },
                                    { id: 'email', alertId: 'emailAlert' },
                                    { id: 'contactNo', alertId: 'contactNoAlert' },
                                    { id: 'religion', alertId: 'religionAlert' },
                                    { id: 'region', alertId: 'regionAlert' },
                                    { id: 'street', alertId: 'streetAlert' },
                                    { id: 'barangay', alertId: 'barangayAlert' },
                                    { id: 'city', alertId: 'cityAlert' },
                                    { id: 'province', alertId: 'provinceAlert' }
                                ];

                                fields.forEach(field => {
                                    const element = document.getElementById(field.id);
                                    const alertElement = document.getElementById(field.alertId);

                                    element.addEventListener(element.tagName === 'SELECT' ? 'change' : 'input', function () {
                                        if (this.value) {
                                            alertElement.classList.add('hidden');
                                            this.classList.remove('border-red-500');
                                        }
                                    });
                                });
                            </script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const regionSelect = document.getElementById('region');
                                    const provinceSelect = document.getElementById('province');
                                    const citySelect = document.getElementById('city');
                                    const barangaySelect = document.getElementById('barangay');

                                    // Fetch Regions
                                    fetch('https://psgc.gitlab.io/api/regions.json')
                                        .then(response => response.json())
                                        .then(data => {
                                            data.forEach(region => {
                                                const option = document.createElement('option');
                                                option.value = region.code;
                                                option.textContent = region.name;
                                                regionSelect.appendChild(option);
                                            });


                                        })
                                        .catch(err => console.error('Error fetching regions:', err));

                                        


                                    // Event listener for Region change to fetch Provinces or handle NCR
                                    regionSelect.addEventListener('change', function () {
                                        const selectedRegionCode = regionSelect.value;

                                        const selectedOption = regionSelect.options[regionSelect.selectedIndex];
                                        document.getElementById("regionValue").value = selectedOption.textContent;

                                        if (selectedRegionCode === '130000000') {  // If NCR is selected
                                            // Metro Manila is the "province" in NCR, so set it up.
                                            const selectProvinceOption = document.createElement('option');
                                            selectProvinceOption.value = '';
                                            selectProvinceOption.textContent = 'Select Province';
                                            const metroManilaOption = document.createElement('option');
                                            metroManilaOption.value = 'Metro Manila'; // Use a placeholder value for Metro Manila
                                            metroManilaOption.textContent = 'Metro Manila';
                                            provinceSelect.innerHTML = '';  // Clear existing provinces
                                            provinceSelect.appendChild(selectProvinceOption);
                                            provinceSelect.appendChild(metroManilaOption);  // Add Metro Manila option

                                            citySelect.innerHTML = '<option value="">Select City</option>';  // Reset city select
                                            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';  // Reset barangay select

                                            fetchCities(selectedRegionCode);
                                        } else if (selectedRegionCode) {
                                            fetchProvinces(selectedRegionCode);  // Fetch provinces for the selected region
                                            fetchCities(selectedRegionCode);
                                        } else {
                                            provinceSelect.innerHTML = '<option value="">Select Province</option>';
                                            citySelect.innerHTML = '<option value="">Select City</option>';
                                            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                                        }
                                    });

                                    // Fetch Provinces based on selected Region
                                    function fetchProvinces(regionCode) {
                                        fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces.json`)
                                            .then(response => response.json())
                                            .then(data => {
                                                provinceSelect.innerHTML = '<option value="">Select Province</option>';
                                                data.forEach(province => {
                                                    const option = document.createElement('option');
                                                    option.value = province.code;
                                                    option.textContent = province.name;
                                                    provinceSelect.appendChild(option);
                                                });
                                                citySelect.innerHTML = '<option value="">Select City</option>'; // Reset city select
                                                barangaySelect.innerHTML = '<option value="">Select Barangay</option>'; // Reset barangay select
                                            })
                                            .catch(err => console.error('Error fetching provinces:', err));
                                           
                                        // Update cityValue when a city is selected
                                        provinceSelect.addEventListener('change', function () {
                                            const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
                                            document.getElementById("provinceValue").value = selectedOption.textContent;
                                        });
                                    }

                                    // Event listener for Province change to fetch Cities
                                    provinceSelect.addEventListener('change', function () {
                                        const selectedProvinceCode = provinceSelect.value;
                                        if (selectedProvinceCode) {

                                        } else {
                                            citySelect.innerHTML = '<option value="">Select City</option>';
                                            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                                        }
                                    });

                                    // Fetch Cities based on selected Region or Province
                                    function fetchCities(regionCodeOrProvinceCode) {
                                        fetch(`https://psgc.gitlab.io/api/regions/${regionCodeOrProvinceCode}/cities.json`)
                                            .then(response => response.json())
                                            .then(data => {
                                                citySelect.innerHTML = '<option value="">Select City</option>';
                                                data.forEach(city => {
                                                    const option = document.createElement('option');
                                                    option.value = city.code;
                                                    option.textContent = city.name;
                                                    citySelect.appendChild(option);
                                                });
                                                barangaySelect.innerHTML = '<option value="">Select Barangay</option>'; // Reset barangay select
                                            })
                                            .catch(err => console.error('Error fetching cities:', err));

                                        // Update cityValue when a city is selected
                                        citySelect.addEventListener('change', function () {
                                            const selectedOption = citySelect.options[citySelect.selectedIndex];
                                            document.getElementById("cityValue").value = selectedOption.textContent;
                                        });
                                    }

                                    // Event listener for City change to fetch Barangays
                                    citySelect.addEventListener('change', function () {
                                        const selectedCityCode = citySelect.value;
                                        if (selectedCityCode) {
                                            fetchBarangays(selectedCityCode);
                                        } else {
                                            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                                        }
                                    });

                                    // Fetch Barangays based on selected City
                                    function fetchBarangays(cityCode) {
                                        fetch(`https://psgc.gitlab.io/api/cities/${cityCode}/barangays.json`)
                                            .then(response => response.json())
                                            .then(data => {
                                                barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                                                data.forEach(barangay => {
                                                    const option = document.createElement('option');
                                                    option.value = barangay.code;
                                                    option.textContent = barangay.name;
                                                    barangaySelect.appendChild(option);
                                                });
                                            })
                                            .catch(err => console.error('Error fetching barangays:', err));

                                            barangaySelect.addEventListener('change', function () {
                                            const selectedOption = barangaySelect.options[barangaySelect.selectedIndex];
                                            document.getElementById("barangayValue").value = selectedOption.textContent;
                                        });
                                    }
                                });
                            </script>

<div class="mt-5">
    <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
        <i class="fa-solid fa-file text-teal-700"></i>
    </span>
    <h1 class="ml-5">Parents Information</h1>
</div>

<li class=" mb-10 ms-2" id="paraentsInfo">
    <div class="col-span-4 p-2 rounded-lg shadow-lg border my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-0 lg:px-3">
        
            <!-- Personal Information -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                <p class="text-[20px] font-normal"><i class="fas fa-address-card mr-2 mb-5"></i>Parents Information</p>
            </div>

            <!-- Father's Information -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                <p class="mt-2 text-lg font-normal">Father Information:</p>
            </div>

            <!-- Father's Last Name -->
            <div class="mb-5">
                <label for="fatherLastName" class="text-sm font-normal text-gray-900">
                    <span class="text-red-600 mr-1">*</span>Father's Last Name:
                </label>
                <input type="text" name="father_last_name" id="fatherLastName"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                    placeholder="Enter Father's Last Name" required>
                <small class="text-red-600 text-xs hidden" id="fatherLastNameAlert">Father's Last Name is required</small>
            </div>

            <!-- Father's First Name -->
            <div class="mb-5">
                <label for="fatherFirstName" class="text-sm font-normal text-gray-900">
                    <span class="text-red-600 mr-1">*</span>Father's First Name:
                </label>
                <input type="text" name="father_first_name" id="fatherFirstName"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                    placeholder="Enter Father's First Name" required>
                <small class="text-red-600 text-xs hidden" id="fatherFirstNameAlert">Father's First Name is required</small>
            </div>

            <!-- Father's Middle Name -->
            <div class="mb-5">
                <label for="fatherMiddleName" class="text-sm font-normal text-gray-900">Father's Middle Name:</label>
                <input type="text" name="father_middle_name" id="fatherMiddleName"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                    placeholder="Enter Father's Middle Name">
                <small class="text-red-600 text-xs hidden" id="fatherMiddleNameAlert">Father's Middle Name is optional</small>
            </div>

            <!-- Father's Suffix Name -->
            <div class="mb-5">
                <label for="fatherSuffixName" class="text-sm font-normal text-gray-900">Father's Suffix Name:</label>
                <select id="fatherSuffixName" name="father_suffix_name"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer">
                    <option value="">Select Suffix Name</option>
                    <option value="Jr.">Jr.</option>
                    <option value="Sr.">Sr.</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                </select>
                <small class="text-red-600 text-xs hidden" id="fatherSuffixNameAlert">Suffix Name is optional</small>
            </div>

            <!-- Father's Occupation -->
            <div class="mb-5">
                <label for="fatherOccupation" class="text-sm font-normal text-gray-900">
                    <span class="text-red-600 mr-1">*</span>Father's Occupation:
                </label>
                <input type="text" name="father_occupation" id="fatherOccupation"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                    placeholder="Enter Father's Occupation" required>
                <small class="text-red-600 text-xs hidden" id="fatherOccupationAlert">Father's Occupation is required</small>
            </div>

            <!-- Mother's Information -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                <p class="mt-5 text-lg font-normal">Mother Information:</p>
            </div>

            <!-- Mother's Last Name -->
            <div class="mb-5">
                <label for="motherLastName" class="text-sm font-normal text-gray-900">
                    <span class="text-red-600 mr-1">*</span>Mother's Last Name:
                </label>
                <input type="text" name="mother_last_name" id="motherLastName"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                    placeholder="Enter Mother's Last Name" required>
                <small class="text-red-600 text-xs hidden" id="motherLastNameAlert">Mother's Last Name is required</small>
            </div>

            <!-- Mother's First Name -->
            <div class="mb-5">
                <label for="motherFirstName" class="text-sm font-normal text-gray-900">
                    <span class="text-red-600 mr-1">*</span>Mother's First Name:
                </label>
                <input type="text" name="mother_first_name" id="motherFirstName"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                    placeholder="Enter Mother's First Name" required>
                <small class="text-red-600 text-xs hidden" id="motherFirstNameAlert">Mother's First Name is required</small>
            </div>

            <!-- Mother's Middle Name -->
            <div class="mb-5">
                <label for="motherMiddleName" class="text-sm font-normal text-gray-900">Mother's Middle Name:</label>
                <input type="text" name="mother_middle_name" id="motherMiddleName"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                    placeholder="Enter Mother's Middle Name">
                <small class="text-red-600 text-xs hidden" id="motherMiddleNameAlert">Mother's Middle Name is optional</small>
            </div>

            <!-- Mother's Occupation -->
            <div class="mb-5">
                <label for="motherOccupation" class="text-sm font-normal text-gray-900">
                    <span class="text-red-600 mr-1">*</span>Mother's Occupation:
                </label>
                <input type="text" name="mother_occupation" id="motherOccupation"
                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                    placeholder="Enter Mother's Occupation" required>
                <small class="text-red-600 text-xs hidden" id="motherOccupationAlert">Mother's Occupation is required</small>
            </div>
        </div>

        <button class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-normal rounded-lg text-sm w-full sm:w-auto px-10 py-2.5 text-center" type="button" onclick="showNextStepGuardian()">
    Next
</button>

    </div>
</li>

<script>
    // Place this script at the end of the body to ensure DOM elements are loaded before any interaction
    function checkParentInfoValidityParents() {
        var isValid = true;

        // Validate Father's Last Name
        var fatherLastNameInput = document.getElementById('fatherLastName');
        var fatherLastNameAlert = document.getElementById('fatherLastNameAlert');
        if (fatherLastNameInput.value === '') {
            fatherLastNameInput.classList.add('border-red-500');
            fatherLastNameAlert.classList.remove('hidden');
            isValid = false;
        } else {
            fatherLastNameInput.classList.remove('border-red-500');
            fatherLastNameAlert.classList.add('hidden');
        }

        // Validate Father's First Name
        var fatherFirstNameInput = document.getElementById('fatherFirstName');
        var fatherFirstNameAlert = document.getElementById('fatherFirstNameAlert');
        if (fatherFirstNameInput.value === '') {
            fatherFirstNameInput.classList.add('border-red-500');
            fatherFirstNameAlert.classList.remove('hidden');
            isValid = false;
        } else {
            fatherFirstNameInput.classList.remove('border-red-500');
            fatherFirstNameAlert.classList.add('hidden');
        }

        // Validate Father's Occupation
        var fatherOccupationInput = document.getElementById('fatherOccupation');
        var fatherOccupationAlert = document.getElementById('fatherOccupationAlert');
        if (fatherOccupationInput.value === '') {
            fatherOccupationInput.classList.add('border-red-500');
            fatherOccupationAlert.classList.remove('hidden');
            isValid = false;
        } else {
            fatherOccupationInput.classList.remove('border-red-500');
            fatherOccupationAlert.classList.add('hidden');
        }

        // Validate Mother's Last Name
        var motherLastNameInput = document.getElementById('motherLastName');
        var motherLastNameAlert = document.getElementById('motherLastNameAlert');
        if (motherLastNameInput.value === '') {
            motherLastNameInput.classList.add('border-red-500');
            motherLastNameAlert.classList.remove('hidden');
            isValid = false;
        } else {
            motherLastNameInput.classList.remove('border-red-500');
            motherLastNameAlert.classList.add('hidden');
        }

        // Validate Mother's First Name
        var motherFirstNameInput = document.getElementById('motherFirstName');
        var motherFirstNameAlert = document.getElementById('motherFirstNameAlert');
        if (motherFirstNameInput.value === '') {
            motherFirstNameInput.classList.add('border-red-500');
            motherFirstNameAlert.classList.remove('hidden');
            isValid = false;
        } else {
            motherFirstNameInput.classList.remove('border-red-500');
            motherFirstNameAlert.classList.add('hidden');
        }

        // Validate Mother's Occupation
        var motherOccupationInput = document.getElementById('motherOccupation');
        var motherOccupationAlert = document.getElementById('motherOccupationAlert');
        if (motherOccupationInput.value === '') {
            motherOccupationInput.classList.add('border-red-500');
            motherOccupationAlert.classList.remove('hidden');
            isValid = false;
        } else {
            motherOccupationInput.classList.remove('border-red-500');
            motherOccupationAlert.classList.add('hidden');
        }

        return isValid;
    }

    function showNextStepGuardian() {
        if (checkParentInfoValidityParents()) {
            // Show the guardian information section
            document.getElementById('guardianInfo').classList.remove('hidden');
        }
    }

    // Event listeners for dynamic validation
    const fields = [
        { id: 'fatherLastName', alertId: 'fatherLastNameAlert' },
        { id: 'fatherFirstName', alertId: 'fatherFirstNameAlert' },
        { id: 'fatherOccupation', alertId: 'fatherOccupationAlert' },
        { id: 'motherLastName', alertId: 'motherLastNameAlert' },
        { id: 'motherFirstName', alertId: 'motherFirstNameAlert' },
        { id: 'motherOccupation', alertId: 'motherOccupationAlert' }
    ];

    fields.forEach(field => {
        const element = document.getElementById(field.id);
        const alertElement = document.getElementById(field.alertId);

        element.addEventListener(element.tagName === 'SELECT' ? 'change' : 'input', function () {
            if (this.value) {
                alertElement.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });
    });
</script>

                            <div class="mt-5">
                                <span
                                    class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                    <i class="fa-solid fa-file text-teal-700"></i>
                                </span>
                                <h1 class="ml-5">Guardian Information</h1>
                            </div>
                            <li class="hidden mb-10 ms-2" id="guardianInfo">
                                <div
                                    class="col-span-4 p-2 rounded-lg shadow-lg border  my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                                    <div
                                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                        <!-- Personal Information -->
                                        <div
                                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                            <p class="text-[20px] font-normal"><i
                                                    class="fas fa-address-card mr-2 mb-5"></i>
                                                Guardian Information
                                            </p>
                                        </div>

                                        <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                            <label class="block mb-2 text-sm font-normal text-gray-900">Guardian
                                                Type:</label>
                                            <div class="flex items-center mb-4">
                                                <input type="radio" id="guardianMother" name="guardianType"
                                                    value="mother" class="mr-2" onclick="setGuardianInfo('mother')">
                                                <label for="guardianMother"
                                                    class="mr-4 text-sm font-medium text-gray-900">Mother</label>

                                                <input type="radio" id="guardianFather" name="guardianType"
                                                    value="father" class="mr-2" onclick="setGuardianInfo('father')">
                                                <label for="guardianFather"
                                                    class="text-sm font-medium text-gray-900">Father</label>
                                            </div>
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianLastName"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Last Name:
                                            </label>
                                            <input type="text" name="guardian_last_name" id="guardianLastName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Last Name" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianFirstName"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's First Name:
                                            </label>
                                            <input type="text" name="guardian_first_name" id="guardianFirstName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's First Name" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianMiddleName"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                Guardian's Middle Name:
                                            </label>
                                            <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Middle Name">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianSuffixName"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                Suffix Name:
                                            </label>
                                            <select id="guardianSuffixName" name="guardian_suffix_name"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                                <option value="">Select Suffix Name</option>
                                                <option value="Jr.">Jr.</option>
                                                <option value="Sr.">Sr.</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                            </select>
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianRelationship"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Relationship to
                                                Student:
                                            </label>
                                            <input type="text" name="guardian_relationship" id="guardianRelationship"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Relationship" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianContactNumber"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Contact Number:
                                            </label>
                                            <input type="text" name="guardian_contact_number" id="guardianContactNumber"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Contact Number" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardian_religion"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Religion:
                                            </label>
                                            <input type="text" name="guardian_religion" id="guardian_religion"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Religion" required>
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <button
                                            class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-normal rounded-lg text-sm w-full sm:w-auto px-10 py-2.5 text-center"
                                            onclick="showNextStep()" type="button">Next</button>
                                    </div>
                                </div>
                            </li>

                            <div class="mt-5">
                                <span
                                    class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                    <i class="fa-solid fa-file text-teal-700"></i>
                                </span>
                                <h1 class="ml-5">Emergency Contact Information</h1>
                            </div>
                            <li class="hidden mb-10 ms-2">
                                <div
                                    class=" col-span-4 p-2 rounded-lg shadow-lg border  my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                                    <div
                                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                        <!-- Personal Information -->
                                        <div
                                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                            <p class="text-[20px] font-normal"><i
                                                    class="fa-regular fa-address-card mr-2 mb-5"></i>
                                                Emergency Contact Information </p>
                                        </div>

                                        <div class="mb-5">
                                            <label for="emergencyContactPerson"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Emergency Contact Person:
                                            </label>
                                            <input type="text" name="emergency_contact_person"
                                                id="emergencyContactPerson"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Emergency Contact Person" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="emergencyContactNumber"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Emergency Contact Number:
                                            </label>
                                            <input type="text" name="emergency_contact_number"
                                                id="emergencyContactNumber"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Emergency Contact Number" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="emailAddress"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Email Address:
                                            </label>
                                            <input type="email" name="email_address" id="emailAddress"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Email Address" required>
                                        </div>

                                        <div class="mb-5">
                                            <label for="messengerAccount"
                                                class="block mb-2 text-sm font-normal text-gray-900">
                                                Messenger Account (optional):
                                            </label>
                                            <input type="text" name="messenger_account" id="messengerAccount"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="e.g., Facebook Messenger ID">
                                        </div>

                                    </div>
                                    <div class="col-span-4 flex justify-center mt-10">
                                        <label class="flex items-center space-x-2 text-center">
                                            <span class="text-gray-600 font-seminormal text-lg">Double check your
                                                information
                                                before you proceed <br /> <span onclick="window.location.href = '#top';"
                                                    class="cursor-pointer p-2 px-3 mt-10 rounded-full text-xl text-white bg-teal-700 hover:bg-teal-800"><i
                                                        class="fa-solid fa-chevron-up"></i></span></span>

                                        </label>
                                    </div>
                                    <div class="col-span-4 flex  justify-center lg:justify-end mt-20 lg:me-20">
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" id="confirmCheck"
                                                class="form-checkbox h-5 w-5 text-teal-600">
                                            <span>I double-checked my information</span>

                                        </label>
                                    </div>
                                    <div class="col-span-4 flex justify-end mt-5">
                                        <button type="button" id="submitButton" disabled
                                            class="text-white w-96 text-center bg-gray-400 focus:ring-4 focus:outline-none focus:ring-teal-300 font-normal rounded text-sm px-20 py-2.5 text-center">
                                            Submit Registration
                                        </button>
                                    </div>

                                    <script>
                                        document.getElementById('confirmCheck').addEventListener('change', function () {
                                            const submitButton = document.getElementById('submitButton');
                                            submitButton.disabled = !this.checked;
                                            submitButton.classList.toggle('bg-gray-400', !this.checked);
                                            submitButton.classList.toggle('bg-sky-800', this.checked);
                                            submitButton.classList.toggle('hover:bg-sky-700', this.checked);
                                        });
                                    </script>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // Initialize the flatpickr
    flatpickr("#birthDate", {
        dateFormat: "m/d/Y",   // Set the desired format: MM/DD/YYYY
        onChange: function (selectedDates, dateStr, instance) {
            calculateAge(dateStr); // When date is selected, calculate age
        }
    });

    // Function to calculate age based on the selected date
    function calculateAge(birthDateStr) {
        const birthDateInput = document.getElementById('birthDate');
        const ageInput = document.getElementById('ageStudent');
        const birthDate = new Date(birthDateStr);
        const today = new Date();

        // Check if the date is valid
        if (isNaN(birthDate.getTime())) {
            return; // Don't trigger anything if the date is incomplete/invalid
        }

        // Calculate the age
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;  // Adjust age if birthday hasn't occurred yet this year
        }

        // Check if the age is within the valid range
        if (age < 5) {
            alert('The minimum age allowed is 5.');
            ageInput.value = '';  // Clear age input if below minimum age
            birthDateInput.value = ''; // Clear birthdate input as well
        } else if (age > 16) {
            alert('The maximum age allowed is 16.');
            ageInput.value = '';  // Clear age input if above maximum age
            birthDateInput.value = ''; // Clear birthdate input as well
        } else {
            ageInput.value = age;  // Set valid age in the age input field
        }
    }



    function setGuardianInfo(type) {
        const motherFirstName = document.getElementById('motherFirstName').value;
        const motherLastName = document.getElementById('motherLastName').value;
        const motherMiddleName = document.getElementById('motherMiddleName').value; // Get mother's middle name

        const fatherFirstName = document.getElementById('fatherFirstName').value;
        const fatherLastName = document.getElementById('fatherLastName').value;
        const fatherMiddleName = document.getElementById('fatherMiddleName').value; // Get father's middle name
        const fatherSuffix = document.getElementById('fatherSuffixName').value;

        const guardianRelationship = document.getElementById('guardianRelationship');

        if (type === 'mother') {
            document.getElementById('guardianFirstName').value = motherFirstName;
            document.getElementById('guardianLastName').value = motherLastName;
            document.getElementById('guardianMiddleName').value = motherMiddleName; // Set middle name
            document.getElementById('guardianSuffixName').value = ""; // Reset suffix when choosing mother
            guardianRelationship.value = "Mother";
        } else if (type === 'father') {
            document.getElementById('guardianFirstName').value = fatherFirstName;
            document.getElementById('guardianLastName').value = fatherLastName;
            document.getElementById('guardianMiddleName').value = fatherMiddleName; // Set middle name;
            document.getElementById('guardianSuffixName').value = fatherSuffix; // Set suffix when choosing father
            guardianRelationship.value = "Father";
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        document
            .querySelector("#birth_certificate")
            .addEventListener("change", function () {
                document.querySelector("#birthFileName").textContent = this.files[0]
                    ? this.files[0].name
                    : "No file chosen";
            });

        document
            .querySelector("#proof_of_residency")
            .addEventListener("change", function () {
                document.querySelector("#residencyFileName").textContent = this
                    .files[0]
                    ? this.files[0].name
                    : "No file chosen";
            });
    });
</script>
</body>

</html>