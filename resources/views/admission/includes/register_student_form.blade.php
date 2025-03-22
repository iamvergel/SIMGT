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
                        {{ old('lastName', $primaryInfo->student_last_name) }},
                        {{ old('firstName', $primaryInfo->student_first_name) }}
                        {{ old('suffixName', $primaryInfo->student_suffix_name) }}
                        {{ old('middleName', $primaryInfo->student_middle_name) }}

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
                    <div
                        class=" col-span-4 p-2 rounded-lg shadow-lg border  my-5 bg-gradient-to-tr from-sky-50 via-white to-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">
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
                                    <option value="Registered" {{ $student->status == 'Registered' ? 'selected' : '' }}>
                                        Registered</option>
                                    <option value="Enrolled" {{ $student->status == 'Enrolled' ? 'selected' : '' }}>Enrolled
                                    </option>
                                </select>
                            </div>

                            <div class="mb-5">
                                <label for="grade" class="block mb-2 text-sm font-bold text-gray-900">
                                    <span class="text-red-600 mr-1">*</span>Select Grade :
                                </label>
                                <select id="grade" name="grade" required disabled
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                    <option value="">Select Grade</option>
                                    <option value="Grade One" {{ $student->grade == 'Grade One' ? 'selected' : '' }}>Grade One
                                    </option>
                                    <option value="Grade Two" {{ $student->grade == 'Grade Two' ? 'selected' : '' }}>Grade Two
                                    </option>
                                    <option value="Grade Three" {{ $student->grade == 'Grade Three' ? 'selected' : '' }}>Grade
                                        Three</option>
                                    <option value="Grade Four" {{ $student->grade == 'Grade Four' ? 'selected' : '' }}>Grade
                                        Four</option>
                                    <option value="Grade Five" {{ $student->grade == 'Grade Five' ? 'selected' : '' }}>Grade
                                        Five</option>
                                    <option value="Grade Six" {{ $student->grade == 'Grade Six' ? 'selected' : '' }}>Grade Six
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>
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