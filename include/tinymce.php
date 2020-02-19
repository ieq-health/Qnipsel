<?php

// Add code button
add_filter('mce_buttons_2', function($buttons) {
  $buttons[] = 'code';
  return $buttons;
});