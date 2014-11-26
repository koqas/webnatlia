<!--dynamic table-->
  <link href="<?php echo $this->webroot; ?>js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="<?php echo $this->webroot; ?>js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $this->webroot; ?>js/data-tables/DT_bootstrap.css" />

<script src="<?php echo $this->webroot; ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/modernizr.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="<?php echo $this->webroot; ?>js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<script src="<?php echo $this->webroot; ?>js/dynamic_table_init.js"></script>

<!--common scripts for all pages-->
<script src="<?php echo $this->webroot; ?>js/scripts.js"></script>

<script>
$(document).ready(function(){
	
	$("#contents_area").css("opacity","0.5");
	$("#contents_area").load("<?php echo $settings['cms_url'] . $ControllerName?>/ListItem",function(){
		$("#contents_area").css("opacity","1");
		$("a[rel^='lightbox']").prettyPhoto({
			social_tools :''									
		});
	});
});

function onClickPage(el,divName)
{
	$(divName).css("opacity","0.5");
	$(divName).load(el.toString(),function(){
		$(divName).css("opacity","1");
		$("a[rel^='lightbox']").prettyPhoto({
			social_tools :''									
		});
	});
	return false;
}
function SearchAdvance()
{
	$("#SearchAdvance").ajaxSubmit({
		url:"<?php echo $settings['cms_url'].$ControllerName ?>/ListItem",
		type:'POST',
		dataType: "html",
		clearForm:false,
		beforeSend:function()
		{
			$("#reset").val("0");
			$("#contents_area").css("opacity","0.5");
		},
		complete:function(data,html)
		{
			$("#contents_area").css("opacity","1");
		},
		error:function(XMLHttpRequest, textStatus,errorThrown)
		{
			alert(textStatus);
		},
		success:function(data)
		{
			$("#contents_area").html(data);
		}
	});
	
	return false;
}
function ClearSearchAdvance()
{
	$("#SearchSalesId").val(0);
	$("#SearchStartDate").val("");
	$("#SearchEndDate").val("");
	$('#reset').val('1');
	SearchAdvance();
}
</script>

<!-- page heading start-->
        <div class="page-heading">
            <h3>
                <?php echo $ControllerName?>
            </h3>
        </div>
<!-- page heading end-->

<!--body wrapper start-->
        <div class="wrapper">
        <div class="row">
        <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="clearfix">
                    <div class="btn-group pull-right">
                        <a href="<?php echo $settings["cms_url"].$ControllerName?>/Add" title="Add New <?php echo $ControllerName?>">
                        <button id="editable-sample_new" class="btn btn-primary" onclick="<?php echo $settings["cms_url"].$ControllerName?>/Add">
                            Add New <i class="fa fa-plus"></i>
                        </button>
                    </a>
                    </div>
            </div>
            </header>
            <div class="panel-body">
                <section id="unseen">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th><?php echo $this->Paginator->sort("$ModelName.id",'ID');?></th>
                            <th><?php echo $this->Paginator->sort("$ModelName.name",'Gallery Name');?></th>
                            <th><?php echo $this->Paginator->sort("$ModelName.place",'Gallery Place');?></th>
                            <th><?php echo $this->Paginator->sort("$ModelName.address",'Gallery Address');?></th>
                            <th><?php echo $this->Paginator->sort("$ModelName.SStatus",'Status');?></th>
                            <th colspan="3"><center>Action</center></th>
                        </tr>
                        </thead>
                        <?php foreach($data as $data): ?>
                            <?php $class    =   ($data[$ModelName]['status'] == "0") ? "style='background-color:#FFDDDE'" : "";?>
                            <tr <?php echo $class?>>
                                <td><?php echo $data[$ModelName]['id'] ?></td>
								<td><?php echo $data[$ModelName]['name'] ?></td>
								<td><?php echo $data[$ModelName]['place'] ?></td>
								<td><?php echo $data[$ModelName]['address'] ?></td>
                                <td><?php echo $data[$ModelName]['SStatus'] ?></td>
                                <td colspan="3">
                                    <?php echo $this->Html->link("Edit", array('action' => 'Edit', $data[$ModelName]['id'])); ?>&nbsp;
                                    <?php if($data[$ModelName]['status']=="1"):?>
                                        <a href="javascript:void(0);" onclick="ChangeStatus('Do you realy want hide this item ?','<?php echo $data[$ModelName]['id']?>','0')">Hide</a>
                                    <?php else:?>
                                        <a href="javascript:void(0);" onclick="ChangeStatus('Do you realy want publish this item ?','<?php echo $data[$ModelName]['id']?>','1')">Publish</a>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="col-lg-offset-9">
                        <ul class="pagination">
                            <?php echo $this->Paginator->prev("<",
                                    array(
                                        "escape"    =>  false,
                                        'tag'       =>  "li",
                                        "class"     =>  "prev"
                                    ),
                                    "<a href='javascript:void(0)'></a>",
                                    array(
                                        'tag'       =>  "li",
                                        "escape"    =>  false,
                                        "class"     =>  "prev"
                                    )
                                );
                            ?>
                            
                            <?php
                                echo $this->Paginator->numbers(array(
                                    'separator'     =>  null,
                                    'tag'           =>  "li",
                                    'currentclass'  =>  'active',
                                    'modulus'       =>  4
                                ));
                            ?>
                            <?php echo $this->Paginator->next(">",
                                    array(
                                        "escape"    =>  false,
                                        'tag'       =>  "li",
                                        "class"     =>  "next"
                                    ),
                                    "<a href='javascript:void(0)'></a>",
                                    array(
                                        'tag'       =>"li",
                                        "escape"    =>  false,
                                        "class"     =>  "next"
                                    )
                                );
                            ?>
                        </ul>
                    </div>
                </section>
            </div>
        </section>
        </div>
        </div>
        </div>
<!--body wrapper end-->