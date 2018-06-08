<!-- <section id="main"> -->
<section id="main">

  <h2 class="form-title">Add Content</h2>
  <p style="text-align:center;color:red">
      <?php if($error_message != "") echo $error_message ?>
  </p>
  <form action="add_content" method="post" class="form content-form">
      <fieldset>
          <select name="select-action">
              <option value="" selected>---</option>
              <option value="add-track">New Track</option>
              <option value="add-category">New Category</option>
              <option value="add-problem-statement">New Problem Statement</option>
              <option value="add-test-case">New Test Case</option>
          </select>
          <input type="submit" name="submit" class="choose-action-button" value="Go" />
      </fieldset>
  </form>

  <?php $this->new_form($selected_action) ?>

</section>
<!-- end main section -->
