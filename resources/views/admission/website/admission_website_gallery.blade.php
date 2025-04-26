@include('admission.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('admission.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('admission.includes.topnav')
            </header>

            <div class="p-5">
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span class="hover:text-teal-700">Manage Admission Website</span> / Gallery
                    </p>
                </div>

                <div class="flex justify-end items-center gap-4 mt-10">
                    <button
                        class="px-4 py-2 me-2 px-10 bg-teal-700 text-md font-semibold hover:bg-teal-800 text-white rounded mt-4"
                        onclick="openWebsiteModal()">Show Gallery In Website</button>
                    <button
                        class="px-4 py-2 me-10 px-10 bg-teal-700 text-md font-semibold hover:bg-teal-800 text-white rounded mt-4"
                        onclick="openAddModal()">Add
                        New
                        Image</button>
                </div>

                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200 ">
                    <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px]">
                        <div class="p-5">
                            <table id="studentTable" class="p-3 display responsive nowrap" width="100%">
                                <thead class="bg-gray-200">
                                    <tr class="text-[12px] font-normal uppercase text-left text-black">
                                        <th class="export">Image</th>
                                        <th class="export">Category</th>
                                        <th class="export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>


            <div id="websiteModal" class="hidden">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[20] p-20">
                    <div class="absolute bg-gray-100 rounded-lg shadow-md p-2 w-[90%]">
                        <div class="flex justify-end items-center p-2 px-4 bg-white shadow-l rounded-md">
                            <span id="closeModalFormAnnouncement" onclick="closeWebsiteModal()"
                                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                                    class="fas fa-times fa-lg"></i></span>
                        </div>
                        <div class="">
                            <div id="website-container" class="w-full h-[650px]">
                                <iframe src="/Admission" width="100%"
                                    height="100%" class="border-0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Image Modal -->
            <div id="addImageModal" class="hidden">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[20]">
                    <div class="absolute bg-gray-100 rounded-lg shadow-lg p-5">
                        <div class="flex justify-between items-center p-2 px-4 bg-white shadow-l rounded-md">
                            <p class="font-bold text-teal-900">Add image</p>
                            <span id="closeModalFormAnnouncement" onclick="closeAddModal()"
                                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                                    class="fas fa-times fa-lg"></i></span>
                        </div>
                        <div class="">
                            <form id="addImageForm" enctype="multipart/form-data"
                                class="mt-5 bg-white p-5 rounded-lg shadow-lg border-2">

                                <div class="mb-4">
                                    <label for="announcementDate" class="font-semibold text-[15px] mt-4"><span
                                            class="text-red-500">*</span>Category</label>
                                    <select id="imageName" name="name"
                                        class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[14px]"
                                        required>
                                        <option value="">Select Category</option>
                                        <option value="Classroom">Classroom</option>
                                        <option value="Playground">Playground</option>
                                        <option value="Library">Library</option>
                                        <option value="Office">Office</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="imageFile" class="font-semibold text-[15px] mt-4"><span
                                            class="text-red-500">*</span>Image</label>
                                    <input type="file" id="imageFile" name="image"
                                        class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px] file:mr-4 file:rounded-full file:border-0 file:bg-teal-100 file:px-4 file:py-2 file:text-md file:font-semibold file:text-teal-800 hover:file:bg-teal-200"
                                        required>
                                    <small id="descriptionHelp" class="text-gray-500">Enter picture (jpeg, png anf
                                        jpg)</small>
                                </div>

                                <!-- <button type="submit"
                        class="mt-3 w-full bg-yellow-700 text-white py-2 rounded-lg hover:bg-yellow-800 transition py-5 ">
                        Add Announcement
                      </button> -->

                                <div class="flex justify-end">
                                    <!-- <button type="submit" id="delete"
                          class="mt-10 w-1/4 indent-[-2rem] bg-red-700 text-white rounded-lg hover:bg-red-800 transition py-2 text-md font-semibold me-2 hidden">Delete
                        </button> -->
                                    <button type="submit"
                                        class="mt-10 w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Image Modal -->
            <div id="editImageModal" class="hidden">
                <div class=" fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[20]">
                    <div class="absolute bg-gray-100 rounded-lg shadow-lg p-5">
                        <div class="flex justify-between items-center p-2 px-4 bg-white shadow-l rounded-md">
                            <p class="font-bold text-teal-900">Edit Image</p>
                            <span id="closeModalFormAnnouncement" onclick="closeEditModal()"
                                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                                    class="fas fa-times fa-lg"></i></span>
                        </div>
                        <div class="">
                            <form id="addImageForm" enctype="multipart/form-data"
                                class="mt-5 bg-white p-5 rounded-lg shadow-lg border-2">
                                <input type="hidden" id="editImageId" name="id">
                                <div class="mb-4">
                                    <label for="editImageName" class="font-semibold text-[15px] mt-4"><span
                                            class="text-red-500">*</span>Category</label>
                                    <select id="editImageName" name="name"
                                        class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[14px]"
                                        required>
                                        <option value="">Select Category</option>
                                        <option value="Classroom">Classroom</option>
                                        <option value="Playground">Playground</option>
                                        <option value="Library">Library</option>
                                        <option value="Office">Office</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="editImageFile" class="font-semibold text-[15px] mt-4"><span
                                            class="text-red-500">*</span>Image</label>
                                    <input type="file" id="editImageFile" name="image"
                                        class="w-full p-3 border-2 uppercase rounded-md focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px] file:mr-4 file:rounded-full file:border-0 file:bg-teal-100 file:px-4 file:py-2 file:text-md file:font-semibold file:text-teal-800 hover:file:bg-teal-200"
                                        required>
                                    <small id="descriptionHelp" class="text-gray-500">Enter picture (jpeg, png anf
                                        jpg)</small>
                                </div>

                                <div class="">
                                    <label for="currentAnnouncement" class="font-semibold text-[15px] mt-4">Current
                                        Announcement</label>
                                    <div class="w-[350px] h-[200px]">
                                        <img id="currentImage" src="" alt="" width="100%"
                                            class="w-full h-full object-cover">
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <!-- <button type="submit" id="delete"
                          class="mt-10 w-1/4 indent-[-2rem] bg-red-700 text-white rounded-lg hover:bg-red-800 transition py-2 text-md font-semibold me-2 hidden">Delete
                        </button> -->
                                    <button type="submit"
                                        class="mt-10 w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            // Fetch images from API and populate the table
            function fetchImages() {
                $.get('/api/images', function (data) {
                    table.clear();  // Clear any existing data
                    data.data.forEach(image => {
                        table.row.add([
                            `<img src="/storage/images/${image.file_name}" alt="${image.name}" class="w-36 h-auto">`,
                            `<p class="font-semibold text-md">${image.name}</p>`,
                            `<button onclick="editImage(${image.id})" class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-teal-700 rounded-full hover:bg-teal-600"><i class="fa-solid fa-square-pen"></i></button>
                             <button onclick="deleteImage(${image.id})" class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-red-700 rounded-full hover:bg-red-600"><i class="fa-solid fa-trash"></i></button>`
                        ]);
                    });
                    table.draw();
                });
            }

            // Add image form submit
            $('#addImageForm').on('submit', function (e) {
                e.preventDefault();  // Prevent the default form submit behavior
                let formData = new FormData(this);

                // Perform the AJAX request to add the image
                $.ajax({
                    url: '/api/images/store',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function () {
                        alert('Image added successfully!');
                        fetchImages();  // Refresh the image list
                        closeAddModal();  // Close the Add modal
                    }
                });
            });

            $('#editImageForm').on('submit', function (e) {
                e.preventDefault();  // Prevent the default form submit behavior
                let formData = new FormData(this);  // Collect the form data

                // Debugging: Log formData entries to check if 'name' is included
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ": " + pair[1]);
                }

                // Perform the AJAX request to update the image
                $.ajax({
                    url: `/api/images/${$('#editImageId').val()}`,
                    type: 'PUT',
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Let jQuery set the correct content type for FormData
                    success: function () {
                        fetchImages();  // Refresh the image list
                        closeEditModal();  // Close the Edit modal
                    },
                    error: function (xhr) {
                        // Log the error response to help with debugging
                        console.error(xhr.responseText);
                    }
                });
            });

            // Open Add Modal
            window.openAddModal = function () {
                $('#addImageModal').show();
                $('#addImageForm')[0].reset();  // Reset the form fields
            }

            // Close Add Modal
            window.closeAddModal = function () {
                $('#addImageModal').hide();
            }

            // Open Add Modal with Refresh
            window.openWebsiteModal = function () {
                const modal = $('#websiteModal');
                modal.show();
                modal.load(location.href + " #websiteModal>*", "");
            }

            // Close Add Modal
            window.closeWebsiteModal = function () {
                $('#websiteModal').hide();
            }

            // Open Edit Modal
            window.editImage = function (id) {
                $.get(`/api/images/${id}`, function (data) {
                    $('#editImageId').val(data.id);  // Set the image ID
                    $('#editImageName').val(data.name);  // Set the current category
                    $("#currentImage").attr("src", "/storage/images/" + data.file_name);
                    $('#editImageModal').show();
                });
            }

            // Close Edit Modal
            window.closeEditModal = function () {
                $('#editImageModal').hide();
            }

            // Delete image function
            window.deleteImage = function (id) {
                if (confirm("Are you sure you want to delete this image?")) {
                    $.ajax({
                        url: `/api/images/${id}`,
                        type: 'DELETE',
                        success: function () {
                            fetchImages();  // Refresh the image list after deletion
                            alert("Image deleted successfully!");
                        }
                    });
                }
            }

            // Initially load images
            fetchImages();
        });
    </script>

</body>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 20px;
        width: 80%;
        max-width: 500px;
        border-radius: 10px;
    }
</style>

</html>