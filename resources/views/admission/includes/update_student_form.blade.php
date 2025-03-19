<!-- Update Student Modal -->
@foreach ($students as $student)
    <div id="updatetudentinfo{{ $student->id }}" tabindex="-1" aria-="true"
        class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll"
        style="scrollbar-width: none;">
        <div class="relative px-20 py-10 w-screen h-screen">
            <div class="w-full h-full bg-white rounded-lg shadow overflow-y-scroll">
                <div
                    class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg sticky top-0 z-[10]">
                    <h3 class="text-lg font-bold text-teal-800 uppercase"><i class="fa-solid fa-user mr-2"></i>
                        {{ old('lastName', $student->student_last_name) }},
                        {{ old('firstName', $student->student_first_name) }}
                        {{ old('suffixName', $student->student_suffix_name) }}
                        {{ old('middleName', $student->student_middle_name) }}
                        
                    </h3>
                    <button type="button"
                        class="text-white bg-teal-700 hover:bg-teal-800 p-3 py-2 rounded-full text-xl font-bold flex items-center justify-center shadow-lg"
                        aria-label="Close modal" id="updatetudentinfoClose{{ $student->id }}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div class="grid grid-cols-4 gap-4 mb-4 text-[13px] text-gray-900 p-5">
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

                                        <div class="mb-5 hidden">
                                            <label for="lrn" class="block mb-2 text-[12px] font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>LRN
                                                :</label>
                                            <input type="text" name="lrn" id="lrn"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Learner Reference Number (LRN)">

                                        </div>

                                        <div class="mb-5">
                                            <label for="schoolYear" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>School Year :
                                            </label>
                                            <input type="text" name="school_year" id="schoolYear" readonly
                                                value="{{ $student->school_year }}"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">

                                        </div>

                                        <div class="mb-5">
                                            <label for="status" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Admission Type :</label>
                                            <select name="status" id="status" required disabled
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                                <option value="" disabled selected>Select Admission Type</option>
                                                <option value="new regular" {{ $student->status == 'new regular' ? 'selected' : '' }}>New Regular</option>
                                                <option value="transferee" {{ $student->status == 'transferee' ? 'selected' : '' }}>Transferee</option>
                                            </select>
                                        </div>

                                        <div class="mb-5">
                                            <label for="grade" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Select Grade :
                                            </label>
                                            <select id="grade" name="grade" required disabled
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                                <option value="">Select Grade</option>
                                                <option value="Grade One" {{ $student->grade == 'Grade One' ? 'selected' : '' }}>Grade One</option>
                                                <option value="Grade Two" {{ $student->grade == 'Grade Two' ? 'selected' : '' }}>Grade Two</option>
                                                <option value="Grade Three" {{ $student->grade == 'Grade Three' ? 'selected' : '' }}>Grade Three</option>
                                                <option value="Grade Four" {{ $student->grade == 'Grade Four' ? 'selected' : '' }}>Grade Four</option>
                                                <option value="Grade Five" {{ $student->grade == 'Grade Five' ? 'selected' : '' }}>Grade Five</option>
                                                <option value="Grade Six" {{ $student->grade == 'Grade Six' ? 'selected' : '' }}>Grade Six</option>
                                            </select>
                                        </div>

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

                            <li class=" mb-10 ms-2">

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
                                                value="{{ $student->student_last_name }}"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Last Name" required readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="firstName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                    class="text-red-600 mr-1">*</span>First Name :</label>
                                            <input type="text" name="firstName" id="firstName"
                                                value="{{ $student->student_first_name }}"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter First Name" required readonly>
                                        </div class="mb-5">

                                        <div class="mb-5">
                                            <label for="middleName"
                                                class="block mb-2 text-sm font-bold text-gray-900">Middle
                                                Name
                                                :</label>
                                            <input type="text" name="middleName" id="middleName"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Middle Name" readonly
                                                value="{{ $student->student_middle_name }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="suffixName"
                                                class="block mb-2 text-sm font-bold text-gray-900">Suffix
                                                Name
                                                :</label>
                                            <select id="suffixName" name="suffixName" disabled
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                                <option value="">Select an option</option>
                                                <option value="Jr." {{ old('suffixName',$student->student_suffix_name == 'Jr.' ? 'selected' : '' )}}>Jr.</option>
                                                <option value="Sr." {{ old('suffixName',$student->student_suffix_name == 'Sr.' ? 'selected' : '' )}}>Sr.</option>
                                                <option value="II" {{ old('suffixName',$student->student_suffix_name == 'II' ? 'selected' : '' )}}>II</option>
                                                <option value="III" {{ old('suffixName',$student->student_suffix_name == 'III' ? 'selected' : '' )}}>III</option>
                                                <option value="IV" {{ old('suffixName',$student->student_suffix_name == 'IV' ? 'selected' : '' )}}>IV</option>
                                                <option value="V" {{ old('suffixName',$student->student_suffix_name == 'V' ? 'selected' : '' )}}>V</option>
                                            </select>
                                        </div>

                                        <div class="mb-5">
                                            <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                    class="text-red-600 mr-1">*</span>Birthplace :</label>
                                            <input type="text" name="birthplace" id="birthplace"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Birthplace" required
                                                value="{{ $student->place_of_birth }}" readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="birthDate" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Birth Date:
                                            </label>
                                            <input type="date" name="birthDate" id="birthDate" onchange="calculateAge()"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                required value="{{ $student->birth_date }}" readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="age" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Age:
                                            </label>
                                            <input type="number" name="age" id="age"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Age" min="0" required value="{{ $student->age }}"
                                                readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="gender" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                    class="text-red-600 mr-1">*</span>Gender : </label>
                                            <select name="gender" id="gender"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                required disabled>
                                                <option value="" disabled selected>Select Gender</option>
                                                <option value="Male" {{ $student->sex == 'Male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="Female" {{ $student->sex == 'Female' ? 'selected' : '' }}>
                                                    Female</option>
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
                                                title="Please enter a valid Gmail address."
                                                value="{{ $student->email_address_send }}" readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="contactNo" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Contact No. :
                                                <small>(Parents or
                                                    Student)</small>
                                            </label>
                                            <input type="tel" name="contactNo" id="contactNo"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Contact Number" required
                                                value="{{ $student->contact_number }}" readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="religion" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Religion :
                                            </label>
                                            <input type="text" name="religion" id="religion"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Religion" required value="{{ $student->religion }}"
                                                readonly>
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
                                                placeholder="Enter House No." required value="{{ $student->house_number }}"
                                                readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="street" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Street:
                                            </label>
                                            <input type="text" name="street" id="street"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Street" required value="{{ $student->street }}" readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="barangay" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Barangay:
                                            </label>
                                            <input type="text" name="barangay" id="barangay"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Barangay" required value="{{ $student->barangay }}"
                                                readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="city" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>City:
                                            </label>
                                            <input type="text" name="city" id="city"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter City" required value="{{ $student->city }}" readonly>
                                        </div>

                                        <div class="mb-5">
                                            <label for="province" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Province:
                                            </label>
                                            <input type="text" name="province" id="province"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Province" required value="{{ $student->province }}"
                                                readonly>
                                        </div>
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
                            <li class=" mb-10 ms-2">
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
                                                placeholder="Enter Father's Last Name" required readonly
                                                value="{{ $studentsAdditional[$student->id]->father_last_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="fatherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Father's First Name:
                                            </label>
                                            <input type="text" name="father_first_name" id="fatherFirstName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Father's First Name" required readonly
                                                value="{{ $studentsAdditional[$student->id]->father_first_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="fatherMiddleName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Father's Middle Name:
                                            </label>
                                            <input type="text" name="father_middle_name" id="fatherMiddleName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Father's Middle Name" readonly
                                                value="{{ $studentsAdditional[$student->id]->father_middle_name ?? '' }}">
                                        </div>

                                        <!-- Father's Suffix Selection -->
                                        <div class="mb-5">
                                            <label for="fatherSuffixName"
                                                class="block mb-2 text-sm font-bold text-gray-900"><span
                                                    class="text-red-600 mr-1">*</span>Father's Suffix Name:
                                            </label>
                                            <select name="father_suffix_name" id="fatherSuffixName"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                required disabled>
                                                <option value="" disabled selected>Select Suffix Name</option>
                                                <option value="Jr." {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->father_suffix_name == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                                <option value="Sr." {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->father_suffix_name == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                                <option value="II" {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->father_suffix_name == 'II' ? 'selected' : '' }}>II</option>
                                                <option value="III" {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->father_suffix_name == 'III' ? 'selected' : '' }}>III</option>
                                                <option value="IV" {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->father_suffix_name == 'IV' ? 'selected' : '' }}>IV</option>
                                                <option value="V" {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->father_suffix_name == 'V' ? 'selected' : '' }}>V</option>
                                            </select>
                                        </div>

                                        <div class="mb-5">
                                            <label for="fatherOccupation"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Father's Occupation:
                                            </label>
                                            <input type="text" name="father_occupation" id="fatherOccupation"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Father's Occupation" required readonly
                                                value="{{ $studentsAdditional[$student->id]->father_occupation ?? '' }}">
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
                                                placeholder="Enter Mother's Last Name" required readonly
                                                value="{{ $studentsAdditional[$student->id]->mother_last_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="motherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Mother's First Name:
                                            </label>
                                            <input type="text" name="mother_first_name" id="motherFirstName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Mother's First Name" required readonly
                                                value="{{ $studentsAdditional[$student->id]->mother_first_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="motherMiddleName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Mother's Middle Name:
                                            </label>
                                            <input type="text" name="mother_middle_name" id="motherMiddleName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Mother's Middle Name" readonly
                                                value="{{ $studentsAdditional[$student->id]->mother_middle_name ?? '' }}">
                                        </div><br class=" lg:block">

                                        <div class="mb-5">
                                            <label for="motherOccupation"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Mother's Occupation:
                                            </label>
                                            <input type="text" name="mother_occupation" id="motherOccupation"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Mother's Occupation" required readonly
                                                value="{{ $studentsAdditional[$student->id]->mother_occupation ?? '' }}">
                                        </div>
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
                            <li class=" mb-10 ms-2">
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

                                        <div class="mb-5">
                                            <label for="guardianLastName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Last Name:
                                            </label>
                                            <input type="text" name="guardian_last_name" id="guardianLastName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Last Name" required readonly
                                                value="{{ $studentsAdditional[$student->id]->guardian_last_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianFirstName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's First Name:
                                            </label>
                                            <input type="text" name="guardian_first_name" id="guardianFirstName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's First Name" required readonly
                                                value="{{ $studentsAdditional[$student->id]->guardian_first_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianMiddleName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Guardian's Middle Name:
                                            </label>
                                            <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Middle Name" readonly
                                                value="{{ $studentsAdditional[$student->id]->guardian_middle_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianSuffixName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Suffix Name:
                                            </label>
                                            <select id="guardianSuffixName" name="guardian_suffix_name"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                readonly disabled>
                                                <option value="">Select Suffix Name</option>
                                                <option value="Jr." {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->guardian_suffix_name == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                                <option value="Sr." {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->guardian_suffix_name == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                                <option value="II" {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->guardian_suffix_name == 'II' ? 'selected' : '' }}>II</option>
                                                <option value="III" {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->guardian_suffix_name == 'III' ? 'selected' : '' }}>III</option>
                                                <option value="IV" {{ isset($studentsAdditional[$student->id]) && $studentsAdditional[$student->id]->guardian_suffix_name == 'IV' ? 'selected' : '' }}>IV</option>
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
                                                placeholder="Enter Guardian's Relationship" required readonly
                                                value="{{ $studentsAdditional[$student->id]->guardian_relationship ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianContactNumber"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Contact Number:
                                            </label>
                                            <input type="text" name="guardian_contact_number" id="guardianContactNumber"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Contact Number" required readonly
                                                value="{{ $studentsAdditional[$student->id]->guardian_contact_number ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardian_religion"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Religion:
                                            </label>
                                            <input type="text" name="guardian_religion" id="guardian_religion"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Religion" required readonly
                                                value="{{ $studentsAdditional[$student->id]->guardian_religion ?? '' }}">
                                        </div>
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
                            <li class=" mb-10 ms-2">
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
                                                placeholder="Enter Emergency Contact Person" required readonly
                                                value="{{ $studentsAdditional[$student->id]->emergency_contact_person ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="emergencyContactNumber"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Emergency Contact Number:
                                            </label>
                                            <input type="text" name="emergency_contact_number" id="emergencyContactNumber"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Emergency Contact Number" required readonly
                                                value="{{ $studentsAdditional[$student->id]->emergency_contact_number ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="emailAddress" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Email Address:
                                            </label>
                                            <input type="email" name="email_address" id="emailAddress"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Email Address" required readonly
                                                value="{{ $studentsAdditional[$student->id]->email_address ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="messengerAccount"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Messenger Account (optional):
                                            </label>
                                            <input type="text" name="messenger_account" id="messengerAccount"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="e.g., Facebook Messenger ID" readonly
                                                value="{{ $studentsAdditional[$student->id]->messenger_account ?? '' }}">
                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ol>
                        <div class="col-span-4 flex justify-end mt-5">
                            <button type="button" onclick="printRegistrationForm()"
                                class="text-white w-96 text-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-bold rounded text-sm px-20 py-2.5 text-center">
                                <i class="fa-solid fa-print me-2"></i>Print Registration Form
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endforeach


