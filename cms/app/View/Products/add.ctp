<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Add new <?php echo strtolower($ModelName)?></h5>
            <span><?php echo $this->Html->link('Index', array('action' => 'index')); ?></span>
        </div>
        <div class="middleNav">
	        <ul>
				<li class="mUser"><a href="<?php echo $settings["cms_url"].$ControllerName ?>" title="View List"><span class="list"></span></a></li>
	        </ul>
	    </div>
    </div>
</div>

<div class="line"></div>

<div class="wrapper">
	<div class="fluid">
		<div class="users form span8">
			<?php echo $this->Form->create($ModelName, array("type"=>"file",'url' => array("controller"=>$ControllerName,"action"=>"Add","?"=>"debug=1"),'class' => 'form')); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Add new <?php echo strtolower($ModelName)?></h6>
						</div>
						<?php
							echo $this->Form->input('product_category_id', array(
								'label'			=> 'Product Category(*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Product Category',
								'options'		=>	$productcategories
							));
						?>

						<?php
							echo $this->Form->input('harga', array(
								'label'			=> 'Harga Product (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Harga Product'
							));
						?>
						
						<?php
							echo $this->Form->input('name', array(
								'label'			=> 'Product Name (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Product Name'
							));
						?>
						
						<?php
							echo $this->Form->input('description', array(
								'label'			=> 'Description (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Description'
							));
						?>

						<?php
							//echo $this->Aimfox->printImageByImageId(1, array('class' => 'Bakso'));
							//echo $this->Form->input('Image.id', array('type' => 'hidden'));
							echo $this->Form->input('Image.attachment', array(
								'type'	=>	'file',
								'label'	=>	'Image',
								'div' => 'formRow',
								'between' => '<div class="formRight">',
								'after' => '<div style="width:100%;float:left;display:block"><p>Recomended size 800 x 500<p></div></div>',
								'error' => array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' => ''
							));
						?>
						
						<?php
							echo $this->Form->input('status', array(
								'label'			=> 'Status (*)',
								'options'		=>	array('0' => 'Not Active', '1' => 'Active'),
								'value'			=>	'1',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'empty' 		=> 'Please Choose'
							));
						?>

						<div class="formSubmit">
							<input type="submit" value="Add" class="redB" />
							<input type="reset" value="Reset" class="blueB"/>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>