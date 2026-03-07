<header class="bg-white shadow-sm border-b">
  <div class="flex justify-between items-center px-6 py-4">

      <div class="text-lg font-semibold text-gray-800">
          <!-- hamburger here that toggles the sidebar on mobile -->
           <button
              @click="sidebarOpen = !sidebarOpen"
              class="md:hidden text-gray-600 hover:text-indigo-600 focus:outline-none">

              <x-icon name="menu" class="w-6 h-6" />
          </button>
      </div>

      {{-- User Dropdown --}}
      <div class="flex items-center space-x-4">
          <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                  <button class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-indigo-600 focus:outline-none transition">
                      <x-icon name="circle-user-round" class="w-5 h-5" />
                      <span class="inline-flex items-center">{{ Auth::user()->name }}</span>

                      <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                      </svg>
                  </button>
              </x-slot>

              <x-slot name="content">
                  <x-dropdown-link :href="route('profile.edit')">
                      Profile
                  </x-dropdown-link>

                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <x-dropdown-link :href="route('logout')"
                          onclick="event.preventDefault(); this.closest('form').submit();">
                          Log Out
                      </x-dropdown-link>
                  </form>
              </x-slot>
          </x-dropdown>
      </div>

  </div>
</header>