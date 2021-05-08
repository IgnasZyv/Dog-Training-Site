$(function() {
    $("#date").datepicker({ dateFormat: "yy-mm-dd" });
    $("#date").on("change",function(){
        var selected = $(this).val();
        $.post('bookingscript.php', {'date':selected}, function(data){
            console.log("data");
            $("#time-right").html(data);
    });
});

})
