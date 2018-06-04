<section id="main">

    <div class="container container-main">
        <h2 class="form-title">User Support Page</h2>

        <form id="support-form" action="search_users" method="post">
            <!-- Treba promeniti action atribut forme da vodi ka skripti
            koja ce da handle-uje user input. -->

            <div class="form-field">
                <input type="text" class="block margin-center minw-400px"
                id="search"
                name="search" value="" placeholder="search">
            </div>

            <div class="button button-submit margin-center">
                <input type="submit" class="block minw-100px margin-center"
                name="submit" value="Submit">
            </div>
        </form>

    </div>

</section>
