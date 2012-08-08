<div class="page-title">
    <h2><?php echo __('Ajouter/Modifier un élève'); ?></h2>
    <?php echo $this->Html->link('<i class="icon-arrow-left"></i> '.__('retour à la classe'), '/classrooms/view/'.$this->data['ClassroomsPupil'][0]['classroom_id'], array('class' => 'ontitle btn', 'escape' => false)); ?>
</div>

<?php 

echo $this->Form->create('Classroom', array(
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'between' => '<div class="controls">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
        )
    )
);

echo $this->Form->input('Pupil.id');

echo $this->Form->input('Pupil.first_name', array(
    'label' => array(
        'text' => 'Prénom de l\'élève',
        'class' => 'control-label'
    )
)); 

echo $this->Form->input('Pupil.name', array(
    'label' => array(
        'text' => 'Nom de l\'élève',
        'class' => 'control-label'
    )
)); 

echo $this->Form->input('Pupil.sex', array(
	'type' => 'select',
    'options' => array('M'=>'Masculin','F'=>'Féminin'),
    'label' => array(
        'text' => 'Sexe de l\'élève',
        'class' => 'control-label'
    )
)); 

echo $this->Form->input('Pupil.birthday', array(
    'between' => '<div class="controls"><div class="input-append date datepicker" data-date="'.date('Y-m-d').'" data-date-format="yyyy-mm-dd">',
    'after' => '<span class="add-on"><i class="icon-calendar"></i></span></div></div>',
    'class' => 'span2',
    'type' => 'text',
    'readonly' => 'readonly',
    'label' => array(
        'text' => 'Date de naissance',
        'class' => 'control-label'
    )
)); 

echo $this->Form->hidden('ClassroomsPupil.classroom_id', array('value' => $classroom_id));

echo $this->Form->input('ClassroomsPupil.level_id', array(
	'selected' => $this->data['ClassroomsPupil'][0]['level_id'],
    'label' => array(
        'text' => 'Niveau scolaire',
        'class' => 'control-label'
    )
));

?>

<div class="form-actions">
     <?php echo $this->Form->button('Enregistrer les modifications', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>        
</div>

<?php echo $this->Form->end(); ?>