<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");


//ako guest pokusava da pogleda neciju profilnu stranicu, treba da mu se zabrani pristup.
//Dakle, ovaj deo php koda ispod komentara ne sme da se izvrsava, tj.    pre ovog komentara treba
//da se uradi provera da li korisnik sme da gleda progile drugih ljudi.
render('header', array(
    'title' => "Privacy Policy",
    'css' => array('css/style.css'),
    'navigation' => $controller->header_navigation()
));
?>

<section id="main">
   <div class="profile-page">
       <div class="profile-info">
           <!-- ako korisnik nema sliku, renderujemo default-nu sliku, sto cu ovde da hardcode-ujem -->
           <img src="../codeup_res/profile_pics/default.png" class="profile-pic" alt="Profile Picture">

           <!-- vrednosti sledecih stavki bi trebalo dinamicki da se generisu -->
           <h3 class="username">Drazen Draskovic</h3>
           <p class="profession">Asistent</p>
           <p class="points"><span class="field-name">Total Points:</span><span class="field-value">-100</span></p>
       </div>

       <div class="achievements">
           <div class="section personal-info">
               <p class="section-title">Profile Information</p>
               <div class="section-content flex-col-nowrap">
                   <p>
                       <span class="field-name">Username:</span>
                       <span class="field-value">Drazen Draskovic</span>
                   </p>
                   <p>
                       <span class="field-name">Country:</span>
                       <span class="field-value">
                           <img src="../codeup_res/flags/Albania.png" class="country-flag" alt="country">
                           (Albania)
                       </span>
                   </p>
                   <p>
                       <span class="field-name">Profession:</span>
                       <span class="field-value">Teaching Assistant</span>
                   </p>

               </div>
           </div>
           <div class="section badges">
               <p class="section-title">Badges</p>
               <div class="section-content flex-row-wrap">
                   <!-- dinamicki se generisu bedzevi koje je korisnik osvojio. Mozda ovaj deo trenutno
               nije prioritet, ali neka logika bi bila da negde mapiramo svaki od achievement-a koji zelimo
           da nagradimo sa lokacijom bedza na serveru (tj gde se taj bedz nalazi, da bismo mogli da ga dohvatimo). -->
                <img src="../codeup_res/badge-icons/001-badge-2.png" class="badge" alt="badge">
                <img src="../codeup_res/badge-icons/002-medal-11.png" class="badge" alt="badge">
                <img src="../codeup_res/badge-icons/003-badge-1.png" class="badge" alt="badge">
               </div>
           </div>
           <div class="section ratings">
               <p class="section-title">Ratings</p>
               <!-- Ovde mozda mozemo po ispisemo osvojene poene po kategorijama,
           eventualno u sortiranom poretku, sa tim sto mozda ne bi trebalo ispisivat
       kategorije iz kojih korisnik ima nula poena (tj iz kojih nije resio nijedan problem) -->
            <div class="section-content flex-col-nowrap">
                <p class="rating"> <span class="field-name">Algorithms:</span> <span class="field-value">572</span> </p>
                <p class="rating"> <span class="field-name">C++:</span></span> <span class="field-value">248</span> </p>
                <p class="rating"> <span class="field-name">Data Structures:</span></span> <span class="field-value">182</span> </p>
            </div>
           </div>
       </div>
   </div>

</section>


<?php
render('footer');
?>
