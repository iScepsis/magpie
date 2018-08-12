$('document').ready(function(){
   // $()
});

function toggleTask(obj, status){
    var id = $(obj).data('id');

    $.post('toggle', {
        id: id,
        status: status
    }, function(data){
        console.log(data);
    });
}