/** Disabled Continue button **/
function disableContinueButton(){
    var answer_container = document.querySelector('#answer-text')
    if(answer_container.innerHTML === ``){
        document.querySelector('#check-choice').disabled = true
    }
}
disableContinueButton()
/**  Select the missing word click  **/

$(document).on('click', '.choice-input', function(){
    var answer_container = document.querySelector('#answer-text')

    var choices = document.getElementsByClassName('choice-input')
    for(var i = 0; i<choices.length; i++){
        choices[i].disabled = true
    }

    document.querySelector('#check-choice').disabled = false
    var value = this.value;
    answer_container.innerHTML += value + ' '
})

/** Reset choices **/
$(document).on('click', '#reset-choice', function(){
    var answer_container = document.querySelector('#answer-text')
    var choices = document.getElementsByClassName('choice-input')
    for(var i = 0; i<choices.length; i++){
        choices[i].disabled = false
    }
    document.querySelector('#check-choice').disabled = true
    answer_container.innerHTML = ``
})

$(document).on('click', '#check-choice', function(){
    var user_answer = document.querySelector('#answer-text').innerHTML

    $_token = "{{ csrf_token() }}";
    $.ajax({
        type: "GET",
        url: window.location.href + "/check-translation",
        headers: {'Access-Control-Allow-Origin': "http://127.0.0.1:8000/",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data : { user_answer: user_answer},
        dataType: "json",
        cache: false,
        success: function(result){
            console.log(result)
            if(result.finished){
                document.querySelector('#background').innerHTML = result.html
            }
            else if(result.correct === false){
                document.querySelector('#error-container').style.display = 'flex'
                document.querySelector('#error-text').innerHTML = result.translation
            }
            else{
                document.querySelector('#background').innerHTML = result.html
            }
        },
        error: function (error) {
            console.log(error);
        }
    })
})

