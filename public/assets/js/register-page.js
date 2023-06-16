
(function() {
    /**
     *  Next/Previous logic
     */
    let currentSurveyIndex = 0;
    let surveys = document.querySelectorAll('.survey');
    let surveysAllButActive = document.querySelectorAll('.survey:not(.active)');

    for(let i = 0; i < surveysAllButActive.length; i++){
        surveysAllButActive[i].style.display = "none";
    }

    function nextPrevious(currentSurveyIndex){
        document.querySelector('.survey.active').style.display = 'none';
        document.querySelector('.survey.active').classList.remove('active');

        surveys[currentSurveyIndex].classList.add('active');
        surveys[currentSurveyIndex].style.display = "flex";

        if(currentSurveyIndex === 0) {
            document.querySelector(".btn-previous").disabled = true;
        }
        else if(currentSurveyIndex === surveys.length - 1){
            document.querySelector(".btn-next").disabled = true;
        }
        else{
            document.querySelector(".btn-previous").disabled = false;
            document.querySelector(".btn-next").disabled = false;
        }

    }

    let icon_box = document.querySelectorAll(".icon-box");
    for(let i=0; i<icon_box.length; i++){
        icon_box[i].addEventListener('click',function (){
            currentSurveyIndex++;
            nextPrevious(currentSurveyIndex)
        })
    }

    let buttonsPrevious = document.querySelectorAll(".btn-previous");
    for(let i=0; i<buttonsPrevious.length; i++){
        buttonsPrevious[i].addEventListener('click',function (){
            currentSurveyIndex--;
            nextPrevious(currentSurveyIndex)
        })
    }
    let buttonsNext = document.querySelectorAll(".btn-next");
    for(let i=0; i<buttonsNext.length; i++){
        buttonsNext[i].addEventListener('click',function (){
            currentSurveyIndex++;
            nextPrevious(currentSurveyIndex)
        })
    }
    /** Validate register form **/
    document.querySelector('#validate-register-form').addEventListener('click',function (){
        validateRegisterForm()

    });
    function validateRegisterForm(){
        var errorsBlock  = document.getElementById('register-form-errors')
        errorsBlock.style = "none"
        errorsBlock.innerHTML = '';

        var regexName = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,255}$/u;
        var regexEmail =/^(?!\.)[A-z\d!#$%&'*+-/=?^_`{|}~\.]{3,30}@[A-z\d-]{3,10}\.[a-z]{2,5}$/;
        var regexUsername = /^[a-z ,.'-]{1,15}$/i
        var regexPassword = /^.{6,15}$/
        //var regexBirthDate =

        var why_learn_a_language = document.getElementsByName('why-learn-a-language');
        var checked = false;
        for(let i = 0; i <= why_learn_a_language.length; i++){
            if(why_learn_a_language[i].checked){
                why_learn_a_language = why_learn_a_language[i].value;
                checked = true;

                break;
            }
        }

        var first_name = document.getElementById('first_name').value
        var last_name = document.getElementById('last_name').value
        var username= document.getElementById('username').value
        var email = document.getElementById('email').value
        var password = document.getElementById('password').value
        var birth_date = document.getElementById('birth_date').value

        var valid = true;
        var messages = '';

        if(!checked){
            valid = false;
            messages += "<li>Please select why you're learning a language.</li>"
        }
        if(!regexName.test(first_name)){
            valid = false
            messages += "<li>First name is required.</li>"
        }
        if(!regexName.test(last_name)){
            valid = false
            messages += "<li>Last name is required.</li>"
        }
        if(!regexUsername.test(username)){
            valid = false
            messages += "<li>Username is required.</li>"
        }
        if(!regexEmail.test(email)){
            valid = false
            messages += "<li>Email is required.</li>"
        }
        if(!regexPassword.test(password)){
            valid = false
            messages += "<li>Password is required.</li>"
        }
        if(!birth_date){
            valid = false
            messages += "<li>Birth date is required.</li>"
        }

        if(!valid){
            errorsBlock.style.display = "block";
            errorsBlock.innerHTML = '<ul>'
            errorsBlock.innerHTML += messages
            errorsBlock.innerHTML += '</ul>'
        }

        if(valid){
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/check-username-email",
                headers: {'Access-Control-Allow-Origin': "http://127.0.0.1:8000/"},
                data : { email: email, username: username},
                dataType: "json",
                success: function(result){
                    if( result === 'NotExists'){
                        currentSurveyIndex++;
                        nextPrevious(currentSurveyIndex)
                    }
                    else{
                        valid = false;
                        if(result === 'EmailExists'){
                            messages += "<li>Email has already been taken.</li>"
                        }
                        if(result === 'UsernameExists'){
                            messages += "<li>Username has already been taken.</li>"
                        }
                        if(result === 'UsernameAndEmailExist'){
                            messages += "<li>Email and username have been already taken.</li>"
                        }
                        errorsBlock.style.display = "block";
                        errorsBlock.innerHTML = '<ul>'
                        errorsBlock.innerHTML += messages
                        errorsBlock.innerHTML += '</ul>'

                        return valid
                    }

                },
                error: function (error) {
                    console.log(error);
                }
            })
        }


    }

})()
