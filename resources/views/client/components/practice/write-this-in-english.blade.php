<div class="challenge-container" id="write-this-in-english">
    @include('client.components.practice.progress-bar',['challenges_quantity' => $challenges_quantity, 'current_challenge' => $current_challenge])
    <div class="task-container">
        <div class="question-container">
            @if(session()->get('user')->language_id == 1)
                <p>Write this in English</p>
            @else
                <p>Napiši ovo na srpskom</p>
            @endif
            <strong data-id="{{ $sentence->id }}" id="sentence-id">{{ $sentence->text }}</strong>
        </div>
        <div class="answer-container">
            <div id="answer">
                    <p id="answer-text"></p>
            </div>
            <div class="choices-container d-flex">

                @php
                $translations = $sentence->translations;
                foreach ($translations as $translation){
                    if($translation->language->id == session()->get('user')->language_id){
                        $lang_translation = $translation;
                    }
                }

                $sentence_words = explode(' ', $lang_translation->text);
                $all_words = array();

                foreach ($sentence_words as $key => $sentence_word){
                    array_push($all_words, $sentence_word);
                }
                foreach ($words as $word){
                    foreach ($word->translations as $translation){
                        if($translation->language_id == session()->get('user')->language_id){
                            array_push($all_words,$translation->text);
                        }
                    }
                }
                shuffle($all_words);
                foreach ($all_words as $key=>$wordy){
                    echo '<div class="choice">
                                <input type="button" class="btn-get-started btn white-bg-button choice-input" id="'.$key.'" value="'. $wordy .'">
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
