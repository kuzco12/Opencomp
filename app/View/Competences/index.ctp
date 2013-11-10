<div class="page-title">
    <h2><?php echo __('Instructions officielles').' <small>Programmes 2008 & 2012</small>'; ?></h2>
    <div class="btn-toolbar">
		<div class="btn-group ontitle">
			<?php echo $this->Html->link('<i class="icon-resize-full"></i> '.__('Déplier l\'arbre'), '#', array('class' => 'btn', 'escape' => false, 'onclick' => "$('#demo1').jstree('open_all', -1, true);")); ?>
			<?php echo $this->Html->link('<i class="icon-resize-small"></i> '.__('Replier l\'arbre'), '#', array('class' => 'btn', 'escape' => false, 'onclick' => "$('#demo1').jstree('close_all', -1, true);")); ?>
		</div>
	</div>
</div>

<?php if(AuthComponent::user('role') !== 'admin'){ ?>
	<div class="alert alert-info">
	<i class="icon-info-sign icon-3x pull-left"></i> 
	  Dans Opencomp, les référentiels sont utilisés de façon à hiérarchiser les items lors de l'impression de documents papier de synthèse (Bulletin, LPC).<br />
	  Seul l'administrateur de l'application a la possibilité de modifier les référentiels. Vous pouvez néanmoins consulter l'arborescence de ce référentiel.
	</div>
<?php }else{
	echo $this->Html->link(
		' <i class="icon-plus"></i> '.__('créer une nouvelle compétence à la racine de l\'arbre'), 
		array(
            'admin'=> true,
			'controller' => 'competences', 
			'action' => 'add'
		), 
		array(
			'escape' => false,
			'style' => 'color:green;'
		)
	);
}
?>

<div id="demo1" class="jstree-default" style="margin-top:20px;">
<?php echo $this->Tree->generate($stuff, array('element' => 'competences_ref'));  ?>
</div>