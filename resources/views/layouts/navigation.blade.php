@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ route('home') }}"
                class="btn btn-sm pmd-ripple-effect btn-outline pmd-btn-fab pmd-btn-raised pmd-btn-fab ml-4" type="button"
                data-bs-toggle="tooltip" data-bs-placement="bottom" title=" Home">
                <i class="material-icons pmd-sm"></i>
                <img src="{{ asset('images/homeone.png') }}" alt="Description of the image"
                    style="width: 25px; height: 25px;">
            </a>

            <!-- Initialize Bootstrap tooltips -->
            <script>
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            </script>

            <a href="{{ url('/logout') }}"
                class="btn btn-sm pmd-ripple-effect btn-outline pmd-btn-fab pmd-btn-raised pmd-btn-fab" type="button"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Logout">
                <i class="material-icons pmd-sm"></i>
                <img src="{{ asset('images/logoutpic.png') }}" alt="Description of the image"
                    style="width: 25px; height: 25px;">
            </a>

            <script>
                // Initialize Bootstrap tooltip
                $(function() {
                    $('[data-bs-toggle="tooltip"]').tooltip()
                })
            </script>
        @else

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
        @endauth
    </div>
@endif
