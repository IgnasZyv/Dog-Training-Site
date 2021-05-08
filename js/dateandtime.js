// Everything except weekend days
const validate = dateString => {
    const day = (new Date(dateString)).getDay();
    if (day==0 || day==6) {
      return false;
    }
    return true;
  }
  
  // Sets the value to '' in case of an invalid date
  document.querySelector("input[name='date']").onchange = evt => {
    if (!validate(evt.target.value)) {
      evt.target.value = '';
    }
  }