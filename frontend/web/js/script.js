/**
 * Created by max on 19.02.17.
 */
$('#clock')
    .on('update.countdown', function(event) {
    var format = '%M:%S';
    $(this).html(event.strftime(format));
    })
    .on('finish.countdown', function() {
    $(this).parent()
    .addClass('disabled')
    .html('Time is out!');
    })
    .countdown((new Date().valueOf() + 600000).toString(), {defer: false});

$('#resignButton').on('click', function () {
    $('#clock').countdown('stop');
});

$('#drawButton').on('click', function () {
    $('#clock').countdown('stop');
});

$('#enemyMoveButton').on('click', function () {
    $('#clock').countdown('pause');
});

$('#myMoveButton').on('click', function () {
    $('#clock').countdown('resume');
});

var board = ChessBoard('board');