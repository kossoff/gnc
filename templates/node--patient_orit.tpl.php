<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php
    // prepopulate taxonomy field
    // &edit[field_diagnosis_choice][und][tid]=tid
    $diagnosis = field_get_items('node', $node, 'field_diagnosis_choice');
    $diagnosis_tid = $diagnosis[0]['tid'];

    $droplink = '?field_patient_reference='
                  . $node->nid
                  //. '&destination=/node/'
                  //. $node->nid
                  . '&edit[field_diagnosis_choice][und]['
                  . $diagnosis_tid
                  . ']='
                  . $diagnosis_tid;

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
    hide($content['field_view_trach']);
  ?>

  <div class="panel patient-info">
    <div class="clearfix">
      <div class="left">
          <div class="posted">
            <?php print $submitted; ?>
          </div>
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
        <div class="age">Возраст: <strong><?php print get_age($node->field_birthdate['und'][0]['value']); ?></strong> лет.
          <?php print render($content['field_birthdate']); ?>
        </div>
        <div class="diagnosis">Диагноз:
          <?php
            if (isset($node->field_diagnosis_ultimate[LANGUAGE_NONE]))
              print render($content['field_diagnosis_ultimate']);
            else
              print render($content['field_diagnosis_choice']);
          ?>
        </div>
        <div class="ib-num">И/б № <strong><?php print $node->field_medical_history_number['und'][0]['value']; ?> / <?php print render($content['field_medical_history_year']); ?></strong></div>
      </div>
      <ul class="button-group right radius">
        <li><a href="/node/add/hospitalization<?php print $droplink; ?>" class="button small secondary"><i class="fi-plus"></i>&nbsp;Госпитализация</a></li>
        <li><a href="#" class="button small secondary disabled"><i class="fi-arrows-out"></i>&nbsp;Направления</a></li>
        <li>
          <a href="#" class="button small" data-dropdown="drop"><i class="fi-plus"></i> Добавить</a>
          <ul id="drop" class="tiny f-dropdown" data-dropdown-content="">
            <li><a href="/node/add/anesthesia<?php print $droplink; ?>"><i class="fi-page-filled"></i>&nbsp;Анестезия</a></li>
            <li><a href="/node/add/bronchoscopy<?php print $droplink; ?>"><i class="fi-magnifying-glass"></i>&nbsp;Бронхоскопия</a></li>
            <li><a href="/node/add/diagnosis<?php print $droplink; ?>"><i class="fi-page-copy"></i>&nbsp;Диагноз</a></li>
            <li><a href="/node/add/diary<?php print $droplink; ?>"><i class="fi-calendar"></i>&nbsp;Дневник</a></li>
            <li><a href="/node/add/catheterization<?php print $droplink; ?>"><i class="fi-first-aid"></i>&nbsp;Катетеризация</a></li>
            <li><a href="/node/add/tracheostomy<?php print $droplink; ?>"><i class="fi-first-aid"></i>&nbsp;Трахеостомия</a></li>
            <li><a href="/node/add/ecg<?php print $droplink; ?>"><i class="fi-heart"></i>&nbsp;ЭКГ</a></li>
            <li><a href="/node/add/summary-inspection<?php print $droplink; ?>"><i class="fi-page-multiple"></i>&nbsp;Эпикриз/Осмотр</a></li>
            <li><a href="/node/add/miscellaneous<?php print $droplink; ?>"><i class="fi-asterisk"></i>&nbsp;Разное</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <hr />
    <?php print render($content['field_view_hospitalizations']); ?>
    <?php if(isset($content['body'])): ?>
      <hr />
      <div id="body"><?php print render($content['body']); ?></div>
    <?php endif; ?>
  </div>

  <div class="files">
    <dl class="accordion" data-accordion>
      <dd class="accordion-navigation">
        <a href="#anesth"><i class="fi-page-filled"></i>&nbsp;Анестезии</a>
        <div class="content" id="anesth">
          <?php print render($content['field_view_anesth']); ?>
        </div>
      </dd>
      <dd class="accordion-navigation">
        <a href="#broncho"><i class="fi-magnifying-glass"></i>&nbsp;Бронхоскопии</a>
        <div class="content" id="broncho">
          <?php print render($content['field_view_broncho']); ?>
        </div>
      </dd>
      <dd class="accordion-navigation">
        <a href="#diagnoses"><i class="fi-page-copy"></i>&nbsp;Диагнозы</a>
        <div class="content" id="diagnoses">
          <?php print render($content['field_view_diagnoses']); ?>
        </div>
      </dd>
      <dd class="accordion-navigation">
        <a href="#diaries"><i class="fi-calendar"></i>&nbsp;Дневники</a>
        <div class="content" id="diaries">
          <?php print render($content['field_view_diaries']); ?>
        </div>
      </dd>
      <dd class="accordion-navigation">
        <a href="#cateter"><i class="fi-first-aid"></i>&nbsp;Катетеризации</a>
        <div class="content" id="cateter">
          <?php print render($content['field_view_katet']); ?>
        </div>
      </dd>
      <dd class="accordion-navigation">
        <a href="#trach"><i class="fi-first-aid"></i>&nbsp;Трахеостомии</a>
        <div class="content" id="trach">
          <?php print render($content['field_view_trach']); ?>
        </div>
      </dd>
      <dd class="accordion-navigation">
        <a href="#summarys"><i class="fi-page-multiple"></i>&nbsp;Эпикризы&Осмотры</a>
        <div class="content" id="summarys">
          <?php print render($content['field_view_summarys']); ?>
        </div>
      </dd>
      <dd class="accordion-navigation">
        <a href="#ecgs"><i class="fi-heart"></i>&nbsp;ЭКГ</a>
        <div class="content" id="ecgs">
          <?php print render($content['field_view_ecgs']); ?>
        </div>
      </dd>
      <dd class="accordion-navigation">
        <a href="#misc"><i class="fi-asterisk"></i>&nbsp;Разное</a>
        <div class="content" id="misc">
          <?php print render($content['field_view_misc']); ?>
        </div>
      </dd>
    </dl>
  </div>
<!--
  <?php print render($content); ?>

  <?php if (!empty($content['field_tags']) && !$is_front): ?>
    <?php print render($content['field_tags']) ?>
  <?php endif; ?>

  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>
-->
</article>
