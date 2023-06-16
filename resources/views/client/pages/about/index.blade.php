@extends('client.layouts.layout')

@section('content')
    <section id="hero" class="about bg lilac-background">
        <div class="container">
            <div class="row pb-4">
                <div class="col-md-6 order-1 order-md-2" data-aos="zoom-in" data-aos-delay="150">
                    <img src="{{ asset('assets/img/about.jpg')}}" class="img-fluid" alt="about">
                </div>
                <div class="col-md-6 pt-4 pt-lg-0 order-2 order-md-1 content" data-aos="fade-right">

                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            <h3>Our teaching approach</h3>
                            <p class="fst-italic">
                                We believe that anyone can learn a language. Our free, bite-size lessons feel more like a game than a textbook, and that's by design: Learning is easier when you're having fun.

                                But Lapsus Linguae isn't just a game. It's based on a methodology proven to foster long-term retention, and a curriculum aligned to an international standard.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle"></i>&nbsp;Real-life communication</li>
                                <li><i class="bi bi-check-circle"></i>&nbsp;Standout content</li>
                                <li><i class="bi bi-check-circle"></i>A balanced approach</li>
                            </ul>
                            <div>
                                <a href="{{ route('recap') }}" class="btn-get-started scrollto white-bg-button">
                                    Start by learning the vocabulary here
                                </a>
                            </div>
                        @elseif(session()->get('user')->language_id == 2)
                            <h3>Naš pristup predavanju</h3>
                            <p class="fst-italic">
                                Verujemo da svako može da nauči jezik. Naše besplatne lekcije male veličine više liče na igru nego na udžbenik, i to je po dizajnu: Učiti je lakše kada se zabavljate.

                                Ali Lapsus Linguae nije samo igra. Zasnovan je na metodologiji za koju je dokazano da podstiče dugotrajno zadržavanje, i nastavnom planu i programu usklađenom sa međunarodnim standardima.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle"></i>&nbsp;Komunikacija u stvarnom životu</li>
                                <li><i class="bi bi-check-circle"></i>&nbsp;Izvanredan sadržaj</li>
                                <li><i class="bi bi-check-circle"></i>&nbsp;Balansiran pristup</li>
                            </ul>
                            <div>
                                <a href="{{ route('recap') }}" class="btn-get-started scrollto white-bg-button">
                                    Počni sa vokabularom oovde
                                </a>
                            </div>
                        @endif
                    @else
                        <h3>Our teaching approach</h3>
                        <p class="fst-italic">
                            We believe that anyone can learn a language. Our free, bite-size lessons feel more like a game than a textbook, and that's by design: Learning is easier when you're having fun.

                            But Lapsus Linguae isn't just a game. It's based on a methodology proven to foster long-term retention, and a curriculum aligned to an international standard.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i>&nbsp;Real-life communication</li>
                            <li><i class="bi bi-check-circle"></i>&nbsp;Standout content</li>
                            <li><i class="bi bi-check-circle"></i>A balanced approach</li>
                        </ul>
                        <div>
                            <a href="{{ route('recap') }}" class="btn-get-started scrollto white-bg-button">
                                Start by learning the vocabulary here
                            </a>
                        </div>
                    @endif
            </div>
            </div>



            <div class="row detail d-flex white-background detail-circle">
                <div class="d-flex align-items-center justify-content-center">
                    <img class="img-fluid" src="{{ asset('assets/img/about.svg') }}" alt="about1">
                </div>
                <div>
                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            <h3>Real-life communication</h3>
                            <p>
                                Language is ultimately a communication tool. Lapsus Linguae takes a functional approach by focusing on what learners actually want to do with a language.
                            </p>
                            <p>
                                Lessons focus on a real-life goal — for instance, ordering at a restaurant. Learners develop the vocabulary and grammar needed to achieve that goal through lots of varied practice in reading, writing, listening, and speaking.
                            </p>
                        @elseif(session()->get('user')->language_id == 2)
                            <h3>Komunikacija u stvarnom životu</h3>
                            <p>
                                Jezik je konačno sredstvo komunikacije. Lapsus Linguae ima funkcionalan pristup fokusirajući se na ono što učenici zapravo žele da rade sa jezikom.
                            </p>
                            <p>
                                Lekcije se fokusiraju na stvarni cilj - na primer, naručivanje u restoranu. Učenici razvijaju rečnik i gramatiku potrebnu za postizanje tog cilja kroz mnogo različitih vežbi u čitanju, pisanju, slušanju i govoru.
                            </p>
                        @endif
                    @else
                        <h3>Real-life communication</h3>
                        <p>
                            Language is ultimately a communication tool. Lapsus Linguae takes a functional approach by focusing on what learners actually want to do with a language.
                        </p>
                        <p>
                            Lessons focus on a real-life goal — for instance, ordering at a restaurant. Learners develop the vocabulary and grammar needed to achieve that goal through lots of varied practice in reading, writing, listening, and speaking.
                        </p>
                    @endif
                </div>
            </div>

            <div class="row detail d-flex">
                <div>
                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            <h3>Standout content
                            </h3>
                            <p>Along with commonly used phrases like "Dov'è il bagno?"
                                (Where is the bathroom?), Lapsus Linguae learners also encounter sentences
                                like "Il tuo orso beve birra." (Your bear drinks beer).
                            </p>
                            <p>
                                Why the quirky sentences?
                                They're memorable and more fun to learn.
                                Our unexpected content also pushes learners to think
                                carefully about the language they're learning.
                            </p>
                        @elseif(session()->get('user')->language_id == 2)
                            <h3>Istaknuti sadržaj
                            </h3>
                            <p>Zajedno sa često korišćenim frazama poput „Dov'e il bagno?“
                                (Gde je kupatilo?), učenici Lapsus Linguae se takođe susreću sa rečenicama
                                poput „Il tuo orso beve birra“. (Tvoj medved pije pivo).
                            </p>
                            <p>
                                Zašto čudne rečenice?
                                Oni su nezaboravni i zabavniji su za učenje.
                                Naš neočekivani sadržaj takođe podstiče učenike na razmišljanje
                                pažljivo o jeziku koji uče.
                            </p>
                        @endif
                    @else
                        <h3>Standout content
                        </h3>
                        <p>Along with commonly used phrases like "Dov'è il bagno?"
                            (Where is the bathroom?), Lapsus Linguae learners also encounter sentences
                            like "Il tuo orso beve birra." (Your bear drinks beer).
                        </p>
                        <p>
                            Why the quirky sentences?
                            They're memorable and more fun to learn.
                            Our unexpected content also pushes learners to think
                            carefully about the language they're learning.
                        </p>
                    @endif
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <img class="img-fluid" src="{{ asset('assets/img/about1.svg') }}" alt="about1">
                </div>
            </div>

            <div class="row detail d-flex">
                <div class="d-flex align-items-center justify-content-center">
                    <img class="img-fluid" src="{{ asset('assets/img/about2.svg') }}" alt="about1">
                </div>
                <div>
                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            <h3>A balanced approach</h3>
                            <p>
                                Lapsus Linguae allows learners to discover patterns on their own without needing
                                to focus on language rules — the same way you learned your first language as a
                                child. This approach, called "implicit learning," is ideal for developing a
                                strong foundational knowledge of a language and its rules.
                            </p>
                            <p>
                                But explicit instruction is useful for some concepts. So Lapsus Linguae offers
                                both! In addition to lessons, learners can access Tips for explanations on
                                grammar, pronunciation, and helpful phrases.
                            </p>
                        @elseif(session()->get('user')->language_id == 2)
                            <h3>Uravnotežen pristup</h3>
                            <p>
                                Lapsus Linguae omogućava učenicima da sami otkriju obrasce bez potrebe
                                da se fokusirate na jezička pravila — na isti način na koji ste naučili svoj prvi jezik kao a
                                dete. Ovaj pristup, nazvan „implicitno učenje“, idealan je za razvoj a
                                snažno osnovno poznavanje jezika i njegovih pravila.
                            </p>
                            <p>
                                Ali eksplicitno uputstvo je korisno za neke koncepte. Dakle, Lapsus Linguae nudi
                                oboje! Pored lekcija, učenici mogu pristupiti i Savetima za objašnjenja na
                                gramatiku, izgovor i korisne fraze.
                            </p>
                        @endif
                    @else
                        <h3>A balanced approach</h3>
                        <p>
                            Lapsus Linguae allows learners to discover patterns on their own without needing
                            to focus on language rules — the same way you learned your first language as a
                            child. This approach, called "implicit learning," is ideal for developing a
                            strong foundational knowledge of a language and its rules.
                        </p>
                        <p>
                            But explicit instruction is useful for some concepts. So Lapsus Linguae offers
                            both! In addition to lessons, learners can access Tips for explanations on
                            grammar, pronunciation, and helpful phrases.
                        </p>
                    @endif

                </div>
            </div>

            @include('client.pages.about.team',$team)

            <div class="pt-2 mb-5 row d-flex flex-column align-items-center
                        pt-5 pb-5 justify-content-center text-center white-background detail-circle">
                @if(session()->has('user'))
                    @if(session()->get('user')->language_id == 1)
                        <h3>Contact us</h3>
                        <p>Are you having any trouble? Find help here.</p>
                        <p>Journalists and bloggers, please reach out to: <b style="color:orange">press@lapsuslinguae.com</b></p>
                    @elseif(session()->get('user')->language_id == 2)
                        <h3>Kontaktirajte nas</h3>
                        <p>Da li imate poteškoća? Pronađite pomoć ovde.</p>
                        <p>Novinari i blogeri, molimo vas pošaljite nam poruku ovde: <b style="color:orange">press@lapsuslinguae.com</b></p>
                    @endif
                @else
                    <h3>Contact us</h3>
                    <p>Are you having any trouble? Find help here.</p>
                    <p>Journalists and bloggers, please reach out to: <b style="color:orange">press@lapsuslinguae.com</b></p>
                @endif
            </div>
        </div>
    </section>
@endsection


