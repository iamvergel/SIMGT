<div class="p-5 overflow-x-scroll">
                        <table id="gradetable" class="bg-white overflow-x-scroll w-full">
                            <thead>
                                <tr class="text-[8px] font-normal uppercase text-left text-black">
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($TeacherSubject as $index => $teachersubject)
                                                                @php
                                                                    // Extract the subject name from the active link
                                                                    $currentUrl = url()->current();
                                                                    $urlParts = explode('/', $currentUrl);
                                                                    $subjectName = end($urlParts); // Get the last part of the URL as the subject name
                                                                    $subjectName = urldecode(str_replace('%20', ' ', $subjectName)); // Decode the subject name
                                                                @endphp
                                                                @if ($TeacherSubject && $teachersubject->quarter == "1st Quarter" && $teachersubject->subject == $subjectName)
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 px-2 py-5" colspan="3">GRADE AND SECTION :
                                                                            {{ $teachersubject->grade . ' - ' . $teachersubject->section}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2 py-5" colspan="2">TECHER :
                                                                            {{ session('teacher_fname') . ' ' . session('teacher_mname') . ' ' . session('teacher_lname')}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2 py-5" colspan="2" id="subject">SUBJECT :
                                                                            {{ $teachersubject->subject }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[15px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</th>
                                                                        <td class="export border-2 text-start px-2 border-gray-900">Name</th>
                                                                        <td class="export border-2 text-center border-gray-900">1st Quarter</td>
                                                                        <td class="export border-2 text-center border-gray-900">2nd Quarter</td>
                                                                        <td class="export border-2 text-center border-gray-900">3rd Quarter</td>
                                                                        <td class="export border-2 text-center border-gray-900">4th Quarter</td>
                                                                        <td class="export border-2 text-center border-gray-900">Final Grade</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-start px-2 border-gray-900">
                                                                            Male
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    <tr class="hover:bg-gray-100">
                                                                        @php $iteration = 1; @endphp
                                                                        @foreach ($StudentFinals as $StudentFinal)
                                                                                @if ($StudentFinal && $StudentFinal->gender == "Male" && $StudentFinal->scholl_year == $teachersubject->scholl_year && $StudentFinal->subject == $teachersubject->subject)
                                                                                    <tr class="hover:bg-gray-100">
                                                                                        <td class="export border-2 text-center border-gray-900">
                                                                                            {{ $iteration++ }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900 px-2">
                                                                                            {{ $StudentFinal->first_name }} {{ $StudentFinal->middle_name }}
                                                                                            {{ $StudentFinal->last_name }} {{ $StudentFinal->suffix }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="first_quarter_grade" data-id="{{ $StudentFinal->id }}"
                                                                                            data-subject="{{ $StudentFinal->subject }}">
                                                                                            {{ $StudentFinal->first_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="second_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->second_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="third_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->third_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="fourth_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->fourth_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900">
                                                                                            {{ $StudentFinal->final_grade }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                        @endforeach
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-start px-2 border-gray-900">
                                                                            Female
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>

                                                                    <tr class="hover:bg-gray-100">
                                                                        @php $iteration = 1; @endphp
                                                                        @foreach ($StudentFinals as $StudentFinal)
                                                                                @if ($StudentFinal && $StudentFinal->gender == "Female" && $StudentFinal->scholl_year == $teachersubject->scholl_year && $StudentFinal->subject == $teachersubject->subject)
                                                                                    <tr class="hover:bg-gray-100">
                                                                                        <td class="export border-2 text-center border-gray-900">
                                                                                            {{ $iteration++ }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900 px-2">
                                                                                            {{ $StudentFinal->first_name }} {{ $StudentFinal->middle_name }}
                                                                                            {{ $StudentFinal->last_name }} {{ $StudentFinal->suffix }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="first_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->first_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="second_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->second_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="third_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->third_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="fourth_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->fourth_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900">
                                                                                            {{ $StudentFinal->final_grade }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                        @endforeach
                                                                    </tr>
                                                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>