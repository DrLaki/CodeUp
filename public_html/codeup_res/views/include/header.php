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
                <?php foreach($navigation as $navigation_name => $navigation_url) { ?>
                <li class="custom-button button-basic"> <a href="./<?php echo $navigation_url ?>"><?php echo $navigation_name?></a></li>
                <?php }; ?>
            </ul>
          </nav>

        </header>
                <!-- end header -->
