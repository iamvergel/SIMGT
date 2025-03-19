const studentNumber = document.getElementById("studentNumber").value;
const studentName = document.getElementById("studentName").value;
const gender = document.getElementById("gender").value;
const grade = document.getElementById("grade").value;
const section = document.getElementById("section").value;
const schoolYear = document.getElementById("schoolYear").value;
const status = document.getElementById("status").value;
const lrn = document.getElementById("lrn").value;
const currentDate = new Date().toLocaleDateString();

$("#downloadHtmlButton").on("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const logoUrl = "/assets/images/SELC.png";
    const topMargin = 5;

    const logoWidth = 15;
    const logoHeight = 15;
    doc.addImage(logoUrl, "PNG", 10, 10, logoWidth, logoHeight);

    const title = "St. Emilie Learning Center";
    doc.setFontSize(20);
    doc.setTextColor(40, 40, 40);
    const titleWidth = doc.getTextWidth(title);
    const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
    doc.text(title, titleX, 18);

    const address = "Amparo Village, 18 Bangkal, Caloocan, Metro Manila";
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    const addressWidth = doc.getTextWidth(address);
    const addressX = (doc.internal.pageSize.width - addressWidth) / 2;
    doc.text(address, addressX, 23);

    const reportTitle = "REPORT OF GRADES";
    doc.setFontSize(22);
    doc.setTextColor(0, 0, 0);
    const reportWidth = doc.getTextWidth(reportTitle);
    const reportX = (doc.internal.pageSize.width - reportWidth) / 2;
    doc.text(reportTitle, reportX, 43);

    const leftColumnX = 10;
    const rightColumnX = 150;
    const astartY = 55;

    doc.setFontSize(10);

    // Student information
    doc.text(`LRN               :  ${lrn}`, leftColumnX, astartY);
    doc.text(`Fullname       :  ${studentName}`, leftColumnX, astartY + 5);
    doc.text(`Gender          :  ${gender}`, leftColumnX, astartY + 10);
    doc.text(`Grade            :  ${grade}`, leftColumnX, astartY + 15);
    doc.text(`Section          :  ${section}`, leftColumnX, astartY + 20);

    doc.text(
        `Student No        :  ${studentNumber}`,
        rightColumnX,
        astartY + 5
    );
    doc.text(`Academic Year  :  ${schoolYear}`, rightColumnX, astartY + 10);
    doc.text(
        `Date                   :  ${currentDate}`,
        rightColumnX,
        astartY + 15
    );
    doc.text(`Status                :  ${status}`, rightColumnX, astartY + 20);

    // Get grades from table
    const subjects = [];
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        subjects.push({
            name: subject,
            firstQuarterGrade: firstQuarter,
            secondQuarterGrade: secondQuarter,
            thirdQuarterGrade: thirdQuarter,
            fourthQuarterGrade: fourthQuarter,
            finalGrade: finalGrade,
            remarks: remarks,
        });
    });

    // Start the table
    const margin = 5;
    const bstartX = 5;
    const bstartY = 90;
    const bcolumnWidth = (doc.internal.pageSize.width - margin * 2) / 7;
    const headers = [
        "Learning Areas",
        "1st Quarter",
        "2nd Quarter",
        "3rd Quarter",
        "4th Quarter",
        "Final Grade",
        "Remarks",
    ];
    const headerHeight = 10;
    const startY = bstartY;
    const cellHeight = 5;

    // Draw table headers
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    doc.setFillColor(255, 255, 255);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight, "F");
    doc.setLineWidth(0.5);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight);

    headers.forEach((header, index) => {
        doc.text(header, bstartX + index * bcolumnWidth + margin, startY + 8);
    });

    // Add subject rows to the table
    let totalGrades = 0;
    subjects.forEach((subject, index) => {
        const yPosition = startY + headerHeight + (index + 1) * cellHeight;
        doc.text(subject.name, bstartX + margin, yPosition);
        doc.text(
            subject.firstQuarterGrade,
            bstartX + bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.secondQuarterGrade,
            bstartX + 2 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.thirdQuarterGrade,
            bstartX + 3 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.fourthQuarterGrade,
            bstartX + 4 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.finalGrade,
            bstartX + 5 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(subject.remarks, bstartX + 6 * bcolumnWidth + 5, yPosition);

        if (!isNaN(parseFloat(subject.finalGrade))) {
            totalGrades += parseFloat(subject.finalGrade);
        }
    });

    // Add average and remarks at the bottom
    const average = (totalGrades / subjects.length).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    doc.text(
        `General Average: ${finalGrade}`,
        bstartX,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );
    doc.text(
        `Remark: ${remark}`,
        bstartX + bcolumnWidth * 6 - margin,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );

    // Create a new Date object
    const currentDateTime = new Date();

    // Format the date and time (e.g., "YYYY-MM-DD HH:mm:ss")
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };
    const datePrinted = currentDateTime
        .toLocaleString("en-GB", options)
        .replace(",", "");

    doc.text(`Date Printed : ${datePrinted} [${studentName}]`, 5, 150);

    // Save the PDF
    doc.save(`${studentName}` + "_grades_report_grade_one.pdf", {
        pageHeight: 297,
        pageWidth: 210,
    });
});

