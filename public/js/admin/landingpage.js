document.addEventListener("DOMContentLoaded", function () {
    let imagesData = [];
    let currentIndex = 0;

    // Function to fetch and display images
    function fetchImages(page = 1) {
        fetch(`/api/images?page=${page}`)
            .then((response) => response.json())
            .then((data) => {
                imagesData = data.data; // Store the image data
                const imagesContainer =
                    document.getElementById("image-gallery");
                const paginationLinks =
                    document.getElementById("pagination-links");

                // Clear current images
                imagesContainer.innerHTML = "";

                // Display images
                imagesData.forEach((image) => {
                    const imageElement = document.createElement("div");
                    imageElement.classList.add(
                        "relative",
                        "overflow-hidden",
                        "group"
                    );

                    imageElement.innerHTML = `
            <img src="/storage/images/${image.file_name}" alt="${image.name}"
                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110 group-hover:opacity-80" 
                onclick="openImageModal(${image.id})">
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:bg-teal-500 group-hover:opacity-100 transition-opacity duration-500">
                <p class="text-white text-lg">${image.name}</p>
            </div>
        `;
                    imagesContainer.appendChild(imageElement);
                });

                // Display pagination links with active class handling
                paginationLinks.innerHTML = data.links
                    .map((link) => {
                        const isActive = link.active
                            ? "text-teal-700 font-semibold"
                            : "text-teal-500";
                        return `
            <a href="javascript:void(0)" onclick="fetchImages(${parseInt(
                link.label
            )})" class="mx-2 ${isActive} hover:underline">
                ${link.label}
            </a>
        `;
                    })
                    .join("");
            })
            .catch((error) => {
                console.error("Error fetching images:", error);
            });
    }

    // Open Image Modal to show full image and navigate
    window.openImageModal = function (id) {
        currentIndex = imagesData.findIndex((image) => image.id === id); // Set current index
        showModal();
    };

    // Show modal with full image and next/previous functionality
    function showModal() {
        const modal = document.createElement("div");
        const currentImage = imagesData[currentIndex];
        modal.classList.add(
            "fixed",
            "inset-0",
            "flex",
            "items-center",
            "justify-center",
            "bg-black",
            "bg-opacity-50"
        );
        modal.innerHTML = `
<div class="relative p-4 bg-white max-w-4xl max-h-full">
    <img src="/storage/images/${currentImage.file_name}" class="max-w-full max-h-full object-contain">
    <button onclick="closeModal()" class="absolute top-0 right-0 p-2 bg-red-500 text-white rounded-full">X</button>
    
    <!-- Navigation Buttons (Positioned at the edges of the screen) -->
    <button onclick="prevImage()" class="absolute left-0 top-1/2 transform -translate-y-1/2 p-4 text-white bg-teal-500 hover:bg-teal-600 rounded-full">
        &lt;
    </button>
    <button onclick="nextImage()" class="absolute right-0 top-1/2 transform -translate-y-1/2 p-4 text-white bg-teal-500 hover:bg-teal-600 rounded-full">
        &gt;
    </button>
</div>
`;
        document.body.appendChild(modal);
    }

    // Close the modal
    window.closeModal = function () {
        const modal = document.querySelector(".fixed");
        if (modal) {
            modal.remove();
        }
    };

    // Show previous image
    window.prevImage = function () {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = imagesData.length - 1; // Loop to the last image
        }
        showModal();
    };

    // Show next image
    window.nextImage = function () {
        if (currentIndex < imagesData.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Loop to the first image
        }
        showModal();
    };

    // Initially load images for the first page
    fetchImages();
});
