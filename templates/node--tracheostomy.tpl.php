<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <h2 class="text-center">ПРОТОКОЛ ТРАХЕОСТОМИИ</h2>
  <p><div class="text-center"><?php print render($content['field_datetime']); ?></div></p>
  <p>
    Больной(ая) <?php print render($content['field_patient_reference']); ?>.
    <?php
      $patient = node_load( $node->field_patient_reference['und'][0]['target_id'] );
     ?>
    Возраст: <?php print get_age_at_date($patient->field_birthdate['und'][0]['value'], $node->field_datetime['und'][0]['value']); ?> лет.
    История болезни №<?php print $patient->field_medical_history_number['und'][0]['value']; ?>.
    Диагноз:
    <?php
      if (isset($node->field_diagnosis_ultimate[LANGUAGE_NONE]))
        print render($content['field_diagnosis_ultimate']);
      else
        print render($content['field_diagnosis_choice']);
    ?>.
  </p>
  <p>Показания к трахеостомии: <?php print render($content['field_tr_evidence']); ?>.</p>
  <p>Показатели перед трахеостомией:
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
      фибриноген <?php print render($content['field_pbc_fibrinogen']); ?> г/л,
    <?php endif; ?>
    <?php if (isset($node->field_trb_fio2[LANGUAGE_NONE])): ?>
      FiO<sub>2</sub> <?php print render($content['field_trb_fio2']); ?> %
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
    Под общей анастезией после обработки операционного поля 1% раствором аквазана и 1% спиртовым раствором хлоргексидина в асептических условиях выполнена
    <?php print render($content['field_tr_type']); ?>
    нижняя <?php print render($content['field_tr_tracheostomy']);?> трахеостомия.
    Установлена трахеостомическая трубка <?php print render($content['field_tr_tube_name']); ?>
    диаметром <?php print render($content['field_tr_tube_number']); ?> мм
    (<?php print render($content['field_tr_tube_vendor']);?>)
    на расстоянии <?php print render($content['field_tr_distance_to_carina']);?> см над бифуркацией трахеи.

    Трудности при трахеостомии &mdash; <?php  print render($content['field_tr_difficulties']); ?>.
    Осложнения во время процедуры &mdash;
    <?php if(!isset($node->field_tr_early_complications[LANGUAGE_NONE]) && !isset($node->field_tr_late_complications[LANGUAGE_NONE])): ?>
      нет.
    <?php else: ?>
      <?php
        if (!isset($node->field_tr_early_complications[LANGUAGE_NONE]) && !isset($node->field_tr_late_complications[LANGUAGE_NONE]))
          print 'нет';
        if (field_get_items('node', $node, 'field_tr_early_complications'))
          print 'ранние: ' . render($content['field_tr_early_complications']);

        if (field_get_items('node', $node, 'field_tr_late_complications')){
          if (field_get_items('node', $node, 'field_tr_early_complications'))
            print ", ";
          print 'поздние: ' . render($content['field_tr_late_complications']);
        }
      ?>.
    <?php endif; ?>
  </p>
  <br />
  <p>
    Реаниматолог: <?php print render($content['field_tr_resuscitator_ref']); ?>
    ________________________
  </p>
  <p>
    Эндоскопист: <?php print render($content['field_tr_endoscopist_ref']); ?>
    ________________________
  </p>
</article>
