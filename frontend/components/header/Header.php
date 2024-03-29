<header class="z-[999] bg-white dark:bg-[#1f1d2b] dark:text-white  px-5  min-h-[70px]    flex  w-full md:gap-0 gap-2 md:flex-row flex-col  items-center justify-between  color-opacity-87    backdrop-blur-md mb-20">



  <div>
    <a href="./">
      <img src="assets\logo-dark.png">
    </a>
  </div>


  <div class="  flex justify-center items-center gap-x-4 ">
    <!-- <button id="toggleSideBar"><i class="lg:hidden  flex ti ti-menu-2 text-xl cursor-pointer block "> </i></button> -->

    <!-- <div class="dark:bg-[#111c2d] bg-white relative flex items-center w-full rounded-full border-2 dark:border-[#111c2d] py-1 overflow-hidden">
      <div class="grid place-items-center h-full w-12 text-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>

      <input class=" h-full w-full outline-none text-sm text-gray-700 pr-2 dark:bg-[#111c2d]   light:bg-white  " type="text" id="search" placeholder="Search something.." />
    </div> -->


    <div class="group ">

      <a href="./"><i class="ti ti-home  text-3xl cursor-pointer"></i></a>
      <div class="group-hover:flex hidden popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">

        <p class="text-white ">Home</p>
      </div>
    </div>

    <div class="group  ">

      <button id="searchBtn" href="categories.php"><i class="ti ti-search text-3xl cursor-pointer"></i></button>

      <div class="group-hover:flex hidden popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">

        <p class="text-white ">Search</p>
      </div>
    </div>

    <div class="group ">

      <a href="popular.php"><i class=" ti ti-heart text-3xl cursor-pointer"></i></a>

      <div class="group-hover:flex hidden popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">

        <p class="text-white ">popular</p>
      </div>
    </div>
    <div class="group ">

      <a  href="archived.php"><i class=" ti ti-archive text-3xl cursor-pointer"></i></a>

      <div class="group-hover:flex hidden popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">

        <p class="text-white ">archived</p>
      </div>
    </div>

    <div class="group ">

      <a href="./auth/login.php" id="profileLink">
        <i class="ti ti-user text-3xl cursor-pointer"></i>
      </a>

      <div class="group-hover:flex hidden popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">

        <p class="text-white ">Profile</p>
      </div>
    </div>

    <div class="isAuthor group">
      <button id="logout">
        <i class="ti ti-logout  text-3xl cursor-pointer"></i>
      </button>
      <div class="group-hover:flex hidden popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">

        <p class="text-white ">Logout</p>
      </div>
    </div>



    <div id="createBtn" class="isAuthor group">
      <a href="./create.php" id="createPost">
        <i class="ti ti-plus text-[#0085DB] text-3xl cursor-pointer"></i>
      </a>
      <div class="group-hover:flex hidden popover absolute bg-gray-700 border shadow-md mt-2 px-4 py-2 rounded-lg">

        <p class="text-white ">Create</p>
      </div>
    </div>
    <!-- switcher drk mode -->
    <div>

      <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400   text-3xl    ">
        <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
        <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>


    <!-- switcher drk mode -->

  </div>

</header>
<script src="components\header\header.js"></script>