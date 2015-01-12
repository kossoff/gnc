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
