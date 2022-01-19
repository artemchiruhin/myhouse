const btnBurger = document.querySelector('.btn-hamburger');
const bottomMenu = document.querySelector('.menu-bottom');

btnBurger.addEventListener('click', () => {
    bottomMenu.classList.toggle('menu-bottom__active');
    btnBurger.classList.toggle('btn-hamburger_active');
})

$('.alert').fadeOut(5000);

$('.select-status').on('change', function() {
    if(this.value == 2) {
        $('.comment-container').removeClass('d-none');
    } else {
        $('.comment-container').addClass('d-none');
    }
});

$('.filter-form').on('change', function () {
    $('.filter-form').submit();
});

$('#date-from').on('change', function () {
    if($('#date-from').val() < $('#date-to').val() && $('#date-to').val() !== '') {
        $('.cost').text(getCost() + ' руб.');
    } else {
        $('.cost').text('некорректное значение выбранных дат');
    }
});

$('#date-to').on('change', function () {
    if($('#date-from').val() < $('#date-to').val() && $('#date-from').val() !== '') {
        $('.cost').text(getCost() + ' руб.');
    } else {
        $('.cost').text('некорректное значение выбранных дат');
    }
});

function getCost() {
    let price = $('.price-per-day').text();

    let dateFrom = $('#date-from').val();
    let dateTo = $('#date-to').val();

    let days = getDaysDifference(dateTo, dateFrom);

    return price * days;
}

function getDaysDifference(firstDate, secondDate){
    let startDay = new Date(firstDate);
    let endDay = new Date(secondDate);

    let millisBetween = startDay.getTime() - endDay.getTime();

    let days = millisBetween / (1000 * 3600 * 24);

    return Math.round(Math.abs(days));
}