$("#printHtmlButton").on("click", function () {
    // Create a new window or use an existing element for print
    const printWindow = window.open("", "", "height=800,width=1000");

    // Add content for printing
    printWindow.document.write(
        "<html><head><title>REPORT OF GRADES</title>"
    );
    printWindow.document.write("<style>");
    printWindow.document.write(
        "body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }"
    );
    printWindow.document.write(
        ".table { width: 100%; border-collapse: collapse; margin-top: 20px; }"
    );
    printWindow.document.write(
        ".table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }"
    );
    printWindow.document.write(".table th { background-color: #f2f2f2; }");
    printWindow.document.write("</style></head><body>");

    // Add logo, title, and address
    printWindow.document.write(
        '<img src="../assets/images/SELC.png" width="50" height="50" />'
    );
    printWindow.document.write(
        '<h1 style="text-align:center;">St. Emilie Learning Center</h1>'
    );
    printWindow.document.write(
        '<p style="text-align:center;">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>'
    );
    printWindow.document.write(
        '<h2 style="text-align:center;">REPORT OF GRADES</h2>'
    );

    // Add student information
    printWindow.document.write('<table style="width: 100%;">');
    printWindow.document.write(
        "<tr><td><strong>LRN</strong>: " +
            lrn +
            "</td><td><strong>Student No</strong>: " +
            studentNumber +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Fullname</strong>: " +
            studentName +
            "</td><td><strong>Academic Year</strong>: " +
            schoolYear +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Gender</strong>: " +
            gender +
            "</td><td><strong>Date</strong>: " +
            currentDate +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Grade</strong>: " +
            grade +
            "</td><td><strong>Status</strong>: " +
            status +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Section</strong>: " + section + "</td></tr>"
    );
    printWindow.document.write("</table>");

    // Create table headers for grades
    printWindow.document.write('<table class="table">');
    printWindow.document.write("<thead>");
    printWindow.document.write(
        "<tr><th>Learning Areas</th><th>1st Quarter</th><th>2nd Quarter</th><th>3rd Quarter</th><th>4th Quarter</th><th>Final Grade</th><th>Remarks</th></tr>"
    );
    printWindow.document.write("</thead>");

    // Get grades from table and add rows to the table
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        printWindow.document.write("<tr>");
        printWindow.document.write("<td>" + subject + "</td>");
        printWindow.document.write("<td>" + firstQuarter + "</td>");
        printWindow.document.write("<td>" + secondQuarter + "</td>");
        printWindow.document.write("<td>" + thirdQuarter + "</td>");
        printWindow.document.write("<td>" + fourthQuarter + "</td>");
        printWindow.document.write("<td>" + finalGrade + "</td>");
        printWindow.document.write("<td>" + remarks + "</td>");
        printWindow.document.write("</tr>");
    });

    // Add average and remarks at the bottom
    let totalGrades = 0;
    let subjectsCount = 0;
    document.querySelectorAll(".subject-row").forEach((row) => {
        const finalGrade = row.cells[5].textContent;
        if (!isNaN(parseFloat(finalGrade))) {
            totalGrades += parseFloat(finalGrade);
            subjectsCount++;
        }
    });

    const average = (totalGrades / subjectsCount).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    printWindow.document.write(
        '<tr><td colspan="5"><strong>General Average: ' +
            finalGrade +
            '</strong></td><td colspan="2"><strong>Remark: ' +
            remark +
            "</strong></td></tr>"
    );
    printWindow.document.write("</table>");

    // Close the body and open print window
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
});

$("#downloadHtmlButtonTwo").on("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const logoUrl = "/assets/images/SELC.png";
    const topMargin = 5;

    const logoWidth = 15;
    const logoHeight = 15;
    doc.addImage(logoUrl, "PNG", 10, 10, logoWidth, logoHeight);

    const title = "St. Emilie Learning Center";
    doc.setFontSize(20);
    doc.setTextColor(40, 40, 40);
    const titleWidth = doc.getTextWidth(title);
    const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
    doc.text(title, titleX, 18);

    const address = "Amparo Village, 18 Bangkal, Caloocan, Metro Manila";
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    const addressWidth = doc.getTextWidth(address);
    const addressX = (doc.internal.pageSize.width - addressWidth) / 2;
    doc.text(address, addressX, 23);

    const reportTitle = "REPORT OF GRADES";
    doc.setFontSize(22);
    doc.setTextColor(0, 0, 0);
    const reportWidth = doc.getTextWidth(reportTitle);
    const reportX = (doc.internal.pageSize.width - reportWidth) / 2;
    doc.text(reportTitle, reportX, 43);

    const leftColumnX = 10;
    const rightColumnX = 150;
    const astartY = 55;

    doc.setFontSize(10);

    // Student information
    doc.text(`LRN               :  ${lrn}`, leftColumnX, astartY);
    doc.text(`Fullname       :  ${studentName}`, leftColumnX, astartY + 5);
    doc.text(`Gender          :  ${gender}`, leftColumnX, astartY + 10);
    doc.text(`Grade            :  ${grade}`, leftColumnX, astartY + 15);
    doc.text(`Section          :  ${section}`, leftColumnX, astartY + 20);

    doc.text(
        `Student No        :  ${studentNumber}`,
        rightColumnX,
        astartY + 5
    );
    doc.text(`Academic Year  :  ${schoolYear}`, rightColumnX, astartY + 10);
    doc.text(
        `Date                   :  ${currentDate}`,
        rightColumnX,
        astartY + 15
    );
    doc.text(`Status                :  ${status}`, rightColumnX, astartY + 20);

    // Get grades from table
    const subjects = [];
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        subjects.push({
            name: subject,
            firstQuarterGrade: firstQuarter,
            secondQuarterGrade: secondQuarter,
            thirdQuarterGrade: thirdQuarter,
            fourthQuarterGrade: fourthQuarter,
            finalGrade: finalGrade,
            remarks: remarks,
        });
    });

    // Start the table
    const margin = 5;
    const bstartX = 5;
    const bstartY = 90;
    const bcolumnWidth = (doc.internal.pageSize.width - margin * 2) / 7;
    const headers = [
        "Learning Areas",
        "1st Quarter",
        "2nd Quarter",
        "3rd Quarter",
        "4th Quarter",
        "Final Grade",
        "Remarks",
    ];
    const headerHeight = 10;
    const startY = bstartY;
    const cellHeight = 5;

    // Draw table headers
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    doc.setFillColor(255, 255, 255);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight, "F");
    doc.setLineWidth(0.5);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight);

    headers.forEach((header, index) => {
        doc.text(header, bstartX + index * bcolumnWidth + margin, startY + 8);
    });

    // Add subject rows to the table
    let totalGrades = 0;
    subjects.forEach((subject, index) => {
        const yPosition = startY + headerHeight + (index + 1) * cellHeight;
        doc.text(subject.name, bstartX + margin, yPosition);
        doc.text(
            subject.firstQuarterGrade,
            bstartX + bcolumnWidth + 20,
            yPosition
        );
        doc.text(
            subject.secondQuarterGrade,
            bstartX + 2 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.thirdQuarterGrade,
            bstartX + 3 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.fourthQuarterGrade,
            bstartX + 4 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.finalGrade,
            bstartX + 5 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(subject.remarks, bstartX + 6 * bcolumnWidth + 5, yPosition);

        if (!isNaN(parseFloat(subject.finalGrade))) {
            totalGrades += parseFloat(subject.finalGrade);
        }
    });

    // Add average and remarks at the bottom
    const average = (totalGrades / subjects.length).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    doc.text(
        `General Average: ${finalGrade}`,
        bstartX,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );
    doc.text(
        `Remark: ${remark}`,
        bstartX + bcolumnWidth * 6 - margin,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );

    // Create a new Date object
    const currentDateTime = new Date();

    // Format the date and time (e.g., "YYYY-MM-DD HH:mm:ss")
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };
    const datePrinted = currentDateTime
        .toLocaleString("en-GB", options)
        .replace(",", "");

    doc.text(`Date Printed : ${datePrinted} [${studentName}]`, 5, 180);

    // Save the PDF
    doc.save(`${studentName}` + "_grades_report_grade_two.pdf", {
        pageHeight: 297,
        pageWidth: 210,
    });
});

