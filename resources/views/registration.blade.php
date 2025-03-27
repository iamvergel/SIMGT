@include("includes.header")
<div class="2xl:max-w-[1600px] w-full h-full overflow-hidden overflow-y-scroll bg-gray-100">
    <div class="p-0 lg:p-5">
        @if (session('success'))
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-5">
                <div class="bg-white rounded-md shadow-lg p-5 max-w-3xl mx-auto z-20">
                    <div class="flex justify-center items-center p-5 border-b border-gray-900">
                        <p class="text-lg lg:text-2xl font-bold text-green-500"><i
                                class="fas fa-check mr-2"></i>Registration Submitted Successfully!</p>
                    </div>
                    <div class="overflow-y-scroll h-[60vh] scrollbar-width-thin my-3 p-5 w-full">
                        <div class="mt-5 text-sm">
                            <span class="text-justify">
                                Please proceed to the Admissions Office to claim your Admission Slip.
                            </span>
                            <p class="font-seminormal mt-3 pl-5">Next Steps:</p>
                            <ul class="list-disc pl-5 mt-2">
                                <li class="list-item">Accounting Office – Submit your Admission Slip and complete the
                                    payment
                                    process.</li>
                                <li class="list-item">Registrar’s Office – Submit your Admission Slip, and Official Receipt
                                    along with the required documents.</li>
                            </ul>
                            <p class="font-seminormal pl-5 mt-3">Required Documents for Submission to the Registrar:</p>
                            <ul class="list-disc pl-5 mt-2">
                                <li class="list-item">Birth Certificate (PSA/NSO Copy)</li>
                                <li class="list-item">Form 137 (SF10)</li>
                                <li class="list-item">Form 138 (SF9) - (For Transferees)</li>
                            </ul>
                            <span class="block mt-5 bg-gray-200 p-2">
                                <i class="fa-solid fa-circle-exclamation me-2 text-green-700 text-justify"></i><span
                                    class="font-normal">Important:</span> Your registration will only be fully processed
                                once
                                all required documents have been submitted.
                            </span>
                        </div>
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
                            Okay</button>
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
                Registration <br /><span class="text-[15px]">For School Year
                    {{ date('Y') }}-{{ date('Y') + 1 }}</span>
            </p>
        </div>

        <div class="bg-gray-100">
            <!-- Modal body -->
            <form class="p-2 lg:p-3 " action="{{ route('student.register') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="p-2 rounded-lg shadow-lg border my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">
                        <div
                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                            <p class="text-[20px] font-normal"><i class="fas fa-user mr-2 mb-5"></i>Primary
                                Information
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
                                class="px-3 block py-2.5 px-0 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                onchange="toggleGradeOptions(this.value)">
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
                                class="px-3 block py-2.5 px-0 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer">
                                <option value="" disabled selected>Select Grade</option>
                                <option value="Grade One">Grade One</option>
                                <option value="Grade Two" class="transferee-option hidden">Grade Two</option>
                                <option value="Grade Three" class="transferee-option hidden">Grade Three</option>
                                <option value="Grade Four" class="transferee-option hidden">Grade Four</option>
                                <option value="Grade Five" class="transferee-option hidden">Grade Five</option>
                                <option value="Grade Six" class="transferee-option hidden">Grade Six</option>
                            </select>
                            <div class="text-red-600 text-xs hidden" id="gradeAlert">Grade is required</div>
                        </div>
                    </div>

                    <!-- Proceed Modal -->
                    <div class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden p-5 flex items-center justify-center"
                        id="proceedModal">
                        <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto mt-16">
                            <div class="flex items-center text-green-700 text-md font-normal">
                                <span>Important Notice:</span>
                            </div>
                            <hr class="border-1 border-green-500 mt-5">
                            <div class="mt-5 text-sm">
                                <p class="text-gray-600 text-justify">Do you have your Learner Reference Number (LRN)? If not, please be sure to visit the admission office to process it.</p>

                            </div>
                            <div class="flex justify-end mt-10 text-sm">
                                <button
                                    class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white"
                                    onclick="document.getElementById('proceedModal').classList.add('hidden');">
                                    Close
                                </button>
                                <button
                                    class="cursor-pointer bg-teal-700 hover:bg-teal-800 px-5 py-2 rounded-sm text-white ml-5"
                                    onclick="handleProceedToAdmissionProcess()">
                                    I Already Have LRN
                                </button>
                            </div>
                        </div>
                    </div>

                    <script>
                        function toggleGradeOptions(admissionType) {
                            const transfereeOptions = document.querySelectorAll('.transferee-option');
                            const gradeSelect = document.getElementById('grade');
                            gradeSelect.value = "";
                            if (admissionType === 'New Student') {
                                transfereeOptions.forEach(option => option.classList.add('hidden'));
                                document.getElementById('basicinfo').classList.add('hidden');
                            } else if (admissionType === 'Transferee') {
                                transfereeOptions.forEach(option => option.classList.remove('hidden'));
                                document.getElementById('basicinfo').classList.add('hidden');
                            }
                        }
                    </script>

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
                    var admissionType = document.getElementById("status").value;

                    console.log(admissionType);
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
                        var gradeSelect = document.getElementById('grade');
                        var gradeAlert = document.getElementById('gradeAlert');
                        var statusSelect = document.getElementById('status');
                        var statusAlert = document.getElementById('statusAlert');

                        if (statusSelect.value === 'New Student' && gradeSelect.value === 'Grade One') {
                            document.getElementById('proceedModal').classList.remove('hidden');

                        } else if (statusSelect.value === 'Transferee' && gradeSelect.value === 'Grade One') {
                            document.getElementById('proceedModal').classList.remove('hidden');
                        } else {
                            if (checkValidity()) {
                                document.getElementById('basicinfo').classList.remove('hidden');
                            }
                        }
                    }

                    function handleProceedToAdmissionProcess() {
                        if (checkValidity()) {
                            document.getElementById('basicinfo').classList.remove('hidden');
                        }

                        document.getElementById('proceedModal').classList.add('hidden');
                    }

                    document.getElementById('grade').addEventListener('change', function () {
                        if (this.value) {
                            document.getElementById('gradeAlert').classList.add('hidden');
                            this.classList.remove('border-red-500');
                        }

                        document.getElementById('basicinfo').classList.add('hidden');
                        document.getElementById('parentsInfo').classList.add('hidden');
                    });

                    document.getElementById('status').addEventListener('change', function () {
                        if (this.value) {
                            document.getElementById('statusAlert').classList.add('hidden');
                            this.classList.remove('border-red-500');
                        }

                        document.getElementById('basicinfo').classList.add('hidden');
                        document.getElementById('emergencyContactInfo').classList.add('hidden');
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
                                            <small class="text-gray-500 text-[12px]">(LRN must be exactly 12 digits)
                                                <span class="text-red-600 text-xs hidden" id="lrnAlert">LRN is
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
                                            <small class="text-red-600 text-xs hidden" id="lastNameAlert">Last Name
                                                is
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
                                            <small class="text-red-600 text-xs hidden" id="firstNameAlert">First
                                                Name is
                                                required</small>
                                        </div>

                                        <!-- Middle Name -->
                                        <div class="mb-5">
                                            <label for="middleName" class="text-sm font-normal text-gray-900">Middle
                                                Name</label>
                                            <input type="text" name="middleName" id="middleName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Middle Name">
                                            <small class="text-red-600 text-xs hidden" id="middleNameAlert">Middle
                                                Name
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
                                            <small class="text-red-600 text-xs hidden" id="suffixNameAlert">Suffix
                                                is
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
                                            <small class="text-red-600 text-xs hidden" id="birthDateAlert">Birth
                                                Date is
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
                                                placeholder="Enter Contact Number" required pattern="^09\d{9}$"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^(?!09).*/, '09');"
                                                value="09">
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
                                                    placeholder="Select or type your Religion"
                                                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                    oninput="filterReligionOptions()" onclick="showReligionList()"
                                                    required>

                                                <ul id="religionList"
                                                    class="hidden absolute w-full bg-white border border-gray-300 mt-1 rounded shadow-lg max-h-60 overflow-y-auto z-10">
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Roman Catholic')">Roman Catholic
                                                    </li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Protestantism')">Protestantism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Islam')">Islam</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Iglesia ni Cristo')">Iglesia ni
                                                        Cristo
                                                    </li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Hinduism')">Hinduism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Buddhism')">Buddhism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Indigenous Beliefs')">Indigenous
                                                        Beliefs</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Atheism and Agnosticism')">Atheism
                                                        and
                                                        Agnosticism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Sikhism')">Sikhism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligion('Zoroastrianism')">Zoroastrianism
                                                    </li>
                                                </ul>
                                            </div>

                                            <small class="text-red-600 text-xs hidden" id="religionAlert">Religion
                                                is
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
                                                    class="fa-solid fa-map-location-dot mr-2 mb-5"></i>Permanent
                                                Address
                                            </p>
                                        </div>

                                        <!-- Region Dropdown -->
                                        <div class="mb-5">
                                            <label for="region" class="block mb-2 text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Region:
                                            </label>
                                            <input type="hidden" name="house_number" id="regionValue">
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
                                            <small class="text-red-600 text-xs hidden" id="provinceAlert">Province
                                                is
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
                                            <select id="barangay"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                required>
                                                <option value="">Select Barangay</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden" id="barangayAlert">Barangay
                                                is
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
                                    } else if (!emailInput.value.endsWith('@gmail.com')) {
                                        emailAlert.classList.remove('hidden');
                                        emailAlert.innerText = 'Email must be @gmail.com';
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
                                    } else if (contactNoInput.value.length !== 11) {
                                        // If LRN is not exactly 12 digits, show 'LRN must be 12 digits' message
                                        contactNoInput.classList.add('border-red-500');
                                        contactNoAlert.classList.remove('hidden');
                                        contactNoAlert.innerHTML = 'Contact Number must be 11 digits';
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
                                        document.getElementById('parentsInfo').classList.remove('hidden'); // Show parentsInfo section

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

                                        document.getElementById('parentsInfo').classList.add('hidden');
                                        document.getElementById('emergencyContactInfo').classList.add('hidden');
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

                                            // Update cityValue when a city is selected
                                            provinceSelect.addEventListener('change', function () {
                                                const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
                                                document.getElementById("provinceValue").value = selectedOption.textContent;
                                            });

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
                                <span
                                    class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                    <i class="fa-solid fa-file text-teal-700"></i>
                                </span>
                                <h1 class="ml-5">Parents Information</h1>
                            </div>

                            <li class=" mb-10 ms-2 hidden" id="parentsInfo">
                                <div
                                    class="col-span-4 p-2 rounded-lg shadow-lg border my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                                    <div
                                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-0 lg:px-3">

                                        <!-- Personal Information -->
                                        <div
                                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                            <p class="text-[20px] font-normal"><i
                                                    class="fas fa-address-card mr-2 mb-5"></i>Parents Information
                                            </p>
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
                                            <small class="text-red-600 text-xs hidden" id="fatherLastNameAlert">Father's
                                                Last Name is required</small>
                                        </div>

                                        <!-- Father's First Name -->
                                        <div class="mb-5">
                                            <label for="fatherFirstName" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Father's First Name:
                                            </label>
                                            <input type="text" name="father_first_name" id="fatherFirstName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Father's First Name" required>
                                            <small class="text-red-600 text-xs hidden"
                                                id="fatherFirstNameAlert">Father's First Name is required</small>
                                        </div>

                                        <!-- Father's Middle Name -->
                                        <div class="mb-5">
                                            <label for="fatherMiddleName"
                                                class="text-sm font-normal text-gray-900">Father's Middle
                                                Name:</label>
                                            <input type="text" name="father_middle_name" id="fatherMiddleName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Father's Middle Name">
                                            <small class="text-red-600 text-xs hidden"
                                                id="fatherMiddleNameAlert">Father's Middle Name is optional</small>
                                        </div>

                                        <!-- Father's Suffix Name -->
                                        <div class="mb-5">
                                            <label for="fatherSuffixName"
                                                class="text-sm font-normal text-gray-900">Father's Suffix
                                                Name:</label>
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
                                            <small class="text-red-600 text-xs hidden" id="fatherSuffixNameAlert">Suffix
                                                Name is optional</small>
                                        </div>

                                        <!-- Father's Occupation -->
                                        <div class="mb-5">
                                            <label for="fatherOccupation" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Father's Employee Status:
                                            </label>
                                            <select id="fatherOccupation" name="father_occupation"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer">
                                                <option value="">Select Occupation</option>
                                                <option value="employed">Employed</option>
                                                <option value="unemployed">Unemployed</option>
                                                <option value="self-employed">Self-employed</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden"
                                                id="fatherOccupationAlert">Father's Occupation is required</small>
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
                                            <small class="text-red-600 text-xs hidden" id="motherLastNameAlert">Mother's
                                                Last Name is required</small>
                                        </div>

                                        <!-- Mother's First Name -->
                                        <div class="mb-5">
                                            <label for="motherFirstName" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Mother's First Name:
                                            </label>
                                            <input type="text" name="mother_first_name" id="motherFirstName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Mother's First Name" required>
                                            <small class="text-red-600 text-xs hidden"
                                                id="motherFirstNameAlert">Mother's First Name is required</small>
                                        </div>

                                        <!-- Mother's Middle Name -->
                                        <div class="mb-5">
                                            <label for="motherMiddleName"
                                                class="text-sm font-normal text-gray-900">Mother's Middle
                                                Name:</label>
                                            <input type="text" name="mother_middle_name" id="motherMiddleName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Mother's Middle Name">
                                            <small class="text-red-600 text-xs hidden"
                                                id="motherMiddleNameAlert">Mother's Middle Name is optional</small>
                                        </div>

                                        <div></div>

                                        <!-- Mother's Occupation -->
                                        <div class="mb-5">
                                            <label for="motherOccupation" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Mother's Employee Status:
                                            </label>
                                            <select id="motherOccupation" name="mother_occupation"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer">
                                                <option value="">Select Occupation</option>
                                                <option value="employed">Employed</option>
                                                <option value="unemployed">Unemployed</option>
                                                <option value="self-employed">Self-employed</option>
                                            </select>
                                            <small class="text-red-600 text-xs hidden"
                                                id="motherOccupationAlert">Mother's Occupation is required</small>
                                        </div>

                                        <!-- Mother's Information -->
                                        <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                            <p class="mt-5 text-lg font-normal">Guardian Information: </p>
                                        </div>
                                        <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                            <label class="block mb-2 text-sm font-normal text-teal-700 text-sm">( "If
                                                your guardian is your parent or parents, select 'Parent/s'. If your
                                                guardian is a relative other than your parents, select 'Others'. )<span
                                                    class="text-red-600">*</span></label>
                                            <div class="flex items-center mb-4 mt-4">
                                                <input type="radio" id="guardianMother" name="guardianType"
                                                    value="parent" class="mr-2" onclick="setGuardianInfo('parent')"
                                                    required>
                                                <label for="guardianParents"
                                                    class="mr-4 text-sm font-medium text-gray-900">Parent/s</label>

                                                <input type="radio" id="guardianother" name="guardianType" value="other"
                                                    class="mr-2" onclick="setGuardianInfo('other')" required>
                                                <label for="guardianOther"
                                                    class="text-sm font-medium text-gray-900">Other</label>
                                            </div>
                                            <small class="text-red-600 text-xs hidden"
                                                id="guardianSelectionAlert">Select Guardian is required</small>
                                        </div>

                                        <!-- Guardian's Information -->
                                        <!-- Guardian's First Name -->
                                        <div class="mb-5 hidden" id="gfname">
                                            <label for="guardianLastName" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Last Name:
                                            </label>
                                            <input type="text" name="guardian_last_name" id="guardianLastName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Guardian's last Name" required>
                                            <small class="text-red-600 text-xs hidden"
                                                id="guardianLastNameAlert">Guardian's Last Name is required</small>
                                        </div>

                                        <!-- Guardian's First Name -->
                                        <div class="mb-5 hidden" id="glname">
                                            <label for="guardianFirstName" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's First Name:
                                            </label>
                                            <input type="text" name="guardian_first_name" id="guardianFirstName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Guardian's First Name" required>
                                            <small class="text-red-600 text-xs hidden"
                                                id="guardianFirstNameAlert">Guardian's First Name is
                                                required</small>
                                        </div>

                                        <!-- Guardian's Middle Name -->
                                        <div class="mb-5 hidden" id="gmname">
                                            <label for="guardianMiddleName"
                                                class="text-sm font-normal text-gray-900">Guardian's Middle
                                                Name:</label>
                                            <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Guardian's Middle Name">
                                            <small class="text-red-600 text-xs hidden"
                                                id="guardianMiddleNameAlert">Guardian's Middle Name is
                                                optional</small>
                                        </div>

                                        <!-- Guardian's Suffix Name -->
                                        <div class="mb-5 hidden" id="gsname">
                                            <label for="guardianSuffixName"
                                                class="text-sm font-normal text-gray-900">Suffix Name:</label>
                                            <select id="guardianSuffixName" name="guardian_suffix_name"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer">
                                                <option value="">Select Suffix Name</option>
                                                <option value="Jr.">Jr.</option>
                                                <option value="Sr.">Sr.</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                            </select>
                                        </div>

                                        <!-- Guardian's Relationship -->
                                        <div class="mb-5 hidden" id="grelatioanship">
                                            <label for="guardianRelationship" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Relationship to
                                                Student:
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="guardianRelationship"
                                                    name="guardian_relationship"
                                                    placeholder="Select or type relationship"
                                                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                    oninput="filterRelationshipOptions()"
                                                    onclick="showGuardianRelationshipList()" required>

                                                <ul id="GuardinRelationshipList"
                                                    class="hidden absolute w-full bg-white border border-gray-300 mt-1 rounded shadow-lg max-h-60 overflow-y-auto z-10">
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectRelationshipGuardian('Uncle')">Uncle</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectRelationshipGuardian('Aunt')">Aunt</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectRelationshipGuardian('Grandfather')">
                                                        Grandfather
                                                    </li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectRelationshipGuardian('Grandmother')">
                                                        Grandmother
                                                    </li>
                                                </ul>
                                            </div>

                                            <small class="text-red-600 text-xs hidden"
                                                id="guardianRelationshipAlert">Guardian's Relationship is
                                                required</small>
                                        </div>

                                        <!-- Guardian's Contact Number -->
                                        <div class="mb-5 hidden" id="gnumber">
                                            <label for="guardianContactNumber"
                                                class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Contact Number:
                                            </label>
                                            <input type="tel" name="guardian_contact_number" id="guardianContactNumber"
                                                maxlength="11"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Guardian's Contact Number" required
                                                pattern="^09\d{9}$"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^(?!09).*/, '09');"
                                                value="09">
                                            <small class="text-red-600 text-xs hidden"
                                                id="guardianContactNumberAlert">Guardian's Contact Number is
                                                required</small>
                                        </div>

                                        <div class="mb-5 hidden" id="greligion">
                                            <label for="guardianReligion" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Religion
                                            </label>

                                            <!-- Custom dropdown with search -->
                                            <div class="relative">
                                                <input type="text" id="guardianReligion" name="guardian_religion"
                                                    placeholder="Select or type religion"
                                                    class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                    oninput="filterReligionOptions()"
                                                    onclick="showGuardianReligionList()" required>

                                                <ul id="guardianReligionList"
                                                    class="hidden absolute w-full bg-white border border-gray-300 mt-1 rounded shadow-lg max-h-60 overflow-y-auto z-10">
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Roman Catholicism')">Roman
                                                        Catholic
                                                    </li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Protestantism')">
                                                        Protestantism
                                                    </li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Islam')">Islam</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Iglesia ni Cristo')">
                                                        Iglesia ni
                                                        Cristo
                                                    </li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Hinduism')">Hinduism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Buddhism')">Buddhism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Indigenous Beliefs')">
                                                        Indigenous
                                                        Beliefs</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Atheism and Agnosticism')">
                                                        Atheism and
                                                        Agnosticism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Sikhism')">Sikhism</li>
                                                    <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                        onclick="selectReligionGuardian('Zoroastrianism')">
                                                        Zoroastrianism</li>
                                                </ul>
                                            </div>

                                            <small class="text-red-600 text-xs hidden"
                                                id="guardianReligionAlert">Religion is
                                                required</small>
                                        </div>

                                    </div>

                                    <div class="flex justify-end p-2">
                                        <button
                                            class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-normal rounded-md text-sm w-full sm:w-auto px-10 py-2 text-center"
                                            onclick="showNextStepGuardians()" type="button">Next</button>
                                    </div>

                                </div>
                            </li>

                            <script>
                                // Function to show the list when clicked
                                function showGuardianReligionList() {
                                    const listGuardian = document.getElementById('guardianReligionList');
                                    listGuardian.classList.remove('hidden');
                                }

                                // Function to show the list when clicked
                                function showGuardianRelationshipList() {
                                    const listGuardianRelation = document.getElementById('GuardinRelationshipList');
                                    listGuardianRelation.classList.remove('hidden');
                                }

                                // Function to select a religion option
                                function selectReligionGuardian(religion) {
                                    const inputGuardian = document.getElementById('guardianReligion');
                                    const listGuardian = document.getElementById('guardianReligionList');

                                    inputGuardian.value = religion;
                                    listGuardian.classList.add('hidden'); // Hide dropdown after selection

                                    // Optionally, validate religion
                                    validateReligionGuardian();
                                }

                                // Function to select a relationship option
                                function selectRelationshipGuardian(relation) {
                                    const inputGuardianRelation = document.getElementById('guardianRelationship');
                                    const listGuardianRelation = document.getElementById('GuardinRelationshipList');

                                    inputGuardianRelation.value = relation;
                                    listGuardianRelation.classList.add('hidden'); // Hide dropdown after selection

                                    // Optionally, validate relationship
                                    validateReligionGuardianRelation();
                                }

                                // Validation to check if a religion is selected
                                function validateReligionGuardian() {
                                    const religionInputGuardian = document.getElementById('guardianReligion');
                                    const religionAlertGuardian = document.getElementById('guardianReligionAlert');

                                    if (religionInputGuardian.value === "") {
                                        religionAlertGuardian.classList.remove('hidden');
                                    } else {
                                        religionAlertGuardian.classList.add('hidden');
                                    }
                                }

                                // Validation to check if a relationship is selected
                                function validateReligionGuardianRelation() {
                                    const religionInputGuardianRelation = document.getElementById('guardianRelationship');
                                    const religionAlertGuardianRelation = document.getElementById('guardianRelationshipAlert');

                                    if (religionInputGuardianRelation.value === "") {
                                        religionAlertGuardianRelation.classList.remove('hidden');
                                    } else {
                                        religionAlertGuardianRelation.classList.add('hidden');
                                    }
                                }

                                // Close the dropdown when clicked outside
                                document.addEventListener('click', function (event) {
                                    const list = document.getElementById('guardianReligionList');
                                    const input = document.getElementById('guardianReligion');
                                    const listGuardian = document.getElementById('GuardinRelationshipList');
                                    const inputGuardian = document.getElementById('guardianRelationship');

                                    if (!input.contains(event.target) && !list.contains(event.target)) {
                                        list.classList.add('hidden');
                                    }

                                    if (!inputGuardian.contains(event.target) && !listGuardian.contains(event.target)) {
                                        listGuardian.classList.add('hidden');
                                    }
                                });

                                function setGuardianInfo(type) {
                                    const motherFirstName = document.getElementById('motherFirstName').value;
                                    const motherLastName = document.getElementById('motherLastName').value;
                                    const motherMiddleName = document.getElementById('motherMiddleName').value; // Get mother's middle name

                                    const fatherFirstName = document.getElementById('fatherFirstName').value;
                                    const fatherLastName = document.getElementById('fatherLastName').value;
                                    const fatherMiddleName = document.getElementById('fatherMiddleName').value; // Get father's middle name
                                    const fatherSuffix = document.getElementById('fatherSuffixName').value;

                                    const guardianRelationship = document.getElementById('guardianRelationship');

                                    if (type === 'parent') {
                                        document.getElementById('guardianFirstName').value = "N/A";
                                        document.getElementById('guardianLastName').value = "N/A";
                                        document.getElementById('guardianMiddleName').value = "N/A"; // Set middle name
                                        document.getElementById('guardianSuffixName').value = ""; // Reset suffix when choosing mother
                                        document.getElementById('guardianRelationship').value = "N/A";
                                        document.getElementById('guardianReligion').value = "N/A";
                                        document.getElementById('guardianContactNumber').value = "09000000000";
                                        document.getElementById('gfname').classList.add('hidden');
                                        document.getElementById('glname').classList.add('hidden');
                                        document.getElementById('gmname').classList.add('hidden');
                                        document.getElementById('gsname').classList.add('hidden');
                                        document.getElementById('grelatioanship').classList.add('hidden');
                                        document.getElementById('gnumber').classList.add('hidden');
                                        document.getElementById('greligion').classList.add('hidden');
                                        document.getElementById('emergencyContactInfo').classList.add('hidden');
                                    } else if (type === 'other') {
                                        document.getElementById('gfname').classList.remove('hidden');
                                        document.getElementById('glname').classList.remove('hidden');
                                        document.getElementById('gmname').classList.remove('hidden');
                                        document.getElementById('gsname').classList.remove('hidden');
                                        document.getElementById('grelatioanship').classList.remove('hidden');
                                        document.getElementById('gnumber').classList.remove('hidden');
                                        document.getElementById('greligion').classList.remove('hidden');
                                        document.getElementById('guardianFirstName').value = "";
                                        document.getElementById('guardianLastName').value = "";
                                        document.getElementById('guardianMiddleName').value = ""; // Set middle name
                                        document.getElementById('guardianSuffixName').value = ""; // Reset suffix when choosing mother
                                        document.getElementById('guardianRelationship').value = "";
                                        document.getElementById('guardianReligion').value = "";
                                        document.getElementById('guardianContactNumber').value = "09";
                                        document.getElementById('emergencyContactInfo').classList.add('hidden');
                                    }
                                }

                                // Place this script at the beginning to ensure the function is defined before use.
                                function checkParentInfoValidityParents() {
                                    var isValidParent = true;

                                    const guardianSelectionAlert = document.getElementById('guardianSelectionAlert');
                                    const guardianRadioButtons = document.getElementsByName('guardianType');

                                    // Check if either 'Parent/Parents' or 'Other' radio button is selected
                                    let hasChecked = false;
                                    guardianRadioButtons.forEach(function (radioButton) {
                                        if (radioButton.checked) {
                                            hasChecked = true;
                                            if (radioButton.value === 'other') {
                                                isValidParent = false;
                                            }
                                        }
                                    });

                                    if (hasChecked) {
                                        guardianSelectionAlert.classList.add('hidden');
                                    } else {
                                        guardianSelectionAlert.classList.remove('hidden');
                                        isValidParent = false;
                                    }


                                    // Validate Father's Last Name
                                    var fatherLastNameInput = document.getElementById('fatherLastName');
                                    var fatherLastNameAlert = document.getElementById('fatherLastNameAlert');
                                    if (fatherLastNameInput.value === '') {
                                        fatherLastNameInput.classList.add('border-red-500');
                                        fatherLastNameAlert.classList.remove('hidden');
                                        isValidParent = false;
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
                                        isValidParent = false;
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
                                        isValidParent = false;
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
                                        isValidParent = false;
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
                                        isValidParent = false;
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
                                        isValidParent = false;
                                    } else {
                                        motherOccupationInput.classList.remove('border-red-500');
                                        motherOccupationAlert.classList.add('hidden');
                                    }

                                    // Validate Guardian's Last Name
                                    var guardianLastNameInput = document.getElementById('guardianLastName');
                                    var guardianLastNameAlert = document.getElementById('guardianLastNameAlert');
                                    if (guardianLastNameInput.value === '') {
                                        guardianLastNameInput.classList.add('border-red-500');
                                        guardianLastNameAlert.classList.remove('hidden');
                                        isValidParent = false;
                                    } else {
                                        guardianLastNameInput.classList.remove('border-red-500');
                                        guardianLastNameAlert.classList.add('hidden');
                                    }

                                    // Validate Guardian's First Name
                                    var guardianFirstNameInput = document.getElementById('guardianFirstName');
                                    var guardianFirstNameAlert = document.getElementById('guardianFirstNameAlert');
                                    if (guardianFirstNameInput.value === '') {
                                        guardianFirstNameInput.classList.add('border-red-500');
                                        guardianFirstNameAlert.classList.remove('hidden');
                                        isValidParent = false;
                                    } else if (guardianFirstNameInput.value === fatherFirstNameInput.value) {
                                        guardianFirstNameInput.classList.add('border-red-500');
                                        guardianFirstNameAlert.classList.remove('hidden');
                                        guardianFirstNameAlert.innerHTML = 'Guardian cannot be Father';
                                        isValidParent = false;
                                    } else if (guardianFirstNameInput.value === motherFirstNameInput.value) {
                                        guardianFirstNameInput.classList.add('border-red-500');
                                        guardianFirstNameAlert.classList.remove('hidden');
                                        guardianFirstNameAlert.innerHTML = 'Guardian cannot be Mother';
                                        isValidParent = false;
                                    } else {
                                        guardianFirstNameInput.classList.remove('border-red-500');
                                        guardianFirstNameAlert.classList.add('hidden');
                                    }

                                    // Validate Guardian's Relationship
                                    var guardianRelationshipInput = document.getElementById('guardianRelationship');
                                    var guardianRelationshipAlert = document.getElementById('guardianRelationshipAlert');
                                    if (guardianRelationshipInput.value === '') {
                                        guardianRelationshipInput.classList.add('border-red-500');
                                        guardianRelationshipAlert.classList.remove('hidden');
                                        isValidParent = false;
                                    } else {
                                        guardianRelationshipInput.classList.remove('border-red-500');
                                        guardianRelationshipAlert.classList.add('hidden');
                                    }

                                    // Validate Guardian's Contact Number
                                    var guardianContactNumberInput = document.getElementById('guardianContactNumber');
                                    var guardianContactNumberAlert = document.getElementById('guardianContactNumberAlert');
                                    if (guardianContactNumberInput.value === '') {
                                        guardianContactNumberInput.classList.add('border-red-500');
                                        guardianContactNumberAlert.classList.remove('hidden');
                                        isValidParent = false;
                                    } else if (guardianLastNameInput.value.toUpperCase() === 'N/A' || guardianLastNameInput.value.toUpperCase() === 'NA') {
                                        guardianContactNumberInput.classList.remove('border-red-500');
                                        guardianContactNumberAlert.classList.add('hidden');

                                        isValidParent = false;
                                    } else if (guardianContactNumberInput.value.length !== 11) {
                                        guardianContactNumberInput.classList.add('border-red-500');
                                        guardianContactNumberAlert.classList.remove('hidden');
                                        guardianContactNumberAlert.innerHTML = 'Contact number must be 11 digits';
                                        isValid = false;
                                    } else {
                                        guardianContactNumberInput.classList.remove('border-red-500');
                                        guardianContactNumberAlert.classList.add('hidden');
                                    }

                                    // Validate Guardian's Religion
                                    var guardianReligionInput = document.getElementById('guardianReligion');
                                    var guardianReligionAlert = document.getElementById('guardianReligionAlert');
                                    if (guardianReligionInput.value === '') {
                                        guardianReligionInput.classList.add('border-red-500');
                                        guardianReligionAlert.classList.remove('hidden');
                                        isValidParent = false;
                                    } else {
                                        guardianReligionInput.classList.remove('border-red-500');
                                        guardianReligionAlert.classList.add('hidden');
                                    }


                                    return isValidParent;
                                }

                                // This function is now defined before it is used
                                function showNextStepGuardians() {
                                    if (checkParentInfoValidityParents()) {
                                        // Show the guardian information section

                                        document.getElementById('emergencyContactInfo').classList.remove('hidden');
                                    }
                                }

                                // Event listeners for dynamic validation
                                const fieldParents = [
                                    { id: 'fatherLastName', alertId: 'fatherLastNameAlert' },
                                    { id: 'fatherFirstName', alertId: 'fatherFirstNameAlert' },
                                    { id: 'fatherOccupation', alertId: 'fatherOccupationAlert' },
                                    { id: 'motherLastName', alertId: 'motherLastNameAlert' },
                                    { id: 'motherFirstName', alertId: 'motherFirstNameAlert' },
                                    { id: 'motherOccupation', alertId: 'motherOccupationAlert' },
                                    { id: 'guardianLastName', alertId: 'guardianLastNameAlert' },
                                    { id: 'guardianFirstName', alertId: 'guardianFirstNameAlert' },
                                    { id: 'guardianRelationship', alertId: 'guardianRelationshipAlert' },
                                    { id: 'guardianContactNumber', alertId: 'guardianContactNumberAlert' },
                                    { id: 'guardianReligion', alertId: 'guardianReligionAlert' }
                                ];

                                fieldParents.forEach(field => {
                                    const element = document.getElementById(field.id);
                                    const alertElement = document.getElementById(field.alertId);

                                    element.addEventListener(element.tagName === 'SELECT' ? 'change' : 'input', function () {
                                        if (this.value) {
                                            alertElement.classList.add('hidden');
                                            this.classList.remove('border-red-500');
                                        }
                                        document.getElementById('emergencyContactInfo').classList.add('hidden');
                                    });
                                });
                            </script>

                            <div class="mt-5">
                                <span
                                    class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                    <i class="fa-solid fa-file text-teal-700"></i>
                                </span>
                                <h1 class="ml-5">Emergency Contact Information</h1>
                            </div>

                            <li class="mb-10 ms-2 hidden" id="emergencyContactInfo">
                                <div
                                    class="col-span-4 p-2 rounded-lg shadow-lg border my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                                    <div
                                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                        <!-- Emergency Contact Information -->
                                        <div
                                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                            <p class="text-[20px] font-normal"><i
                                                    class="fa-regular fa-address-card mr-2 mb-5"></i>
                                                Emergency Contact Information</p>
                                        </div>

                                        <div class="mb-5">
                                            <label for="emergencyContactPerson"
                                                class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Emergency Contact Person:
                                            </label>
                                            <input type="text" name="emergency_contact_person"
                                                id="emergencyContactPerson"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Emergency Contact Person" required>
                                            <small class="text-red-600 text-xs hidden"
                                                id="emergencyContactPersonAlert">Emergency contact person is
                                                required</small>
                                        </div>

                                        <div class="mb-5">
                                            <label for="emergencyContactNumber"
                                                class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Emergency Contact Number:
                                            </label>
                                            <input type="tel" name="emergency_contact_number"
                                                id="emergencyContactNumber" maxlength="11"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Emergency Contact Number" required
                                                pattern="^09\d{9}$"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^(?!09).*/, '09');"
                                                value="09">
                                            <small class="text-gray-500 text-xs">(e.g. Parents, guardian or personal
                                                number)</small><br />
                                            <small class="text-red-600 text-xs hidden"
                                                id="emergencyContactNumberAlert">Emergency contact number is
                                                required</small>
                                        </div>

                                        <div class="mb-5">
                                            <label for="emailAddress" class="text-sm font-normal text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Email Address:
                                            </label>
                                            <input type="email" name="email_address" id="emailAddress"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="Enter Email Address" required>
                                            <small class="text-red-600 text-xs hidden" id="emailAlertContact">Email
                                                is
                                                required</small>
                                        </div>

                                        <div class="mb-5">
                                            <label for="messengerAccount" class="text-sm font-normal text-gray-900">
                                                Messenger Account (optional):
                                            </label>
                                            <input type="text" name="messenger_account" id="messengerAccount"
                                                class="px-3 block py-2.5 w-full text-sm text-gray-900 bg-gray-100 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-teal-600 peer"
                                                placeholder="e.g., Facebook Messenger ID">
                                        </div>

                                    </div>

                                    <div class="flex justify-end p-2">
                                        <button
                                            class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-normal rounded-md text-sm w-full sm:w-auto px-10 py-2 text-center"
                                            onclick="showNextStepReview()" type="button">Next</button>
                                    </div>
                                </div>
                            </li>

                            <script>
                                function checkValidityReview() {
                                    var isValidReview = true;

                                    // Emergency Contact Person validation
                                    var emergencyContactPerson = document.getElementById('emergencyContactPerson');
                                    var emergencyContactPersonAlert = document.getElementById('emergencyContactPersonAlert');
                                    if (!emergencyContactPerson.value) {
                                        emergencyContactPerson.classList.add('border-red-500');
                                        emergencyContactPersonAlert.classList.remove('hidden');
                                        isValidReview = false;
                                    } else {
                                        emergencyContactPerson.classList.remove('border-red-500');
                                        emergencyContactPersonAlert.classList.add('hidden');
                                    }

                                    // Emergency Contact Number validation
                                    var emergencyContactNumber = document.getElementById('emergencyContactNumber');
                                    var emergencyContactNumberAlert = document.getElementById('emergencyContactNumberAlert');
                                    if (emergencyContactNumber.value === '') {
                                        emergencyContactNumberAlert.classList.remove('hidden');
                                        emergencyContactNumber.classList.add('border-red-500');
                                        isValidReview = false;
                                    } else if (emergencyContactNumber.value.length !== 11) {
                                        // If LRN is not exactly 12 digits, show 'LRN must be 12 digits' message
                                        emergencyContactNumber.classList.add('border-red-500');
                                        emergencyContactNumberAlert.classList.remove('hidden');
                                        emergencyContactNumberAlert.innerHTML = 'Contact Number must be 11 digits';
                                        isValidReview = false;
                                    } else {
                                        emergencyContactNumber.classList.remove('border-red-500');
                                        emergencyContactNumberAlert.classList.add('hidden');
                                    }

                                    // Email validation
                                    var emailAddress = document.getElementById('emailAddress');
                                    var emailAlertContact = document.getElementById('emailAlertContact');
                                    if (emailAddress.value === '') {
                                        emailAlertContact.classList.remove('hidden');
                                        emailAddress.classList.add('border-red-500');
                                        isValidReview = false;
                                    } else if (!emailAddress.value.endsWith('@gmail.com')) {
                                        emailAlertContact.classList.remove('hidden');
                                        emailAlertContact.innerText = 'Email must be @gmail.com';
                                        emailAddress.classList.add('border-red-500');
                                        isValidReview = false;
                                    } else {
                                        emailAddress.classList.remove('border-red-500');
                                        emailAlertContact.classList.add('hidden');
                                    }

                                    return isValidReview;
                                }

                                function showNextStepReview() {
                                    if (checkValidityReview()) {
                                        document.getElementById('reviewModal').classList.remove('hidden');

                                        // Function to populate the review modal with the form input values
                                        var admissionType = document.getElementById("status").value;

                                        console.log(admissionType);

                                        // Update the review modal with the values
                                        document.getElementById('reviewAdmissionType').innerText = document.getElementById("status").value;
                                        document.getElementById('reviewGrade').innerText = document.getElementById("grade").value;
                                        document.getElementById('reviewLRN').innerText = document.getElementById("lrn").value;
                                        document.getElementById('reviewLastName').innerText = document.getElementById("lastName").value;
                                        document.getElementById('reviewFirstName').innerText = document.getElementById("firstName").value;
                                        document.getElementById('reviewMiddleName').innerText = document.getElementById("middleName").value;
                                        document.getElementById('reviewSuffix').innerText = document.getElementById("suffixName").value;
                                        document.getElementById('reviewBirthplace').innerText = document.getElementById("birthplace").value;
                                        document.getElementById('reviewBirthDate').innerText = document.getElementById("birthDate").value;
                                        document.getElementById('reviewAge').innerText = document.getElementById("ageStudent").value;
                                        document.getElementById('reviewGender').innerText = document.getElementById("gender").value;
                                        document.getElementById('reviewEmailAddress').innerText = document.getElementById("email").value;
                                        document.getElementById('reviewContactNumber').innerText = document.getElementById("contactNo").value;
                                        document.getElementById('reviewReligion').innerText = document.getElementById("religion").value;
                                        document.getElementById('reviewRegion').innerText = document.getElementById("regionValue").value;
                                        document.getElementById('reviewProvince').innerText = document.getElementById("provinceValue").value;
                                        document.getElementById('reviewCity').innerText = document.getElementById("cityValue").value;
                                        document.getElementById('reviewBarangay').innerText = document.getElementById("barangayValue").value;
                                        document.getElementById('reviewStreet').innerText = document.getElementById("street").value;
                                        document.getElementById('reviewFatherLastName').innerText = document.getElementById("fatherLastName").value;
                                        document.getElementById('reviewFatherFirstName').innerText = document.getElementById("fatherFirstName").value;
                                        document.getElementById('reviewFatherMiddleName').innerText = document.getElementById("fatherMiddleName").value;
                                        document.getElementById('reviewFatherSuffix').innerText = document.getElementById("fatherSuffixName").value;
                                        document.getElementById('reviewFatherOccupation').innerText = document.getElementById("fatherOccupation").value;
                                        document.getElementById('reviewMotherLastName').innerText = document.getElementById("motherLastName").value;
                                        document.getElementById('reviewMotherFirstName').innerText = document.getElementById("motherFirstName").value;
                                        document.getElementById('reviewMotherMiddleName').innerText = document.getElementById("motherMiddleName").value;
                                        document.getElementById('reviewMotherOccupation').innerText = document.getElementById("motherOccupation").value;
                                        document.getElementById('reviewGuardianLastName').innerText = document.getElementById("guardianLastName").value;
                                        document.getElementById('reviewGuardianFirstName').innerText = document.getElementById("guardianFirstName").value;
                                        document.getElementById('reviewGuardianMiddleName').innerText = document.getElementById("guardianMiddleName").value;
                                        document.getElementById('reviewGuardianSuffix').innerText = document.getElementById("guardianSuffixName").value;
                                        document.getElementById('reviewGuardianRelationship').innerText = document.getElementById("guardianRelationship").value;
                                        document.getElementById('reviewGuardianContactNumber').innerText = document.getElementById("guardianContactNumber").value;
                                        document.getElementById('reviewGuardianReligion').innerText = document.getElementById("guardianReligion").value;
                                        document.getElementById('reviewEmergencyContactPerson').innerText = document.getElementById("emergencyContactPerson").value;
                                        document.getElementById('reviewEmergencyContactNumber').innerText = document.getElementById("emergencyContactNumber").value;
                                        document.getElementById('reviewEmergencyEmail').innerText = document.getElementById("emailAddress").value;
                                        document.getElementById('reviewMessengerAccount').innerText = document.getElementById("messengerAccount").value;

                                        // Add styling
                                        document.querySelectorAll('span').forEach(element => {
                                            element.classList.add('text-green-700');
                                            element.classList.add('font-semibold');
                                        });

                                    }
                                }

                                // Event listeners for input validation
                                document.getElementById('emergencyContactPerson').addEventListener('input', function () {
                                    if (this.value) {
                                        document.getElementById('emergencyContactPersonAlert').classList.add('hidden');
                                        this.classList.remove('border-red-500');
                                    }
                                });

                                document.getElementById('emergencyContactNumber').addEventListener('input', function () {
                                    if (this.value) {
                                        document.getElementById('emergencyContactNumberAlert').classList.add('hidden');
                                        this.classList.remove('border-red-500');
                                    }
                                });

                                document.getElementById('emailAddress').addEventListener('input', function () {
                                    if (this.value) {
                                        document.getElementById('emailAlertContact').classList.add('hidden');
                                        this.classList.remove('border-red-500');
                                    }
                                });
                            </script>
                            </li>
                        </ol>
                    </div>
                </div>

                <div id="reviewModal"
                    class="fixed hidden z-[100] top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 px-2 flex justify-center items-center p-5 lg:p-20">
                    <div class="bg-white rounded-md shadow-lg p-5 max-w-1xl mx-auto z-20">
                        <div class="flex justify-center items-center p-5 border-b border-gray-900">
                            <p class="text-2xl font-bold text-teal-800">Review Information</p>
                        </div>
                        <div
                            class="overflow-y-scroll h-[40vh] lg:h-[60vh] scrollbar-width-thin my-3 p-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">

                            <h3 class="font-semibold">Primary info</h3>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <h5>Admission type : <br /><span id="reviewAdmissionType"></span></h5>
                            <h5>Grade : <br /><span id="reviewGrade"></span></h5>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>

                            <h5 class="font-semibold mt-5">Basic Information</h5>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <h5>LRN: <br /><span id="reviewLRN"></span></h5>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <h5>Last Name: <br /><span id="reviewLastName"></span></h5>
                            <h5>First Name: <br /><span id="reviewFirstName"></span></h5>
                            <h5>Middle Name: <br /><span id="reviewMiddleName"></span></h5>
                            <h5>Suffix: <br /><span id="reviewSuffix"></span></h5>
                            <h5>Birthplace: <br /><span id="reviewBirthplace"></span></h5>
                            <h5>Birth Date: <br /><span id="reviewBirthDate"></span></h5>
                            <h5>Age: <br /><span id="reviewAge"></span></h5>
                            <h5>Gender: <br /><span id="reviewGender"></span></h5>
                            <h5>Email Address: <br /><span id="reviewEmailAddress"></span></h5>
                            <h5>Contact Number: <br /><span id="reviewContactNumber"></span></h5>
                            <h5>Religion: <br /><span id="reviewReligion"></span></h5>
                            <div class="hidden md:block lg:block"></div>
                            <h3 class="font-semibold mt-5">Permanent Address</h3>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <h5>Region: <br /><span id="reviewRegion"></span></h5>
                            <h5>province: <br /><span id="reviewProvince"></span></h5>
                            <h5>City: <br /><span id="reviewCity"></span></h5>
                            <h5>Barangay: <br /><span id="reviewBarangay"></span></h5>
                            <h5 class="col-sapn-1 md;col-span-2">Home/Building/Street:: <span id="reviewStreet"></span>
                            </h5>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>

                            <h5 class="font-semibold mt-5">Parents Information</h5>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <h5>Father's Last Name: <br /><span id="reviewFatherLastName"></span></h5>
                            <h5>Father's First Name: <br /><span id="reviewFatherFirstName"></span></h5>
                            <h5>Father's Middle Name: <br /><span id="reviewFatherMiddleName"></span></h5>
                            <h5>Father's Suffix: <br /><span id="reviewFatherSuffix"></span></h5>
                            <h5>Father's Employee Status: <br /><span id="reviewFatherOccupation"></span></h5>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <h5>Mother's Last Name: <br /><span id="reviewMotherLastName"></span></h5>
                            <h5>Mother's First Name: <br /><span id="reviewMotherFirstName"></span></h5>
                            <h5>Mother's Middle Name: <br /><span id="reviewMotherMiddleName"></span></h5>
                            <div class="hidden md:block lg:block"></div>
                            <h5>Mother's Employee Status: <br /><span id="reviewMotherOccupation"></span></h5>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>

                            <h3 class="font-semibold mt-5">Guardian Information</h3>
                            <div class="hidden md:block lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <h5>Guardian's Last Name: <br /><span id="reviewGuardianLastName"></span></h5>
                            <h5>Guardian's First Name: <br /><span id="reviewGuardianFirstName"></span></h5>
                            <h5>Guardian's Middle Name: <br /><span id="reviewGuardianMiddleName"></span></h5>
                            <h5>Guardian's Suffix: <br /><span id="reviewGuardianSuffix"></span></h5>
                            <h5>Guardian's Relationship: <br /><span id="reviewGuardianRelationship"></span></h5>
                            <h5>Guardian's Contact Number: <br /><span id="reviewGuardianContactNumber"></span></h5>
                            <h5>Guardian's Religion: <br /><span id="reviewGuardianReligion"></span></h5>
                            <div class="hidden lg:block"></div>

                            <h3 class="font-semibold mt-5 col-span-1 md:col-span-2">Emergency Contact Information
                            </h3>
                            <div class="hidden lg:block"></div>
                            <div class="hidden lg:block"></div>
                            <h5>Emergency Contact Person: <br /><span id="reviewEmergencyContactPerson"></span></h5>
                            <h5>Emergency Contact Number: <br /><span id="reviewEmergencyContactNumber"></span></h5>
                            <h5>Email Address: <br /><span id="reviewEmergencyEmail"></span></h5>
                            <h5>Messenger Account: <br /><span id="reviewMessengerAccount"></span></h5>

                        </div>
                        <div class="col-span-4 flex  justify-center lg:justify-start mt-5 lg:me-20" id="confirmation">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" id="confirmCheck" class="form-checkbox h-5 w-5 text-teal-600">
                                <p class="text-[14px]">I confirm that the information provided above is correct.</p>
                            </label>
                        </div>
                        <div class="flex justify-end items-center mt-5">
                            <button onclick="document.getElementById('reviewModal').classList.add('hidden')"
                                type="button" id="closeClose"
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded-sm transition-all duration-300">Close</button>
                            <button onclick="showNextStepReview()" id="submitButton" type="submit" disabled
                                class="ml-3 bg-gray-400 text-white font-semibold py-1 px-4 rounded-sm transition-all duration-300">Next</button>
                            <button type="button"
                                class="hidden w-80 flex justify-center items-center bg-teal-700 text-white font-semibold py-1 px-4 rounded-sm transition-all duration-300 ml-10"
                                id="processingButton" disabled>
                                <svg class="mr-3 size-5 animate-spin" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" />
                                </svg>
                                Processing…
                            </button>
                        </div>
                    </div>

                    <script>
                        // When the checkbox is checked, enable the submit button and update the button style
                        document.getElementById('confirmCheck').addEventListener('change', function () {
                            const submitButton = document.getElementById('submitButton');
                            if (this.checked) {
                                submitButton.disabled = false;
                                submitButton.classList.remove('bg-gray-400');
                                submitButton.classList.add('bg-teal-700');
                                submitButton.classList.add('hover:bg-teal-800');
                                submitButton.classList.remove('hover:bg-gray-400');
                            } else {
                                submitButton.disabled = true;
                                submitButton.classList.remove('bg-teal-700');
                                submitButton.classList.remove('hover:bg-teal-700');
                                submitButton.classList.add('bg-gray-400');
                                submitButton.classList.add('hover:bg-gray-400');
                            }
                        });

                        // When the form is submitted, show the processing button and hide the close and submit buttons
                        document.getElementById('submitButton').addEventListener('click', function () {
                            document.getElementById('closeClose').classList.add('hidden');
                            document.getElementById('submitButton').classList.add('hidden');
                            document.getElementById('processingButton').classList.remove('hidden');
                            document.getElementById('confirmation').classList.add('hidden');
                        });
                    </script>

                </div>
            </form>

            <!-- Drop Student Modal -->
            <div class="fixed inset-0 z-10 bg-black bg-opacity-50  p-5 flex items-center justify-center hidden"
                id="ageDropdown">
                <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto w-96">
                    <div class="flex items-center text-teal-800 text-lg font-semibold font-normal justify-center">
                        <span id="ageConfirmation" class="text-center"></span>
                    </div>
                    <div class="flex justify-end mt-10 text-sm">

                        <button type="button"
                            class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white ml-3"
                            onclick="document.getElementById('ageDropdown').classList.add('hidden')">
                            Okay
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Initialize the flatpickr
    flatpickr("#birthDate", {

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
            document.getElementById('ageConfirmation').innerText = "The minimum age allowed is 5.";
            document.getElementById('ageDropdown').classList.remove('hidden');
            ageInput.value = '';  // Clear age input if below minimum age
            birthDateInput.value = ''; // Clear birthdate input as well
        } else if (age > 16) {
            document.getElementById('ageConfirmation').innerText = "The maximum age allowed is 16.";
            document.getElementById('ageDropdown').classList.remove('hidden');
            ageInput.value = '';  // Clear age input if above maximum age
            birthDateInput.value = ''; // Clear birthdate input as well
        } else {
            ageInput.value = age;  // Set valid age in the age input field
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

<style>
    form input[type="text"] {
        text-transform: capitalize;
    }
</style>

</html>