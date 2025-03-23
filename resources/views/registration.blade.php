@include("includes.header")
<div class="2xl:max-w-[1600px] w-full h-full overflow-hidden overflow-y-scroll bg-gray-100">
    <div class="p-0 lg:p-5">
        @if (session('success'))
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg p-5 max-w-sm">
                    <div class="flex items-center text-green-700 text-md font-bold">
                        <i class="fa-solid fa-check text-green-700 mr-2"></i>
                        <span>Registration Submitted Successfully!</span>
                    </div>
                    <hr class="border-1 border-teal-700 mt-5">
                    <div class="mt-5 text-sm">
                        <span class="text-justify">
                            Please proceed to the Admissions Office to claim three (3) copies of your registration form.
                            Next, submit them to the following offices:
                        </span>
                        <p class="font-semibold mt-3 pl-5">Next Steps:</p>
                        <ul class="list-disc pl-5 mt-2">
                            <li class="list-item">Registrar’s Office – Submit one copy along with the required documents.</li>
                            <li class="list-item">Accounting Office – Submit one copy for payment and financial processing.</li>
                            <li class="list-item">Student Copy – Keep one copy for your personal reference.</li>
                        </ul>
                        <span class="block mt-5 bg-gray-200 p-2">
                            <i class="fa-solid fa-circle-exclamation me-2 text-green-700 text-justify"></i><span
                                class="font-bold">Important:</span> Your registration will only be fully processed once
                            all required documents have been submitted.
                        </span>
                        <p class="font-semibold pl-5 mt-3">Required Documents to Submit to the Registrar:</p>
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
                    <div class="flex items-center text-red-700 text-md font-bold">
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
            <p class="text-[15px] md:text-[30px] lg:text-[40px] xl:text-[50px] font-bold text-teal-900">St. Emelie
                Learning Center</p>
        </div>

        <div class="flex justify-center items-center my-5">
            <p class="text-[15px] leading-[1.5rem] text-center md:text-[15px] lg:text-[20px] xl:text-[30px] font-bold text-teal-900">
                Registration <br /><span class="text-[15px]">For School Year {{ date('Y') }}-{{ date('Y') + 1 }}</span>
            </p>
        </div>

        <div class="bg-gray-100">
            <!-- Modal body -->
            <form class="p-5 lg:p-10 " onsubmit="return validateForm()" id="myform"
                action="{{ route('student.register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-4 gap-4 mb-4 text-[13px] text-gray-900 lh:hidden">
                    <ol class="col-span-4 relative border-s border-teal-800" id="steps">
                        <li class="mb-10 ms-2">
                            <span
                                class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                <i class="fa-solid fa-file text-teal-700"></i>
                            </span>
                            <h1 class="ml-5">Primary Information</h1>
                            <div
                                class=" col-span-4 p-2 rounded-lg shadow-lg border  my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i class="fas fa-user mr-2 mb-5"></i>
                                            Primary Information
                                        </p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="lrn" class="block mb-2 text-[12px] font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>LRN
                                            :</label>
                                        <input type="text" name="lrn" id="lrn" maxlength="12" inputmode="numeric"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Learner Reference Number (LRN)" onkeydown="return event.key != 'ArrowUp' && event.key != 'ArrowDown'">
                                        <div class="text-red-600 text-x hidden" id="alert">This field is required</div>
                                    </div>

                                    <div class="mb-5">
                                        <label for="schoolYear" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>School Year :
                                        </label>
                                        <input type="text" name="school_year" id="schoolYear" readonly
                                            value="{{ date('Y') }}-{{ date('Y') + 1}}"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                        <div class="text-red-600 text-xs hidden" id="alert">This field is required</div>
                                    </div>

                                    <div class="mb-5">
                                        <label for="status" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Admission Type :</label>
                                        <select name="status" id="status" required
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="" disabled selected>Select Admission Type</option>
                                            <option value="new regular">New Regular</option>
                                            <option value="transferee">Transferee</option>
                                        </select>
                                        <div class="text-red-600 text-xs hidden" id="alert">This field is required</div>
                                    </div>

                                    <div class="mb-5">
                                        <label for="grade" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Select Grade :
                                        </label>
                                        <select id="grade" name="grade" required
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select Grade</option>
                                            <option value="Grade One">Grade I</option>
                                            <option value="Grade Two">Grade II</option>
                                            <option value="Grade Three">Grade III</option>
                                            <option value="Grade Four">Grade IV</option>
                                            <option value="Grade Five">Grade V</option>
                                            <option value="Grade Six">Grade VI</option>
                                        </select>
                                        <div class="text-red-600 text-xs hidden" id="alert">This field is required</div>
                                    </div>

                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-bold rounded-lg text-sm w-full sm:w-auto px-10 py-2.5 text-center"
                                        onclick="showNextStep()" type="button">Next</button>
                                </div>
                            </div>
                        </li>
                        <div>
                            <span
                                class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                <i class="fa-solid fa-file text-teal-700"></i>
                            </span>
                            <h1 class="ml-5">Personal Information</h1>
                        </div>

                        <li class="hidden mb-10 ms-2">

                            <div
                                class=" col-span-4 p-2 rounded-lg shadow-lg border  my-5 bg-gradient-to-tr from-sky-50 via-white to-white">

                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <!-- Personal Information -->
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i class="fas fa-user mr-2 mb-5"></i>
                                            Personal Information
                                        </p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="lastName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Last Name :</label>
                                        <input type="text" name="lastName" id="lastName"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Last Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="firstName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>First Name :</label>
                                        <input type="text" name="firstName" id="firstName"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter First Name" required>
                                    </div class="mb-5">

                                    <div class="mb-5">
                                        <label for="middleName"
                                            class="block mb-2 text-sm font-bold text-gray-900">Middle
                                            Name
                                            :</label>
                                        <input type="text" name="middleName" id="middleName"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Middle Name" value="">
                                    </div>

                                    <div class="mb-5">
                                        <label for="suffixName"
                                            class="block mb-2 text-sm font-bold text-gray-900">Suffix
                                            Name
                                            :</label>
                                        <select id="suffixName" name="suffixName"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select an option</option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Birthplace :</label>
                                        <input type="text" name="birthplace" id="birthplace"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Birthplace" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="birthDate" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Birth Date:
                                        </label>
                                        <input type="date" name="birthDate" id="birthDate" onchange="calculateAge()"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="age" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Age:
                                        </label>
                                        <input type="number" name="age" id="age"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Age" min="0" required readonly>
                                    </div>

                                    <div class="mb-5">
                                        <label for="gender" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Gender : </label>
                                        <select name="gender" id="gender"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            required>
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Email: <small>(Parents or
                                                Student
                                                Email)</small>
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Ex. StEmilieLearningCenter@gmail.com" required
                                            pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                            title="Please enter a valid Gmail address.">
                                    </div>

                                    <div class="mb-5">
                                        <label for="contactNo" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Contact No. :
                                            <small>(Parents or
                                                Student)</small>
                                        </label>
                                        <input type="tel" name="contactNo" id="contactNo"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Contact Number" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="religion" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Religion :
                                        </label>
                                        <input type="text" name="religion" id="religion"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Religion" required>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="col-span-4 p-5 rounded-lg shadow-lg border  my-5 bg-gradient-to-tr from-sky-50 via-white to-white mb-5">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <!-- Personal Information -->
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i
                                                class="fa-solid fa-map-location-dot mr-2 mb-5"></i>
                                            Permanent Address
                                        </p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="houseNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>House Number:
                                        </label>
                                        <input type="text" name="house_number" id="houseNumber"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter House No." required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="street" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Street:
                                        </label>
                                        <input type="text" name="street" id="street"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Street" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="barangay" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Barangay:
                                        </label>
                                        <input type="text" name="barangay" id="barangay"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Barangay" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="city" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>City:
                                        </label>
                                        <input type="text" name="city" id="city"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter City" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="province" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Province:
                                        </label>
                                        <input type="text" name="province" id="province"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Province" required>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-bold rounded-lg text-sm w-full sm:w-auto px-10 py-2.5 text-center"
                                        onclick="showNextStep()" type="button">Next</button>
                                </div>
                            </div>
                        </li>

                        <div class="mt-5">
                            <span
                                class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                <i class="fa-solid fa-file text-teal-700"></i>
                            </span>
                            <h1 class="ml-5">Parents Information</h1>
                        </div>
                        <li class="hidden mb-10 ms-2">
                            <div
                                class=" col-span-4 p-2 rounded-lg shadow-lg border  my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <!-- Personal Information -->
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i class="fas fa-address-card mr-2 mb-5"></i>
                                            Parents
                                            Information </p>
                                    </div>

                                    <!-- Father's Information -->
                                    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                        <p class="mt-2 text-lg font-bold">Father Information :</p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="fatherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Father's Last Name:
                                        </label>
                                        <input type="text" name="father_last_name" id="fatherLastName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Father's Last Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="fatherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Father's First Name:
                                        </label>
                                        <input type="text" name="father_first_name" id="fatherFirstName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Father's First Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="fatherMiddleName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            Father's Middle Name:
                                        </label>
                                        <input type="text" name="father_middle_name" id="fatherMiddleName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Father's Middle Name">
                                    </div>

                                    <!-- Father's Suffix Selection -->
                                    <div class="mb-5">
                                        <label for="fatherSuffixName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            Father's Suffix Name:
                                        </label>
                                        <select id="fatherSuffixName" name="father_suffix_name"
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
                                        <label for="fatherOccupation"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Father's Occupation:
                                        </label>
                                        <input type="text" name="father_occupation" id="fatherOccupation"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Father's Occupation" required>
                                    </div>


                                    <!-- Mother's Information -->
                                    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                        <p class="mt-5 text-lg font-bold">Mother Information:</p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="motherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Mother's Last Name:
                                        </label>
                                        <input type="text" name="mother_last_name" id="motherLastName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Mother's Last Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="motherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Mother's First Name:
                                        </label>
                                        <input type="text" name="mother_first_name" id="motherFirstName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Mother's First Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="motherMiddleName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            Mother's Middle Name:
                                        </label>
                                        <input type="text" name="mother_middle_name" id="motherMiddleName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Mother's Middle Name">
                                    </div><br class="hidden lg:block">

                                    <div class="mb-5">
                                        <label for="motherOccupation"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Mother's Occupation:
                                        </label>
                                        <input type="text" name="mother_occupation" id="motherOccupation"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Mother's Occupation" required>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-bold rounded-lg text-sm w-full sm:w-auto px-10 py-2.5 text-center"
                                        onclick="showNextStep()" type="button">Next</button>
                                </div>
                            </div>
                        </li>

                        <div class="mt-5">
                            <span
                                class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -start-3 ring-8 ring-white">
                                <i class="fa-solid fa-file text-teal-700"></i>
                            </span>
                            <h1 class="ml-5">Guardian Information</h1>
                        </div>
                        <li class="hidden mb-10 ms-2">
                            <div
                                class="col-span-4 p-2 rounded-lg shadow-lg border  my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <!-- Personal Information -->
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i class="fas fa-address-card mr-2 mb-5"></i>
                                            Guardian Information
                                        </p>
                                    </div>

                                    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                        <label class="block mb-2 text-sm font-bold text-gray-900">Guardian
                                            Type:</label>
                                        <div class="flex items-center mb-4">
                                            <input type="radio" id="guardianMother" name="guardianType" value="mother"
                                                class="mr-2" onclick="setGuardianInfo('mother')">
                                            <label for="guardianMother"
                                                class="mr-4 text-sm font-medium text-gray-900">Mother</label>

                                            <input type="radio" id="guardianFather" name="guardianType" value="father"
                                                class="mr-2" onclick="setGuardianInfo('father')">
                                            <label for="guardianFather"
                                                class="text-sm font-medium text-gray-900">Father</label>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <label for="guardianLastName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Guardian's Last Name:
                                        </label>
                                        <input type="text" name="guardian_last_name" id="guardianLastName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Guardian's Last Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="guardianFirstName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Guardian's First Name:
                                        </label>
                                        <input type="text" name="guardian_first_name" id="guardianFirstName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Guardian's First Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="guardianMiddleName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            Guardian's Middle Name:
                                        </label>
                                        <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Guardian's Middle Name">
                                    </div>

                                    <div class="mb-5">
                                        <label for="guardianSuffixName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
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
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Guardian's Relationship to
                                            Student:
                                        </label>
                                        <input type="text" name="guardian_relationship" id="guardianRelationship"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Guardian's Relationship" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="guardianContactNumber"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Guardian's Contact Number:
                                        </label>
                                        <input type="text" name="guardian_contact_number" id="guardianContactNumber"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Guardian's Contact Number" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="guardian_religion"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Religion:
                                        </label>
                                        <input type="text" name="guardian_religion" id="guardian_religion"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Guardian's Religion" required>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        class="bg-teal-700 text-white hover:bg-teal-800 hover:text-white font-bold rounded-lg text-sm w-full sm:w-auto px-10 py-2.5 text-center"
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
                                        <p class="text-[20px] font-bold"><i
                                                class="fa-regular fa-address-card mr-2 mb-5"></i>
                                            Emergency Contact Information </p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="emergencyContactPerson"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Emergency Contact Person:
                                        </label>
                                        <input type="text" name="emergency_contact_person" id="emergencyContactPerson"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Emergency Contact Person" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="emergencyContactNumber"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Emergency Contact Number:
                                        </label>
                                        <input type="text" name="emergency_contact_number" id="emergencyContactNumber"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Emergency Contact Number" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="emailAddress" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Email Address:
                                        </label>
                                        <input type="email" name="email_address" id="emailAddress"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Email Address" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="messengerAccount"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            Messenger Account (optional):
                                        </label>
                                        <input type="text" name="messenger_account" id="messengerAccount"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="e.g., Facebook Messenger ID">
                                    </div>

                                </div>
                                <div class="col-span-4 flex justify-center mt-10">
                                    <label class="flex items-center space-x-2 text-center">
                                        <span class="text-gray-600 font-semibold text-lg">Double check your information
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
                                        class="text-white w-96 text-center bg-gray-400 focus:ring-4 focus:outline-none focus:ring-teal-300 font-bold rounded text-sm px-20 py-2.5 text-center">
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
            </form>
        </div>
    </div>
