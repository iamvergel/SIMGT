<style>
    option {
        border: none;
    }

    .input-field,
    .select-field {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }
</style>

<!-- Main modal -->
<div id="inputstudentgrade" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll">
    <div class="relative px-20 py-10 w-screen h-screen">
        <div class="w-full h-full bg-white rounded-lg shadow overflow-y-scroll">
            <div class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg">
                <h3 class="text-lg font-bold text-teal-800 uppercase"><i class="fa-solid fa-users mr-2"></i>Input
                    Student Grade</h3>
                <button type="button"
                    class="close-modal text-teal-800 hover:bg-gray-100 hover:text-teal-700 p-3 py-2 rounded-full bg-white text-xl font-bold flex items-center justify-center shadow-lg"
                    aria-label="Close modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-20" id="inputgradeForm" method="POST" action="{{ route('student.grade.store') }}">
                @csrf
                <div class="grid grid-cols-4 gap-4 mb-4 text-[13px] text-gray-900">
                    <div class="mb-5">
                        <label for="studentNumber" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Student No. :</label>
                        <input type="text" name="student_number" id="studentNumber" class="input-field" required
                            readonly>
                    </div>

                    <div class="mb-5">
                        <input type="hidden" name="grade" id="gradeq" class="input-field" required
                            readonly>
                    </div>

                    <div></div>
                    <div></div>

                    <div>
                        <label for="quarter" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Select Quarter:
                        </label>
                        <select id="quarter" name="quarter"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            required>
                            <option value="">Select Quarter</option>
                            <option value="1st Quarter">1st Quarter</option>
                            <option value="2nd Quarter">2nd Quarter</option>
                            <option value="3rd Quarter">3rd Quarter</option>
                            <option value="4th Quarter">4th Quarter</option>
                        </select>
                    </div>

                    <div></div>
                    <div></div>
                    <div></div>

                    <div>
                        <label for="subjectone" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject One :</label>
                        <input type="number" name="subject_one" id="subjectone" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="subjecttwo" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject Two :</label>
                        <input type="number" name="subject_two" id="subjecttwo" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="subjectthree" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject Three :</label>
                        <input type="number" name="subject_three" id="subjectthree" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="subjectfour" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject Four :</label>
                        <input type="number" name="subject_four" id="subjectfour" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="subjectfive" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject Five :</label>
                        <input type="number" name="subject_five" id="subjectfive" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="subjectsix" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject Six :</label>
                        <input type="number" name="subject_six" id="subjectsix" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="subjectseven" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject Seven :</label>
                        <input type="number" name="subject_seven" id="subjectseven" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="subjecteight" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject Eight :</label>
                        <input type="number" name="subject_eight" id="subjecteight" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>

                    <div>
                        <label for="subjectnine" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Subject Nine :</label>
                        <input type="number" name="subject_nine" id="subjectnine" step="0.01" required
                            placeholder="Enter Grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                    </div>
                </div>
                <div class="col-span-4 flex justify-end mt-20">
                    <button type="submit"
                        class="text-white w-96 text-center bg-sky-800 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded text-sm px-20 py-2.5 text-center">
                        Submit Grades
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("inputgradeForm").addEventListener("submit", function (event) {
        const inputs = this.querySelectorAll("input[required]");
        let allFilled = true;

        inputs.forEach(input => {
            if (!input.value) {
                allFilled = false;
                input.classList.add("border-red-500"); // Highlight empty fields
            } else {
                input.classList.remove("border-red-500");
            }
        });

        if (!allFilled) {
            event.preventDefault(); // Prevent form submission
            alert("Please fill out all required fields.");
        }
    });

</script>