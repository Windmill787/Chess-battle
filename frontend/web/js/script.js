/**
 * Created by max on 19.02.17.
 */
$('#enemy, #my')
    .on('finish.countdown', function() {
    $(this).parent()
    .addClass('disabled')
    .html('Time is out!');
    });

$('#resignButton').on('click', function () {
    $('#enemy, #my').countdown('pause')
});

$('#drawButton').on('click', function () {
    $('#enemy, #my').countdown('pause')
});

$('#enemyMoveButton').on('click', function () {
    $('#enemy').countdown('pause');
    $('#my').countdown('resume');
});

$('#myMoveButton').on('click', function () {
    $('#my').countdown('pause');
    $('#enemy').countdown('start');
});

$('#figure').on('click', function () {
    $('#pawn1, #pawn2').removeClass('hidden');
    $('#figure').css('border','2px solid #F0E68C').css('background-color','#F0E68C');
});

$('td').on('click', function () {
    $('img.figure').css('border','0px').css('background-color','');
});