$("#printHtmlButtonTwo").on("click", function () {
    // Create a new window or use an existing element for print
    const printWindow = window.open("", "", "height=800,width=1000");

    // Add content for printing
    printWindow.document.write(
        "<html><head><title>REPORT OF GRADES</title>"
    );
    printWindow.document.write("<style>");
    printWindow.document.write(
        "body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }"
    );
    printWindow.document.write(
        ".table { width: 100%; border-collapse: collapse; margin-top: 20px; }"
    );
    printWindow.document.write(
        ".table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }"
    );
    printWindow.document.write(".table th { background-color: #f2f2f2; }");
    printWindow.document.write("</style></head><body>");

    // Add logo, title, and address
    printWindow.document.write(
        '<img src="../assets/images/SELC.png" width="50" height="50" />'
    );
    printWindow.document.write(
        '<h1 style="text-align:center;">St. Emilie Learning Center</h1>'
    );
    printWindow.document.write(
        '<p style="text-align:center;">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>'
    );
    printWindow.document.write(
        '<h2 style="text-align:center;">REPORT OF GRADES</h2>'
    );

    // Add student information
    printWindow.document.write('<table style="width: 100%;">');
    printWindow.document.write(
        "<tr><td><strong>LRN</strong>: " +
            lrn +
            "</td><td><strong>Student No</strong>: " +
            studentNumber +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Fullname</strong>: " +
            studentName +
            "</td><td><strong>Academic Year</strong>: " +
            schoolYear +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Gender</strong>: " +
            gender +
            "</td><td><strong>Date</strong>: " +
            currentDate +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Grade</strong>: " +
            grade +
            "</td><td><strong>Status</strong>: " +
            status +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Section</strong>: " + section + "</td></tr>"
    );
    printWindow.document.write("</table>");

    // Create table headers for grades
    printWindow.document.write('<table class="table">');
    printWindow.document.write("<thead>");
    printWindow.document.write(
        "<tr><th>Learning Areas</th><th>1st Quarter</th><th>2nd Quarter</th><th>3rd Quarter</th><th>4th Quarter</th><th>Final Grade</th><th>Remarks</th></tr>"
    );
    printWindow.document.write("</thead>");

    // Get grades from table and add rows to the table
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        printWindow.document.write("<tr>");
        printWindow.document.write("<td>" + subject + "</td>");
        printWindow.document.write("<td>" + firstQuarter + "</td>");
        printWindow.document.write("<td>" + secondQuarter + "</td>");
        printWindow.document.write("<td>" + thirdQuarter + "</td>");
        printWindow.document.write("<td>" + fourthQuarter + "</td>");
        printWindow.document.write("<td>" + finalGrade + "</td>");
        printWindow.document.write("<td>" + remarks + "</td>");
        printWindow.document.write("</tr>");
    });

    // Add average and remarks at the bottom
    let totalGrades = 0;
    let subjectsCount = 0;
    document.querySelectorAll(".subject-row").forEach((row) => {
        const finalGrade = row.cells[5].textContent;
        if (!isNaN(parseFloat(finalGrade))) {
            totalGrades += parseFloat(finalGrade);
            subjectsCount++;
        }
    });
    const average = (totalGrades / subjectsCount).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    printWindow.document.write(
        '<tr><td colspan="5"><strong>General Average: ' +
            finalGrade +
            '</strong></td><td colspan="2"><strong>Remark: ' +
            remark +
            "</strong></td></tr>"
    );
    printWindow.document.write("</table>");

    // Close the body and open print window
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
});

$("#downloadHtmlButtonThree").on("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const logoUrl = "/assets/images/SELC.png";
    const topMargin = 5;

    const logoWidth = 15;
    const logoHeight = 15;
    doc.addImage(logoUrl, "PNG", 10, 10, logoWidth, logoHeight);

    const title = "St. Emilie Learning Center";
    doc.setFontSize(20);
    doc.setTextColor(40, 40, 40);
    const titleWidth = doc.getTextWidth(title);
    const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
    doc.text(title, titleX, 18);

    const address = "Amparo Village, 18 Bangkal, Caloocan, Metro Manila";
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    const addressWidth = doc.getTextWidth(address);
    const addressX = (doc.internal.pageSize.width - addressWidth) / 2;
    doc.text(address, addressX, 23);

    const reportTitle = "REPORT OF GRADES";
    doc.setFontSize(22);
    doc.setTextColor(0, 0, 0);
    const reportWidth = doc.getTextWidth(reportTitle);
    const reportX = (doc.internal.pageSize.width - reportWidth) / 2;
    doc.text(reportTitle, reportX, 43);

    const leftColumnX = 10;
    const rightColumnX = 150;
    const astartY = 55;

    doc.setFontSize(10);

    // Student information
    doc.text(`LRN               :  ${lrn}`, leftColumnX, astartY);
    doc.text(`Fullname       :  ${studentName}`, leftColumnX, astartY + 5);
    doc.text(`Gender          :  ${gender}`, leftColumnX, astartY + 10);
    doc.text(`Grade            :  ${grade}`, leftColumnX, astartY + 15);
    doc.text(`Section          :  ${section}`, leftColumnX, astartY + 20);

    doc.text(
        `Student No        :  ${studentNumber}`,
        rightColumnX,
        astartY + 5
    );
    doc.text(`Academic Year  :  ${schoolYear}`, rightColumnX, astartY + 10);
    doc.text(
        `Date                   :  ${currentDate}`,
        rightColumnX,
        astartY + 15
    );
    doc.text(`Status                :  ${status}`, rightColumnX, astartY + 20);

    // Get grades from table
    const subjects = [];
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        subjects.push({
            name: subject,
            firstQuarterGrade: firstQuarter,
            secondQuarterGrade: secondQuarter,
            thirdQuarterGrade: thirdQuarter,
            fourthQuarterGrade: fourthQuarter,
            finalGrade: finalGrade,
            remarks: remarks,
        });
    });

    // Start the table
    const margin = 5;
    const bstartX = 5;
    const bstartY = 90;
    const bcolumnWidth = (doc.internal.pageSize.width - margin * 2) / 7;
    const headers = [
        "Learning Areas",
        "1st Quarter",
        "2nd Quarter",
        "3rd Quarter",
        "4th Quarter",
        "Final Grade",
        "Remarks",
    ];
    const headerHeight = 10;
    const startY = bstartY;
    const cellHeight = 5;

    // Draw table headers
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    doc.setFillColor(255, 255, 255);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight, "F");
    doc.setLineWidth(0.5);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight);

    headers.forEach((header, index) => {
        doc.text(header, bstartX + index * bcolumnWidth + margin, startY + 8);
    });

    // Add subject rows to the table
    let totalGrades = 0;
    subjects.forEach((subject, index) => {
        const yPosition = startY + headerHeight + (index + 1) * cellHeight;
        doc.text(subject.name, bstartX + margin, yPosition);
        doc.text(
            subject.firstQuarterGrade,
            bstartX + bcolumnWidth + 20,
            yPosition
        );
        doc.text(
            subject.secondQuarterGrade,
            bstartX + 2 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.thirdQuarterGrade,
            bstartX + 3 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.fourthQuarterGrade,
            bstartX + 4 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.finalGrade,
            bstartX + 5 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(subject.remarks, bstartX + 6 * bcolumnWidth + 5, yPosition);

        if (!isNaN(parseFloat(subject.finalGrade))) {
            totalGrades += parseFloat(subject.finalGrade);
        }
    });

    // Add average and remarks at the bottom
    const average = (totalGrades / subjects.length).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    doc.text(
        `General Average: ${finalGrade}`,
        bstartX,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );
    doc.text(
        `Remark: ${remark}`,
        bstartX + bcolumnWidth * 6 - margin,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );

    // Create a new Date object
    const currentDateTime = new Date();

    // Format the date and time (e.g., "YYYY-MM-DD HH:mm:ss")
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };
    const datePrinted = currentDateTime
        .toLocaleString("en-GB", options)
        .replace(",", "");

    doc.text(`Date Printed : ${datePrinted} [${studentName}]`, 5, 180);

    // Save the PDF
    doc.save(`${studentName}` + "_grades_report_grade_three.pdf", {
        pageHeight: 297,
        pageWidth: 210,
    });
});

