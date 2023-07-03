/* ------------------------------------------------------------------------------
*
*  # Date and time pickers
*
*  Specific JS code additions for picker_date.html page
*
*  Version: 1.1
*  Latest update: Aug 10, 2016
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Display week numbers
    $('.daterange-weeknumbers').daterangepicker({
        showWeekNumbers: false,
        applyClass: 'bg-slate-600',
        cancelClass: 'btn-default',

        ranges: {
            'Сегодня': [moment(), moment()],
            'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
            'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
            'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
            'Прошедший месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: 'DD.MM.YYYY',
            applyLabel: 'Вперед',
            cancelLabel: 'Отмена',
            startLabel: 'Начальная дата',
            endLabel: 'Конечная дата',
            customRangeLabel: 'Выбрать дату',
            daysOfWeek: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт','Сб'],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            firstDay: 1
        }
    });


    
});
