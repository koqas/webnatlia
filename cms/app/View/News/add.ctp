<script type="text/javascript">
	
	var mapOptions;
	var map;
	var marker = false;
	var editVersion = false; 
	
	function initialize() {
		mapOptions = {
			center: new google.maps.LatLng(3.140516, 101.678467),
			zoom: 11,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("map-canvas"),
		mapOptions);
		
		checkMarker();
		
	}
	
	function placeMarker(position, map) {
		if(editVersion) {

			if(marker == false) {
				
				marker = new google.maps.Marker({
					position: position, 
					map: map,
					draggable: true
				});
				map.panTo(position);
				
				google.maps.event.addListener(marker, 'dragend', function(e){
					placeMarker(e.latLng, map);
				});
				
			} else {

				marker.setPosition(position);
				map.panTo(position);
			}
			geocodePosition(position);
			setMarkerPosition();
		} else {
			alert('Please turn on edit mode');
		}
		
	}
	
	function geocodePosition(pos) {
	}
	
	function updateMarkerAddress(text) {
		if($("#PlaceAddress").val() == "") {
			$("#PlaceAddress").val(text);
		}
	}
	
	function setMarkerPosition() {
		$("#<?php echo $ModelName ?>Lat").val(marker.getPosition().lat());
		$("#<?php echo $ModelName ?>Lng").val(marker.getPosition().lng());
	}
	
	function changeRegion() {
		var branchId = $('#<?php echo $ModelName ?>RegionId').val();
		$("#loaderRegionId").html('loading');
		removeDropZoneValue();
		$.getJSON("<?php echo $this->webroot ?>Zones/getListZoneByRegionId/"+branchId+".json", function(data){
			if(data.data.Error) {
				
			} else {
				$.each(data.data, function (index, value) {  
					var listItem = $("<option></option>").val(index).html(value);  
					$("#<?php echo $ModelName ?>ZoneId").append(listItem);  
				});
			}
			
			$("#loaderRegionId").html('');
		});
		
	}
	
	function removeDropZoneValue() {
		$("#<?php echo $ModelName ?>ZoneId option").remove();
		var listItem = $("<option></option>").val("").html("Please choose");  
		$("#<?php echo $ModelName ?>ZoneId").append(listItem);
		$("#<?php echo $ModelName ?>ZoneId").val(false);
	}
	
	function checkMarker() {
		var latValue = $("#<?php echo $ModelName ?>Lat").val();
		var lngValue = $("#<?php echo $ModelName ?>Lng").val();

		if(latValue != "") {
			position = new google.maps.LatLng(latValue, lngValue);
			editVersion = true;
			placeMarker(position, map);
			editVersion = false;
		}
		
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
	
	$(document).ready(function(){
		
		$("#<?php echo $ModelName ?>RegionId").change(changeRegion);
		
		$("#editButton").addClass('redB');
		
		$("#editButton").click(function(){
			if(editVersion) {
				$("#editButton").removeClass('blueB').html("<span>Edit</span>");
				$("#editButton").addClass('redB');		
				editVersion = false;
				google.maps.event.clearListeners(map, 'click');
				if(marker != false) {
					marker.setDraggable(false);
				}
			} else {
				editVersion = true;
				
				google.maps.event.addListener(map, 'click', function(e) {
					placeMarker(e.latLng, map);
				});
				
				$("#editButton").removeClass('redB').html("<span>Save</span>");		
				$("#editButton").addClass('blueB');
				
				if(marker != false) {
					marker.setDraggable(true);
				}
				
			}
		});
		
	});
	
	$(window).load(function() {
		changeRegion();
	});
	
</script>

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
							echo $this->Form->input('title', array(
								'label'			=> array('class' => 'col-lg-2 col-sm-2 control-label', 'text' => 'Title'),
								'class'			=> 'form-control',
								'div' 			=> 'form-group',
								'between'		=> '<div class="col-lg-10">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> 'News Title'
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