$("#printHtmlButtonThree").on("click", function () {
    // Create a new window or use an existing element for print
    const printWindow = window.open("", "", "height=800,width=1000");

    // Add content for printing
    printWindow.document.write(
        "<html><head><title>REPORT OF GRADES</title>"
    );
    printWindow.document.write("<style>");
    printWindow.document.write(
        "body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }"
    );
    printWindow.document.write(
        ".table { width: 100%; border-collapse: collapse; margin-top: 20px; }"
    );
    printWindow.document.write(
        ".table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }"
    );
    printWindow.document.write(".table th { background-color: #f2f2f2; }");
    printWindow.document.write("</style></head><body>");

    // Add logo, title, and address
    printWindow.document.write(
        '<img src="../assets/images/SELC.png" width="50" height="50" />'
    );
    printWindow.document.write(
        '<h1 style="text-align:center;">St. Emilie Learning Center</h1>'
    );
    printWindow.document.write(
        '<p style="text-align:center;">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>'
    );
    printWindow.document.write(
        '<h2 style="text-align:center;">REPORT OF GRADES</h2>'
    );

    // Add student information
    printWindow.document.write('<table style="width: 100%;">');
    printWindow.document.write(
        "<tr><td><strong>LRN</strong>: " +
            lrn +
            "</td><td><strong>Student No</strong>: " +
            studentNumber +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Fullname</strong>: " +
            studentName +
            "</td><td><strong>Academic Year</strong>: " +
            schoolYear +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Gender</strong>: " +
            gender +
            "</td><td><strong>Date</strong>: " +
            currentDate +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Grade</strong>: " +
            grade +
            "</td><td><strong>Status</strong>: " +
            status +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Section</strong>: " + section + "</td></tr>"
    );
    printWindow.document.write("</table>");

    // Create table headers for grades
    printWindow.document.write('<table class="table">');
    printWindow.document.write("<thead>");
    printWindow.document.write(
        "<tr><th>Learning Areas</th><th>1st Quarter</th><th>2nd Quarter</th><th>3rd Quarter</th><th>4th Quarter</th><th>Final Grade</th><th>Remarks</th></tr>"
    );
    printWindow.document.write("</thead>");

    // Get grades from table and add rows to the table
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        printWindow.document.write("<tr>");
        printWindow.document.write("<td>" + subject + "</td>");
        printWindow.document.write("<td>" + firstQuarter + "</td>");
        printWindow.document.write("<td>" + secondQuarter + "</td>");
        printWindow.document.write("<td>" + thirdQuarter + "</td>");
        printWindow.document.write("<td>" + fourthQuarter + "</td>");
        printWindow.document.write("<td>" + finalGrade + "</td>");
        printWindow.document.write("<td>" + remarks + "</td>");
        printWindow.document.write("</tr>");
    });

    // Add average and remarks at the bottom
    let totalGrades = 0;
    let subjectsCount = 0;
    document.querySelectorAll(".subject-row").forEach((row) => {
        const finalGrade = row.cells[5].textContent;
        if (!isNaN(parseFloat(finalGrade))) {
            totalGrades += parseFloat(finalGrade);
            subjectsCount++;
        }
    });
    const average = (totalGrades / subjectsCount).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    printWindow.document.write(
        '<tr><td colspan="5"><strong>General Average: ' +
            finalGrade +
            '</strong></td><td colspan="2"><strong>Remark: ' +
            remark +
            "</strong></td></tr>"
    );
    printWindow.document.write("</table>");

    // Close the body and open print window
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
});

