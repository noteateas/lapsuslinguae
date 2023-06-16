<div class="challenge-container" id="select-the-missing-word">
    @include('client.components.practice.progress-bar')
    <div class="task-container">
        <div class="question-container">
            @if(session()->get('user')->language_id == 1)
                <p>Select the missing word</p>
            @else
                <p>Odaberi reč koja nedostaje</p>
            @endif
            <strong id="sentence-id">{{ strip_tags($sentence) }}</strong>
        </div>
        <div class="answer-container">
            <div id="answer">
                <p id="answer-text"></p>
            </div>
            <div class="choices-container d-flex ">
                @php
                    $all_words = array();

                    foreach ($words as $word){
                        array_push($all_words, $word->text);
                    }

                    array_push($all_words,$answer);

                    shuffle($all_words);
                    foreach ($all_words as $wordy){
                        echo '<div class="choice">
                                    <input type="button" class="btn-get-started btn white-bg-button choice-input" value="'. $wordy .'">
                              </div>';
                    }
                @endphp
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
                <strong>Correct answer:&nbsp;</strong><p id="error-text"></p>
            @else
                <strong>Tačan odgovor:&nbsp;</strong><p id="error-text"></p>
            @endif
        </div>
    </div>
</div>