</div>


<script>
    let step = 0;  // Start from step 0 since the first step is visible
    const steps = document.querySelectorAll('#steps li');
    const nextButton = document.querySelectorAll('button');

    function showNextStep(event) {
        const currentStep = steps[step];  // Get the current step
        const inputs = currentStep.querySelectorAll('input, select'); // Select all input and select elements
        let allFilled = true; // Flag to track if all fields are filled

        // Loop through all inputs and check if they are empty
        inputs.forEach(input => {
            if (input.value === '' && !input.hasAttribute('required')) {
                // Skip required validation for optional fields (middleName and suffixName)
                return;
            }

            if (input.value === null || input.value === '') {
                allFilled = false;
                input.classList.add('border-red-500');  // Add red border if empty
            } else {
                input.classList.remove('border-red-500');  // Remove red border if filled
            }
        });

        if (allFilled) {
            // If all fields are filled, proceed to the next step
            if (step + 1 < steps.length) {
                step++;  // Increment the step
                steps[step].classList.remove('hidden');  // Show the next step
                event.target.classList.add('hidden');  // Hide the next button of the previous step
            }
        }
    }

    // Add event listeners to each "Next" button to trigger the showNextStep function
    nextButton.forEach(button => {
        button.addEventListener('click', showNextStep);
    });

    function calculateAge() {
        const birthDateInput = document.getElementById('birthDate');
        const ageInput = document.getElementById('age');
        const birthDate = new Date(birthDateInput.value);
        const today = new Date();

        if (birthDate) {
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            ageInput.value = age;
        } else {
            ageInput.value = '';
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