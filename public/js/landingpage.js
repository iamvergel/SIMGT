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

    window.openImageModal = function (id) {
        currentIndex = imagesData.findIndex((image) => image.id === id);
        showModal();
    };

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

    window.closeModal = function () {
        const modal = document.querySelector(".fixed");
        if (modal) {
            modal.remove();
        }
    };

    window.prevImage = function () {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = imagesData.length - 1;
        }
        showModal();
    };

    window.nextImage = function () {
        if (currentIndex < imagesData.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        showModal();
    };

    fetchImages();
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

$(document).ready(function () {});
