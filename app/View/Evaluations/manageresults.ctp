<div class="page-title">
    <h2><?php echo __('Détails d\'une évaluation'); ?></h2>
    <?php echo $this->Html->link('<i class="icon-pencil"></i> '.__('modifier'), 'edit/'.$evaluation['Evaluation']['id'], array('class' => 'ontitle btn btn-primary', 'escape' => false)); ?>
    <?php echo $this->Html->link('<i class="icon-arrow-left"></i> '.__('retour à la classe'), '/classrooms/viewtests/'.$evaluation['Classroom']['id'], array('class' => 'ontitle btn', 'escape' => false)); ?>
</div>

<div class="row">
    <div class="span6">
        <div class="well">
        	<dl class="dl-horizontal">
        		<dt><?php echo __('Identifiant'); ?></dt>
        		<dd>
        			<?php echo h('#'.$evaluation['Evaluation']['id']); ?>
        			&nbsp;
        		</dd>
        		<dt><?php echo __('Titre'); ?></dt>
				<dd>
					<?php echo h($evaluation['Evaluation']['title']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Classe'); ?></dt>
				<dd>
					<?php echo $this->Html->link($evaluation['Classroom']['title'], array('controller' => 'classrooms', 'action' => 'view', $evaluation['Classroom']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Évalué par'); ?></dt>
				<dd>
					<?php echo $this->Html->link('<i class="icon-user"></i>&nbsp;'.$evaluation['User']['first_name'].'&nbsp;'.$evaluation['User']['name'], array('controller' => 'users', 'action' => 'view', $evaluation['User']['id']), array('escape' => false)); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Période'); ?></dt>
				<dd>
					<?php echo $this->Html->link($evaluation['Period']['wellnamed'], array('controller' => 'periods', 'action' => 'view', $evaluation['Period']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Résultats globaux'); ?></dt>
				<dd>
					 <div class="progress" style="margin-bottom:0px;">
					  <div class="info bar bar-success" rel="tooltip" data-placement="bottom" title="<?php echo number_format($resultats['pourcent_A'],1) ?>% des items acquis <br /> <?php echo $resultats['A'] ?> A sur <?php echo $resultats['TOT'] ?> items évalués au total" style="width: <?php echo $resultats['pourcent_A'] ?>%;"></div>
					  <div class="info bar" rel="tooltip" data-placement="bottom" title="<?php echo number_format($resultats['pourcent_B'],1) ?>% des items à renforcer <br /><?php echo $resultats['B'] ?> B sur <?php echo $resultats['TOT'] ?> items évalués au total" style="width: <?php echo $resultats['pourcent_B'] ?>%;"></div>
					  <div class="info bar bar-warning" rel="tooltip" data-placement="bottom" title="<?php echo number_format($resultats['pourcent_C'],1) ?>% des items en cours d'acquisition <br /><?php echo $resultats['C'] ?> C sur <?php echo $resultats['TOT'] ?> items évalués au total" style="width: <?php echo $resultats['pourcent_C'] ?>%;"></div>
					  <div class="info bar bar-danger" rel="tooltip" data-placement="bottom" title="<?php echo number_format($resultats['pourcent_D'],1) ?>% des items non acquis <br /><?php echo $resultats['D'] ?> D sur <?php echo $resultats['TOT'] ?> items évalués au total" style="width: <?php echo $resultats['pourcent_D'] ?>%;"></div>
					</div> 
				</dd>
           	</dl>
        </div>
    </div>
    <div class="span6">
        <div class="page-title">
            <h3><?php echo __('Élèves ayant commis cette évaluation'); ?></h3>
        </div>
        
        <?php
        	$pupils = '';
        	foreach($evaluation['Pupil'] as $pupil){
	        	$pupils .= $pupil['first_name'].'&nbsp;'.$pupil['name'].', ';
        	}
        	$pupils = substr($pupils, 0, -2);
        	$pupils .= '.';
        	echo $pupils;
        ?>          
    </div>
</div>

<ul class="nav nav-pills">
  <li><?php echo $this->Html->link(__('1. Définir les items évalués'), array('controller' => 'evaluations', 'action' => 'attacheditems', $evaluation['Evaluation']['id'])); ?></li>
  <li class="active"><?php echo $this->Html->link(__('2. Saisir les résultats'), array('controller' => 'evaluations', 'action' => 'manageresults', $evaluation['Evaluation']['id'])); ?></li>
  <li class="info" rel="tooltip" data-placement="bottom" data-original-title="Bientôt ..."><?php echo $this->Html->link(__('3. Analyser les résultats'), array('controller' => 'evaluations', 'action' => 'manageresults', $evaluation['Evaluation']['id'])); ?></li>
</ul>

<?php if (!empty($evaluation['Item'])): ?>
	<div class="page-title">
	    <h3><?php echo __('Résultats de cette évaluation'); ?></h3>
	    <?php echo $this->Html->link('<i class="icon-magic"></i> '.__('saisie automagique'), '/results/selectpupil/evaluation_id:'.$evaluation['Evaluation']['id'], array('class' => 'ontitle btn btn-primary', 'escape' => false)); ?>
	</div>
	<table class="table table-stripped table-condensed">
	<tr>
		<th style="width:20%;"><?php echo __('Prénom'); ?></th>
		<th style="width:20%;"><?php echo __('Nom'); ?></th>
		<th style="width:20%;"><?php echo __('Progression de la saisie'); ?></th>
		<th style="width:20%;"><?php echo __('Action'); ?></th>
	</tr>
	<?php
		$total = count($evaluation['Item']);
		foreach ($evaluation['Pupil'] as $pupil): 
		$pupilres = count($pupil['Result']);
		$progress = $pupilres*100/$total; ?>
		<tr>
			<td><?php echo $pupil['first_name']; ?></td>
			<td><?php echo $pupil['name']; ?></td>
			<td style="padding-right:5%;"><div style="height:10px; margin-top:4px; margin-bottom:0px;" class="progress active"><div class="bar" style="font-size: 10px; vertical-align:top; width: <?php echo $progress; ?>%;"><span style="position:relative; top: -4px;"><?php if(intval($progress) > 10) echo intval($progress).'%'; ?></span></div></div></td>
			<td class="actions">
				<?php echo $this->Html->link('<i class="icon-pencil"></i> '.__('Compléter ou modifier la saisie'), array('controller' => 'results', 'action' => 'add', 'pupil_id' => $pupil['id'], 'evaluation_id' => $evaluation['Evaluation']['id']), array('escape' => false)); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else: ?>	
<div class="alert alert-info">
    <i class="icon-info-sign"></i> Vous ne pouvez pas saisir les résultats de cette évaluation car vous ne lui avez pas encore associé d'items.<br />
    Commencez par <?php echo $this->Html->link(__('associer des items'), array('controller' => 'evaluations', 'action' => 'attacheditems', $evaluation['Evaluation']['id'])); ?> à cette évaluation.
</div>
<?php endif; ?>