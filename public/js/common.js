var animationSpeed = 300; //Скорость эффектов испозльзующих анимацию

/**
 * Старт анимации загрузки
 */
function showLoading()
{
    $('.loader').show();
}

/**
 * Завершение анимации загрузки
 */
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