$("#downloadHtmlButtonFour").on("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const logoUrl = "/assets/images/SELC.png";
    const topMargin = 5;

    const logoWidth = 15;
    const logoHeight = 15;
    doc.addImage(logoUrl, "PNG", 10, 10, logoWidth, logoHeight);

    const title = "St. Emilie Learning Center";
    doc.setFontSize(20);
    doc.setTextColor(40, 40, 40);
    const titleWidth = doc.getTextWidth(title);
    const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
    doc.text(title, titleX, 18);

    const address = "Amparo Village, 18 Bangkal, Caloocan, Metro Manila";
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    const addressWidth = doc.getTextWidth(address);
    const addressX = (doc.internal.pageSize.width - addressWidth) / 2;
    doc.text(address, addressX, 23);

    const reportTitle = "REPORT OF GRADES";
    doc.setFontSize(22);
    doc.setTextColor(0, 0, 0);
    const reportWidth = doc.getTextWidth(reportTitle);
    const reportX = (doc.internal.pageSize.width - reportWidth) / 2;
    doc.text(reportTitle, reportX, 43);

    const leftColumnX = 10;
    const rightColumnX = 150;
    const astartY = 55;

    doc.setFontSize(10);

    // Student information
    doc.text(`LRN               :  ${lrn}`, leftColumnX, astartY);
    doc.text(`Fullname       :  ${studentName}`, leftColumnX, astartY + 5);
    doc.text(`Gender          :  ${gender}`, leftColumnX, astartY + 10);
    doc.text(`Grade            :  ${grade}`, leftColumnX, astartY + 15);
    doc.text(`Section          :  ${section}`, leftColumnX, astartY + 20);

    doc.text(
        `Student No        :  ${studentNumber}`,
        rightColumnX,
        astartY + 5
    );
    doc.text(`Academic Year  :  ${schoolYear}`, rightColumnX, astartY + 10);
    doc.text(
        `Date                   :  ${currentDate}`,
        rightColumnX,
        astartY + 15
    );
    doc.text(`Status                :  ${status}`, rightColumnX, astartY + 20);

    // Get grades from table
    const subjects = [];
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        subjects.push({
            name: subject,
            firstQuarterGrade: firstQuarter,
            secondQuarterGrade: secondQuarter,
            thirdQuarterGrade: thirdQuarter,
            fourthQuarterGrade: fourthQuarter,
            finalGrade: finalGrade,
            remarks: remarks,
        });
    });

    // Start the table
    const margin = 5;
    const bstartX = 5;
    const bstartY = 90;
    const bcolumnWidth = (doc.internal.pageSize.width - margin * 2) / 7;
    const headers = [
        "Learning Areas",
        "1st Quarter",
        "2nd Quarter",
        "3rd Quarter",
        "4th Quarter",
        "Final Grade",
        "Remarks",
    ];
    const headerHeight = 10;
    const startY = bstartY;
    const cellHeight = 5;

    // Draw table headers
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    doc.setFillColor(255, 255, 255);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight, "F");
    doc.setLineWidth(0.5);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight);

    headers.forEach((header, index) => {
        doc.text(header, bstartX + index * bcolumnWidth + margin, startY + 8);
    });

    // Add subject rows to the table
    let totalGrades = 0;
    subjects.forEach((subject, index) => {
        const yPosition = startY + headerHeight + (index + 1) * cellHeight;
        doc.text(subject.name, bstartX + margin, yPosition);
        doc.text(
            subject.firstQuarterGrade,
            bstartX + bcolumnWidth + 20,
            yPosition
        );
        doc.text(
            subject.secondQuarterGrade,
            bstartX + 2 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.thirdQuarterGrade,
            bstartX + 3 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.fourthQuarterGrade,
            bstartX + 4 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.finalGrade,
            bstartX + 5 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(subject.remarks, bstartX + 6 * bcolumnWidth + 5, yPosition);

        if (!isNaN(parseFloat(subject.finalGrade))) {
            totalGrades += parseFloat(subject.finalGrade);
        }
    });

    // Add average and remarks at the bottom
    const average = (totalGrades / subjects.length).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    doc.text(
        `General Average: ${finalGrade}`,
        bstartX,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );
    doc.text(
        `Remark: ${remark}`,
        bstartX + bcolumnWidth * 6 - margin,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );

    // Create a new Date object
    const currentDateTime = new Date();

    // Format the date and time (e.g., "YYYY-MM-DD HH:mm:ss")
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };
    const datePrinted = currentDateTime
        .toLocaleString("en-GB", options)
        .replace(",", "");

    doc.text(`Date Printed : ${datePrinted} [${studentName}]`, 5, 180);

    // Save the PDF
    doc.save(`${studentName}` + "_grades_report_grade_two.pdf", {
        pageHeight: 297,
        pageWidth: 210,
    });
});

$("#printHtmlButtonFour").on("click", function () {
    // Create a new window or use an existing element for print
    const printWindow = window.open("", "", "height=800,width=1000");

    // Add content for printing
    printWindow.document.write(
        "<html><head><title>REPORT OF GRADES</title>"
    );
    printWindow.document.write("<style>");
    printWindow.document.write(
        "body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }"
    );
    printWindow.document.write(
        ".table { width: 100%; border-collapse: collapse; margin-top: 20px; }"
    );
    printWindow.document.write(
        ".table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }"
    );
    printWindow.document.write(".table th { background-color: #f2f2f2; }");
    printWindow.document.write("</style></head><body>");

    // Add logo, title, and address
    printWindow.document.write(
        '<img src="../assets/images/SELC.png" width="50" height="50" />'
    );
    printWindow.document.write(
        '<h1 style="text-align:center;">St. Emilie Learning Center</h1>'
    );
    printWindow.document.write(
        '<p style="text-align:center;">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>'
    );
    printWindow.document.write(
        '<h2 style="text-align:center;">REPORT OF GRADES</h2>'
    );

    // Add student information
    printWindow.document.write('<table style="width: 100%;">');
    printWindow.document.write(
        "<tr><td><strong>LRN</strong>: " +
            lrn +
            "</td><td><strong>Student No</strong>: " +
            studentNumber +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Fullname</strong>: " +
            studentName +
            "</td><td><strong>Academic Year</strong>: " +
            schoolYear +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Gender</strong>: " +
            gender +
            "</td><td><strong>Date</strong>: " +
            currentDate +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Grade</strong>: " +
            grade +
            "</td><td><strong>Status</strong>: " +
            status +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Section</strong>: " + section + "</td></tr>"
    );
    printWindow.document.write("</table>");

    // Create table headers for grades
    printWindow.document.write('<table class="table">');
    printWindow.document.write("<thead>");
    printWindow.document.write(
        "<tr><th>Learning Areas</th><th>1st Quarter</th><th>2nd Quarter</th><th>3rd Quarter</th><th>4th Quarter</th><th>Final Grade</th><th>Remarks</th></tr>"
    );
    printWindow.document.write("</thead>");

    // Get grades from table and add rows to the table
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        printWindow.document.write("<tr>");
        printWindow.document.write("<td>" + subject + "</td>");
        printWindow.document.write("<td>" + firstQuarter + "</td>");
        printWindow.document.write("<td>" + secondQuarter + "</td>");
        printWindow.document.write("<td>" + thirdQuarter + "</td>");
        printWindow.document.write("<td>" + fourthQuarter + "</td>");
        printWindow.document.write("<td>" + finalGrade + "</td>");
        printWindow.document.write("<td>" + remarks + "</td>");
        printWindow.document.write("</tr>");
    });

    // Add average and remarks at the bottom
    let totalGrades = 0;
    let subjectsCount = 0;
    document.querySelectorAll(".subject-row").forEach((row) => {
        const finalGrade = row.cells[5].textContent;
        if (!isNaN(parseFloat(finalGrade))) {
            totalGrades += parseFloat(finalGrade);
            subjectsCount++;
        }
    });
    const average = (totalGrades / subjectsCount).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    printWindow.document.write(
        '<tr><td colspan="5"><strong>General Average: ' +
            finalGrade +
            '</strong></td><td colspan="2"><strong>Remark: ' +
            remark +
            "</strong></td></tr>"
    );
    printWindow.document.write("</table>");

    // Close the body and open print window
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
});

