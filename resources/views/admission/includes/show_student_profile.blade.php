<!-- Modal to display student details as a form -->
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
<!-- <div id="studentModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll"> -->
<div id="studentModal" class="relative hidden w-full min-h-screen bg-gray-100">
    <div class="relative">
        <div class="w-full h-full bg-white rounded-lg shadow p-5">
            <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
            <p class="text-2xl font-bold text-teal-900 ml-5">
                <span onclick="window.location.href ='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                    class="hover:text-teal-700">Student Management
            </p>

            <!-- <div class="flex items-center justify-start p-0 px-5 py-2 border-b bg-gray-200 rounded-lg mt-5">
                    <div class="p-5 mr-5 text-[12px] text-white shadow-lg bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full py-2 text-center"
                        onclick="window.location.href = '/StEmelieLearningCenter.HopeSci66/admin/student-management/AllStudentData'">
                        <i class="fas fa-arrow-left" style="color: white;"></i>
                    </div>
                </div> -->

            <div class="flex mt-5 text-[14px] w-full mt-5">
                <ul class="flex space-x-0 list-none m-0 bg-gray-50">
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 active1"
                        data-target="#Information"><span id="StudentName"></span> Information</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                        data-target="#documents">Documents</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
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
                        data-target="#gradeSix">Grades for Grade Six</li>
                </ul>
            </div>

            <!-- Student Details -->
            <div class="grid grid-cols-4 border-0 border-t-4 border-teal-800 h-full pt-5">
                <div class="col-span-1 bg-gray-100">
                    <!-- Profile Section -->
                    <div class="bg-gray-200 p-5">
                        <div class="flex justify-center ">
                            <div id="modalAvatar"
                                class="modal-avatar bg-gray-500 text-white flex items-center justify-center font-bold">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 2xl:grid-cols-2 gap-3 2xl:gap-5 mt-10 text-[13px] text-gray-900">
                            <div class="col-span-2">
                                <label for="modalLrn" class="block mb-2 text-[12px] font-bold text-gray-900">Learner
                                    Reference Number (LRN):</label>
                                <input type="text" name="status"
                                    class="input-field1 focus:outline-none focus:ring-none bg-gray-200 text-gray-900"
                                    name="lrn" id="modalLrn" value="" readonly>
                            </div>
                            <div>
                                <label for="modalStatus" class="block text-[12px] font-bold text-gray-900">
                                    Status :</label>
                                <input type="text" name="status"
                                    class="input-field1 focus:outline-none focus:ring-none font-bold bg-gray-200 text-green-500"
                                    id="modalStatus" value="" placeholder="" readonly>
                            </div>
                            <div>
                                <label for="modalStudentNumber" class="block text-[12px] font-bold text-gray-900">
                                    Student Number :</label>
                                <input type="text" name="studentNumber"
                                    class="input-field1 focus:outline-none border-hidden bg-gray-200 focus:ring-none"
                                    id="modalStudentNumber" value="" placeholder="" readonly>
                            </div>
                            <div class="2xl:col-span-2">
                                <label for="StudentName1" class="block text-[12px] font-bold text-gray-900">
                                    Name :</label>
                                <input type="text" name="StudentName"
                                    class="input-field1 focus:outline-none border-hidden bg-gray-200 focus:ring-none"
                                    id="StudentName1" value="" placeholder="" readonly>
                            </div>
                            <div class="2xl:col-span-2">
                                <label for="modalUsername" class="block text-[12px] font-bold text-gray-900">
                                    Username :</label>
                                <input type="text" name="username"
                                    class="input-field1 focus:outline-none border-hidden bg-gray-200 focus:ring-none"
                                    id="modalUsername" value="" placeholder="" readonly>
                            </div>
                            <div>
                                <label for="modalGrade" class="block text-[12px] font-bold text-gray-900">Grade:</label>
                                <input type="text" name="grade"
                                    class="input-field1 bg-gray-200 focus:outline-none focus:ring-none" id="modalGrade"
                                    value="" readonly>
                            </div>

                            <div>
                                <label for="modalSection"
                                    class="block text-[12px] font-bold text-gray-900">Section:</label>
                                <input type="text" name="section"
                                    class="input-field1 focus:outline-none focus:ring-none bg-gray-200"
                                    id="modalSection" value="" readonly>
                            </div>

                            <div>
                                <label for="modalPlaceOfBirth" class="block text-[12px] font-bold text-gray-900">Place
                                    of Birth:</label>
                                <input type="text" name="placeOfBirth"
                                    class="input-field1 focus:outline-none focus:ring-none bg-gray-200"
                                    id="modalPlaceOfBirth" value="" readonly>
                            </div>

                            <div>
                                <label for="modalBirthDate" class="block text-[12px] font-bold text-gray-900">Birth
                                    Date:</label>
                                <input type="date" name="birthDate"
                                    class="input-field1 focus:outline-none focus:ring-none bg-gray-200"
                                    id="modalBirthDate" value="" readonly>
                            </div>

                            <div>
                                <label for="modalAge" class="block text-[12px] font-bold text-gray-900">Age:</label>
                                <input type="number" name="age"
                                    class="input-field1 focus:outline-none bg-gray-200 focus:ring-none" id="modalAge"
                                    value="" readonly>
                            </div>

                            <div>
                                <label for="modalSex" class="block text-[12px] font-bold text-gray-900">Sex:</label>
                                <input type="text" name="sex"
                                    class="input-field1 focus:outline-none bg-gray-200 focus:ring-none" id="modalSex"
                                    value="" readonly>
                            </div>

                            <div class="2xl:col-span-2">
                                <label for="modalEmail" class="block text-[12px] font-bold text-gray-900">Email:</label>
                                <input type="email" name="email"
                                    class="input-field1 focus:outline-none bg-gray-200 focus:ring-none" id="modalEmail"
                                    value="" readonly>
                            </div>

                            <div>
                                <label for="modalContactNumber"
                                    class="block text-[12px] font-bold text-gray-900">Contact
                                    Number:</label>
                                <input type="text" name="contactNumber"
                                    class="input-field1 focus:outline-none focus:ring-none bg-gray-200"
                                    id="modalContactNumber" value="" readonly>
                            </div>

                            <div>
                                <label for="modalReligion"
                                    class="block text-[12px] font-bold text-gray-900">Religion:</label>
                                <input type="text" name="religion"
                                    class="input-field1 focus:outline-none focus:ring-none bg-gray-200"
                                    id="modalReligion" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 px-5">
                    <div class="col-span-3 my-5 flex justify-start">
                        <button id="btnPrint"
                            class="text-[12px] text-white shadow-lg bg-sky-700 rounded-lg shadow hover:bg-sky-600 px-3 mt-3"><i
                                class="fas fa-file-pdf mr-2"></i>Download Reports
                            Grade</button>
                    </div>
                    <!-- Scheduled Table -->
                    <div class="table-container mt-10 pb-10" id="Information" style="display:block;">
                        <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-5 text-[13px] text-gray-900">
                            <!-- <div class="col-span-2">
                                <label for="modalLrn" class="block mb-2 text-[12px] font-bold text-gray-900">Learner
                                    Reference Number (LRN):</label>
                                <input type="text" name="lrn" class="input-field focus:outline-none focus:ring-none"
                                    id="modalLrn" value="" readonly>
                            </div> -->

                            <div>
                                <label for="modalSchoolYear"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">School
                                    Year:</label>
                                <input type="text" name="schoolYear"
                                    class="input-field focus:outline-none focus:ring-none" id="modalSchoolYear" value=""
                                    readonly>
                            </div>

                            <div>
                                <label for="modalSchool"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">School:</label>
                                <input type="text" name="school" class="input-field focus:outline-none focus:ring-none"
                                    id="modalSchool" value="" readonly>
                            </div>

                            <div class="hidden">
                                <label for="modalLastName" class="block mb-2 text-[12px] font-bold text-gray-900">Last
                                    Name:</label>
                                <input type="hidden" name="lastname"
                                    class="input-field focus:outline-none focus:ring-none" id="modalLastName" value=""
                                    readonly>
                            </div>

                            <div class="hidden">
                                <label for="modalFirstName" class="block mb-2 text-[12px] font-bold text-gray-900">First
                                    Name:</label>
                                <input type="hidden" name="lastname"
                                    class="input-field focus:outline-none focus:ring-none" id="modalFirstName" value=""
                                    readonly>
                            </div>

                            <div class="hidden">
                                <label for="modalMiddleName"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Middle
                                    Name:</label>
                                <input type="hidden" name="lastname"
                                    class="input-field focus:outline-none focus:ring-none" id="modalMiddleName" value=""
                                    readonly>
                            </div>

                            <div class="hidden">
                                <label for="modalSuffixName"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Suffix
                                    Name:</label>
                                <input type="hidden" name="lastname"
                                    class="input-field focus:outline-none focus:ring-none" id="modalSuffixName" value=""
                                    readonly>
                            </div>

                            <div class="col-span-4">
                                <p class="text-[16px] font-bold">Address</p>
                            </div>
                            <div>
                                <label for="modalhouseNumber"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">House
                                    No.:</label>
                                <input type="text" name="address" class="input-field focus:outline-none focus:ring-none"
                                    id="modalhouseNumber" value="" readonly>
                            </div>

                            <div>
                                <label for="modalStreet"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Street:</label>
                                <input type="text" name="address" class="input-field focus:outline-none focus:ring-none"
                                    id="modalStreet" value="" readonly>
                            </div>

                            <div>
                                <label for="modalBarangay"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Barangay:</label>
                                <input type="text" name="address" class="input-field focus:outline-none focus:ring-none"
                                    id="modalBarangay" value="" readonly>
                            </div>

                            <div>
                                <label for="modalCity"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">City:</label>
                                <input type="text" name="address" class="input-field focus:outline-none focus:ring-none"
                                    id="modalCity" value="" readonly>
                            </div>

                            <div>
                                <label for="modalProvince"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Province:</label>
                                <input type="text" name="address" class="input-field focus:outline-none focus:ring-none"
                                    id="modalProvince" value="" readonly>
                            </div>

                            <div></div>
                            <div></div>
                            <div></div>

                            <!-- Father's Information -->
                            <div class="col-span-4">
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
                                    class="input-field focus:outline-none focus:ring-none" placeholder="Father's Suffix"
                                    readonly>
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
                            <div class="col-span-4">
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
                            <div class="col-span-4">
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
                                <input type="text" name="guardianRelationship" id="modalGuardianRelationship"
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
                            <div class="col-span-4">
                                <p class="text-[16px] font-bold">Emergency Information </p>
                            </div>
                            <div>
                                <label for="modalEmergencyContactPerson"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Emergency
                                    Contact Person:</label>
                                <input type="text" name="emergencyContactPerson" id="modalEmergencyContactPerson"
                                    class="input-field focus:outline-none focus:ring-none"
                                    placeholder="Emergency Contact Person" readonly>
                            </div>

                            <div>
                                <label for="modalEmergencyContactNumber"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Emergency
                                    Contact Number:</label>
                                <input type="text" name="emergencyContactNumber" id="modalEmergencyContactNumber"
                                    class="input-field focus:outline-none focus:ring-none"
                                    placeholder="Emergency Contact Number" readonly>
                            </div>

                            <!-- Contact Information -->
                            <div>
                                <label for="modalEmailAddress"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Email
                                    Address:</label>
                                <input type="email" name="emailAddress" id="modalEmailAddress"
                                    class="input-field focus:outline-none focus:ring-none" placeholder="Email Address"
                                    readonly>
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

                    <!-- documents -->
                    <div class="table-container" id="documents" style="display:none;">
                        <div class="col-span-4 mt-10">
                            <div class="col-span-2 mb-10 ">
                                <label for="modalBirthCertificate" class="block text-[12px] font-bold text-gray-900">
                                    Birth Certificate:
                                </label>
                                <div id="modalBirthCertificate"
                                    class="document-preview flex items-center justify-center">No Document Available
                                </div>
                            </div>

                            <div id="imageModal"
                                class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center z-10">
                                <div class="relative">
                                    <span id="closeModal"
                                        class="absolute top-0 right-0 text-white cursor-pointer text-2xl p-2">×</span>
                                    <img id="zoomedImage" class="max-w-full max-h-full" />
                                    <div class="flex items-center justify-center ">
                                        <button id="downloadButton"
                                            class="bg-sky-600 hover:bg-sky-700 text-white text-[14px] p-2 rounded w-full py-3 mt-5">Print</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label for="modalProofOfResidency"
                                    class="block mb-2 text-[12px] font-bold text-gray-900">Form 137 :</label>
                                <div id="modalProofOfResidency"
                                    class="document-preview flex items-center justify-center">No Document Available
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Unsheduled Table -->
                    <div class="table-container" id="gradeOne" style="display:none;">
                        <!-- First table (existing one) -->
                        <table class="table" id="tableGradeOne">
                            <thead class="bg-yellow-100 text-[12px]">
                                <tr>
                                    <th class="hidden">Student Number</th>
                                    <th class="export">Quarter</th>
                                    <th class="export">Reading and Literacy</th>
                                    <th class="export">Language</th>
                                    <th class="export">Mathematics</th>
                                    <th class="export">GMRC</th>
                                    <th class="export">Makabansa</th>
                                </tr>
                            </thead>
                            <tbody class="text-[12px]">
                                @foreach ($gradeOne as $gradeOneGrade)
                                                                @php
                                                                    $additionalInfo = $studentsAdditional[$student->student_number];
                                                                @endphp
                                                                <tr data-student-number="{{ $gradeOneGrade->student_number }}">
                                                                    <td class="hidden">{{ $gradeOneGrade->student_number }}</td>
                                                                    <td>{{ $gradeOneGrade->quarter }}</td>
                                                                    <td>{{ $gradeOneGrade->subject_one }}</td>
                                                                    <td>{{ $gradeOneGrade->subject_two }}</td>
                                                                    <td>{{ $gradeOneGrade->subject_three }}</td>
                                                                    <td>{{ $gradeOneGrade->subject_four }}</td>
                                                                    <td>{{ $gradeOneGrade->subject_five }}</td>
                                                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Buttons for View and Download -->
                        <button id="viewGradeBtn"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">View Grade</button>
                    </div>

                    <!-- Modal for Viewing Grades -->
                    <div id="gradeModal"
                        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden p-10">
                        <div class="bg-white p-6 rounded-lg w-[800px] h-[400px]">
                                <h2 class="text-2xl font-bold mb-4" id="studentFullname">
                                    {{ $student->student_last_name . ' ' . $student->student_first_name . ' ' . $student->student_middle_name}}
                                    Grades</h2>
                            <div id="modalContent">
                                <!-- Dynamic content will be inserted here -->
                            </div>
                            <button id="closeModalBtn"
                                class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Close</button>
                            <button id="downloadGradeButton"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Download
                                Grade</button>
                        </div>
                    </div>

                    <!-- Settled Table -->
                    <div class="table-container" id="gradeTwo" style="display:none;">
                        <div class="overflow-x-auto">
                            <!-- Grade Two -->
                            <div class="col-span-4 mt-10">
                                <table class="table table-bordeteal shadow-lg" id="tableGradeTwo">
                                    <thead class="bg-teal-200">
                                        <tr>
                                            <th>Student Number</th>
                                            <th>Quarter</th>
                                            <th>Subject 1</th>
                                            <th>Subject 2</th>
                                            <th>Subject 3</th>
                                            <th>Subject 4</th>
                                            <th>Subject 5</th>
                                            <th>Subject 6</th>
                                            <th>Subject 7</th>
                                            <th>Subject 8</th>
                                            <th>Subject 9</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gradeTwo as $gradeTwoGrade)
                                            <tr data-student-number="{{ $gradeTwoGrade->student_number }}">
                                                <td>{{ $gradeTwoGrade->student_number }}</td>
                                                <td>{{ $gradeTwoGrade->quarter }}</td>
                                                <td>{{ $gradeTwoGrade->subject_one }}</td>
                                                <td>{{ $gradeTwoGrade->subject_two }}</td>
                                                <td>{{ $gradeTwoGrade->subject_three }}</td>
                                                <td>{{ $gradeTwoGrade->subject_four }}</td>
                                                <td>{{ $gradeTwoGrade->subject_five }}</td>
                                                <td>{{ $gradeTwoGrade->subject_six }}</td>
                                                <td>{{ $gradeTwoGrade->subject_seven }}</td>
                                                <td>{{ $gradeTwoGrade->subject_eight }}</td>
                                                <td>{{ $gradeTwoGrade->subject_nine }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Unsheduled Table -->
                    <div class="table-container" id="gradeThree" style="display:none;">
                        <div class="overflow-x-auto">
                            <!-- Grade Three -->
                            <div class="col-span-4 mt-10">
                                <table class="table table-bordeteal shadow-lg" id="tableGradeThree">
                                    <thead class="bg-green-200">
                                        <tr>
                                            <th>Student Number</th>
                                            <th>Quarter</th>
                                            <th>Subject 1</th>
                                            <th>Subject 2</th>
                                            <th>Subject 3</th>
                                            <th>Subject 4</th>
                                            <th>Subject 5</th>
                                            <th>Subject 6</th>
                                            <th>Subject 7</th>
                                            <th>Subject 8</th>
                                            <th>Subject 9</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gradeThree as $gradeThreeGrade)
                                            <tr data-student-number="{{ $gradeThreeGrade->student_number }}">
                                                <td>{{ $gradeThreeGrade->student_number }}</td>
                                                <td>{{ $gradeThreeGrade->quarter }}</td>
                                                <td>{{ $gradeThreeGrade->subject_one }}</td>
                                                <td>{{ $gradeThreeGrade->subject_two }}</td>
                                                <td>{{ $gradeThreeGrade->subject_three }}</td>
                                                <td>{{ $gradeThreeGrade->subject_four }}</td>
                                                <td>{{ $gradeThreeGrade->subject_five }}</td>
                                                <td>{{ $gradeThreeGrade->subject_six }}</td>
                                                <td>{{ $gradeThreeGrade->subject_seven }}</td>
                                                <td>{{ $gradeThreeGrade->subject_eight }}</td>
                                                <td>{{ $gradeThreeGrade->subject_nine }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Settled Table -->
                    <div class="table-container" id="gradeFour" style="display:none;">
                        <div class="overflow-x-auto">
                            <div class="col-span-4 mt-10">
                                <table class="table table-bordeteal shadow-lg" id="tableGradeFour">
                                    <thead class="bg-sky-200">
                                        <tr>
                                            <th>Student Number</th>
                                            <th>Quarter</th>
                                            <th>Subject 1</th>
                                            <th>Subject 2</th>
                                            <th>Subject 3</th>
                                            <th>Subject 4</th>
                                            <th>Subject 5</th>
                                            <th>Subject 6</th>
                                            <th>Subject 7</th>
                                            <th>Subject 8</th>
                                            <th>Subject 9</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gradeFour as $gradeFourGrade)
                                            <tr data-student-number="{{ $gradeFourGrade->student_number }}">
                                                <td>{{ $gradeFourGrade->student_number }}</td>
                                                <td>{{ $gradeFourGrade->quarter }}</td>
                                                <td>{{ $gradeFourGrade->subject_one }}</td>
                                                <td>{{ $gradeFourGrade->subject_two }}</td>
                                                <td>{{ $gradeFourGrade->subject_three }}</td>
                                                <td>{{ $gradeFourGrade->subject_four }}</td>
                                                <td>{{ $gradeFourGrade->subject_five }}</td>
                                                <td>{{ $gradeFourGrade->subject_six }}</td>
                                                <td>{{ $gradeFourGrade->subject_seven }}</td>
                                                <td>{{ $gradeFourGrade->subject_eight }}</td>
                                                <td>{{ $gradeFourGrade->subject_nine }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Unsheduled Table -->
                    <div class="table-container" id="gradeFive" style="display:none;">
                        <div class="overflow-x-auto">
                            <div class="col-span-4 mt-10">
                                <table class="table table-bordeteal shadow-lg" id="tableGradeFive">
                                    <thead class="bg-cyan-200">
                                        <tr>
                                            <th>Student Number</th>
                                            <th>Quarter</th>
                                            <th>Subject 1</th>
                                            <th>Subject 2</th>
                                            <th>Subject 3</th>
                                            <th>Subject 4</th>
                                            <th>Subject 5</th>
                                            <th>Subject 6</th>
                                            <th>Subject 7</th>
                                            <th>Subject 8</th>
                                            <th>Subject 9</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gradeFive as $gradeFiveGrade)
                                            <tr data-student-number="{{ $gradeFiveGrade->student_number }}">
                                                <td>{{ $gradeFiveGrade->student_number }}</td>
                                                <td>{{ $gradeFiveGrade->quarter }}</td>
                                                <td>{{ $gradeFiveGrade->subject_one }}</td>
                                                <td>{{ $gradeFiveGrade->subject_two }}</td>
                                                <td>{{ $gradeFiveGrade->subject_three }}</td>
                                                <td>{{ $gradeFiveGrade->subject_four }}</td>
                                                <td>{{ $gradeFiveGrade->subject_five }}</td>
                                                <td>{{ $gradeFiveGrade->subject_six }}</td>
                                                <td>{{ $gradeFiveGrade->subject_seven }}</td>
                                                <td>{{ $gradeFiveGrade->subject_eight }}</td>
                                                <td>{{ $gradeFiveGrade->subject_nine }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Settled Table -->
                    <div class="table-container" id="gradeSix" style="display:none;">
                        <div class="overflow-x-auto">
                            <div class="col-span-4 mt-10">
                                <table class="table table-bordeteal shadow-lg" id="tableGradeSix">
                                    <thead class="bg-blue-200">
                                        <tr>
                                            <th>Student Number</th>
                                            <th>Quarter</th>
                                            <th>Subject 1</th>
                                            <th>Subject 2</th>
                                            <th>Subject 3</th>
                                            <th>Subject 4</th>
                                            <th>Subject 5</th>
                                            <th>Subject 6</th>
                                            <th>Subject 7</th>
                                            <th>Subject 8</th>
                                            <th>Subject 9</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gradeSix as $gradeSixGrade)
                                            <tr data-student-number="{{ $gradeSixGrade->student_number }}">
                                                <td>{{ $gradeSixGrade->student_number }}</td>
                                                <td>{{ $gradeSixGrade->quarter }}</td>
                                                <td>{{ $gradeSixGrade->subject_one }}</td>
                                                <td>{{ $gradeSixGrade->subject_two }}</td>
                                                <td>{{ $gradeSixGrade->subject_three }}</td>
                                                <td>{{ $gradeSixGrade->subject_four }}</td>
                                                <td>{{ $gradeSixGrade->subject_five }}</td>
                                                <td>{{ $gradeSixGrade->subject_six }}</td>
                                                <td>{{ $gradeSixGrade->subject_seven }}</td>
                                                <td>{{ $gradeSixGrade->subject_eight }}</td>
                                                <td>{{ $gradeSixGrade->subject_nine }}</td>
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