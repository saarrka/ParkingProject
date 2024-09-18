<div class="container-fluid nav-div">
    <div class="d-flex align-items-center justify-content-between">
        <!-- Slika -->
        <a href='/'>
            <x-application-logo class="me-3 logo-img" />  
        </a>
        
        <!-- Dugmad -->
        <div class="menu-div">
            <x-nav-link :href="route('login')" >Login</x-nav-link>
            <x-nav-link :href="route('register')" >Register</x-nav-link>
            <x-nav-link :href="route('about')" >About Us</x-nav-link>
            <x-nav-link :href="route('contact')" >Contact</x-nav-link>
        </div>
    </div>
</div>
