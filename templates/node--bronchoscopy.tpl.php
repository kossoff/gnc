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
<?php /* field_medical_history_number field_medical_history_year*/ ?>
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
