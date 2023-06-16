/** Disabled Continue button **/
function disableContinueButton(){
    //var answer_container = document.querySelector('#answer-text')
    var translations = document.getElementsByClassName('translation')
    for(var i = 0; i < translations.length; i++){
        translations[i].disabled = true
    }

    //if(answer_container.innerHTML === ``){
        document.querySelector('#check-choice').disabled = true
    //}
}
disableContinueButton()

/** Clear Locale Storage Item(answer) **/
function clearLocalStorageItem(item){
    if(window.localStorage.getItem(item)){
        localStorage.removeItem(item);
    }
}
clearLocalStorageItem('answer')

/** Choice click  **/
$(document).on('click', '.it-word', function(){
    document.querySelector('#check-choice').disabled = false

    var translations = document.getElementsByClassName('translation')
    for(var i = 0; i < translations.length; i++){
        translations[i].disabled = false
    }
    var italian_choices = document.getElementsByClassName('it-word')
    for(var i = 0; i < italian_choices.length; i++){
        italian_choices[i].disabled = true
    }

    if(!window.localStorage.getItem('answer')){
        var answer = []
        answer[0] = {it_word_id : $(this).data('id'), translation_id : null}
        window.localStorage.setItem('answer', JSON.stringify(answer))
    }
    else{
        answer = JSON.parse(window.localStorage.getItem('answer'))
        answer[answer.length] = {it_word_id : $(this).data('id'), translation_id : null}
        window.localStorage.setItem('answer', JSON.stringify(answer))

        for(let i = 0; i < answer.length; i++){
            if(answer[i].translation_id != null){
                let translation = document.querySelector('#translation-' + answer[i].translation_id)

                translation.disabled = true
            }
        }

    }
})

/** Reset choices **/
function resetChoices(){
    document.querySelector('#check-choice').disabled = true

    if(window.localStorage.getItem('answer')){
        localStorage.removeItem('answer');
    }

    var choices = document.getElementsByClassName('choice-input')
    for(var i = 0; i < choices.length; i++){
        choices[i].disabled = false
    }
}
$(document).on('click', '#reset-choice', function(){
    resetChoices()
})

/** Click on the translation choice **/
$(document).on('click', '.translation', function(){
    var translations = document.getElementsByClassName('translation')
    for(var i = 0; i < translations.length; i++){
        translations[i].disabled = true
    }
    var italian_choices = document.getElementsByClassName('it-word')
    for(var i = 0; i < italian_choices.length; i++){
        italian_choices[i].disabled = false
    }

    if(window.localStorage.getItem('answer')){
        answer = JSON.parse(window.localStorage.getItem('answer'))
        if(answer.length <= 4){
            answer[answer.length-1].translation_id = $(this).data('id')
        }

        for(let i = 0; i < answer.length; i++){
            let it_word = document.querySelector('#it-word-' + answer[i].it_word_id)

            it_word.disabled = true
        }

        window.localStorage.setItem('answer', JSON.stringify(answer))
    }
})

/** Check the answer **/
$(document).on('click', '#check-choice', function(){
    var answer = JSON.parse(window.localStorage.getItem('answer'))
    resetChoices()

    $_token = "{{ csrf_token() }}";
    $.ajax({
        type: "GET",
        url: window.location.href + "/check-translation",
        headers: {'Access-Control-Allow-Origin': "http://127.0.0.1:8000/",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data : { answer: answer},
        dataType: "json",
        cache: false,
        success: function(result){
            if(result.success){
                document.querySelector('#background').innerHTML = result.html
            }
            else if(result.success === false){
                document.querySelector('#error-container').style.display = 'flex'

                for(var i = 0; i < result.words.length; i++){
                    document.querySelector('#error-text').innerHTML += '<p>' +
                        result.words[i].text +
                        ' = ' +
                        result.words[i].translation_text +
                        '</p>'
                }
            }
            else if(result.finished){
                document.querySelector('#background').innerHTML = result.html
            }
            else if(result.failure){
                document.querySelector('#error-container').style.display = 'flex'
                document.querySelector('#error-text').innerHTML += result.text
            }
        },
        error: function (error) {
            console.log(error);
        }
    })
})
