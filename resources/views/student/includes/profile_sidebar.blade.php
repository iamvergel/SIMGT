<style>
  .active {
    color: #fff;
  }
</style>

<nav class="bg-white">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-2">
    <div class="flex justify-between h-16">
      <div class="flex justify-center items-center lg:hidden">
        <span onclick="toggleMobileMenu()"
          class="items-center justify-center p-2 px-3 rounded-full text-gray-900 hover:bg-gray-200"
          aria-controls="mobile-menu" aria-expanded="false">
          <i class="fas fa-bars text-lg text-normal"></i>
        </span>
      </div>
      <div class="flex">
        <div class="hidden mx-2 lg:flex space-x-4">
          <div class="px-0 pt-2 pb-3 space-y-1 text-[15px]">
            <a href="/StEmelieLearningCenter.HopeSci66/student/student-profile/account"
              class="nav-link w-full text-teal-900 hover:bg-teal-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium py-5"><i
                class="fas fa-user mr-2"></i>Account</a>
            <a href="/StEmelieLearningCenter.HopeSci66/student/student-profile/security"
              class="nav-link text-teal-900 hover:bg-teal-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium py-5"><i
                class="fas fa-lock mr-2"></i>Security</a>
            <a href="/StEmelieLearningCenter.HopeSci66/student/student-profile/additional-inforamtion"
              class="nav-link text-teal-900 hover:bg-teal-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium py-5"><i
                class="fa-solid fa-file me-2"></i>Student Additional Information</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="mobile-menu" class="max-h-0 overflow-hidden transition-max-height duration-300">
    <div class="px-2 pt-2 pb-3 space-y-1 text-[15px]">
      <a href="/StEmelieLearningCenter.HopeSci66/student/student-profile/account"
        class="nav-link text-teal-900 hover:bg-teal-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium py-5"><i
          class="fas fa-user mr-2"></i>Account</a>
      <a href="/StEmelieLearningCenter.HopeSci66/student/student-profile/security"
        class="nav-link text-teal-900 hover:bg-teal-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium py-5"><i
          class="fas fa-lock mr-2"></i>Security</a>
      <a href="/StEmelieLearningCenter.HopeSci66/student/student-profile/additional-inforamtion"
        class="nav-link text-teal-900 hover:bg-teal-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium py-5"><i
          class="fa-solid fa-file me-2"></i>Student Additional Information</a>
    </div>
  </div>
</nav>

<script>
  function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const isOpen = mobileMenu.style.maxHeight && mobileMenu.style.maxHeight !== "0px";

    mobileMenu.style.maxHeight = isOpen ? "0" : mobileMenu.scrollHeight + "px";
  }

  function setActiveLink() {
    const links = document.querySelectorAll('.nav-link');
    const currentUrl = window.location.pathname;

    links.forEach(link => {
      if (link.getAttribute('href') === currentUrl) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }

  // Set the active link on page load
  window.onload = setActiveLink;
</script>