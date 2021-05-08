// Overelay Message stuff
function overlayOff() {
    var overlay = document.getElementById("overlay");
    overlay.style.display = "none";
} 
// after a set time turn off the overlay.
setTimeout(() => {
    overlayOff()
}, 3000);

// Check if the date provided in the booking form is a valid date.
var date = document.getElementById("date");
// Everything except weekend days
function noWeekends(e){

    var day = new Date( e.target.value ).getUTCDay();
    // 6 is saturday 0 is sunday.
    if(day == 0 || day == 6 ){
        e.target.setCustomValidity('Please enter a valid day');

    } else {
        e.target.setCustomValidity('');
    }

}

date.addEventListener('input',noWeekends);

// Counting characters in the booking form.
var msgEl;

function countCharacters(e) {
    var textEntered, displayCount, counter;
    textEntered = document.getElementById("message").value;
    counter = (50 - (textEntered.length));
    displayCount = document.getElementById("char-left");
    displayCount.textContent = counter + " characters left";
}

msgEl = document.getElementById('message');                   
msgEl.addEventListener('keyup', countCharacters, false);

// Check which List item was clicked.
var ul = document.getElementById('time-list');  // Parent ul
var text =  document.querySelector("input[name='time']") // text field


    
$(document).on("click",ul, function(e){
    var target = e.target; // Clicked element
    console.log(target.value);
    if (target.tagName === 'LI'){
        text.removeAttribute("readonly");
        text.value = target.textContent;
        text.setAttribute("readonly","true")
    }
  });

var dateToday = new Date(); 
$(function() {
    $("#date").datepicker({
        beforeShowDay: $.datepicker.noWeekends,
        minDate: dateToday,
        dateFormat: "yy-mm-dd"
    });
    $("#date").on("change",function(){
        var selected = $(this).val();
        document.getElementById('time').value = '';

        $.post('bookingscript.php', {'date':selected}, function(data){
            console.log(data);
            $("#time-right").html(data);
    });
});

})