$("#downloadHtmlButtonFive").on("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const logoUrl = "/assets/images/SELC.png";
    const topMargin = 5;

    const logoWidth = 15;
    const logoHeight = 15;
    doc.addImage(logoUrl, "PNG", 10, 10, logoWidth, logoHeight);

    const title = "St. Emilie Learning Center";
    doc.setFontSize(20);
    doc.setTextColor(40, 40, 40);
    const titleWidth = doc.getTextWidth(title);
    const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
    doc.text(title, titleX, 18);

    const address = "Amparo Village, 18 Bangkal, Caloocan, Metro Manila";
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    const addressWidth = doc.getTextWidth(address);
    const addressX = (doc.internal.pageSize.width - addressWidth) / 2;
    doc.text(address, addressX, 23);

    const reportTitle = "REPORT OF GRADES";
    doc.setFontSize(22);
    doc.setTextColor(0, 0, 0);
    const reportWidth = doc.getTextWidth(reportTitle);
    const reportX = (doc.internal.pageSize.width - reportWidth) / 2;
    doc.text(reportTitle, reportX, 43);

    const leftColumnX = 10;
    const rightColumnX = 150;
    const astartY = 55;

    doc.setFontSize(10);

    // Student information
    doc.text(`LRN               :  ${lrn}`, leftColumnX, astartY);
    doc.text(`Fullname       :  ${studentName}`, leftColumnX, astartY + 5);
    doc.text(`Gender          :  ${gender}`, leftColumnX, astartY + 10);
    doc.text(`Grade            :  ${grade}`, leftColumnX, astartY + 15);
    doc.text(`Section          :  ${section}`, leftColumnX, astartY + 20);

    doc.text(
        `Student No        :  ${studentNumber}`,
        rightColumnX,
        astartY + 5
    );
    doc.text(`Academic Year  :  ${schoolYear}`, rightColumnX, astartY + 10);
    doc.text(
        `Date                   :  ${currentDate}`,
        rightColumnX,
        astartY + 15
    );
    doc.text(`Status                :  ${status}`, rightColumnX, astartY + 20);

    // Get grades from table
    const subjects = [];
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        subjects.push({
            name: subject,
            firstQuarterGrade: firstQuarter,
            secondQuarterGrade: secondQuarter,
            thirdQuarterGrade: thirdQuarter,
            fourthQuarterGrade: fourthQuarter,
            finalGrade: finalGrade,
            remarks: remarks,
        });
    });

    // Start the table
    const margin = 5;
    const bstartX = 5;
    const bstartY = 90;
    const bcolumnWidth = (doc.internal.pageSize.width - margin * 2) / 7;
    const headers = [
        "Learning Areas",
        "1st Quarter",
        "2nd Quarter",
        "3rd Quarter",
        "4th Quarter",
        "Final Grade",
        "Remarks",
    ];
    const headerHeight = 10;
    const startY = bstartY;
    const cellHeight = 5;

    // Draw table headers
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    doc.setFillColor(255, 255, 255);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight, "F");
    doc.setLineWidth(0.5);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight);

    headers.forEach((header, index) => {
        doc.text(header, bstartX + index * bcolumnWidth + margin, startY + 8);
    });

    // Add subject rows to the table
    let totalGrades = 0;
    subjects.forEach((subject, index) => {
        const yPosition = startY + headerHeight + (index + 1) * cellHeight;
        doc.text(subject.name, bstartX + margin, yPosition);
        doc.text(
            subject.firstQuarterGrade,
            bstartX + bcolumnWidth + 20,
            yPosition
        );
        doc.text(
            subject.secondQuarterGrade,
            bstartX + 2 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.thirdQuarterGrade,
            bstartX + 3 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.fourthQuarterGrade,
            bstartX + 4 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.finalGrade,
            bstartX + 5 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(subject.remarks, bstartX + 6 * bcolumnWidth + 5, yPosition);

        if (!isNaN(parseFloat(subject.finalGrade))) {
            totalGrades += parseFloat(subject.finalGrade);
        }
    });

    // Add average and remarks at the bottom
    const average = (totalGrades / subjects.length).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    doc.text(
        `General Average: ${finalGrade}`,
        bstartX,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );
    doc.text(
        `Remark: ${remark}`,
        bstartX + bcolumnWidth * 6 - margin,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );

    // Create a new Date object
    const currentDateTime = new Date();

    // Format the date and time (e.g., "YYYY-MM-DD HH:mm:ss")
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };
    const datePrinted = currentDateTime
        .toLocaleString("en-GB", options)
        .replace(",", "");

    doc.text(`Date Printed : ${datePrinted} [${studentName}]`, 5, 180);

    // Save the PDF
    doc.save(`${studentName}` + "_grades_report_grade_two.pdf", {
        pageHeight: 297,
        pageWidth: 210,
    });
});

$("#printHtmlButtonFive").on("click", function () {
    // Create a new window or use an existing element for print
    const printWindow = window.open("", "", "height=800,width=1000");

    // Add content for printing
    printWindow.document.write(
        "<html><head><title>REPORT OF GRADES</title>"
    );
    printWindow.document.write("<style>");
    printWindow.document.write(
        "body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }"
    );
    printWindow.document.write(
        ".table { width: 100%; border-collapse: collapse; margin-top: 20px; }"
    );
    printWindow.document.write(
        ".table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }"
    );
    printWindow.document.write(".table th { background-color: #f2f2f2; }");
    printWindow.document.write("</style></head><body>");

    // Add logo, title, and address
    printWindow.document.write(
        '<img src="../assets/images/SELC.png" width="50" height="50" />'
    );
    printWindow.document.write(
        '<h1 style="text-align:center;">St. Emilie Learning Center</h1>'
    );
    printWindow.document.write(
        '<p style="text-align:center;">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>'
    );
    printWindow.document.write(
        '<h2 style="text-align:center;">REPORT OF GRADES</h2>'
    );

    // Add student information
    printWindow.document.write('<table style="width: 100%;">');
    printWindow.document.write(
        "<tr><td><strong>LRN</strong>: " +
            lrn +
            "</td><td><strong>Student No</strong>: " +
            studentNumber +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Fullname</strong>: " +
            studentName +
            "</td><td><strong>Academic Year</strong>: " +
            schoolYear +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Gender</strong>: " +
            gender +
            "</td><td><strong>Date</strong>: " +
            currentDate +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Grade</strong>: " +
            grade +
            "</td><td><strong>Status</strong>: " +
            status +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Section</strong>: " + section + "</td></tr>"
    );
    printWindow.document.write("</table>");

    // Create table headers for grades
    printWindow.document.write('<table class="table">');
    printWindow.document.write("<thead>");
    printWindow.document.write(
        "<tr><th>Learning Areas</th><th>1st Quarter</th><th>2nd Quarter</th><th>3rd Quarter</th><th>4th Quarter</th><th>Final Grade</th><th>Remarks</th></tr>"
    );
    printWindow.document.write("</thead>");

    // Get grades from table and add rows to the table
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        printWindow.document.write("<tr>");
        printWindow.document.write("<td>" + subject + "</td>");
        printWindow.document.write("<td>" + firstQuarter + "</td>");
        printWindow.document.write("<td>" + secondQuarter + "</td>");
        printWindow.document.write("<td>" + thirdQuarter + "</td>");
        printWindow.document.write("<td>" + fourthQuarter + "</td>");
        printWindow.document.write("<td>" + finalGrade + "</td>");
        printWindow.document.write("<td>" + remarks + "</td>");
        printWindow.document.write("</tr>");
    });

    // Add average and remarks at the bottom
    let totalGrades = 0;
    let subjectsCount = 0;
    document.querySelectorAll(".subject-row").forEach((row) => {
        const finalGrade = row.cells[5].textContent;
        if (!isNaN(parseFloat(finalGrade))) {
            totalGrades += parseFloat(finalGrade);
            subjectsCount++;
        }
    });
    const average = (totalGrades / subjectsCount).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    printWindow.document.write(
        '<tr><td colspan="5"><strong>General Average: ' +
            finalGrade +
            '</strong></td><td colspan="2"><strong>Remark: ' +
            remark +
            "</strong></td></tr>"
    );
    printWindow.document.write("</table>");

    // Close the body and open print window
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
});

