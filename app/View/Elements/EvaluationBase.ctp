<div class="page-title">
    <h2><?php echo __('Détails d\'une évaluation'); ?></h2>
    <?php echo $this->Html->link('<i class="icon-pencil"></i> '.__('modifier'), 'edit/'.$evaluation['Evaluation']['id'], array('class' => 'ontitle btn btn-primary', 'escape' => false)); ?>
    <?php echo $this->Html->link('<i class="icon-arrow-left"></i> '.__('retour à la classe'), '/classrooms/viewtests/'.$evaluation['Classroom']['id'], array('class' => 'ontitle btn btn-default', 'escape' => false)); ?>
</div>

<div class="row">
    <div class="col-md-6">
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
                <?php if(isset($resultats)): ?>
                <dt><?php echo __('Résultats globaux'); ?></dt>
                <dd>
                    <div class="progress" style="margin-bottom:0px;">
                        <div class="info progress-bar progress-bar-success" rel="tooltip" data-placement="bottom" title="<?php echo number_format($resultats['pourcent_A'],1) ?>% des items acquis <?php echo $resultats['A'] ?> A sur <?php echo $resultats['TOT'] ?> items évalués au total" style="width: <?php echo $resultats['pourcent_A'] ?>%;"></div>
                        <div class="info progress-bar" rel="tooltip" data-placement="bottom" title="<?php echo number_format($resultats['pourcent_B'],1) ?>% des items à renforcer <?php echo $resultats['B'] ?> B sur <?php echo $resultats['TOT'] ?> items évalués au total" style="width: <?php echo $resultats['pourcent_B'] ?>%;"></div>
                        <div class="info progress-bar progress-bar-warning" rel="tooltip" data-placement="bottom" title="<?php echo number_format($resultats['pourcent_C'],1) ?>% des items en cours d'acquisition <?php echo $resultats['C'] ?> C sur <?php echo $resultats['TOT'] ?> items évalués au total" style="width: <?php echo $resultats['pourcent_C'] ?>%;"></div>
                        <div class="info progress-bar progress-bar-danger" rel="tooltip" data-placement="bottom" title="<?php echo number_format($resultats['pourcent_D'],1) ?>% des items non acquis <?php echo $resultats['D'] ?> D sur <?php echo $resultats['TOT'] ?> items évalués au total" style="width: <?php echo $resultats['pourcent_D'] ?>%;"></div>
                    </div>
                </dd>
                <?php endif; ?>
            </dl>
        </div>
    </div>
    <div class="col-md-6">
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