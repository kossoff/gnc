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

  <?php
    $droplink = '?field_patient_reference=' . $node->nid . '&destination=/node/' . $node->nid;

    // We hide the comments and links now so that we can render them later.
    hide($content['field_surname']);
    hide($content['field_name']);
    hide($content['field_patronymic']);
    hide($content['field_medical_history_number']);
    hide($content['field_birthdate']);
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    hide($content['field_view_diagnoses']);
    hide($content['field_view_diaries']);
    hide($content['field_view_ecgs']);
    hide($content['field_view_directions']);
    hide($content['field_view_summarys']);
    hide($content['field_view_misc']);
    print render($content);
  ?>

  <div class="panel patient-info clearfix">
    <div class="left">
      <?php if ($display_submitted): ?>
        <div class="posted">
          <?php if ($user_picture): ?>
            <?php print $user_picture; ?>
          <?php endif; ?>
          <?php print $submitted; ?>
        </div>
      <?php endif; ?>
      <?php print render($title_prefix); ?>
        <h2<?php print $title_attributes; ?>>
          <?php if (!$page): ?>
            <a href="<?php print $node_url; ?>">
          <?php endif; ?>
          <i class="fi-torso"></i>
          <?php print $node->field_surname['und'][0]['value'] . ' '
            . $node->field_name['und'][0]['value'] . ' '
            . $node->field_patronymic['und'][0]['value']; ?>
          <?php if (!$page): ?>
            </a>
          <?php endif; ?></h2>
      <?php print render($title_suffix); ?>
      <p>Возраст: <strong><?php print get_age($node->field_birthdate['und'][0]['value']); ?></strong> лет.</p>
      <p>И/б № <?php print $node->field_medical_history_number['und'][0]['value']; ?></p>
    </div>
    <div class="right">
      <a href="#" class="button small right" data-dropdown="drop"><i class="fi-plus"></i> Добавить</a>
      <ul id="drop" class="tiny f-dropdown" data-dropdown-content="">
        <li><a href="/node/add/diagnosis<?php print $droplink; ?>"><i class="fi-page-copy"></i>&nbsp;Диагноз</a></li>
        <li><a href="/node/add/diary<?php print $droplink; ?>"><i class="fi-calendar"></i>&nbsp;Дневник</a></li>
        <li><a href="/node/add/ecg<?php print $droplink; ?>"><i class="fi-heart"></i>&nbsp;ЭКГ</a></li>
        <li><a href="/node/add/direction<?php print $droplink; ?>"><i class="fi-arrows-out"></i>&nbsp;Направление</a></li>
        <li><a href="/node/add/summary-inspection<?php print $droplink; ?>"><i class="fi-page-multiple"></i>&nbsp;Эпикриз/Осмотр</a></li>
        <li><a href="/node/add/miscellaneous<?php print $droplink; ?>"><i class="fi-asterisk"></i>&nbsp;Разное</a></li>
      </ul>
    </div>
  </div>

  <div class="files">
    <dl class="tabs" data-tab>
      <dd class="active">
        <a href="#diagnoses"><i class="fi-page-copy"></i>&nbsp;Диагнозы</a>
      </dd>
      <dd>
        <a href="#diaries"><i class="fi-calendar"></i>&nbsp;Дневники</a></dd>
      <dd>
        <a href="#ecgs"><i class="fi-heart"></i>&nbsp;ЭКГ</a>
      </dd>
      <dd>
        <a href="#directions"><i class="fi-arrows-out"></i>&nbsp;Направления</a>
      </dd>
      <dd>
        <a href="#summarys"><i class="fi-page-multiple"></i>&nbsp;Эпикризы&Осмотры</a>
      </dd>
      <dd>
        <a href="#misc"><i class="fi-asterisk"></i>&nbsp;Разное</a>
      </dd>
    </dl>
    <div class="tabs-content">
      <div class="content active" id="diagnoses">
        <?php print render($content['field_view_diagnoses']); ?>
      </div>
      <div class="content" id="diaries">
        <?php print render($content['field_view_diaries']); ?>
      </div>
      <div class="content" id="ecgs">
        <?php print render($content['field_view_ecgs']); ?>
      </div>
      <div class="content" id="directions">
        <?php print render($content['field_view_directions']); ?>
      </div>
      <div class="content" id="summarys">
        <?php print render($content['field_view_summarys']); ?>
      </div>
      <div class="content" id="misc">
        <?php print render($content['field_view_misc']); ?>
      </div>
    </div>
  </div>

  <?php if (!empty($content['field_tags']) && !$is_front): ?>
    <?php print render($content['field_tags']) ?>
  <?php endif; ?>

  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>

</article>
