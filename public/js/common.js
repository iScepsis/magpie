//лоадер
function showLoading()
{
    $('.loader').show();
}

//лоадер
function hideLoading()
{
    $('.loader').hide();
}

//показывается при загрузке страницы, отправке формы
window.onbeforeunload = function ()
{
    showLoading();
};
window.onafterunload = function ()
{
    hideLoading();
};

