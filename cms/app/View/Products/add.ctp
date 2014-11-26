<!-- page heading start-->
<div class="page-heading">
        <h4>
            Add new <?php echo strtolower($ModelName)?>
        </h4>
        <ul class="breadcrumb">
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<section class="wrapper">

	<div class="row">
            <div class="col-lg-8">
                <section class="panel">
                    <header class="panel-heading">
						Add new <?php echo strtolower($ModelName)?>
                    </header>
                    <div class="panel-body">
                    <?php echo $this->Form->create($ModelName, array("type"=>"file",'url' => array("controller"=>$ControllerName,"action"=>"Add","?"=>"debug=1"),'class' => 'form-horizontal adminex-form')); ?>

                    	<?php
							echo $this->Form->input('product_category_id', array(
								'label'			=> array('class' => 'col-lg-2 col-sm-2 control-label', 'text' => 'Product Category'),
								'class'			=> 'form-control',
								'div' 			=> 'form-group',
								'between'		=> '<div class="col-lg-10">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Product Category',
								'options'		=>	$productcategories
							));
						?>

                    	<?php
							echo $this->Form->input('harga', array(
								'label'			=> array('class' => 'col-lg-2 col-sm-2 control-label', 'text' => 'Price'),
								'class'			=> 'form-control',
								'div' 			=> 'form-group',
								'between'		=> '<div class="col-lg-10">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Price'
							));
						?>

						<?php
							echo $this->Form->input('name', array(
								'label'			=> array('class' => 'col-lg-2 col-sm-2 control-label', 'text' => 'Name'),
								'class'			=> 'form-control',
								'div' 			=> 'form-group',
								'between'		=> '<div class="col-lg-10">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Name'
							));
						?>

						<?php
							echo $this->Form->input('description', array(
								'label'			=> array('class' => 'col-lg-2 col-sm-2 control-label', 'text' => 'Description'),
								'class'			=> 'form-control',
								'div' 			=> 'form-group',
								'between'		=> '<div class="col-lg-10">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'Description'
							));
						?>

						<?php
							//echo $this->Aimfox->printImageByImageId(1, array('class' => 'Bakso'));
							//echo $this->Form->input('Image.id', array('type' => 'hidden'));
							echo $this->Form->input('Image.attachment', array(
								'type'			=>	'file',
								'label'			=>	array('class' => 'col-lg-2 col-sm-2 control-label', 'text' => 'Image'),
								'class'			=>	'help-block',
								'div' 			=> 	'form-group',
								'between'		=> 	'<div class="col-lg-10">',
								'after' 		=> 	'</div>',
								'after' 		=>	'<div style="width:100%;float:left;display:block"><p>Recomended size 800 x 500<p></div></div>',
								'error' 		=>	array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 	''
							));
						?>

						<?php
							echo $this->Form->input('status', array(
								'label'			=>  array('class' => 'col-lg-2 col-sm-2 control-label'),
								'class'			=>	'form-control m-bot15',
								'options'		=>	array('0' => 'Not Active', '1' => 'Active'),
								'value'			=>	'1',
								'div' 			=> 'form-group',
								'between'		=> '<div class="col-lg-10">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'empty' 		=> 'Please Choose'
							));
						?>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
        <!--body wrapper end-->
    </div>
    <!-- main content end-->
</section><!-- page start-->