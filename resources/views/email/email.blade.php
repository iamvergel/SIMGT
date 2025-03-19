<!DOCTYPE html>
<html>

<head>
    <title>Test Email</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .container {
            padding: 5px;
            max-width: 400px;
            margin: auto;
        }

        .header-img {
            height: 175px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: auto;
            object-fit: cover;
        }

        .bg-gray {
            background-color: #e5e7eb;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            font-size: 12px;
            margin-top: 0.5rem;
        }

        .footer {
            margin-top: 0.5rem;
            background-color: #134e4a;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }

        .footer img {
            height: 40px;
            margin-right: 5px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/462537292_515369887923680_7814019648934416783_n.png"
            alt="SELC" class="header-img">

        <div class="bg-gray">
            <p style="margin-bottom: 1rem;">
                Dear {{ $student->student_first_name }} {{ $student->student_last_name }},
            </p>
            <p style="margin-bottom: 1rem;">
                We are pleased to inform you that your student portal account is now active. You can use the following
                credentials to log in and access your academic information:
            </p>
            <p style="margin-bottom: 1rem;">
                <strong>Login Credentials:</strong><br>
                Username (Email):
                {{ strtolower($student->student_last_name) }}{{ strtolower($student->student_first_name) }}@stemilie.edu.ph<br>
                Password: SELC{{ $student->student_last_name }}{{ substr($student->student_number, -4) }}<br>
            </p>
            <p style="margin-bottom: 1rem;">
                You can log in to the portal by visiting the following link: [https://www.simgt66.com]
            </p>
            <p style="margin-bottom: 1rem;">
                <strong>Important Notes:</strong><br>
                After logging in for the first time, we recommend you change your password to something more secure.<br>
                We wish you the best of luck with your studies.
            </p style="margin-bottom: 1rem;">
            <p style="margin-bottom: 1rem;">
                Best regards,<br>
                St. Emilie Learning Center<br><br>
                <a href="mailto:theemilians@gmail.com">theemilians@gmail.com</a><br>
                +63 915 521 8235
            </p>
        </div>

        <div class="footer">
            <img src="https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/SELC.png"
                alt="SELC">
            <img src="https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/grouplogo.png"
                alt="Logo">
            <div style="font-size: 15px; margin-left: 5px;">
                <p>St Emilie Learning Center</p>
                <p style="font-size: 12px">HopeSci66.SIMGT66</p>
            </div>
        </div>
    </div>
</body>

</html>