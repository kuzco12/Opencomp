<?php if(isset($manual)): ?>
    <div class="page-title">
        <h2><?php echo __('Saisissez les résultats de l\'évaluation'); ?></h2>
    </div>
    <div class="well">
        Vous êtes sur le point de saisir les résultats de <code><?php echo $pupil['Pupil']['first_name'].' '.$pupil['Pupil']['name']; ?></code> pour l'évaluation <code><?php echo $items[0]['Evaluation']['title']; ?></code>.<br /><br />
        Saisissez l'ensemble des résultats. Pour chaque item, vous pouvez saisir <code>A</code>, <code>B</code>, <code>C</code>, <code>D</code>, <code>NE</code> ou <code>ABS</code> suivi de la touche tabulation. <br /> A la fin de la saisie, les résultats sont automatiquement sauvegardés.
    </div>
<?php else: ?>
    <div class="page-title">
        <h2><?php echo __('<span class="flash">Flashez</span> les résultats de l\'évaluation'); ?></h2>
    </div>
    <div class="well">
      Vous êtes sur le point de saisir les résultats de <code><?php echo $pupil['Pupil']['first_name'].' '.$pupil['Pupil']['name']; ?></code> pour l'évaluation <code><?php echo $items[0]['Evaluation']['title']; ?></code>.<br /><br />
      <span class="flash">Flashez</span> l'ensemble des résultats en utilisant la table de codage.<br /> A la fin de la saisie, les résultats sont automatiquement sauvegardés.
    </div>
<?php endif;

echo $this->Form->create('Results', array('class' => 'form-horizontal'));


foreach($items as $item){
	if(!isset($results[$item['Item']['id']]))
		$results[$item['Item']['id']] = '';

    if(isset($manual)):
        echo $this->Form->input($item['Item']['id'], array(
            'prepend' => '<i class="icon-keyboard"></i>',
            'helpBlock' => $item['Item']['title'],
            'class' => 'span1 result',
            'value' => $results[$item['Item']['id']],
            'label' => array(
                'text' => 'Résultat item '.($item['EvaluationsItem']['position']),
                'class' => 'control-label'
            )
        ));
    else:
        echo $this->Form->input($item['Item']['id'], array(
        'prepend' => '<i class="icon-barcode"></i>',
        'helpBlock' => $item['Item']['title'],
        'class' => 'span1 result',
        'value' => $results[$item['Item']['id']],
        'label' => array(
        'text' => 'Résultat item '.($item['EvaluationsItem']['position']),
        'class' => 'control-label'
        )
        ));
    endif;
}


echo $this->Form->end(); 

?>