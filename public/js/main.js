var activeTaskHeader = 'bg-dark',
    unactiveTaskHeader = 'bg-danger',
    activeTaskBtn = 'btn-success',
    unactiveTaskBtn = 'btn-danger';

/****************** DOCUMENT READY *********************/
$('document').ready(function(){
   $('#tasks').on('click', '.activateTask', function(){
      toggleTask(this, 1);
   });

    $('#tasks').on('click', '.deactivateTask', function(){
        toggleTask(this, 0);
    });
});
/****************** END DOCUMENT READY *****************/

/**
 * Активация/деактивация задачи
 * @param obj
 * @param status
 */
function toggleTask(obj, status){
    showLoading();
    var id = $(obj).data('id');

    $.post('toggle', {
        id: id,
        status: status
    }, function(data){
        hideLoading();
        if (data['result'] === true) {
            if ($(obj).data('hide-after')) {
                $(obj).closest('.card').slideUp(animationSpeed);
            }
            if ($(obj).data('redraw-after')) {
                $(obj).closest('.card').find('.card-header')
                      .removeClass(status == 1 ? unactiveTaskHeader : activeTaskHeader)
                      .addClass(status == 1 ? activeTaskHeader : unactiveTaskHeader)

                $(obj).removeClass(status == 1 ? activeTaskBtn : unactiveTaskBtn)
                      .removeClass(status == 1 ? 'activateTask' : 'deactivateTask')
                      .addClass(status == 1 ? unactiveTaskBtn : activeTaskBtn)
                      .addClass(status == 1 ? 'deactivateTask' : 'activateTask')
                      .text(status == 1 ? 'Deactivate' : 'Activate');
            }
        } else {
            console.warn(data['mesage']);
        }
    });
}