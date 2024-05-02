function getValue(value){

          if (value=="ClubPresident")
          {
            document.getElementById('cname').style.display='inline-block';
            document.getElementById('clubName').required=true;

          }
          else{
            document.getElementById('cname').style.display='none';
            document.getElementById('clubName').required=false;

          }
}
var check = function() {
  var button = document.querySelector('#submitButton');
  button.disabled = false;
  document.getElementById('message').style.display = 'inline-block';

  
  if (document.getElementById('password').value != document.getElementById('cpassword').value) {
    button.disabled = true;
    document.getElementById('valid-feedback').style.color = 'red';
    document.getElementById('valid-feedback').innerHTML = 'Password not matching';
  } else {
    button.disabled = false;
    document.getElementById('valid-feedback').style.color = 'green';
    document.getElementById('valid-feedback').innerHTML = 'Password matching';
  }

 
  if (document.getElementById('password').value.length < 8 || document.getElementById('cpassword').value.length < 8) {
    button.disabled = true;
    document.getElementById('invalid-feedback').style.color = 'red';
    document.getElementById('invalid-feedback').innerHTML = 'Password must be 8 characters or more';
  } else {
    button.disabled = false;
    document.getElementById('invalid-feedback').style.color = 'green';
    document.getElementById('invalid-feedback').innerHTML = 'Password valid';
  }
}

var verifyPassword = function(){

        
        
        document.getElementById('message').style.display='inline-block';        
        if (document.getElementById('password').value.length<8){
                document.querySelector('#submit').disabled = true;

                document.getElementById('invalid-feedback').style.color = 'red';
                document.getElementById('invalid-feedback').innerHTML = 'Password must be 8 characters or more ';}
        else{
                document.querySelector('#submit').disabled = false;

                document.getElementById('invalid-feedback').style.color = 'green';
                document.getElementById('invalid-feedback').innerHTML = 'Password valid';
        }
}
const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', () => {
    const toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}
var check_event = function(){
        document.getElementById('message').style.display='inline-block';        
        if (parseInt(document.getElementById('seatAvailability').value)<10||document.getElementById('seatAvailability').value.length==0){
                document.querySelector('#submitButton').disabled = true;
                document.getElementById('invalid-feedback').style.color = 'red';
                document.getElementById('invalid-feedback').innerHTML = 'Number of seats must be greater than 10 ';}
        else{
                document.querySelector('#submitButton').disabled = false;

                document.getElementById('invalid-feedback').style.color = 'green';
                document.getElementById('invalid-feedback').innerHTML = 'Number of seats is valid';
        }
}