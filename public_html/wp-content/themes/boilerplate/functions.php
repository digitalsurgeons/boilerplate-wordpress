<?php

add_theme_support('title-tag');

if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
}

// render components based on file name matching from flexible content plugin
function get_components() {
  global $UI_DEBUG;

  if(have_rows('components')):
    while (have_rows('components')) : the_row();
      $layout = get_row_layout();
      $path = ABSPATH . './components/' . $layout . '/index.php';
      if (file_exists($path)):
        if ($UI_DEBUG):
          echo '<h2 class="ui-title">' . $layout . '</h2>';
        endif;
        require($path);
      endif;
    endwhile;
  endif;
}

// include single component
function get_component($name) {
  $path = ABSPATH . './components/' . $name . '/index.php';
  if (file_exists($path)):
    require($path);
  endif;
}