$("#downloadHtmlButtonSix").on("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const logoUrl = "/assets/images/SELC.png";
    const topMargin = 5;

    const logoWidth = 15;
    const logoHeight = 15;
    doc.addImage(logoUrl, "PNG", 10, 10, logoWidth, logoHeight);

    const title = "St. Emilie Learning Center";
    doc.setFontSize(20);
    doc.setTextColor(40, 40, 40);
    const titleWidth = doc.getTextWidth(title);
    const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
    doc.text(title, titleX, 18);

    const address = "Amparo Village, 18 Bangkal, Caloocan, Metro Manila";
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    const addressWidth = doc.getTextWidth(address);
    const addressX = (doc.internal.pageSize.width - addressWidth) / 2;
    doc.text(address, addressX, 23);

    const reportTitle = "REPORT OF GRADES";
    doc.setFontSize(22);
    doc.setTextColor(0, 0, 0);
    const reportWidth = doc.getTextWidth(reportTitle);
    const reportX = (doc.internal.pageSize.width - reportWidth) / 2;
    doc.text(reportTitle, reportX, 43);

    const leftColumnX = 10;
    const rightColumnX = 150;
    const astartY = 55;

    doc.setFontSize(10);

    // Student information
    doc.text(`LRN               :  ${lrn}`, leftColumnX, astartY);
    doc.text(`Fullname       :  ${studentName}`, leftColumnX, astartY + 5);
    doc.text(`Gender          :  ${gender}`, leftColumnX, astartY + 10);
    doc.text(`Grade            :  ${grade}`, leftColumnX, astartY + 15);
    doc.text(`Section          :  ${section}`, leftColumnX, astartY + 20);

    doc.text(
        `Student No        :  ${studentNumber}`,
        rightColumnX,
        astartY + 5
    );
    doc.text(`Academic Year  :  ${schoolYear}`, rightColumnX, astartY + 10);
    doc.text(
        `Date                   :  ${currentDate}`,
        rightColumnX,
        astartY + 15
    );
    doc.text(`Status                :  ${status}`, rightColumnX, astartY + 20);

    // Get grades from table
    const subjects = [];
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        subjects.push({
            name: subject,
            firstQuarterGrade: firstQuarter,
            secondQuarterGrade: secondQuarter,
            thirdQuarterGrade: thirdQuarter,
            fourthQuarterGrade: fourthQuarter,
            finalGrade: finalGrade,
            remarks: remarks,
        });
    });

    // Start the table
    const margin = 5;
    const bstartX = 5;
    const bstartY = 90;
    const bcolumnWidth = (doc.internal.pageSize.width - margin * 2) / 7;
    const headers = [
        "Learning Areas",
        "1st Quarter",
        "2nd Quarter",
        "3rd Quarter",
        "4th Quarter",
        "Final Grade",
        "Remarks",
    ];
    const headerHeight = 10;
    const startY = bstartY;
    const cellHeight = 5;

    // Draw table headers
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 0);
    doc.setFillColor(255, 255, 255);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight, "F");
    doc.setLineWidth(0.5);
    doc.rect(bstartX, startY, bcolumnWidth * headers.length, headerHeight);

    headers.forEach((header, index) => {
        doc.text(header, bstartX + index * bcolumnWidth + margin, startY + 8);
    });

    // Add subject rows to the table
    let totalGrades = 0;
    subjects.forEach((subject, index) => {
        const yPosition = startY + headerHeight + (index + 1) * cellHeight;
        doc.text(subject.name, bstartX + margin, yPosition);
        doc.text(
            subject.firstQuarterGrade,
            bstartX + bcolumnWidth + 20,
            yPosition
        );
        doc.text(
            subject.secondQuarterGrade,
            bstartX + 2 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.thirdQuarterGrade,
            bstartX + 3 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.fourthQuarterGrade,
            bstartX + 4 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(
            subject.finalGrade,
            bstartX + 5 * bcolumnWidth + 15,
            yPosition
        );
        doc.text(subject.remarks, bstartX + 6 * bcolumnWidth + 5, yPosition);

        if (!isNaN(parseFloat(subject.finalGrade))) {
            totalGrades += parseFloat(subject.finalGrade);
        }
    });

    // Add average and remarks at the bottom
    const average = (totalGrades / subjects.length).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    doc.text(
        `General Average: ${finalGrade}`,
        bstartX,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );
    doc.text(
        `Remark: ${remark}`,
        bstartX + bcolumnWidth * 6 - margin,
        startY + headerHeight + (subjects.length + 2) * cellHeight
    );

    // Create a new Date object
    const currentDateTime = new Date();

    // Format the date and time (e.g., "YYYY-MM-DD HH:mm:ss")
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };
    const datePrinted = currentDateTime
        .toLocaleString("en-GB", options)
        .replace(",", "");

    doc.text(`Date Printed : ${datePrinted} [${studentName}]`, 5, 180);

    // Save the PDF
    doc.save(`${studentName}` + "_grades_report_grade_two.pdf", {
        pageHeight: 297,
        pageWidth: 210,
    });
});

