@php
    $firstName = session('student_first_name', 'Guest');
    $lastName = session('student_last_name', '');
    $middleName = session('student_middle_name', '');
    $suffixName = session('student_suffix_name', '');
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

    $user = Auth::guard('student')->user();
    $avatarPath = $user && $user->avatar ? asset('storage/' . $user->avatar) : null;
@endphp

<div class="p-2 shadow-lg">
    <div class="header py-5 bg-teal-700 mt-2 px-5 text-white font-bold text-[15px] rounded-lg shadow-lg">
        <p><i class="fas fa-user mr-2"></i>Additional Information</p>
    </div>

    <div class="p-5 bg-gray-100 shadow-lg">
        <div class="accountInfo bg-white mt-10 text-[15px] text-teal-900 p-5 shadow-lg font-semibold">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <p class="mb-3">Student Number: <strong>{{ session('student_id') }}</strong></p>
                    <p class="mb-3">School Year: <strong>{{ session('school_year') }}</strong></p>
                    <p class="mb-3">Status: <span class="text-green-500 font-bold">{{ session('status') }}</span></p>
                </div>

                <div>
                    <p class="mb-3">Name: <strong>{{ $firstName . ' ' . $middleName . ' ' . $lastName }}</strong></p>
                    <p class="mb-3">Grade: <strong>{{ session('grade') }}</strong></p>
                    <p class="mb-3">Section: <strong>{{ session('section') }}</strong></p>
                </div>
            </div>

        </div>

        <div class="form text-[15px] text-teal-900 mt-10">
            <p class="font-bold">Perosanal Information</p>
            <p class="text-[13px] mb-5">Following information is publicly displayed.</p>

            <form action="" aria-readonly="">
                <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-5">
                    <div class=" my-3">
                        <label for="firstname" class="block mb-1 text-sm font-normal text-teal-900">First Name :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2 "></i>
                            <input type="text" name="firstname" id="firstname" class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{$firstName}}" disabled readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="middlename" class="block mb-1 text-sm font-normal text-teal-900">Middle Name
                            :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2 "></i>
                            <input type="text" name="middlename" id="middlename" class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{$middleName}}" disabled readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="lastname" class="block mb-1 text-sm font-normal text-teal-900">Last Name :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2 "></i>
                            <input type="text" name="lastname" id="lastname" class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{$lastName}}" disabled readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="suffixname" class="block mb-1 text-sm font-normal text-teal-900">suffix Name
                            :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2 "></i>
                            <input type="text" name="suffixname" id="suffixname" class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{$suffixName}}" disabled readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="place_of_birth" class="block mb-1 text-sm font-normal text-teal-900">Place of
                            Birth :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="place_of_birth" id="place_of_birth"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('place_of_birth') }}" disabled
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="sex" class="block mb-1 text-sm font-normal text-teal-900">Gender :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="sex" id="sex" class="myInput block w-full p-2.5 focus:outline-none focus:ring-none"
                                value="{{ session('sex') }}" disabled readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="age" class="block mb-1 text-sm font-normal text-teal-900">Age :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="age" id="age" class="myInput block w-full p-2.5 focus:outline-none focus:ring-none"
                                value="{{ session('age') }}" disabled readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="religion" class="block mb-1 text-sm font-normal text-teal-900">Religion :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="religion" id="religion" class="myInput block w-full p-2.5 focus:outline-none focus:ring-none"
                                value="{{ session('religion') }}" disabled readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="address" class="block mb-1 text-sm font-normal text-teal-900">Address :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="address" id="address" class="myInput block w-full p-2.5 focus:outline-none focus:ring-none"
                                value="{{ session('house_number') . ' ' . session('street') . ' ' . session('barangay') . ' ' . session('city') }}"
                                disabled readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="province" class="block mb-1 text-sm font-normal text-teal-900">Province :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="province" id="province" class="myInput block w-full p-2.5 focus:outline-none focus:ring-none"
                                value="{{ session('province') }}" disabled readonly>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <p class="font-bold mt-10">Parents Information</p>
                        <p class="text-[13px] mb-5">Please provide the contact details for communication purposes.</p>
                    </div>

                    <div class="lg:col-span-2">
                        <p class="font-semibold">Father's Information</p>
                    </div>

                    <div class="my-3">
                        <label for="father_last_name" class="block mb-1 text-sm font-normal text-teal-900">Last
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="father_last_name" id="father_last_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('father_last_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="father_first_name" class="block mb-1 text-sm font-normal text-teal-900">First
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="father_first_name" id="father_first_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('father_first_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="father_middle_name" class="block mb-1 text-sm font-normal text-teal-900">Middle
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="father_middle_name" id="father_middle_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('father_middle_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="father_suffix_name" class="block mb-1 text-sm font-normal text-teal-900">Suffix
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="father_suffix_name" id="father_suffix_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('father_suffix_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="father_occupation"
                            class="block mb-1 text-sm font-normal text-teal-900">Occupation:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="father_occupation" id="father_occupation"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('father_occupation') }}" 
                                readonly>
                        </div>
                    </div>

                    <!-- Repeat similar structure for Mother's Information -->
                    <div class="lg:col-span-2">
                        <p class="font-semibold">Mother's Information</p>
                    </div>
                    <div class="my-3">
                        <label for="mother_last_name" class="block mb-1 text-sm font-normal text-teal-900">Last
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="mother_last_name" id="mother_last_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('mother_last_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="mother_first_name" class="block mb-1 text-sm font-normal text-teal-900">First
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="mother_first_name" id="mother_first_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('mother_first_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="mother_middle_name" class="block mb-1 text-sm font-normal text-teal-900">Mother
                            Middle Name :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="mother_middle_name" id="mother_middle_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('mother_middle_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="mother_occupation"
                            class="block mb-1 text-sm font-normal text-teal-900">Occupation:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="mother_occupation" id="mother_occupation"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('mother_occupation') }}" 
                                readonly>
                        </div>
                    </div>


                    <div class="lg:col-span-2">
                        <p class="font-semibold">Guardian's Information</p>
                    </div>

                    <div class="my-3">
                        <label for="guardian_last_name" class="block mb-1 text-sm font-normal text-teal-900">Last
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="guardian_last_name" id="guardian_last_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('guardian_last_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="guardian_first_name" class="block mb-1 text-sm font-normal text-teal-900">First
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="guardian_first_name" id="guardian_first_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('guardian_first_name') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="guardian_middle_name" class="block mb-1 text-sm font-normal text-teal-900">Middle
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="guardian_middle_name" id="guardian_middle_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('guardian_middle_name') }}"
                                 readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="guardian_suffix_name" class="block mb-1 text-sm font-normal text-teal-900">Suffix
                            Name:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="guardian_suffix_name" id="guardian_suffix_name"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('guardian_suffix_name') }}"
                                 readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="guardian_relationship"
                            class="block mb-1 text-sm font-normal text-teal-900">Relationship:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2"></i>
                            <input type="text" name="guardian_relationship" id="guardian_relationship"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('guardian_relationship') }}"
                                 readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="guardian_contact_number"
                            class="block mb-1 text-sm font-normal text-teal-900">Contact Number:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-phone mr-2"></i>
                            <input type="text" name="guardian_contact_number" id="guardian_contact_number"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('guardian_contact_number') }}"
                                 readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="guardian_religion"
                            class="block mb-1 text-sm font-normal text-teal-900">Religion:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-pray mr-2"></i>
                            <input type="text" name="guardian_religion" id="guardian_religion"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('guardian_religion') }}" 
                                readonly>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <p class="font-semibold">Emergency Information</p>
                    </div>

                    <div class="my-3">
                        <label for="emergency_contact_person"
                            class="block mb-1 text-sm font-normal text-teal-900">Emergency Contact Person:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user-plus mr-2"></i>
                            <input type="text" name="emergency_contact_person" id="emergency_contact_person"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('emergency_contact_person') }}"
                                 readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="emergency_contact_number"
                            class="block mb-1 text-sm font-normal text-teal-900">Emergency Contact Number:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-phone-alt mr-2"></i>
                            <input type="text" name="emergency_contact_number" id="emergency_contact_number"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('emergency_contact_number') }}"
                                 readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="email_address" class="block mb-1 text-sm font-normal text-teal-900">Email
                            Address:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-envelope mr-2"></i>
                            <input type="email" name="email_address" id="email_address"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('email_address') }}"
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="messenger_account" class="block mb-1 text-sm font-normal text-teal-900">Messenger
                            Account:</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fab fa-facebook-messenger mr-2"></i>
                            <input type="text" name="messenger_account" id="messenger_account"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none" value="{{ session('messenger_account') }}"
                                readonly>
                        </div>
                    </div>

                </div>
        </div>
        </form>
    </div>
</div>
</div>