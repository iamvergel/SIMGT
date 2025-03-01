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
        <p><i class="fas fa-user mr-2"></i>Account</p>
    </div>

    <div class="p-5 bg-gray-100 shadow-lg mt-5">
        <div class="text-[15px] text-teal-900">
            <p class="font-bold">Avatar</p>
            <p>Display Profile</p>
            <div class="block lg:w-96">
                <div class="flex justify-center items-center lg:justify-center">
                    <div class="mt-10 w-32 h-32 border-4 border-white bg-gray-600 rounded-full flex items-center justify-center text-white text-4xl font-semibold transition-all duration-300 shadow-lg"
                        id="profile">
                        @if ($avatarPath !== null)
                            <div class="relative">
                                <img id="avatar-img" src="{{ $avatarPath }}" alt="{{ $initials }}"
                                    class="rounded-full w-32 h-32 object-cover cursor-pointer" onclick="showProfile()">

                                <!-- Modal -->
                                <div id="image-modal"
                                    class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
                                    <span class="absolute top-4 right-4 text-white text-2xl cursor-pointer"
                                        onclick="closeProfile()">&times;</span>
                                    <img class="modal-content max-w-full max-h-full" id="full-image">
                                    <div id="caption" class="text-white mt-4"></div>
                                </div>
                            </div>

                        @else
                            <div id="avatar-div"
                                class="flex items-center justify-center w-full h-full rounded-full @if ($avatarPath !== null) bg-cover @else bg-gray-500 @endif"
                                style="@if ($avatarPath !== null) background-image: url('{{ $avatarPath }}'); background-size: cover; background-position: center; @endif">
                                <span class="text-white">{{ $initials }}</span> <!-- Display initials if avatar is null -->
                            </div>
                        @endif
                    </div>
                </div>

                <form id="avatar-form" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="student_number"
                        value="{{ Auth::guard('student')->check() ? Auth::guard('student')->user()->student_number : '' }}"
                        required class="mt-2" />

                    <input type="file" name="avatar" accept="image/*" id="avatar-input"
                        onchange="handleFileInput(event)" class="sr-only">

                    <button type="button" onclick="document.getElementById('avatar-input').click()"
                        class="bg-teal-600 mt-10 w-full py-3 text-center rounded-full text-white hover:bg-teal-800 focus:outline-none"
                        id="buttonClick">
                        Choose Image
                    </button>
                    <button type="submit"
                        class="bg-teal-600 mt-2 w-full py-3 text-center rounded-full text-white hover:bg-teal-800"
                        id="buttonClick">
                        Update Avatar
                    </button>

                    <p class="rounded-md mt-5" id="alert"></p>
                </form>
            </div>
        </div>

        <div class="accountInfo mt-10 text-[15px] text-teal-900 p-5 shadow-lg font-semibold">
            <p class="mb-3"> {{ session('student_id') }}</p>
            <p class="mb-3"> {{ $firstName . ' ' . $middleName . ' ' . $lastName }}</p>
            <p class="mb-3">{{ session('grade') . ' - ' . session('section')}}</p>
        </div>

        <div class="form text-[15px] text-teal-900 mt-10">
            <p class="font-bold">Account</p>
            <p class="text-[13px] mb-5">Following information is publicly displayed.</p>

            <form action="" aria-readonly="">
                <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-5">
                    <div class=" my-3">
                        <label for="firstname" class="block mb-1 text-sm font-normal text-teal-900">First Name :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2 "></i>
                            <input type="text" name="firstname" id="firstname"
                                class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{$firstName}}" readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="middlename" class="block mb-1 text-sm font-normal text-teal-900">Middle Name
                            :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2 "></i>
                            <input type="text" name="middlename" id="middlename"
                                class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{$middleName}}" readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="lastname" class="block mb-1 text-sm font-normal text-teal-900">Last Name :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2 "></i>
                            <input type="text" name="lastname" id="lastname"
                                class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{$lastName}}" readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="suffixname" class="block mb-1 text-sm font-normal text-teal-900">Suffix Name
                            :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fas fa-user mr-2 "></i>
                            <input type="text" name="suffixname" id="suffixname"
                                class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{$suffixName}}" readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="username" class="block mb-1 text-sm font-normal text-teal-900">Username :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fa-solid fa-address-card mr-2"></i>
                            <input type="text" name="username" id="username"
                                class="myInput block w-full p-2.5 text-[13px] focus:outline-none focus:ring-none"
                                value="{{session('student_username')}}" readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="role" class="block mb-1 text-sm font-normal text-teal-900">Role/s :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fa-solid fa-address-card mr-2"></i>
                            <input type="text" name="role" id="role"
                                class="myInput block w-full p-2.5  focus:outline-none focus:ring-none" value="Student"
                                readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="school" class="block mb-1 text-sm font-normal text-teal-900">School :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fa-solid fa-school mr-2"></i>
                            <input type="text" name="school" id="school"
                                class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="St. Emelie Learning Center" readonly>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <p class="font-bold mt-10">Personal Information</p>
                        <p class="text-[13px] mb-5">Communication details in case we want to connect with you.</p>
                    </div>

                    <div class="my-3">
                        <label for="email" class="block mb-1 text-sm font-normal text-teal-900">Email :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fa-solid fa-envelope mr-2"></i>
                            <input type="text" name="email" id="email"
                                class="myInput block w-full p-2.5 text-[13px]  focus:outline-none focus:ring-none"
                                value="{{ session('email_address_send')}}" readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="contact" class="block mb-1 text-sm font-normal text-teal-900">Contact Number
                            :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <i class="fa-solid fa-mobile mr-2"></i>
                            <input type="text" name="contact" id="contact"
                                class="myInput block w-full p-2.5  focus:outline-none focus:ring-none"
                                value="{{ session('contact_number') }}" readonly>
                        </div>
                    </div>

                    <div class="my-3">
                        <label for="birthday" class="block mb-1 text-sm font-normal text-teal-900">Birthday :</label>
                        <div class="flex items-center text-gray-500 bg-white border border-gray-300 px-5">
                            <input type="date" name="birthday" id="birthday"
                                class="myInput block w-full p-2.5 focus:outline-none focus:ring-none"
                                value="{{ session('birth_date') }}" readonly>
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showProfile() {
        const modal = document.getElementById("image-modal");
        const fullImage = document.getElementById("full-image");
        const caption = document.getElementById("caption");

        fullImage.src = document.getElementById("avatar-img").src;
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
                    alert.classList.add('p-3');
                    alert.classList.add('border');
                    alert.classList.add('border-red-500');
                    alert.classList.add('bg-red-100');
                    alert.classList.add('text-red-500');
                    alert.innerHTML = 'Invalid file type. Please upload an image (jpeg, png, jpg, gif).';

                    setTimeout(function () {
                        alert.innerHTML = '';
                        alert.classList.remove('p-3');
                        alert.classList.remove('border');
                        alert.classList.remove('border-red-500');
                        alert.classList.remove('bg-red-100');
                        alert.classList.remove('text-red-500');
                    }, 3000);

                    return;
                }
                if (file.size > 2048 * 1024) { // 2048 KB
                    alert.classList.add('p-3');
                    alert.classList.add('border');
                    alert.classList.add('border-red-500');
                    alert.classList.add('bg-red-100');
                    alert.classList.add('text-red-500');
                    alert.innerHTML = 'File size exceeds 2 MB. Please upload a smaller image.';

                    setTimeout(function () {
                        alert.innerHTML = '';
                        alert.classList.remove('p-3');
                        alert.classList.remove('border');
                        alert.classList.remove('border-red-500');
                        alert.classList.remove('bg-red-100');
                        alert.classList.remove('text-red-500');
                    }, 3000);

                    return;
                }
            } else {
                alert.classList.add('p-3');
                alert.classList.add('border');
                alert.classList.add('border-red-500');
                alert.classList.add('bg-red-100');
                alert.classList.add('text-red-500');
                alert.innerHTML = 'Please input image first.';

                setTimeout(function () {
                    alert.innerHTML = '';
                    alert.classList.remove('p-3');
                    alert.classList.remove('border');
                    alert.classList.remove('border-red-500');
                    alert.classList.remove('bg-red-100');
                    alert.classList.remove('text-red-500');
                }, 3000);

                return;
            }

            const formData = new FormData(form);

            fetch('{{ route('student.update-avatar') }}', {
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
                            document.getElementById('avatar-img'),
                            document.getElementById('avatar-img2'),
                            document.getElementById('avatar-img3'),
                            document.getElementById('avatar-img4'),
                            document.getElementById('avatar-img5')
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

                        setTimeout(() => {
                            location.reload();
                        }, 500);
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
            alert.classList.add('bg-red-100');
            alert.classList.add('text-red-500');
            alert.innerHTML = message;

            setTimeout(function () {
                alert.innerHTML = '';
                alert.classList.remove('p-3');
                alert.classList.remove('border');
                alert.classList.remove('border-red-500');
                alert.classList.remove('bg-red-100');
                alert.classList.remove('text-red-500');
            }, 3000);
        }

        function showSuccessAlert(message) {
            const alert = document.getElementById('alert');
            alert.classList.add('p-3');
            alert.classList.add('border');
            alert.classList.add('border-green-500'); // Use green color for success alert
            alert.classList.add('bg-green-100');
            alert.classList.add('text-green-500'); // Use white color for success alert
            alert.innerHTML = message;

            setTimeout(function () {
                alert.innerHTML = '';
                alert.classList.remove('p-3');
                alert.classList.remove('border');
                alert.classList.remove('border-green-500');
                alert.classList.remove('bg-green-100');
                alert.classList.remove('text-green-500');
            }, 3000);
        }
    });
</script>