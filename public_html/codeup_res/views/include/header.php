<!DOCTYPE html>

<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="author" content="CodeUpTeam">
        <meta name="description" content="Learn to code for free">

        <title><?php echo $title; ?></title>

        <?php foreach($css as $style) { ?>
        <link rel="stylesheet" href="../codeup_res/views/css/<?= $style ?>" />
        <?php }; ?>
    </head>

    <body>
      <div class="site">
        <header class="full-width">
          <div id="logo">
            <h1><span class="highlight">Code</span>Up</h1>
          </div>
          <nav class="main-nav">
            <ul>
                <?php foreach($navigation as $nav_item) { ?>
                <li class="custom-button button-basic"> <a href="./<?php if($nav_item == "Home") echo ""; else echo strtolower($nav_item)?>"><?php echo $nav_item?></a></li>
                <?php }; ?>
            </ul>
          </nav>

        </header>
                <!-- end header -->