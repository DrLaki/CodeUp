
      <section id="main">
        <p id="path-to-problem">
            <?php path_to_problem($file_name, $category_name); ?>
        </p>
        <!-- end path -->

        <div id="categories">
          <h4 class= "title">Categories</h4>
          <ul>
            <?php display_categories($file_name, $categories); ?>
          </ul>
        </div>
        <div id="problem-statements">
          <ul>
            <?php display_problems($file_name, $category_name) ?>
          </ul>
          <div class="page-nav">
            <?php display_navigation($file_name, $category_name) ?>
              <!-- <button type="button" disabled="true" class="prev-page">Prev</button>
              <button type="button" disabled="true" class="next-page">Next</button> -->
          </div>
        </div>
      </section>
      <!-- end main section -->
