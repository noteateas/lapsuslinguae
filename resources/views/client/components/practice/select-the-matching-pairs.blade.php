<div class="challenge-container" id="select-the-matching-pairs">
    @include('client.components.practice.progress-bar',['challenges_quantity' => $challenges_quantity, 'current_challenge' => $current_challenge])
    <div class="task-container">
        <div class="question-container">
            <div class="question-container">
                @if(session()->get('user')->language_id == 1)
                    <p>Select the matching pairs</p>
                @else
                    <p>Poveži odgovarajuće parove</p>
                @endif
            </div>
        </div>
        <div class="answer-container">
            <div class="choices-container d-flex ">
                <div class="italian-choices">
                    @foreach($words as $word)
                        <div class="choice">
                            <input type="button" class="btn-get-started btn white-bg-button choice-input it-word" id="it-word-{{ $word->id }}" data-id="{{ $word->id }}" value="{{ $word->text }}">
                        </div>
                    @endforeach
                </div>
                <div class="english-choices translations">
                    @php
                        $words = $words->shuffle()
                    @endphp
                    @foreach($words as $word)
                        <div class="choice">
                            <input type="button" class="btn-get-started btn white-bg-button choice-input translation" id="translation-{{ $word->translation_id }}" data-id="{{ $word->translation_id }}" value="{{ $word->translation_text }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="button-container d-flex justify-content-between align-items-baseline">
        <button class="btn-get-started btn white-bg-button" id="reset-choice">
            <span>Reset</span>
        </button>
        <button class="btn-get-started btn white-bg-button check-choice" id="check-choice">
            @if(session()->get('user')->language_id == 1)
                <span>Continue</span>
            @else
                <span>Nastavi</span>
            @endif
        </button>
    </div>
    <div id="error-container">
        <div class="alert alert-warning in alert-dismissible">
            @if(session()->get('user')->language_id == 1)
                <div>
                    <strong>Correct answer:&nbsp;</strong>
                </div>
            @else
                <div>
                    <strong>Tačan odgovor:&nbsp;</strong>
                </div>
            @endif
            <div id="error-text">

            </div>

        </div>
    </div>
</div>
