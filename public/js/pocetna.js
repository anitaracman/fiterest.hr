$('#gumb').click(function(){

    $('#naslov').html('<h1>Hello</h1>');

    return false;
});

$('#primjerAjax').click(function(){

    $.ajax({url: '/podaci.txt'}).done(function(rezultat){
        console.log(rezultat);
    });

    return false;
});

$('#primjerAjaxUListu').click(function(){


    $.ajax({
        url: "/podaci.json",
        dataType: "json",
        success: function(rezultat){
            $('#lista').append('<li>'+
            rezultat.naziv
        +'</li>');
        }
    });


    return false;
});

$('.obrisi').click(function(){
    var id = $(this).attr('id');
    id=id.split('_')[1];
    console.log(id);

    $(this).parent().parent().remove();

    return false;
});