/*$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode === 13) {
            event.preventDefault();
            $("#search-words-button").click();
            return false;
        }
    });
});

$(document).on('click', '#search-words-button', function(){
    var search_word = $('#search-word').val();
    var word_category_id =$('#word-categories').find(':selected').data('id')

    $_token = "{{ csrf_token() }}";
    $.ajax({
        type: "GET",
        url: window.location.href + "/search-words",
        headers: {'Access-Control-Allow-Origin': "http://127.0.0.1:8000/",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: { search_word: search_word, word_category_id: word_category_id },
        dataType: "json",
        cache: false,
        contentType: "application/json; charset=utf-8",
        success: function(result){
            console.log(result)
            var html = '';
            if(result.success === 'success'){
                for(var word of result.words){
                    html += "<tr>\n" +
                        `           <td>${word.text}</td>\n` +
                        `           <td>${word.translation}</td>\n` +
                        "           <td>audio</td>\n" +
                        "       </tr>";
                }
                $('#words-table-body').html(html)
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr)
            console.log(status)
            console.log(error)
        }
    })
})*/
