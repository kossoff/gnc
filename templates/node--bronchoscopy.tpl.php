<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <h2 class="text-center">ПРОТОКОЛ БРОНХОСКОПИИ</h2>
  <p><div class="text-center"><?php print render($content['field_date']); ?></div></p>
  <p>
    Больной(ая) <?php print render($content['field_patient_reference']); ?>.
    <?php
      $patient = node_load( $node->field_patient_reference['und'][0]['target_id'] );
     ?>
    Возраст: <?php print get_age_at_date($patient->field_birthdate['und'][0]['value'], $node->field_date['und'][0]['value']); ?> лет.
    История болезни №<?php print $patient->field_medical_history_number['und'][0]['value']; ?>.
    Диагноз:
    <?php
      if (isset($node->field_diagnosis_ultimate[LANGUAGE_NONE]))
        print render($content['field_diagnosis_ultimate']);
      else
        print render($content['field_diagnosis_choice']);
    ?>.
  </p>
  <p>
    В условиях <?php print render($content['field_in_conditions']); ?>
    <?php if (isset($node->field_bronchoscopy_anesth[LANGUAGE_NONE])): ?>
      <?php if ($node->field_bronchoscopy_anesth['und'][0]['value'] == 0): ?>
        без анестезии
      <?php elseif($node->field_bronchoscopy_anesth['und'][0]['value'] == 1): ?>
        под местной анестезией S. Lidocaini 0,5% <?php print render($content['field_bronchoscopy_anesth_val']); ?> мл.
      <?php elseif($node->field_bronchoscopy_anesth['und'][0]['value'] == 2): ?>
        под общей анестезией
      <?php endif; ?>
    <?php endif; ?>
    через <?php print render($content['field_bronchoscope']); ?>
    выполнена ФБС (бронхоскоп №<?php print render($content['field_bronchoscope_number']); ?>).
  </p>
  <p>
    <?php if($node->field_bal['und'][0]['value']): ?>
      БАЛ выполнялся из сегмента <?php print render($content['field_bal_value']); ?>
      <?php if($node->field_bal_from['und'][0]['value'] == 0): ?>
        правого
      <?php else: ?>
        левого
      <?php endif; ?>
      легкого.
    <?php else: ?>
      БАЛ не выполнялся.
    <?php endif; ?>
    <?php if($node->field_tracheostomy['und'][0]['value'] == 0): ?>
      Трахеостомия не выполнялась.
    <?php else: ?>
      Выполнена <?php print render($content['field_tracheostomy']); ?> трахеостомия.
    <?php endif; ?>
  </p>
  <br />
  <p>
    Врач-реаниматолог: <?php print render($content['field_doctor']); ?>
    ________________________
  </p>

<!--
   <?php if ($display_submitted): ?>
    <div class="posted">
      <?php if ($user_picture): ?>
        <?php print $user_picture; ?>
      <?php endif; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    print render($content);
  ?>

  <?php if (!empty($content['field_tags']) && !$is_front): ?>
    <?php print render($content['field_tags']) ?>
  <?php endif; ?>

  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>
 -->
</article>
