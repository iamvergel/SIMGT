@php
    $firstName = session('teacher_fname', 'Guest');
    $lastName = session('teacher_lname', '');
    $middleName = session('teacher_mname', '');
    $suffixName = session('teacher_sname', '');
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

    $user = Auth::guard('teacher')->user();
    $avatarPath = $user && $user->avatar ? asset('storage/' . $user->avatar) : null;
@endphp

@include('teacher.includes.header')

<body class="font-poppins bg-gray-200">
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('teacher.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('teacher.includes.topnav')
            </header>

            <div class="p-5">
                <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                <h1 class="text-2xl font-bold text-teal-900 ml-5">SIMGT Profile /
                    {{ $firstName . ' ' . $middleName . ' ' . $lastName ?: 'Guest' }}</h1>

                <div class="bg-teal-800 p-5 shadow-lg mt-10 rounded-t-lg">
                    <h2 class="text-md font-semibold text-white">
                        <i class="fas fa-user text-white mr-2"></i> SIMGT PROFILE
                    </h2>
                </div>

                <div class="grid grid-cols-6 mt-1 border-t-2 border-teal-800">
                    <div class="col-span-2 bg-gray-200">
                        <div class=" p-5 h-auto">
                            <div class="flex justify-center ">
                                <div class="text-[15px] text-teal-900">
                                    <div class="block lg:w-96">
                                        <div class="flex justify-center items-center lg:justify-center">
                                            <div class="mt-10 w-32 h-32 border-4 border-white bg-gray-600 rounded-full flex items-center justify-center text-white text-4xl font-semibold transition-all duration-300 shadow-lg"
                                                id="profile">
                                                @if ($avatarPath !== null)
                                                    <div class="relative">
                                                        <div id="avatar-div"
                                                            class="absolute z-10 items-center justify-center w-full h-full rounded-full @if ($avatarPath !== null) bg-cover @else bg-teal-700 @endif"
                                                            onclick="showProfile()"
                                                            style="@if ($avatarPath !== null) background-image: url('{{ $avatarPath }}'); background-size: cover; background-position: center; @endif">

                                                        </div>
                                                        <img id="avatar-img3" src="{{ $avatarPath }}" alt="{{ $initials }}"
                                                            class="rounded-full w-32 h-32 object-cover cursor-pointer">

                                                        <!-- Modal -->
                                                        <div id="image-modal"
                                                            class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
                                                            <span
                                                                class="absolute top-4 right-4 text-white text-2xl cursor-pointer"
                                                                onclick="closeProfile()">&times;</span>
                                                            <img class="modal-content max-w-full max-h-full"
                                                                id="full-image">
                                                            <div id="caption" class="text-white mt-4"></div>
                                                        </div>
                                                    </div>

                                                @else
                                                    <div id="avatar-div"
                                                        class="flex items-center justify-center w-full h-full rounded-full @if ($avatarPath !== null) bg-cover @else bg-teal-700 @endif"
                                                        style="@if ($avatarPath !== null) background-image: url('{{ $avatarPath }}'); background-size: cover; background-position: center; @endif">
                                                        <span class="text-white">{{ $initials }}</span>
                                                        <!-- Display initials if avatar is null -->
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-center mt-5 text-teal-800 ">
                                            <p
                                                class="text-lg tracking-widest font-semibold  shadow-text-lg mt-2 leading-3">
                                                {{ $firstName . ' ' . $middleName . ' ' . $lastName ?: 'Guest' }}
                                            </p>
                                            <span
                                                class="text-xs tracking-widest font-normal shadow-text-lg mt-0"> {{ session('admin_number') ?? 'Guest' }} | {{ session('admin_username') ?? 'Guest' }}</span>
                                            <p class="text-xs">
                                                {{ session('admin_role') ?? 'Guest' }}
                                            </p>
                                        </div>

                                        <form id="avatar-form" method="POST" action="" enctype="multipart/form-data"
                                            class="lg:px-20 2xl:px-0" class="">
                                            @csrf
                                            <input type="hidden" name="id"
                                                value="{{ Auth::guard('teacher')->check() ? Auth::guard('teacher')->user()->id : '' }}"
                                                required class="mt-2" />

                                            <input type="file" name="avatar" accept="image/*" id="avatar-input"
                                                onchange="handleFileInput(event)" class="sr-only">

                                            <div class=" mt-10 grid grid-cols-1 2xl:grid-cols-2 xl:px-2">
                                                <button type="button"
                                                    onclick="document.getElementById('avatar-input').click()"
                                                    class="text-[12px] text-white shadow-lg bg-sky-700 rounded-full shadow hover:bg-sky-600 px-3 mt-3 me-2"
                                                    id="buttonClick">
                                                    <i class="fa-solid fa-image me-1"></i> Choose Image
                                                </button>
                                                <button type="submit"
                                                    class="text-[12px] text-white shadow-lg bg-teal-700 rounded-full shadow hover:bg-teal-600 px-3 mt-3 me-2"
                                                    id="buttonClick">
                                                    <i class="fa-solid fa-pen-to-square me-1"></i> Update Avatar
                                                </button>
                                            </div>

                                            <p class="text-red-900 text-[14px] mt-5 bg-red-300 rounded-md" id="alert">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center font-bold mt-5 ">


                            </div>
                            <hr class="border-1 border-gray-400 mt-5">

                        </div>
                    </div>
                    <div class="col-span-4 bg-white p-5">
                        <div class="mt-3 text-[12px] w-full">
                            <ul
                                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-1 xl:gap-1 bg-gray-50 p-0 m-0">
                                <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 active1"
                                    data-target="#Information">Update Information</li>
                                <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5"
                                    data-target="#password">Change Password</li>
                            </ul>
                        </div>
                        <!-- Update Admin Info Form -->
                        <div class="table-container h-auto w-full border-t-2 border-teal-900" id="Information">
                            @if(session('success'))
                                <div id="success-alert" class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form id="update-form" action="{{ route('admin.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 p-10">
                                    <div>
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="">
                                            <span class="text-red-600 mr-1">*</span>First Name
                                        </label>
                                        <input type="text" name="first_name" placeholder=""
                                            value="{{ $user->first_name }}"
                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" />
                                    </div>

                                    <div>
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="">
                                            <span class="text-red-600 mr-1">*</span>Middle Name
                                        </label>
                                        <input type="text" name="middle_name" placeholder=""
                                            value="{{ $user->middle_name }}"
                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" />
                                    </div>

                                    <div>
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="">
                                            <span class="text-red-600 mr-1">*</span>Last Name
                                        </label>
                                        <input type="text" name="last_name" placeholder=""
                                            value="{{ $user->last_name }}"
                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" />
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="flex justify-end mt-5">
                                    <button type="submit"
                                        class="bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 px-20 rounded-full">
                                        <i class="fa-solid fa-pen-to-square me-1"></i> Update Information
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="table-container h-auto  w-full border-t-2 border-teal-900 " id="password"
                            style="display:none;">
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

                            <div class="p-10">
                                <form action="{{ route('admin.changePassword', $user->id) }}" method="POST"
                                    id="change-password-form">
                                    @csrf
                                    <div class="mb-4">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="">
                                            <span class="text-red-600 mr-1">*</span>Current Password
                                        </label>
                                        <input type="password" name="currentPassword" id="currentPassword" required
                                            class="form-input block text-sm text-normal text-emerald-900 tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5"
                                            oninput="checkInputs()">
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="">
                                            <span class="text-red-600 mr-1">*</span>New Password
                                        </label>
                                        <input type="password" name="newPassword" id="newPassword" required
                                            class="form-input block text-sm text-normal text-emerald-900 tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5"
                                            oninput="checkInputs()">
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="">
                                            <span class="text-red-600 mr-1">*</span>Confirm Password
                                        </label>
                                        <input type="password" name="newPasswordConfirmation"
                                            id="newPasswordConfirmation" required
                                            class="form-input block text-sm text-normal text-emerald-900 tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5"
                                            oninput="checkInputs()">
                                    </div>
                                    <div class="mb-4 flex items-center mt-5">
                                        <input type="checkbox" id="toggle-password" onclick="togglePasswordVisibility()"
                                            class="mr-2">
                                        <label for="toggle-password" class="text-emerald-900 text-[15px]">Show
                                            Passwords</label>
                                    </div>

                                    <button type="submit" id="change-password-button"
                                        class="bg-sky-700 hover:bg-sky-800 text-white py-2 px-4 rounded mr-5 mt-10"
                                        disabled>Change Password</button>
                                    <button type="button" onclick="clearInputs()"
                                        class="bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded mt-3 lg:mt-0">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        setTimeout(function () {
            var alert = document.getElementById('success-alert');
            if (alert) {
                alert.classList.add('fade-out');
                setTimeout(function () {
                    alert.style.display = 'none';
                }, 1000); // Time to wait before hiding after fade-out
            }
        }, 1000);

        function showProfile() {
            const modal = document.getElementById("image-modal");
            const fullImage = document.getElementById("full-image");
            const caption = document.getElementById("caption");

            fullImage.src = document.getElementById("avatar-img3").src;
            modal.classList.remove("hidden");
        }

        // Close modal when clicking outside the image
        window.addEventListener('click', (event) => {
            const modal = document.getElementById("image-modal");
            if (event.target === modal) { // Only close if the background is clicked
                modal.classList.add("hidden"); // Hide the modal
            }
        });

        // Close modal when clicking the close button
        function closeProfile() {
            const modal = document.getElementById("image-modal");
            modal.classList.add("hidden"); // Hide the modal
        }


        function handleFileInput(event) {
            const file = event.target.files[0];
            if (file) {
                previewImage(file);
            }
        }

        function previewImage(file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                updateImagePreview(e.target.result);
            }

            reader.readAsDataURL(file);
        }

        function updateImagePreview(imageSrc) {
            const imgElement = document.getElementById('avatar-img');
            const avatarDiv = document.getElementById('avatar-div');

            if (avatarDiv) {
                avatarDiv.style.backgroundImage = `url(${imageSrc})`; // Set the background image
                avatarDiv.style.backgroundSize = 'cover'; // Ensure the image covers the div
                avatarDiv.style.backgroundPosition = 'center'; // Center the image
            }

            if (imgElement) {
                imgElement.src = imageSrc; // Update the image source
            }
        }

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

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('avatar-form');

            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                const fileInput = document.getElementById('avatar-input');
                const file = fileInput.files[0];

                const alert = document.getElementById('alert');

                // Validate file type and size
                if (file) {
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        showErrorAlert('Invalid file type. Please upload an image (jpeg, png, jpg, gif).');
                        return;
                    }
                    if (file.size > 2048 * 1024) { // 2048 KB
                        showErrorAlert('File size exceeds 2 MB. Please upload a smaller image.');
                        return;
                    }
                } else {
                    showErrorAlert('Please select a picture first.');
                    return;
                }

                const formData = new FormData(form);

                fetch('{{ route('teacher.update-avatar') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.avatar) {
                            // Update the image sources
                            const avatarImgElements = [
                                document.getElementById('avatar-img1'),
                                document.getElementById('avatar-img2'),
                                document.getElementById('avatar-img3')
                            ];

                            // Show success alert before reloading
                            showSuccessAlert('Profile picture updated successfully!');

                            avatarImgElements.forEach(imgElement => {
                                if (imgElement) {
                                    imgElement.src = data.avatar;
                                }
                            });

                            // Update avatar-div background image
                            const avatarDiv = document.getElementById('avatar-div');
                            avatarDiv.style.backgroundImage = `url(${data.avatar})`; // Set the background image
                            avatarDiv.style.backgroundSize = 'cover'; // Ensure the image covers the div
                            avatarDiv.style.backgroundPosition = 'center'; // Center the image

                            // Reload the page after the success alert is shown
                            setTimeout(() => {
                                location.reload();
                            }, 500); // Delay the page reload to give time for the alert to be seen
                        } else if (data.error) {
                            showErrorAlert(data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            function showErrorAlert(message) {
                const alert = document.getElementById('alert');
                alert.classList.add('p-3');
                alert.classList.add('border');
                alert.classList.add('border-red-500');
                alert.innerHTML = message;

                setTimeout(function () {
                    alert.innerHTML = '';
                    alert.classList.remove('p-3');
                    alert.classList.remove('border');
                    alert.classList.remove('border-red-500');
                }, 3000);
            }

            function showSuccessAlert(message) {
                const alert = document.getElementById('alert');
                alert.classList.add('p-3');
                alert.classList.add('border');
                alert.classList.add('border-green-500'); // Use green color for success alert
                alert.innerHTML = message;

                setTimeout(function () {
                    alert.innerHTML = '';
                    alert.classList.remove('p-3');
                    alert.classList.remove('border');
                    alert.classList.remove('border-green-500');
                }, 3000);
            }
        });
    </script>
    <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
    @include('admin.includes.js-link')
</body>

<style>
    .active1 {
        background-color: #115e59;
        color: white;
    }

    .fade-out {
        opacity: 0;
        transition: opacity 1s ease-out;
    }
</style>

</html>