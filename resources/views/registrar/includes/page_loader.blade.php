<!-- Loader Overlay -->
<div class="hidden fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50" id="loaderOverlay"
  aria-live="assertive" aria-busy="true">
  <div class="spinner">
  <div></div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
</div>
</div>

<style>
.spinner {
   position: relative;
   width: 52.8px;
   height: 52.8px;
   perspective: 105.6px;
}

.spinner div {
   width: 100%;
   height: 100%;
   background: #14b8a6;
   position: absolute;
   left: 50%;
   transform-origin: left;
   animation: spinner-16s03x 2s infinite;
}

.spinner div:nth-child(1) {
   animation-delay: 0.15s;
}

.spinner div:nth-child(2) {
   animation-delay: 0.3s;
}

.spinner div:nth-child(3) {
   animation-delay: 0.45s;
}

.spinner div:nth-child(4) {
   animation-delay: 0.6s;
}

.spinner div:nth-child(5) {
   animation-delay: 0.75s;
}

@keyframes spinner-16s03x {
   0% {
      transform: rotateY(0deg);
   }

   50%, 80% {
      transform: rotateY(-180deg);
   }

   90%, 100% {
      opacity: 0;
      transform: rotateY(-180deg);
   }
}
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const loaderOverlay = document.getElementById('loaderOverlay');
    const links = document.querySelectorAll('#sidebar a');

    links.forEach(link => {
      link.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior
        loaderOverlay.classList.remove('hidden'); // Show the loader overlay

        // Redirect after 2 seconds
        setTimeout(() => {
          window.location.href = link.href; // Navigate to the link's href
        }, 500); // 2000 milliseconds = 2 seconds
      });
    });

    // Show loader when navigating away from the page
    window.addEventListener('beforeunload', function () {
      loaderOverlay.classList.remove('hidden'); // Show loader while unloading
    });
  });
</script>