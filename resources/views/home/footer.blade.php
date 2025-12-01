<footer class="footer_section bg-dark text-light pt-5">
    <div class="container">
        <div class="row">
            <!-- About -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">About eSHOPE</h5>
                <p>Your go-to online shop for the latest products and amazing deals. Quality and service are our top priorities!</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 mb-4">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-light text-decoration-none">Home</a></li>
                    <li><a href="{{ url('shop') }}" class="text-light text-decoration-none">Shop</a></li>
                    <li><a href="{{ url('contact') }}" class="text-light text-decoration-none">Contact</a></li>
                    <li><a href="{{ route('login') }}" class="text-light text-decoration-none">Login</a></li>
                    <li><a href="{{ route('register') }}" class="text-light text-decoration-none">Register</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-3 mb-4">
                <h5 class="mb-3">Contact Us</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i>123 Street, Kathmandu, Nepal</p>
                <p><i class="fas fa-phone me-2"></i>+977 9812345678</p>
                <p><i class="fas fa-envelope me-2"></i>support@eshope.com</p>
            </div>

            <!-- Social Media -->
            <div class="col-md-3 mb-4">
                <h5 class="mb-3">Follow Us</h5>
                <div class="d-flex">
                    <a href="#" class="text-light fs-4 me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light fs-4 me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light fs-4 me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light fs-4"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <hr class="bg-secondary">

        <!-- Footer Bottom -->
        <div class="row">
            <div class="col text-center">
                <p class="mb-0">&copy; {{ date('Y') }} eSHOPE. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

<style>
.footer_section a:hover {
    color: #f89cab !important;
    text-decoration: none;
}
</style>
