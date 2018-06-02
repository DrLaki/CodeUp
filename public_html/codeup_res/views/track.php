
      <section id="main">
        <p id="path-to-problem">
            <?php path_to_problem($track_url, $track_name, $category_url, $track_categories[$category_url]); ?>
        </p>
        <!-- end path -->

        <div id="categories">
          <h4 class= "title">Categories</h4>
          <ul>
            <?php $this->render_categories($track_url, $track_categories); ?>
          </ul>
        </div>
        <div id="problem-statements">
          <ul>
            <?php $this->render_problem_statements($category_id) ?>
          </ul>
          <div class="page-nav">
            <?php $this->render_navigation($category_id) ?>
              <!-- <button type="button" disabled="true" class="prev-page">Prev</button>
              <button type="button" disabled="true" class="next-page">Next</button> -->
          </div>
        </div>
      </section>
      <!-- end main section -->
