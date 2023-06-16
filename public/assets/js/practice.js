$(document).on('click', '.task-click', function(){

    var task_id = $(this).data('id')
    var clicked = $('#task-info-container-'+task_id)
    var all_pop_ups = $('.task-info-container');

    if(clicked.css('display') === 'none'){
        clicked.css('display','block');
    }
    else{
        clicked.css('display','none');
    }

    all_pop_ups.each(function(index){
        if($(this).data('id') !== task_id){
            $(this).css('display','none')
        }
    })
})
