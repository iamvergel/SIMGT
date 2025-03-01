<style>
    option {
        border: none;
    }

    .input-field-edit,
    .select-field {
        width: 100%;
        padding: 0.625rem;
        border: none;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }
</style>

<!-- Main modal -->
<div id="editstudentgrade" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll">
    <div class="relative px-20 py-10 w-screen h-screen">
        <div class="w-full h-full bg-white rounded-lg shadow overflow-y-scroll">
            <div class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg">
                <h3 class="text-lg font-bold text-teal-800 uppercase"><i class="fa-solid fa-users mr-2"></i>Edit Student
                    Grades</h3>
                <button type="button"
                    class="close-modal text-teal-800 hover:bg-gray-100 hover:text-teal-700 p-3 py-2 rounded-full bg-white text-xl font-bold flex items-center justify-center shadow-lg"
                    aria-label="Close modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal body -->
            <form class="p-20" id="editgradeForm" method="POST"
                action="{{ route('StEmelieLearningCenter.HopeSci66.admin.Grade-book.GradeOne') }}">
                @csrf <!-- Include CSRF token -->
                <input type="hidden" name="student_number" id="studentNumberq" value="">
                <input type="hidden" name="grade" id="gradew" value="">
                <input type="hidden" name="quarter" id="quarterq" value="">
                <div class="grid grid-cols-4 gap-4 mb-4 text-[13px] text-gray-900">
                    <div class="col-span-2 mb-5">
                        <p id="name" class="text-[15px]"></p>
                    </div>

                    <div></div>
                    <div></div>

                    <div class="mb-5">
                        <p id="studentNumberedit" class="text-[15px]"></p>
                    </div>

                    <div></div>
                    <div></div>
                    <div></div>

                    <div class="mb-5">
                        <p id="grade" class="text-[15px]"></p>
                    </div>

                    <div class="mb-5">
                        <p id="section" class="text-[15px]"></p>
                    </div>

                    <div></div>
                    <div></div>

                    <div class="col-span-4 p-5">
                        <div class="grid grid-cols-5 gap-5 p-5 rounded-lg">
                            <div class="col-span-5">
                                <p id="quarterw" class="text-lg font-bold"></p>
                            </div>
                            <div>
                                <label for="subjectone" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject One :</label>
                                <input type="number" name="subject_one" id="subjectoneq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>

                            <div>
                                <label for="subjecttwo" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject Two :</label>
                                <input type="number" name="subject_two" id="subjecttwoq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>

                            <div>
                                <label for="subjectthree" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject Three :</label>
                                <input type="number" name="subject_three" id="subjectthreeq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>

                            <div>
                                <label for="subjectfour" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject Four :</label>
                                <input type="number" name="subject_four" id="subjectfourq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>

                            <div>
                                <label for="subjectfive" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject Five :</label>
                                <input type="number" name="subject_five" id="subjectfiveq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>

                            <div>
                                <label for="subjectsix" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject Six :</label>
                                <input type="number" name="subject_six" id="subjectsixq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>

                            <div>
                                <label for="subjectseven" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject Seven :</label>
                                <input type="number" name="subject_seven" id="subjectsevenq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>

                            <div>
                                <label for="subjecteight" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject Eight :</label>
                                <input type="number" name="subject_eight" id="subjecteightq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>

                            <div>
                                <label for="subjectnine" class="block mb-2 text-sm font-bold text-gray-900">
                                    Subject Nine :</label>
                                <input type="number" name="subject_nine" id="subjectnineq" step="0.01" required
                                    placeholder="Enter Grade"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 flex justify-end mt-20">
                    <button type="submit"
                        class="text-white w-96 text-center bg-sky-800 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded text-sm px-20 py-2.5 text-center">
                        Update Grades
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const openModalButtons = document.querySelectorAll("[data-modal-toggle]");
        const closeModalButtons = document.querySelectorAll(".close-modal");

        openModalButtons.forEach(button => {
            button.addEventListener("click", function () {
                const modalId = this.getAttribute("data-modal-target");

                const studentNumber = this.getAttribute("data-student-number");
                const gradeLevel = this.getAttribute("data-student-grade");
                const studentName = this.getAttribute("data-name");
                const grade = this.getAttribute("data-grade");
                const section = this.getAttribute("data-section");
                const quarter = this.getAttribute("data-quarter");

                // Get subject values from data attributes
                const subjectOne = this.getAttribute("data-subject-one");
                const subjectTwo = this.getAttribute("data-subject-two");
                const subjectThree = this.getAttribute("data-subject-three");
                const subjectFour = this.getAttribute("data-subject-four");
                const subjectFive = this.getAttribute("data-subject-five");
                const subjectSix = this.getAttribute("data-subject-six");
                const subjectSeven = this.getAttribute("data-subject-seven");
                const subjectEight = this.getAttribute("data-subject-eight");
                const subjectNine = this.getAttribute("data-subject-nine");

                // Show the modal
                document.getElementById(modalId).classList.remove("hidden");
                document.getElementById("studentNumber").value = studentNumber;
                document.getElementById("gradeq").value = gradeLevel;

                // Set input values and display names
                document.getElementById("quarterq").value = quarter;
                document.getElementById("gradew").value = grade;
                document.getElementById("quarterw").innerHTML = quarter + " Grades";
                document.getElementById("studentNumberq").value = studentNumber;
                document.getElementById("name").innerHTML = "Name : " + " " + "<strong>" + studentName + "</strong>";
                document.getElementById("studentNumberedit").innerHTML = "Student Number : " + " " + "<strong>" + studentNumber + "</strong>";
                document.getElementById('grade').innerHTML = "Grade : " + " " + "<strong>" + grade + "</strong>";
                document.getElementById('section').innerHTML = "Section : " + " " + "<strong>" + section + "</strong>";

                // Set subject values
                document.getElementById("subjectoneq").value = subjectOne;
                document.getElementById("subjecttwoq").value = subjectTwo;
                document.getElementById("subjectthreeq").value = subjectThree;
                document.getElementById("subjectfourq").value = subjectFour;
                document.getElementById("subjectfiveq").value = subjectFive;
                document.getElementById("subjectsixq").value = subjectSix;
                document.getElementById("subjectsevenq").value = subjectSeven;
                document.getElementById("subjecteightq").value = subjectEight;
                document.getElementById("subjectnineq").value = subjectNine;
            });
        });


        closeModalButtons.forEach(button => {
            button.addEventListener("click", function () {
                const modal = button.closest(".fixed");
                modal.classList.add("hidden");
            });
        });

        // Close modal on background click
        const modals = document.querySelectorAll(".fixed");
        modals.forEach(modal => {
            modal.addEventListener("click", function (event) {
                if (event.target === modal) {
                    modal.classList.add("hidden");
                }
            });
        });
    });

</script>