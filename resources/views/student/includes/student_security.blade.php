@php
    $firstName = session('student_first_name', 'Guest');
    $lastName = session('student_last_name', '');
    $middleName = session('student_middle_name', '');
    $suffixName = session('student_suffix_name', '');
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

    $user = Auth::guard('student')->user();
    $avatarPath = $user && $user->avatar ? asset('storage/' . $user->avatar) : null;
@endphp

<div class="p-2">
    <div class="header py-5 bg-teal-800 mt-2 px-5 text-white font-bold text-[15px] rounded-lg">
        <p><i class="fas fa-user mr-2"></i>Security</p>
    </div>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");

            document.getElementById('logoutForm').submit();
        </script>
    @endif


    @if($errors->any())
        <script>
            alert("{{ implode('\\n', $errors->all()) }}");
        </script>
    @endif


    <div class="p-5 bg-gray-100 shadow-lg mt-5">
        <div class="p-10">
            <form action="{{ route('student.changePassword', ['studentId' => $user->id]) }}" method="POST"
                id="change-password-form">
                @csrf
                <div class="mb-4">
                    <label for="currentPassword" class="block text-emerald-900">Current Password</label>
                    <input type="password" name="currentPassword" id="currentPassword" required
                        class="form-input block text-sm text-normal text-emerald-900 tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5"
                        oninput="checkInputs()">
                </div>
                <div class="mb-4">
                    <label for="newPassword" class="block text-emerald-900">New Password</label>
                    <input type="password" name="newPassword" id="newPassword" required
                        class="form-input block text-sm text-normal text-emerald-900 tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5"
                        oninput="checkInputs()">
                </div>
                <div class="mb-4">
                    <label for="newPasswordConfirmation" class="block text-emerald-900">Confirm New Password</label>
                    <input type="password" name="newPasswordConfirmation" id="newPasswordConfirmation" required
                        class="form-input block text-sm text-normal text-emerald-900 tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5"
                        oninput="checkInputs()">
                </div>
                <div class="mb-4 flex items-center mt-5">
                    <input type="checkbox" id="toggle-password" onclick="togglePasswordVisibility()" class="mr-2">
                    <label for="toggle-password" class="text-emerald-900 text-[15px]">Show Passwords</label>
                </div>

                <button type="submit" id="change-password-button"
                    class="bg-sky-700 hover:bg-sky-800 text-white py-2 px-4 rounded mr-5 mt-10" disabled>Change
                    Password</button>
                <button type="button" onclick="clearInputs()"
                    class="bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded mt-3 lg:mt-0">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script>
    function checkInputs() {
        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const newPasswordConfirmation = document.getElementById('newPasswordConfirmation').value;

        const changePasswordButton = document.getElementById('change-password-button');
        changePasswordButton.disabled = !(currentPassword && newPassword && newPasswordConfirmation);

        const confirmPasswordField = document.getElementById('newPasswordConfirmation');

        // Check if new password and confirmation match
        if (newPassword !== newPasswordConfirmation) {
            confirmPasswordField.classList.remove('border-green-500'); // Remove green border
            confirmPasswordField.classList.add('border-red-500'); // Add red border
            changePasswordButton.disabled = true; // Disable the button
        } else {
            confirmPasswordField.classList.remove('border-red-500'); // Remove red border
            confirmPasswordField.classList.add('border-green-500'); // Add green border
            changePasswordButton.disabled = false; // Enable the button if all fields are filled
        }
    }

    function clearInputs() {
        document.getElementById('currentPassword').value = '';
        document.getElementById('newPassword').value = '';
        document.getElementById('newPasswordConfirmation').value = '';
        checkInputs(); // Check inputs again to disable the button
    }

    function togglePasswordVisibility() {
        const fields = ['currentPassword', 'newPassword', 'newPasswordConfirmation'];
        fields.forEach(field => {
            const input = document.getElementById(field);
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    }
</script>