<x-guest-layout>
    <x-mynavigation/>
    @if (session('success'))
    <div id="success-message" class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<script>
    window.onload = function() {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = "opacity 0.5s ease";
                successMessage.style.opacity = "0";
                setTimeout(() => {
                    successMessage.remove();
                }, 500);
            }, 7000);
        }
    }
</script>



    <div class="container">
        <!-- Header -->
        <section class="contact-header text-center py-5">
            <h2>Contact Us</h2>
            <p>If you have any questions or need further information, feel free to reach out to us using the form below or through our contact details.</p>
        </section>
    
        <!-- Contact Information -->
        <section class="contact-info d-flex justify-content-around py-5">
            <div class="contact-detail text-center">
                <h4>Address</h4>
                <p>123 Parking Street, Cityville, ST 12345</p>
            </div>
            <div class="contact-detail text-center">
                <h4>Phone</h4>
                <p>+1 (555) 123-4567</p>
            </div>
            <div class="contact-detail text-center">
                <h4>Email</h4>
                <p>info@parkingmanagement.com</p>
            </div>
            <div class="contact-detail text-center">
                <h4>Working Hours</h4>
                <p>Mon - Fri: 8 AM - 6 PM</p>
            </div>
        </section>
    
        <!-- Contact Form -->
        <section class="contact-form py-5">
            <h4 class="text-center" style="color: var(--color2);">Send Us a Message</h4>
            <form action="{{ route('contact.submit') }}" method="POST" class="mx-auto" style="max-width: 600px;">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="buttons">Send Message</button>
                </div>
            </form>
        </section>
    
        <!-- Map Section -->
        <section class="map-section py-5">
            <h4 class="text-center">Our Location</h4>
            <div class="d-flex justify-content-center">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093705!2d144.95373541531823!3d-37.81621897975195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43cfb1d6e3%3A0x506f0b535318b40!2sParking!5e0!3m2!1sen!2sus!4v1629376723355!5m2!1sen!2sus" 
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </div>

    <x-footer/>
</x-guest-layout>