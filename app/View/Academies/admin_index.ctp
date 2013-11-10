<div class="academies index">
    <div class="page-title">
        <h2><?php echo __('Académies'); ?></h2>
        <?php echo $this->Html->link('<i class="icon-plus"></i> '.__('Ajouter une académie'), 'add', array('class' => 'ontitle btn btn-success', 'escape' => false)); ?>
    </div>
    
    <div class="row">
        <div class="span6">
    
        	<table class="table table-striped table-condensed">
            	<tr>
            			<th><?php echo $this->Paginator->sort('name', $this->Utils->sorting_sign('name', $this->Paginator->sortKey(), $this->Paginator->sortDir()).__('Nom de l\'académie'), array('escape' => false)); ?></th>
            			<th><?php echo $this->Paginator->sort('type', $this->Utils->sorting_sign('type', $this->Paginator->sortKey(), $this->Paginator->sortDir()).__('Type d\'académie'), array('escape' => false)); ?></th>
            			<th class="actions"><?php echo __('Actions'); ?></th>
            	</tr>
        	<?php
        	foreach ($academies as $academy): ?>
            	<tr>
            		<td><?php echo h($academy['Academy']['name']); ?></td>
            		<td><?php if ($academy['Academy']['type'] == 0) {echo 'Académie';} else {echo 'Sous rectorat';} ?></td>
            		<td class="actions">
            		    <?php echo $this->Html->link('<button class="btn btn-mini"><i class="icon-eye-open"></i> '.__('Voir').'</button>', array('action' => 'view', $academy['Academy']['id']), array('escape' => false)); ?>
            		</td>
            	</tr>
        	<?php endforeach; ?>
        	</table>
        	
        	<?php echo $this->element('pagination'); ?>
        	
        </div>
    </div>
    
</div>
