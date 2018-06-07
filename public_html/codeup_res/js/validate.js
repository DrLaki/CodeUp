
function validate_login_form() {
    var username = document.getElementsByClassName('login-form').username.value;
    console.log(username);
    if (username.length <= 4){
        alert('Username too short!!!!!');
        return false;
    }
}

function validate_signup_form(){

}
