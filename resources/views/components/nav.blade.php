<header class=" bg-red-400"> 
  <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8 h-[100px]" aria-label="Global">
    
    <!-- Left section with company logo -->
    <div class="flex lg:flex-1">
      <a href="{{ url('/') }}" class="-m-1.5 p-1.5">
        <span class="sr-only">Your Company</span>
        <img src="{{ asset('images/head.png') }}" alt="Head Icon"  class="h-20 w-auto"">


      </a>
    </div>

    <!-- Right section with user, favorite, and cart icons -->
    <div class="flex items-center space-x-6">
      <!-- Cart Icon -->
      <a href="{{ url('/cart') }}" class="text-gray-700 hover:text-gray-900 ">
        <span class="sr-only">Shopping Cart</span>
        <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24px"
              height="24px"
              fill="#000000"
              className="bi bi-cart2"
              viewBox="0 0 16 16"
              
            >
              <title>Cart</title>
              <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
            </svg>
      </a>

      <!-- User Icon -->
      <a href="{{ url('/profile') }}" class="text-gray-700 hover:text-gray-900">
        <span class="sr-only">User Profile</span>
        <svg
              xmlns="http://www.w3.org/2000/svg"
              width="25px"
              height="25px"
              fill="#000000"
              className="bi bi-person"
              viewBox="0 0 16 16"
            >
              <title>User</title>
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
            </svg>
      </a>
    </div>

  </nav>
</header>