$("#printHtmlButtonSix").on("click", function () {
    // Create a new window or use an existing element for print
    const printWindow = window.open("", "", "height=800,width=1000");

    // Add content for printing
    printWindow.document.write(
        "<html><head><title>REPORT OF GRADES</title>"
    );
    printWindow.document.write("<style>");
    printWindow.document.write(
        "body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }"
    );
    printWindow.document.write(
        ".table { width: 100%; border-collapse: collapse; margin-top: 20px; }"
    );
    printWindow.document.write(
        ".table th, .table td { border: 1px solid #000; padding: 5px; text-align: left; }"
    );
    printWindow.document.write(".table th { background-color: #f2f2f2; }");
    printWindow.document.write("</style></head><body>");

    // Add logo, title, and address
    printWindow.document.write(
        '<img src="../assets/images/SELC.png" width="50" height="50" />'
    );
    printWindow.document.write(
        '<h1 style="text-align:center;">St. Emilie Learning Center</h1>'
    );
    printWindow.document.write(
        '<p style="text-align:center;">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>'
    );
    printWindow.document.write(
        '<h2 style="text-align:center;">REPORT OF GRADES</h2>'
    );

    // Add student information
    printWindow.document.write('<table style="width: 100%;">');
    printWindow.document.write(
        "<tr><td><strong>LRN</strong>: " +
            lrn +
            "</td><td><strong>Student No</strong>: " +
            studentNumber +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Fullname</strong>: " +
            studentName +
            "</td><td><strong>Academic Year</strong>: " +
            schoolYear +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Gender</strong>: " +
            gender +
            "</td><td><strong>Date</strong>: " +
            currentDate +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Grade</strong>: " +
            grade +
            "</td><td><strong>Status</strong>: " +
            status +
            "</td></tr>"
    );
    printWindow.document.write(
        "<tr><td><strong>Section</strong>: " + section + "</td></tr>"
    );
    printWindow.document.write("</table>");

    // Create table headers for grades
    printWindow.document.write('<table class="table">');
    printWindow.document.write("<thead>");
    printWindow.document.write(
        "<tr><th>Learning Areas</th><th>1st Quarter</th><th>2nd Quarter</th><th>3rd Quarter</th><th>4th Quarter</th><th>Final Grade</th><th>Remarks</th></tr>"
    );
    printWindow.document.write("</thead>");

    // Get grades from table and add rows to the table
    document.querySelectorAll(".subject-row").forEach((row) => {
        const subject = row.cells[0].textContent;
        const firstQuarter = row.cells[1].textContent;
        const secondQuarter = row.cells[2].textContent;
        const thirdQuarter = row.cells[3].textContent;
        const fourthQuarter = row.cells[4].textContent;
        const finalGrade = row.cells[5].textContent;
        const remarks = parseFloat(finalGrade) >= 75 ? "Passed" : "Failed";

        printWindow.document.write("<tr>");
        printWindow.document.write("<td>" + subject + "</td>");
        printWindow.document.write("<td>" + firstQuarter + "</td>");
        printWindow.document.write("<td>" + secondQuarter + "</td>");
        printWindow.document.write("<td>" + thirdQuarter + "</td>");
        printWindow.document.write("<td>" + fourthQuarter + "</td>");
        printWindow.document.write("<td>" + finalGrade + "</td>");
        printWindow.document.write("<td>" + remarks + "</td>");
        printWindow.document.write("</tr>");
    });

    // Add average and remarks at the bottom
    let totalGrades = 0;
    let subjectsCount = 0;
    document.querySelectorAll(".subject-row").forEach((row) => {
        const finalGrade = row.cells[5].textContent;
        if (!isNaN(parseFloat(finalGrade))) {
            totalGrades += parseFloat(finalGrade);
            subjectsCount++;
        }
    });
    const average = (totalGrades / subjectsCount).toFixed(2);
    let finalGrade;

    if (average >= 100) {
        finalGrade = 100;
    } else if (average >= 98.4) {
        finalGrade = 99;
    } else if (average >= 96.8) {
        finalGrade = 98;
    } else if (average >= 95.2) {
        finalGrade = 97;
    } else if (average >= 93.6) {
        finalGrade = 96;
    } else if (average >= 92.0) {
        finalGrade = 95;
    } else if (average >= 90.4) {
        finalGrade = 94;
    } else if (average >= 88.8) {
        finalGrade = 93;
    } else if (average >= 87.2) {
        finalGrade = 92;
    } else if (average >= 85.6) {
        finalGrade = 91;
    } else if (average >= 84.0) {
        finalGrade = 90;
    } else if (average >= 82.4) {
        finalGrade = 89;
    } else if (average >= 80.8) {
        finalGrade = 88;
    } else if (average >= 79.2) {
        finalGrade = 87;
    } else if (average >= 77.6) {
        finalGrade = 86;
    } else if (average >= 76.0) {
        finalGrade = 85;
    } else if (average >= 74.4) {
        finalGrade = 84;
    } else if (average >= 72.8) {
        finalGrade = 83;
    } else if (average >= 71.2) {
        finalGrade = 82;
    } else if (average >= 69.6) {
        finalGrade = 81;
    } else if (average >= 68.0) {
        finalGrade = 80;
    } else if (average >= 66.4) {
        finalGrade = 79;
    } else if (average >= 64.8) {
        finalGrade = 78;
    } else if (average >= 63.2) {
        finalGrade = 77;
    } else if (average >= 61.6) {
        finalGrade = 76;
    } else if (average >= 60.0) {
        finalGrade = 75;
    } else if (average >= 56.0) {
        finalGrade = 74;
    } else if (average >= 52.0) {
        finalGrade = 73;
    } else if (average >= 48.0) {
        finalGrade = 72;
    } else if (average >= 44.0) {
        finalGrade = 71;
    } else if (average >= 40.0) {
        finalGrade = 70;
    } else if (average >= 36.0) {
        finalGrade = 69;
    } else if (average >= 32.0) {
        finalGrade = 68;
    } else if (average >= 28.0) {
        finalGrade = 67;
    } else if (average >= 24.0) {
        finalGrade = 66;
    } else if (average >= 20.0) {
        finalGrade = 65;
    } else if (average >= 16.0) {
        finalGrade = 64;
    } else if (average >= 12.0) {
        finalGrade = 63;
    } else if (average >= 8.0) {
        finalGrade = 62;
    } else if (average >= 4.0) {
        finalGrade = 61;
    } else {
        finalGrade = 60;
    }

    const remark = finalGrade >= 75 ? "Passed" : "Failed";

    printWindow.document.write(
        '<tr><td colspan="5"><strong>General Average: ' +
            finalGrade +
            '</strong></td><td colspan="2"><strong>Remark: ' +
            remark +
            "</strong></td></tr>"
    );
    printWindow.document.write("</table>");

    // Close the body and open print window
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();
});
