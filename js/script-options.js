$(document).ready(function() {

  $('.btn-add-sequence').click(function() {
    var newSeq = $('#sequences .card-sequence').last().clone(),
        newNum = parseInt(newSeq.find('#sequence-number').html()) + 1;
    newSeq.find('form').trigger('reset');
    newSeq.insertBefore($('#sequences .card-add-sequence'));

  });

  sortable('#sequences', {
    forcePlaceholderSize: true,
    placeholderClass: 'placeholder m-2',
    handle: 'label'
  });

  $(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    if($('.card-sequence').length > 1) {
      $(this).closest('.card-sequence').remove();
    } else {
      $(this).closest('form').trigger('reset');
    }
  });

  $(document).on('click', '.btn-save', function(e){
    e.preventDefault();

    var sequences = new Array(),
        btnSave = $(event.target);

    $('.card-sequence').each(function(){

      var texte = $(this).find('.input-texte').val(),
          duree = $(this).find('.input-duree').val(),
          coef = $(this).find('.input-coef').val(),
          vitesses = new Array();

      $(this).find('.vitesses input').each(function(){
        vitesses.push($(this).val());
      });

      sequences.push({
        texte: texte,
        duree: duree,
        vitesses: vitesses,
        coef: coef,
      });

    });

    sequences = JSON.stringify(sequences);

    btnSave.addClass('loading');

    $.ajax({
        type: 'POST',
        url: 'process.php',
        data: {sequences: sequences},
        dataType: 'json'
    })
    .done( function( data ) {
        console.log('done');
        console.log(data);
        btnSave.removeClass('loading').addClass('btn-success');
        setTimeout(function(){
          btnSave.removeClass('btn-success')
        }, 1000);
    })
    .fail( function( data ) {
        console.log('fail');
        console.log(data);
    });

  });

});
