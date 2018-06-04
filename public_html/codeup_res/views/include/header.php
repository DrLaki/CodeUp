<!DOCTYPE html>

<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="author" content="CodeUpTeam">
        <meta name="description" content="Learn to code for free">

        <title><?php echo $title; ?></title>

        <?php
        foreach($css as $style) {
            echo '<link rel="stylesheet" href="../codeup_res/views/'. $style . '" />';
            echo "\n\t\t";
        };
        echo '
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        ';
        ?>

        <?php
        if(isset($scripts)) {
            foreach($scripts as $script) {
                echo '<script src="' . $script . '"></script>';
                echo "\n\t\t";
            }
        };
        ?>

    </head>

    <body>
      <div class="site">
        <header class="full-width">
          <div id="logo">
            <h1><span class="highlight">Code</span>Up</h1>
          </div>
          <nav class="main-nav">
            <ul>
                <?php foreach($navigation as $nav_item => $navigation_url) {
                    if ($nav_item == "Search"){
                        echo
                        '
                        <form action="search" method="get">
                          <input type="text" class="search-bar" placeholder="Search.." name="username"><button type="submit search-button"><i class="fa fa-search"></i></button>
                        </form>
                        ';
                    }
                    else {
                        echo "
                        <li class='custom-button button-basic'>
                            <a href='$navigation_url'>$nav_item</a>
                        </li>
                        ";
                    }

                }
                ?>
            </ul>
          </nav>

        </header>
                <!-- end header -->
