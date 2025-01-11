<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>St. Emilie Learning Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Tailwind and DataTable CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css">

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>

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
</head>

<body class="font-poppins bg-gray-200">

    <div class="flex p-2 w-full h-screen">
        <main class="flex-grow rounded-r-lg bg-white shadow-lg w-full">
            <header class="p-5">
                <p class="text-2xl font-bold text-teal-900 ml-5">School Gallery</p>
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                    <table id="imageGalleryTable" class="display">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <button class="px-4 py-2 bg-teal-500 text-white rounded mt-4" onclick="openAddModal()">Add New
                        Image</button>
                </section>
            </header>
        </main>
    </div>

    <!-- Add Image Modal -->
    <div id="addImageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Image</h2>
            </div>
            <div class="modal-body">
                <form id="addImageForm" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="imageName" class="block text-sm font-semibold">Category</label>
                        <select id="imageName" name="name" class="w-full p-2 border border-gray-300 rounded mt-1"
                            required>
                            <option value="Classroom">Classroom</option>
                            <option value="Playground">Playground</option>
                            <option value="Library">Library</option>
                            <option value="Office">Office</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="imageFile" class="block text-sm font-semibold">Select Image</label>
                        <input type="file" id="imageFile" name="image"
                            class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeAddModal()">Cancel</button>
                <button type="submit" form="addImageForm">Add Image</button>
            </div>
        </div>
    </div>

    <!-- Edit Image Modal -->
    <div id="editImageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Image</h2>
            </div>
            <div class="modal-body">
                <form id="editImageForm" enctype="multipart/form-data">
                    <input type="hidden" id="editImageId" name="id">
                    <div class="mb-4">
                        <label for="editImageName" class="block text-sm font-semibold">Category</label>
                        <select id="editImageName" name="name" class="w-full p-2 border border-gray-300 rounded mt-1">
                            <option value="Classroom">Classroom</option>
                            <option value="Playground">Playground</option>
                            <option value="Library">Library</option>
                            <option value="Office">Office</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editImageFile" class="block text-sm font-semibold">Select Image</label>
                        <input type="file" id="editImageFile" name="image"
                            class="w-full p-2 border border-gray-300 rounded mt-1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeEditModal()">Cancel</button>
                <button type="submit" form="editImageForm">Update Image</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            const table = $('#imageGalleryTable').DataTable({
                paging: false,  // Disable pagination
            });

            // Fetch images from API and populate the table
            function fetchImages() {
                $.get('/api/images', function (data) {
                    table.clear();  // Clear any existing data
                    data.data.forEach(image => {
                        table.row.add([
                            `<img src="/storage/images/${image.file_name}" alt="${image.name}" class="w-16 h-16 object-cover">`,
                            image.name,  // Display the category
                            `<button onclick="editImage(${image.id})">Edit</button>
                             <button onclick="deleteImage(${image.id})">Delete</button>`
                        ]);
                    });
                    table.draw();  // Redraw the table after adding data
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

            // Open Edit Modal
            window.editImage = function (id) {
                $.get(`/api/images/${id}`, function (data) {
                    $('#editImageId').val(data.id);  // Set the image ID
                    $('#editImageName').val(data.name);  // Set the current category
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

</html>