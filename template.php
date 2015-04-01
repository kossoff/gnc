<?php

/**
 * Implements template_preprocess_html().
 *
 */
//function gnc_preprocess_html(&$variables) {
//  // Add conditional CSS for IE. To use uncomment below and add IE css file
//  drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));
//
//  // Need legacy support for IE downgrade to Foundation 2 or use JS file below
//  // drupal_add_js('http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js', 'external');
//}

/**
 * Implements template_preprocess_page
 *
 */
//function gnc_preprocess_page(&$variables) {
//}

/**
 * Implements template_preprocess_node
 *
 */
//function gnc_preprocess_node(&$variables) {
//}

/*
 Перекрываем форму поиска
 */
function gnc_form_alter(&$form, &$form_state, $form_id) {
  //  для отладки форм
   // drupal_set_message('<pre>' . print_r($form, TRUE) . '</pre>');
  $form['search']['#size'] = 125;
  // $form['#info']['filter-search_api_views_fulltext']['label'] = 'Поиск по сайту';
  $form['search']['#attributes']['placeholder'] = t('Введите поисковый запрос');
  // $form['search']['#attributes']['class'][] = 'hide-for-touch';
  $form['submit']['#attributes']['class'][] = 'small';
}

function gnc_field($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<span ' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</span>';
  }

  // Quick Edit module requires some extra wrappers to work.
  if (module_exists('quickedit')) {
    $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
    foreach ($variables['items'] as $delta => $item) {
      $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
      $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
    }
    $output .= '</div>';
  }
  else {
    $items_total = count($variables['items']);
    $items_counter = 1;

    foreach ($variables['items'] as $item) {
      $output .= drupal_render($item);

      if ($items_counter < $items_total){
        $output .= ", ";
        $items_counter++;
      }
    }
  }

  // Render the top-level DIV.
  $output = '<span class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</span>';

  return $output;
}

function gnc_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<span class="field-label">' . $variables['label'] . ':&nbsp;</span>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<span class="links links-inline">' : '<span class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<span class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</span>';
  }
  $output .= '</span>';

  // Render the top-level DIV.
  // $output = '<span class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</span>';
  $output = '<span class="' . $variables['classes'] . '">' . $output . '</span>';

  return $output;
}

function get_age ( $birthday ) {
  $birthday_timestamp = strtotime($birthday);

  $age = date('Y') - date('Y', $birthday_timestamp);

  if (date('md', $birthday_timestamp) > date('md')) {
    $age--;
  }

  return $age;
}

function get_age_at_date ( $birthday, $date ) {
  $birthday_timestamp = strtotime($birthday);
  $date_timestamp = strtotime($date);

  $age = date('Y', $date_timestamp) - date('Y', $birthday_timestamp);

  if (date('md', $birthday_timestamp) > date('md', $date_timestamp)) {
    $age--;
  }

  return $age;
}
