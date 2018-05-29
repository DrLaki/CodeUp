      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

      <section id="main">
        <div class="main-header">
            <ul class="path">
                <?php path_to_problem($track_name, $category_name, $problem_name, $problem_id) ?>
            </ul>
            <!-- end path -->

            <?php
            /*<div class="progress">
              <span class="attr"> Points: </span>
              <span class="points value"> 0.0 </span>

              <!-- non breaking space -->
              &nbsp; &nbsp;
              <span class="attr"> Rank: </span>
              <span class="rank value"> 126129 </span>
            </div>*/
            ?>
        </div>
        <!-- end main header -->

        <div class="problem-window">
          <div class="problem-name">
            <h2><? echo $problem_name ?></h2>
            <?php
            /*<span class="attr">by</span>
            <span class="author value">unknown</span>*/
            ?>
          </div>

          <div class="navigation">
            <nav>
              <ul>
                <li> <a href="#" class="current">Problem</a> </li>
                <li> <a href="#">Submissions</a> </li>
                <li> <a href="#">Discussion</a> </li>
                <li> <a href="#">Editorial</a> </li>
              </ul>
            </nav>
          </div>

          <div class="problem-descr">
              <div class="description-border">
                  <h4 class="description">Problem description</h4>
                  <p class="description"><?php echo $problem_description ?></p>

                  <h4 class="sample-input">Sample Input</h4>
                  <p id="sample-input" class="field"><?php echo $problem_sample_input ?></p>

                  <h4 class="sample-output">Sample Output</h4>
                  <p id="sample-output" class="field"><?php echo $problem_sample_output ?></p>

                  <h4 class="explanation">Explanation</h4>
                  <p id="explanation"><?php echo $problem_explanation ?></p>
              </div>
          </div>

          <!-- <div class="sidebar">

          </div> -->

          <div class="editor-window">
            <div class="editor-options">
              <ul>
                <li> <a href="#">Theme</a> </li>
                <li> <a href="#">Tab Size</a> </li>
                <li> <a href="#">Language</a> </li>
              </ul>
            </div>
            <div id="codeeditor"></div>
            <pre id="message"></pre>
          </div>


          <div class="submit-button">
               <button id="run" onclick="compile('run')">Run</button>
          </div>
          <div class="submit-button">
               <button id="submit" onclick="compile('submit')">Submit</button>
          </div>




        </div>
        <!-- end problem-window -->

      </section>
      <!-- end main section -->
