$('i.fa-trash').click(function(){
    var id=$(this).attr('id').split('_')[1];

    if(id==0){
        return false;
    }

    $('#pitanje').html('Sigurno obrisati ' + $('#n_'+id).html());
    $('#linkBrisanje').attr('href','/grupa/obrisi?sifra='+id);
    $('#modalObrisi').foundation('open');

    return false;
});

$('#odustani').click(function(){
    $('#modalObrisi').foundation('close');
    return false;
});

$('.naziv').mouseenter(function(){
    var element=$(this);
   var id=element.attr('id').split('_')[1];
   $.ajax({
    url: '/grupa/polaznici',
    data: 'sifra='+id,
    success: function(rezultat){
        element.attr('title',rezultat);
    }
});
});