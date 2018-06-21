
function validate_login_form() {
    alert("Uspesno pozvan js kod za validaciju login forme!");
    var form = document.getElementsByClassName('login-form');
    console.log(form);
    // console.log(username);
    if (username.length <= 4){
        alert('Username too short!!!!!');
        return false;
    }
}

function validate_signup_form(){

}
