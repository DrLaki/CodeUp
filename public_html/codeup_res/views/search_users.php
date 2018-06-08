<section id="main">

    <div class="form-container">
        <h2 class="form-title">Search Results</h2>
        <form id="support-form" class="search-form" action="search" method="get">
            <!-- Treba promeniti action atribut forme da vodi ka skripti
            koja ce da handle-uje user input. -->
            <input type="search" class="search-bar" placeholder="Search.." name="username">
              <button class="search-button">
                  <i class="fa fa-search"></i>
              </button>
        </form>
    </div>

    <div class="search-results">
        <?php
            if(!empty($users)) {
                foreach ($users as $user_id => $user_information) {
                    $username = $user_information[0];
                    $points = $user_information[1];
                    echo '<p class="result">
                        Username: <a href="profile?id=' . $user_id . '">'
                            . $username .'</a>&nbsp;&nbsp;&nbsp; Points: ' . $points .
                        '</p><hr/>';
                }
            }
            else {
                echo "<p>Sorry, we could not find the user you are searching for.</p>";
            }
        ?>
    </div>
</section>
