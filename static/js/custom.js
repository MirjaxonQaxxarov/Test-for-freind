$(document).ready(function(){
    $('#viloyat').on('change', function (event){
        var url = '/oz/appeals/region';
        gerRegion(url, $(this).val());
    });
});

function gerRegion(_url, id) {
    $.ajax({
        method: 'GET',
        url: 'http://'+window.location.hostname+_url,
        dataType: 'JSON',
        data: { id: id, },
        beforeSend: function(){
            $('#tuman option').remove();
            $('<option/>').text('Tanlang...').appendTo('#tuman');
        },
        success: function(data){
            console.log(data);
            $.each(data, function (key, value) {
                $('<option/>').val(value.id).text(value.name).appendTo('#tuman');
            });
        },
    });
}

