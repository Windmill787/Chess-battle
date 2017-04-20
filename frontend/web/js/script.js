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

var pawn = 'pawn';
var knight = 'knight';
var bishop = 'bishop';
var rook = 'rook';
var queen = 'queen';
var king = 'king';

function light (figure, id) {
    $("img").css('background-color','inherit');
    $("img#figure" + id).css('background-color','#DAA520');
    $('.morph').addClass('hidden');
    $('.move').addClass('hidden');
    $('.attack')
        .addClass('hidden')
        .css('position', 'absolute')
        .css('margin-top', -10)
        .css('margin-left', -22.5);
    $('.move' + id).removeClass('hidden');
    $('.attack' + id).removeClass('hidden');
    $('.morph' + id).removeClass('hidden');
}

function checkLight (figure, id) {
    $('img').css('background-color','inherit');
    $('#figure' + id).css('background-color','#DAA520');
    $('.move').addClass('hidden');
    $('.attack')
        .addClass('hidden')
        .css('position', 'absolute')
        .css('margin-top', -10)
        .css('margin-left', -22.5);
    $('.move' + id).removeClass('hidden');
    $('.attack' + id).removeClass('hidden');
}

function hideButtons () {
    $('.attack').addClass('hidden').addClass('disabled');
    $('.move').addClass('hidden').addClass('disabled').click(function () {
        $(".move").attr("disabled", true);
    });
}

var objDiv = document.getElementById("thumbnail-history");
objDiv.scrollTop = objDiv.scrollHeight;