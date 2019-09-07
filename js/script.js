var lines = [],
    linesNum = 15,
    framerate = 24;

$(document).ready(function() {
  document.fonts.ready.then(function () {
    createRows();
    runSequence(0);
  })
});

function createRows(){
  for(var i = 0; i < linesNum; i++){
    var row = $('#poster').append('<div class="row" data-rollspeed="-5"><div class="spinner"></div>');
  }
}

window.onresize = function(event) {
  $('.textBox').css('width', 'auto');
}

function loadText(row, text) {
  var rowSize = row.find('.textBox').length,
      text = [text, text, text, text, text, text, text, text].join(' ');
      textArray = text.split(' '),
      textSize = textArray.length,
      difference = textSize - rowSize,

      rownum = row.eq();

      moon = $("<span/>", {class: "moon"}),
      textBox = $("<span/>", {class: "textBox loading"}).append($("<span/>", {class: "text"}))

      spinner = row.children('.spinner');



  // Stop if loading
  if(spinner.find('.textBox').first().hasClass('loading')) return false;

  // Compare and adapt sizes
  if(difference > 0) {
    for (var i = 0; i < difference; i++) {
      spinner.append(moon.clone());
      spinner.append(textBox.clone());
    }
  } else if (difference < 0) {
    spinner.find('.textBox').slice(difference).remove();
    spinner.find('.moon').slice(difference).remove();
  }

  var textBoxes = row.find('.textBox');

  // Hide
  textBoxes.addClass('loading');

  textBoxes.each(function(i){

    var textBox = textBoxes.eq(i);

    // Measure current text width
    if(!textBox.css('width')) {
      var width = textBox.width();
      textBox.css('width', width);
    }

    // Append new text
    var newText = $('<span/>', {class: 'text'}).html(textArray[i]);
    textBox.append(newText);

    // Measure new text
    var width = newText.width();

    // Adapt size
    textBox.css('width', width);

    // Remove old text
    var oldText = newText.siblings();
    setTimeout(function(oldText){
      oldText.remove();
    }, 1000, oldText);

    // Show
    setTimeout(function(textBox){
      textBox.removeClass('loading');
    }, 1500, textBox);

  })

}

var step = 0;
function runSequence(i) {


  var sequence = sequences[step],
      rows = $('#poster .row'),
      firstsRows = rows.get().slice(0, Math.ceil(linesNum/2)),
      lastsRows = rows.get().slice(-Math.floor(linesNum/2)).reverse(),
      combinedRows = $.map(firstsRows, function(v, i) {
        if(lastsRows[i]) {
          return [v, lastsRows[i]];
        } else {
          return [v];
        }
      });

  $(combinedRows).each(function(j){
    var speed = parseFloat(sequence['vitesses'][j]) * parseFloat(sequence['coef']);
    rows.eq(j).attr('data-rollSpeed', speed);
    loadText($(this), sequence['texte']) ;
  })

  setTimeout(function(){
    step ++
    if(step>=sequences.length) {
      window.postMessage({type: 'REC_STOP'}, '*')
    }
    step = step % sequences.length;
    runSequence(step)
  }, sequence['duree'] * 1000)

}

window.setInterval(function(){

  var screenSize = parseInt($(window).height()) / 500;

  $('.row').each(function(i){

    var rollSpeed = parseFloat($(this).attr('data-rollspeed')) * screenSize,
        spinner = $(this).children('.spinner'),
        pos = parseFloat(spinner.css('left')) + rollSpeed,
        spinnerWidth = parseInt(spinner.width());

    if(pos < -(spinnerWidth / 4)) {
      spinner.css('left', 0);
    } else if(pos > 0) {
      spinner.css('left', -(spinnerWidth / 4));
    } else {
      spinner.css('left', pos);
    }

  })

}, parseInt(1000/framerate));
