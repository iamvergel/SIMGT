<div class="p-5 overflow-x-scroll">
                        <table id="gradetable" class="bg-white overflow-x-scroll">
                            <thead>
                                <tr class="text-[8px] font-normal uppercase text-left text-black">
                                    <th class="export"></th>
                                    <th class="export" width="10%"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
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

                                                                @if ($TeacherSubject && $teachersubject->quarter == "4th Quarter" && $teachersubject->subject == $subjectName)
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-2 px-2" colspan="2">QUARTER :
                                                                            {{ $teachersubject->quarter }}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2" colspan="11">GRADE AND SECTION :
                                                                            {{ $teachersubject->grade . '- ' . $teachersubject->section}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2" colspan="13">TEACHER :
                                                                        {{ $TeacherInfo->first_name }} {{ $TeacherInfo->middle_name }} {{ $TeacherInfo->last_name }}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2" colspan="8" id="subject">SUBJECT :
                                                                            {{ $teachersubject->subject }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-5 px-2" colspan="1"></td>
                                                                        <td class="export border-2 border-gray-900 py-5 px-2" colspan="1">Learner's Name</td>
                                                                        <td class="export border-2 border-gray-900 px-2" colspan="13">Written Works (30%)</td>
                                                                        <td class="export border-2 border-gray-900 px-2" colspan="13">Performance Works (50%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2" colspan="3">Quarterly Assessment (20%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2" colspan="1" rowspan="3">Initial Grade
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2" colspan="1" rowspan="3">Quarterly Grade
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td
                                                                            class="export border-2 text-center border-gray-900 w-[100px] pe-[15rem] text-start">
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                    </tr>

                                                                    <tr class="hover:bg-gray-100">
                                                                        <td class="export border-2 text-center border-gray-900">

                                                                        </td>
                                                                        <td class="export border-2 border-gray-900 px-2 uppercase">
                                                                            Possible Highest Score</td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ws }}%
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ws }}%
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ws }}%
                                                                        </td>
                                                                    </tr>

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start px-2">
                                                                            Male</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Male" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900 px-2">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start px-2">
                                                                            Female</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Female" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900 px-2">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>