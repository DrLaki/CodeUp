<section id="main">

    <div class="container container-main">
        <h2 class="form-title">User Support Page</h2>
        <p style="text-align:center;color:red">
            <?php if($error_message != "") echo $error_message ?>
        </p>

        <form id="support-form" action="support" method="post" class="form support-form">
            <!-- Treba promeniti action atribut forme da vodi ka skripti
            koja ce da handle-uje user input. -->
            <fieldset>
                <label style="text-align:center" for="cusomter-support">You want to:</label>
                <select id="customer-support" name="selection">
                    <option value="report-problem">Report a Problem</option>
                    <option value="reguest-feature">Request a Feature</option>
                </select>
                <input type="text" name="form-title" placeholder="Title">
                <textarea name="form-textarea" rows="10"placeholder="Enter your message here"></textarea>
                <input type="submit" name="form-button" value="Submit">
            </fieldset>
        </form>
    </div>

</section>
