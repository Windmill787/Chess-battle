/**
 * Created by max on 19.02.17.
 */
$('#enemy')
    .on('finish.countdown', function() {
    $(this).parent()
    .addClass('disabled')
    .html('Time is out!');
    });

/*$('#resignButton')
    .on('click' , function () {
    .countdown('stop');
});*/

$('#drawButton').on('click', function () {
    $('#clock').countdown('stop');
    $('#clockMy').countdown('stop');
});

$('#enemyMoveButton').on('click', function () {
    $('#clock').countdown('pause');
});

$('#myMoveButton').on('click', function () {
    $('#clock').countdown('resume');
});