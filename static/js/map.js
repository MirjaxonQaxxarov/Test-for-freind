$(document).ready(function(){
    var Language = $('html').attr('lang');
    var url = window.location + '/map';
    getmap('viloyat');

    $('#mirishkor').hover(function(e){ getmap('mirishkor'); },
        function (){ getmap('viloyat'); });

    $('#kasbi').hover(function(e){ getmap('kasbi'); },
        function (){ getmap('viloyat'); });

    $('#muborak').hover(function(e){ getmap('muborak'); },
        function (){ getmap('viloyat'); });

    $('#koson').hover(function(e){ getmap('koson'); },
        function (){ getmap('viloyat'); });

    $('#chiroqchi').hover(function(e){ getmap('chiroqchi'); },
        function (){ getmap('viloyat'); });

    $('#kitob').hover(function(e){ getmap('kitob'); },
        function (){ getmap('viloyat'); });

    $('#shahrisabz').hover(function(e){ getmap('shahrisabz'); },
        function (){ getmap('viloyat'); });

    $('#yakkabaog').hover(function(e){ getmap('yakkabaog'); },
        function (){ getmap('viloyat'); });

    $('#qamashi').hover(function(e){ getmap('qamashi'); },
        function (){ getmap('viloyat'); });

    $('#qarshit').hover(function(e){ getmap('qarshit'); },
        function (){ getmap('viloyat'); });

    $('#nishon').hover(function(e){ getmap('nishon'); },
        function (){ getmap('viloyat'); });

    $('#guzor').hover(function(e){ getmap('guzor'); },
        function (){ getmap('viloyat'); });

    $('#dehqanabot').hover(function(e){ getmap('dehqanabot'); },
        function (){ getmap('viloyat'); });

    function getmap(reg) {
        $.ajax({
            method: 'GET',
            url: url,
            dataType: 'json',
            headers: {
                reg: reg,
                'Accept-Language': Language,
            },
            success : function(data){
                $('#mapname').html(data.name).show;
                $('#mapinfo').html(data.info);
            },
        });
    }

    $('#appeals-file').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        var fileExtension = ['pdf', 'doc', 'docx'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#file-extension').text('Ruhsat berilgan fayllar : ' + fileExtension.join(', '));
            $('#file-extension').attr('class', 'text-danger');
            $('button[type="submit"]').attr('disabled','disabled');
        }else {
            $('#file-label').html(fileName);
            $('#file-extension').attr('class', 'text-danger d-none');
            $('button[type="submit"]').removeAttr('disabled');
        }
    });
});