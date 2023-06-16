<section class="bg task-background lilac-background" id="background">
    <div class="h-100 d-flex align-items-center justify-content-center flex-column">
        <div class="container finished-container">
            <div class="w-75 d-flex align-items-center justify-content-center flex-column">
                <div class="pb-4">
                    <div class="position-relative finished-image">
                        <svg class="detail-circle-bottom" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                            <circle id="Ellipse_279" data-name="Ellipse 279" cx="15" cy="15" r="15"/>
                        </svg>
                        <svg class="detail-circle-bottom" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                            <circle id="Ellipse_279" data-name="Ellipse 279" cx="15" cy="15" r="15"/>
                        </svg>
                        <img style="width: 250px" src="{{ asset('assets/img/hero-main.png') }}" alt="motivating figurine">
                    </div>

                    <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>

                    <div class="d-flex align-items-center justify-content-center">
                        @if(session()->get('user')->language_id == 1)
                            <p>Practice complete!</p>
                        @else
                            <p>Vežba gotova!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="finished-buttons-container w-100 pt-4">
            <div class="container d-flex justify-content-between">
                <div class="button-container d-flex justify-content-between align-items-baseline">
                    @if(session()->get('user')->language_id == 1)
                        <a href="{{ route('task-info', $task_id) }}" class="btn-get-started btn white-bg-button">Tips</a>
                    @else
                        <a href="{{ route('task-info', $task_id) }}" class="btn-get-started btn white-bg-button">Pomoć</a>
                    @endif

                </div>
                <div class="button-container d-flex justify-content-between align-items-baseline">
                    <a href="{{ route('practice') }}" class="btn-get-started btn green-bg-button ">
                        @if(session()->get('user')->language_id == 1)
                            Continue
                        @else
                            Nastavi
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>
