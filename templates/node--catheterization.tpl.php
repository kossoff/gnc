<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <h2 class="text-center">ПРОТОКОЛ КАТЕТЕРИЗАЦИИ</h2>
  <p><div class="text-center"><?php print render($content['field_datetime']); ?></div></p>
  <p>
    Больной(ая) <?php print render($content['field_patient_reference']); ?>.
    <?php
      $patient = node_load( $node->field_patient_reference['und'][0]['target_id'] );
     ?>
    Возраст: <?php print get_age_at_date($patient->field_birthdate['und'][0]['value'], $node->field_datetime['und'][0]['value']); ?> лет.
    История болезни №<?php
if (isset($node->field_medical_history_number[LANGUAGE_NONE]))
  print render($content['field_medical_history_number']);
else
  print $patient->field_medical_history_number['und'][0]['value']; ?>.
    Диагноз:
    <?php
      if (isset($node->field_diagnosis_ultimate[LANGUAGE_NONE]))
        print render($content['field_diagnosis_ultimate']);
      else
        print render($content['field_diagnosis_choice']);
    ?>.
  </p>
  <p>
    Показание к катетеризации &mdash; <?php print render($content['field_indications4catheteriz']); ?>.
    Катетеризация <?php print render($content['field_catheterization_type']); ?>.
  </p>
  <p>
    Показатели перед катетеризацией:
    <?php if (isset($node->field_pbc_leukocytes[LANGUAGE_NONE])): ?>
      лейкоциты <?php print render($content['field_pbc_leukocytes']); ?> x10^9/л,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_thrombocytes[LANGUAGE_NONE])): ?>
      тромбоциты <?php print render($content['field_pbc_thrombocytes']); ?> x10^9/л,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_achtv[LANGUAGE_NONE])): ?>
      АЧТВ <?php print render($content['field_pbc_achtv']); ?> сек.,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_pi[LANGUAGE_NONE])): ?>
      ПИ <?php print render($content['field_pbc_pi']); ?> %,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_f8[LANGUAGE_NONE])): ?>
      FVIII <?php print render($content['field_pbc_f8']); ?> %,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_fibrinogen[LANGUAGE_NONE])): ?>
      фибриноген <?php print render($content['field_pbc_fibrinogen']); ?> г/л
    <?php endif; ?>.

    <?php if($node->field_cathz_preparation['und'][0]['value']): ?>
      Подготовка:&ensp;
      <?php if (isset($node->field_preparation_szp[LANGUAGE_NONE])): ?>
        СЗП &mdash; <?php print render($content['field_preparation_szp']) . ', '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_thrombocyte[LANGUAGE_NONE])): ?>
        тромбоциты &mdash; <?php print render($content['field_preparation_thrombocyte']) . ' доз, '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_krio[LANGUAGE_NONE])): ?>
        КРИО &mdash; <?php print render($content['field_preparation_krio']) . ', '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_protromplex[LANGUAGE_NONE])): ?>
        протромплекс &mdash; <?php print render($content['field_preparation_protromplex']) . ' ед., '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_f8[LANGUAGE_NONE])): ?>
        FVIII &mdash; <?php print render($content['field_preparation_f8']) . ' ед., '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_f7[LANGUAGE_NONE])): ?>
        FVII &mdash; <?php print render($content['field_preparation_f7']) . ' ед., '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_additional[LANGUAGE_NONE])): ?>
        <?php print render($content['field_preparation_additional']); ?>
      <?php endif; ?>
      .
      Результат подготовки:
      <?php if (isset($node->field_pap_leukocytes[LANGUAGE_NONE])): ?>
        лейкоциты <?php print render($content['field_pap_leukocytes']); ?> x10^9/л,
      <?php endif; ?>
      <?php if (isset($node->field_pap_thrombocytes[LANGUAGE_NONE])): ?>
        тромбоциты <?php print render($content['field_pap_thrombocytes']); ?> x10^9/л,
      <?php endif; ?>
      <?php if (isset($node->field_pap_achtv[LANGUAGE_NONE])): ?>
        АЧТВ <?php print render($content['field_pap_achtv']); ?> сек.,
      <?php endif; ?>
      <?php if (isset($node->field_pap_pi[LANGUAGE_NONE])): ?>
        ПИ <?php print render($content['field_pap_pi']); ?> %,
      <?php endif; ?>
      <?php if (isset($node->field_pap_f8[LANGUAGE_NONE])): ?>
        FVIII <?php print render($content['field_pap_f8']); ?> %,
      <?php endif; ?>
      <?php if (isset($node->field_pap_fibrinogen[LANGUAGE_NONE])): ?>
        фибриноген <?php print render($content['field_pap_fibrinogen']); ?> г/л
      <?php endif; ?>.
    <?php else: ?>
      Без подготовки.
    <?php endif; ?>
  </p>
  <p>
    После обработки операционного поля 1% аквазаном и 1% спиртовым раствором хлоргексидина в асептических условиях

    <?php if ($node->field_anesthesia_type['und'][0]['value'] > 0): ?>
      под местной анестезией
      <?php print render($content['field_anesthesia_type']); ?>
      <?php print render($content['field_anesthesia_amount']); ?> мл
    <?php elseif ($node->field_anesthesia_type['und'][0]['value'] == 0): ?>
      под общей анестезией
    <?php elseif ($node->field_anesthesia_type['und'][0]['value'] == -1): ?>
      без анестезии
    <?php endif; ?>
    выполнена пункция и катетеризация <?php print render($content['field_cathz_vessel']); ?>.
    Всего предпринято попыток: <?php print render($content['field_cathz_number_attempts']); ?>.
    ЭКГ контроль положения катетера и высокий зубец P из правого предсердия (спайк) <?php print render($content['field_cathz_spike']); ?>.
    Результат &mdash; <?php print render($content['field_cathz_result']); ?>,
    <?php
      if ($node->field_cathz_result['und'][0]['value'] != 1 )
        print "катетер не установлен";
      else
        print "установлен катетер " . render($content['field_catheter']);
    ?>.
    Трудности при катетеризации &mdash;
    <?php
      if (!$node->field_cathz_difficulties['und'][0]['value'])
        print render($content['field_cathz_difficulties']);
      else
        print 'были, ' . render($content['field_cathz_difficulties_list']);
    ?>.
    Осложнения во время процедуры &mdash;
    <?php if(!isset($node->field_cathz_compl_early[LANGUAGE_NONE]) && !isset($node->field_cathz_compl_late[LANGUAGE_NONE])): ?>
      нет.
    <?php else: ?>
      <?php
        if ($node->field_cathz_compl_early['und'][0]['value'] == 0 && $node->field_cathz_compl_late['und'][0]['value'] == 0)
          print 'нет';
        if ($node->field_cathz_compl_early[LANGUAGE_NONE][0]['value'] != 0)
          print render($content['field_cathz_compl_early']);

        if ($node->field_cathz_compl_late['und'][0]['value'] != 0){
          if ($node->field_cathz_compl_early['und'][0]['value'] != 0)
            print ", ";
          print render($content['field_cathz_compl_late']);
        }
      ?>.
    <?php endif; ?>
  </p>
  <?php if (!empty($content['field_cathz_tips'])): ?>
    <p>Рекомендации: <?php print render($content['field_cathz_tips']); ?>.</p>
  <?php endif; ?>
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
