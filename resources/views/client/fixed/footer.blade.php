<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row d-flex justify-content-around justify-content-sm-between ">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Lapsus Linguae</h3>
                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            <p>
                                Belgrade <br>
                                Serbia <br><br>
                                <strong>Phone:</strong> +1 5589 55488 55<br>
                                <strong>Email:</strong> info@example.com<br>
                            </p>
                        @elseif(session()->get('user')->language_id == 2)
                            <p>
                                Beograd <br>
                                Srbija <br><br>
                                <strong>Telefon:</strong> +1 5589 55488 55<br>
                                <strong>Imejl:</strong> info@example.com<br>
                            </p>
                        @endif
                    @else
                        <p>
                            Belgrade <br>
                            Serbia <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>
                    @endif
                </div>

                <div class="col-lg-2 col-md-6 footer-links">

                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('about') }}">About</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('profile') }}">Profile</a></li>
                            </ul>
                        @elseif(session()->get('user')->language_id == 2)
                            <h4>Korisni Linkovi</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Početna</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('about') }}">O nama</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('profile') }}">Profil</a></li>
                            </ul>
                        @endif
                    @else
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('about') }}">About</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('profile') }}">Profile</a></li>
                        </ul>
                    @endif

                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            <h4>Our Practice</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('practice') }}">Practice</a></li>
                            </ul>
                        @elseif(session()->get('user')->language_id == 2)
                            <h4>Naši zadaci</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('practice') }}">Vežbe</a></li>
                            </ul>
                        @endif
                    @else
                        <h4>Our Practice</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('practice') }}">Practice</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright-wrap d-md-flex py-4">
            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Lapsus Linguae</span></strong>.
                </div>
                <div class="credits">
                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            Designed by Teodora Nedeljković
                        @elseif(session()->get('user')->language_id == 2)
                            Dizajnirala Teodora Nedeljković
                        @endif
                    @else
                        Designed by Teodora Nedeljković
                    @endif
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>

    </div>
</footer>
