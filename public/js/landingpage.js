document.addEventListener("DOMContentLoaded", function () {
    let imagesData = [];
    let currentIndex = 0;

    function fetchImages(page = 1) {
        fetch(`/api/images?page=${page}`)
            .then((response) => response.json())
            .then((data) => {
                imagesData = data.data;
                const imagesContainer =
                    document.getElementById("image-gallery");
                const paginationLinks =
                    document.getElementById("pagination-links");

                imagesContainer.innerHTML = "";

                imagesData.forEach((image) => {
                    const imageElement = document.createElement("div");
                    imageElement.classList.add(
                        "relative",
                        "overflow-hidden",
                        "group"
                    );

                    // Add GLightbox data attributes
                    imageElement.innerHTML = ` 
                    <a href="/storage/images/${image.file_name}" data-glightbox="image-gallery">
                        <img src="/storage/images/${image.file_name}" alt="${image.name}"
                            class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110 group-hover:opacity-80 rounded-lg" 
                            onclick="openImageModal(${image.id})">
                    </a>
                       
                `;
                    imagesContainer.appendChild(imageElement);
                });

                // Initialize GLightbox after images are added
                const lightbox = GLightbox({
                    selector: '[data-glightbox="image-gallery"]',
                    touchNavigation: true,
                    loop: true,
                    openEffect: "fade",
                    closeEffect: "fade",
                });

                // Pagination Links
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

    fetchImages();

    async function fetchAnnouncements() {
        try {
            const response = await fetch("/api/announcements"); // Your API endpoint
            const announcements = await response.json();

            const swiperWrapper = document.getElementById("swiper-wrapper");

            // Loop through the announcements and create slides dynamically
            announcements.forEach((announcement) => {
                const slide = document.createElement("div");
                slide.classList.add("swiper-slide");

                // Assuming 'announcement.image' holds the URL for the image
                const slideContent = `
                    <div class="flex justify-center items-center p-2 lg:p-10 lg:px-[10rem] w-full h-auto lg:h-[500px] xl:h-[700px]">
                        <img src="/storage/announcements/${announcement.image}" alt="Announcement"
                            class="object-cover w-full h-full rounded-xl cursor-pointer" />
                    </div>
                `;
                slide.innerHTML = slideContent;

                swiperWrapper.appendChild(slide);
            });

            // Initialize the Swiper after populating the slides
            const swiper = new Swiper(".swiper-container", {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: "#slider-button-right",
                    prevEl: "#slider-button-left",
                },
                loop: true,
                autoplay: {
                    delay: 8000,
                },
                // Allow users to click on the image to trigger the slide change
                slideToClickedSlide: true, // Make the slides clickable
            });
        } catch (error) {
            console.error("Error fetching announcements:", error);
        }
    }

    // Call the function to fetch and populate the Swiper
    fetchAnnouncements();

    fetch("/api/allevents")
        .then((response) => response.json())
        .then((events) => {
            const eventContainer = document.getElementById("eventContainer");
            eventContainer.innerHTML = ""; // Clear existing content

            events.forEach((event) => {
                const eventItem = document.createElement("div"); // Use 'div' instead of 'li' for inline layout
                eventItem.className = "relative w-[250px] shrink-0"; // Fixed width for each item, no wrapping

                // Create the content of each event
                eventItem.innerHTML = `
                <div class="flex items-center justify-between w-full">
                    <div class="z-10 flex items-center justify-center w-8 h-8 bg-teal-100 rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                        <i class="fa-solid fa-calendar text-teal-500"></i>
                    </div>
                    <div class="flex-1 bg-teal-700 h-0.5 "></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400">${new Date(
                        event.event_date
                    ).toLocaleDateString()}</time>
                    <div class="w-22">
                        <p class="text-base font-normal text-gray-500 break-words">${
                            event.activity_name || "No description available"
                        }</p>
                    </div>
                </div>
            `;

                // Add click event to edit the event
                eventItem.addEventListener("click", () => {
                    editEvent(event);

                    document.querySelector("#eventFormTitle").innerHTML =
                        "Edit Event / Activities";
                    document
                        .getElementById("EventForm")
                        .classList.remove("hidden");
                });

                // Append the item to the event container
                eventContainer.appendChild(eventItem);
            });
        });
});

/*cursor head design*/
/* --- System Parameters (Recommended)--- */
let bNum = 3; // Num of bubbles created on movement (3)
let bSize = 10; // Bubble size (8)
let bSpeed = 10; // Bubble speed (6)
let bDep = 0.1; // Bubble depletion speed (0.1)
let bDist = 30; // Spark length (30)
let bStarVar = 2; // Num of star variation (2)
let bHue = 4; // Color change speed (4)
let cSize = 100;

/* --- Main Program: DO NOT EDIT BELOW --- */
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let spots = [];
let hue = 0;
let t = 0;

const mouse = {
    x: undefined,
    y: undefined,
};

canvas.addEventListener("mousemove", function (event) {
    mouse.x = event.x;
    mouse.y = event.y;
});

window.addEventListener("resize", function () {
    canvas.width = innerWidth;
    canvas.height = innerHeight;
    init();
});

class Particle {
    constructor() {
        this.x = mouse.x + Math.cos(t / 10) * cSize;
        this.y = mouse.y + Math.sin(t / 10) * cSize;
        this.size = Math.random() * bSize + 0.5;
        this.speedX = Math.random() * bSpeed - bSpeed / 2;
        this.speedY = Math.random() * bSpeed - bSpeed / 2;
        this.points = Math.floor(Math.random() * bStarVar) + 50; //
        this.radius = Math.random() * bSize + 0.1;
        this.color = "hsl(" + (50 + Math.random() * 30) + ", 100%, 50%)"; // Gold and yellow color range
        this.deg = 0;
    }
    draw() {
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.roundRect(this.x, this.y, this.size, this.size, 5);
        ctx.rotate(this.deg);
        ctx.fill();
    }
    update() {
        this.x += this.speedX;
        this.y += this.speedY;
        if (this.size > bDep) this.size -= bDep;
    }
}

function handleParticle() {
    for (let i = 0; i < spots.length; i++) {
        spots[i].update();
        spots[i].draw();
        for (let j = i; j < spots.length; j++) {
            const dx = spots[i].x - spots[j].x;
            const dy = spots[i].y - spots[j].y;
            const distance = Math.sqrt(dx * dx + dy * dy);
        }
        if (spots[i].size <= bDep) {
            spots.splice(i, 1);
            i--;
        }
    }
    hue++;
    t++;
}

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    spots.push(new Particle());
    handleParticle();
    requestAnimationFrame(animate);
}

animate();
