<footer class="bg-dark text-white">
    <div class="container py-4">
        <div class="row py-5">
            <div class="col-md-4 mb-3 mb-md-0">
                <h6 class="text-uppercase mb-3">Customer services</h6>
                <ul class="list-unstyled mb-0">
                    <li><a class="footer-link" href="#">Help &amp; Contact Us</a></li>
                    <li><a class="footer-link" href="#">Returns &amp; Refunds</a></li>
                    <li><a class="footer-link" href="#">Online Stores</a></li>
                    <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <h6 class="text-uppercase mb-3">Company</h6>
                <ul class="list-unstyled mb-0">
                    <li><a class="footer-link" href="#">What We Do</a></li>
                    <li><a class="footer-link" href="#">Available Services</a></li>
                    <li><a class="footer-link" href="#">Latest Posts</a></li>
                    <li><a class="footer-link" href="#">FAQs</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-uppercase mb-3">Social media</h6>
                <ul class="list-unstyled mb-0">
                    @foreach($socialMedia as $social_media)
                        <li><a class="footer-link" href="{{$social_media->url}}"  target="_blank">{{$social_media->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="border-top pt-4" style="border-color: #1d1d1d !important">
            <div class="row">
                <div class="col-lg-6">
                    <p class="small text-muted mb-0">&copy; 2021 All rights reserved.</p>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://www.facebook.com/profile.php?id=100022212197609">Yousef Ibrahim</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
