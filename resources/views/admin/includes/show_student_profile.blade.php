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
</style>
<div id="studentModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll">
    <div class="relative px-20 py-10 w-screen h-screen">
        <div class="w-full h-full bg-white rounded-lg shadow overflow-y-scroll">
            <div class="flex items-center justify-between p-5 px-10 border-b bg-gray-200 rounded-lg">
                <h3 class="text-lg font-bold text-teal-800 uppercase"><i class="fa-solid fa-user mr-2"></i><span
                        id="StudentName"></span> Information</h3>
                <button type="button"
                    class="text-teal-800 hover:bg-gray-100 hover:text-teal-700 p-3 py-2 rounded-full bg-white text-xl font-bold flex items-center justify-center shadow-lg"
                    aria-label="Close modal" id="closeModal" onclick="closeStudentModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Student Details -->
            <div class="grid grid-cols-4">
                <div class="col-span-1 p-5 bg-gray-100">
                    <!-- Profile Section -->
                    <div class="mt-5 bg-white shadow-lg p-5 rounded-lg">
                        <div class="flex justify-center ">
                            <div id="modalAvatar"
                                class="modal-avatar bg-gray-500 text-white flex items-center justify-center font-bold">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 2xl:grid-cols-2 gap-3 2xl:gap-5 mt-10 text-[13px] text-gray-900">
                            <div>
                                <label for="modalStatus" class="block text-[12px] font-bold text-gray-900">
                                    Status :</label>
                                <input type="text" name="status"
                                    class="input-field1 focus:outline-none focus:ring-none font-bold text-green-500"
                                    id="modalStatus" value="" placeholder="" readonly>
                            </div>
                            <div>
                                <label for="modalStudentNumber" class="block text-[12px] font-bold text-gray-900">
                                    Student Number :</label>
                                <input type="text" name="studentNumber"
                                    class="input-field1 focus:outline-none border-hidden focus:ring-none"
                                    id="modalStudentNumber" value="" placeholder="" readonly>
                            </div>
                            <div class="2xl:col-span-2">
                                <label for="StudentName1" class="block text-[12px] font-bold text-gray-900">
                                    Name :</label>
                                <input type="text" name="StudentName"
                                    class="input-field1 focus:outline-none border-hidden focus:ring-none"
                                    id="StudentName1" value="" placeholder="" readonly>
                            </div>
                            <div class="2xl:col-span-2">
                                <label for="modalUsername" class="block text-[12px] font-bold text-gray-900">
                                    Username :</label>
                                <input type="text" name="username"
                                    class="input-field1 focus:outline-none border-hidden focus:ring-none"
                                    id="modalUsername" value="" placeholder="" readonly>
                            </div>
                            <div>
                                <label for="modalGrade" class="block text-[12px] font-bold text-gray-900">Grade:</label>
                                <input type="text" name="grade" class="input-field1 focus:outline-none focus:ring-none"
                                    id="modalGrade" value="" readonly>
                            </div>

                            <div>
                                <label for="modalSection"
                                    class="block text-[12px] font-bold text-gray-900">Section:</label>
                                <input type="text" name="section"
                                    class="input-field1 focus:outline-none focus:ring-none" id="modalSection" value=""
                                    readonly>
                            </div>

                            <div>
                                <label for="modalPlaceOfBirth" class="block text-[12px] font-bold text-gray-900">Place
                                    of Birth:</label>
                                <input type="text" name="placeOfBirth"
                                    class="input-field1 focus:outline-none focus:ring-none" id="modalPlaceOfBirth"
                                    value="" readonly>
                            </div>

                            <div>
                                <label for="modalBirthDate" class="block text-[12px] font-bold text-gray-900">Birth
                                    Date:</label>
                                <input type="date" name="birthDate"
                                    class="input-field1 focus:outline-none focus:ring-none" id="modalBirthDate" value=""
                                    readonly>
                            </div>

                            <div>
                                <label for="modalAge" class="block text-[12px] font-bold text-gray-900">Age:</label>
                                <input type="number" name="age" class="input-field1 focus:outline-none focus:ring-none"
                                    id="modalAge" value="" readonly>
                            </div>

                            <div>
                                <label for="modalSex" class="block text-[12px] font-bold text-gray-900">Sex:</label>
                                <input type="text" name="sex" class="input-field1 focus:outline-none focus:ring-none"
                                    id="modalSex" value="" readonly>
                            </div>

                            <div class="2xl:col-span-2">
                                <label for="modalEmail" class="block text-[12px] font-bold text-gray-900">Email:</label>
                                <input type="email" name="email" class="input-field1 focus:outline-none focus:ring-none"
                                    id="modalEmail" value="" readonly>
                            </div>

                            <div>
                                <label for="modalContactNumber"
                                    class="block text-[12px] font-bold text-gray-900">Contact
                                    Number:</label>
                                <input type="text" name="contactNumber"
                                    class="input-field1 focus:outline-none focus:ring-none" id="modalContactNumber"
                                    value="" readonly>
                            </div>

                            <div>
                                <label for="modalReligion"
                                    class="block text-[12px] font-bold text-gray-900">Religion:</label>
                                <input type="text" name="religion"
                                    class="input-field1 focus:outline-none focus:ring-none" id="modalReligion" value=""
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 p-20">
                    <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-5 text-[13px] text-gray-900">
                        <div class="col-span-2">
                            <label for="modalLrn" class="block mb-2 text-[12px] font-bold text-gray-900">Learner
                                Reference Number (LRN):</label>
                            <input type="text" name="lrn" class="input-field focus:outline-none focus:ring-none"
                                id="modalLrn" value="" readonly>
                        </div>

                        <div>
                            <label for="modalSchoolYear" class="block mb-2 text-[12px] font-bold text-gray-900">School
                                Year:</label>
                            <input type="text" name="schoolYear" class="input-field focus:outline-none focus:ring-none"
                                id="modalSchoolYear" value="" readonly>
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
                            <input type="hidden" name="lastname" class="input-field focus:outline-none focus:ring-none"
                                id="modalLastName" value="" readonly>
                        </div>

                        <div class="hidden">
                            <label for="modalFirstName" class="block mb-2 text-[12px] font-bold text-gray-900">First
                                Name:</label>
                            <input type="hidden" name="lastname" class="input-field focus:outline-none focus:ring-none"
                                id="modalFirstName" value="" readonly>
                        </div>

                        <div class="hidden">
                            <label for="modalMiddleName" class="block mb-2 text-[12px] font-bold text-gray-900">Middle
                                Name:</label>
                            <input type="hidden" name="lastname" class="input-field focus:outline-none focus:ring-none"
                                id="modalMiddleName" value="" readonly>
                        </div>

                        <div class="hidden">
                            <label for="modalSuffixName" class="block mb-2 text-[12px] font-bold text-gray-900">Suffix
                                Name:</label>
                            <input type="hidden" name="lastname" class="input-field focus:outline-none focus:ring-none"
                                id="modalSuffixName" value="" readonly>
                        </div>

                        <div class="col-span-4">
                            <p class="text-[16px] font-bold">Address</p>
                        </div>
                        <div>
                            <label for="modalhouseNumber" class="block mb-2 text-[12px] font-bold text-gray-900">House
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
                            <label for="modalCity" class="block mb-2 text-[12px] font-bold text-gray-900">City:</label>
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
                                class="input-field focus:outline-none focus:ring-none" placeholder="Father's Last Name"
                                readonly>
                        </div>

                        <div>
                            <label for="modalFatherFirstName"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Father's First Name:</label>
                            <input type="text" name="fatherFirstName" id="modalFatherFirstName"
                                class="input-field focus:outline-none focus:ring-none" placeholder="Father's First Name"
                                readonly>
                        </div>

                        <div>
                            <label for="modalFatherMiddleName"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Father's Middle Name:</label>
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
                                class="block mb-2 text-[12px] font-bold text-gray-900">Father's Occupation:</label>
                            <input type="text" name="fatherOccupation" id="modalFatherOccupation"
                                class="input-field focus:outline-none focus:ring-none" placeholder="Father's Occupation"
                                readonly>
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
                                class="input-field focus:outline-none focus:ring-none" placeholder="Mother's Last Name"
                                readonly>
                        </div>

                        <div>
                            <label for="modalMotherFirstName"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Mother's First Name:</label>
                            <input type="text" name="motherFirstName" id="modalMotherFirstName"
                                class="input-field focus:outline-none focus:ring-none" placeholder="Mother's First Name"
                                readonly>
                        </div>

                        <div>
                            <label for="modalMotherMiddleName"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Mother's Middle Name:</label>
                            <input type="text" name="motherMiddleName" id="modalMotherMiddleName"
                                class="input-field focus:outline-none focus:ring-none"
                                placeholder="Mother's Middle Name" readonly>
                        </div>

                        <div></div>

                        <div>
                            <label for="modalMotherOccupation"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Mother's Occupation:</label>
                            <input type="text" name="motherOccupation" id="modalMotherOccupation"
                                class="input-field focus:outline-none focus:ring-none" placeholder="Mother's Occupation"
                                readonly>
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
                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's Last Name:</label>
                            <input type="text" name="guardianLastName" id="modalGuardianLastName"
                                class="input-field focus:outline-none focus:ring-none"
                                placeholder="Guardian's Last Name" readonly>
                        </div>

                        <div>
                            <label for="modalGuardianFirstName"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's First Name:</label>
                            <input type="text" name="guardianFirstName" id="modalGuardianFirstName"
                                class="input-field focus:outline-none focus:ring-none"
                                placeholder="Guardian's First Name" readonly>
                        </div>

                        <div>
                            <label for="modalGuardianMiddleName"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's Middle Name:</label>
                            <input type="text" name="guardianMiddleName" id="modalGuardianMiddleName"
                                class="input-field focus:outline-none focus:ring-none"
                                placeholder="Guardian's Middle Name" readonly>
                        </div>

                        <div>
                            <label for="modalGuardianSuffix"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's Suffix (if
                                any):</label>
                            <input type="text" name="guardianSuffix" id="modalGuardianSuffix"
                                class="input-field focus:outline-none focus:ring-none" placeholder="Guardian's Suffix"
                                readonly>
                        </div>

                        <div>
                            <label for="modalGuardianRelationship"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's Relationship:</label>
                            <input type="text" name="guardianRelationship" id="modalGuardianRelationship"
                                class="input-field focus:outline-none focus:ring-none"
                                placeholder="Guardian's Relationship" readonly>
                        </div>

                        <div>
                            <label for="modalGuardianContact"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Guardian's Contact
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
                                class="block mb-2 text-[12px] font-bold text-gray-900">Emergency Contact Person:</label>
                            <input type="text" name="emergencyContactPerson" id="modalEmergencyContactPerson"
                                class="input-field focus:outline-none focus:ring-none"
                                placeholder="Emergency Contact Person" readonly>
                        </div>

                        <div>
                            <label for="modalEmergencyContactNumber"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Emergency Contact Number:</label>
                            <input type="text" name="emergencyContactNumber" id="modalEmergencyContactNumber"
                                class="input-field focus:outline-none focus:ring-none"
                                placeholder="Emergency Contact Number" readonly>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <label for="modalEmailAddress" class="block mb-2 text-[12px] font-bold text-gray-900">Email
                                Address:</label>
                            <input type="email" name="emailAddress" id="modalEmailAddress"
                                class="input-field focus:outline-none focus:ring-none" placeholder="Email Address"
                                readonly>
                        </div>

                        <div>
                            <label for="modalMessengerAccount"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Messenger Account
                                (optional):</label>
                            <input type="text" name="messengerAccount" id="modalMessengerAccount"
                                class="input-field focus:outline-none focus:ring-none"
                                placeholder="Messenger Account (optional)" readonly>
                        </div>

                        <div class="col-span-4">
                            <p class="text-[16px] font-bold">Student Documents Information</p>
                        </div>
                        <div>
                            <label for="modalBirthCertificate"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Birth
                                Certificate:</label>
                            <div id="modalBirthCertificate" class="document-preview">No Document Available</div>
                        </div>

                        <div>
                            <label for="modalProofOfResidency"
                                class="block mb-2 text-[12px] font-bold text-gray-900">Proof of Residency:</label>
                            <div id="modalProofOfResidency" class="document-preview">No Document Available</div>
                        </div>

                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <form action="" class="p-20 pt-0 shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-5 text-[13px] text-gray-900">
                    <div class="col-span-4 mt-10">
                        <h1 class="text-[15px] font-bold">Grades for Grade One</h1>
                        <!-- First table (existing one) -->
                        <table class="table table-bordered shadow-lg" id="tableGradeOne">
                            <thead class="bg-yellow-100">
                                <tr>
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
                                @foreach ($gradeOne as $gradeOneGrade)
                                @php
                                                                                                    $additionalInfo = $studentsAdditional[$student->student_number];
                                                                                                @endphp
                                    <tr data-student-number="{{ $gradeOneGrade->student_number }}">
                                        <td>{{ $gradeOneGrade->quarter }}</td>
                                        <td>{{ $gradeOneGrade->subject_one }}</td>
                                        <td>{{ $gradeOneGrade->subject_two }}</td>
                                        <td>{{ $gradeOneGrade->subject_three }}</td>
                                        <td>{{ $gradeOneGrade->subject_four }}</td>
                                        <td>{{ $gradeOneGrade->subject_five }}</td>
                                        <td>{{ $gradeOneGrade->subject_six }}</td>
                                        <td>{{ $gradeOneGrade->subject_seven }}</td>
                                        <td>{{ $gradeOneGrade->subject_eight }}</td>
                                        <td>{{ $gradeOneGrade->subject_nine }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Grade Two -->
                    <div class="col-span-4 mt-10">
                        <h1 class="text-[15px] font-bold">Grades for Grade Two</h1>
                        <table class="table table-bordered shadow-lg" id="tableGradeTwo">
                            <thead class="bg-teal-200">
                                <tr>
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

                    <!-- Grade Three -->
                    <div class="col-span-4 mt-10">
                        <h1 class="text-[15px] font-bold">Grades for Grade Three</h1>
                        <table class="table table-bordered shadow-lg" id="tableGradeThree">
                            <thead class="bg-green-200">
                                <tr>
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

                    <div class="col-span-4 mt-10">
                        <h1 class="text-[15px] font-bold">Grades for Grade Four</h1>
                        <table class="table table-bordered shadow-lg" id="tableGradeFour">
                            <thead class="bg-red-200">
                                <tr>
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

                    <div class="col-span-4 mt-10">
                        <h1 class="text-[15px] font-bold">Grades for Grade Five</h1>
                        <table class="table table-bordered shadow-lg" id="tableGradeFive">
                            <thead class="bg-cyan-200">
                                <tr>
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

                    <div class="col-span-4 mt-10">
                        <h1 class="text-[15px] font-bold">Grades for Grade Six</h1>
                        <table class="table table-bordered shadow-lg" id="tableGradeSix">
                            <thead class="bg-blue-200">
                                <tr>
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
            </form>

            <div>
    <!-- Search Bar -->
    <input type="text" id="modalStudentNumber1" class="input-field focus:outline-none focus:ring-none"
        value="" placeholder="Search by Student Number" onkeyup="filterTable()">
</div>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#tableGradeOne').DataTable({
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            language: {
                search: "<i class='fas fa-search text-xl text-teal-700 px-3'></i>",
            },
            dom: '<"top"B>frtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: '!bg-sky-800 !text-[12px] !text-white !border-none !hover:bg-sky-700 !px-4 !py-2 !rounded !flex !items-center !justify-center',
                    text: '<i class="fas fa-clipboard"></i> Copy',
                    titleAttr: 'Click to copy data'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                    className: '!bg-teal-700 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !flex !items-center !justify-center',
                    titleAttr: 'Export to Excel',
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv mr-2"></i> CSV',
                    className: '!bg-yellow-500 !text-[12px] !text-white !border-none !hover:bg-yellow-400 !px-4 !py-2 !rounded !flex !items-center !justify-center',
                    titleAttr: 'Export to CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    className: '!bg-red-600 !text-[12px] !text-white !border-none !hover:bg-red-500 !px-4 !py-2 !rounded !flex !items-center !justify-center',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    titleAttr: 'Export to PDF',
                    customize: function (doc) {
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    className: '!bg-blue-600 !text-[12px] !text-white !border-none !hover:bg-blue-500 !px-4 !py-2 !rounded !flex !items-center !justify-center',
                    orientation: 'landscape',
                    autoPrint: true,
                    titleAttr: 'Print Table',
                    customize: function (win) {
                        var studentNumber = $('#modalStudentNumber1').val(); // Get student number from the input field

                        // Customize the printed content
                        $(win.document.body).find('table').css('width', '100%');
                        $(win.document.body).find('table').css('font-size', '10px');

                        // Add the student number (search term) to the print content if there is a value in the input field
                        if (studentNumber) {
                            $(win.document.body).find('table').before('<h4>Student Number Search: ' + studentNumber + '</h4>');
                        }
                    }
                },
            ],
            initComplete: function () {
                $('.dt-buttons').css({
                    'display': 'flex',
                    'justify-content': 'flex-end',
                    'width': '100%',
                    'padding': '1rem',
                });
            }
        });
    });

    // Function to filter the table based on the search bar
    function filterTable() {
        var studentNumber = $('#modalStudentNumber1').val();
        var table = $('#tableGradeOne').DataTable();
        
        // Filter the table based on the entered student number (or search term)
        table.search(studentNumber).draw();
    }

    $(document).ready(function () {
        $('#tableGradeTwo').DataTable({
            // Optional configuration options (if needed)
            "paging": false,
            "searching": false,
            "ordering": true,
            "info": false
        });
    });

    $(document).ready(function () {
        $('#tableGradeThree').DataTable({
            // Optional configuration options (if needed)
            "paging": false,
            "searching": false,
            "ordering": true,
            "info": false
        });
    });

    $(document).ready(function () {
        $('#tableGradeFour').DataTable({
            // Optional configuration options (if needed)
            "paging": false,
            "searching": false,
            "ordering": true,
            "info": false
        });
    });

    $(document).ready(function () {
        $('#tableGradeFive').DataTable({
            // Optional configuration options (if needed)
            "paging": false,
            "searching": false,
            "ordering": true,
            "info": false
        });
    });

    $(document).ready(function () {
        $('#tableGradeSix').DataTable({
            // Optional configuration options (if needed)
            "paging": false,
            "searching": false,
            "ordering": true,
            "info": false
        });
    });
</script>