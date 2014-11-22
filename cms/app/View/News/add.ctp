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

<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Add new <?php echo $ModelName?></h5>
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
		<?php
			echo $this->Session->flash();
		?>
		<div class="users form span8">
			<?php echo $this->Form->create($ModelName, array('url' => array("controller"=>$ControllerName,"action"=>"Add"),'class' => 'form', 'type' => 'file')); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Add new <?php echo strtolower($ModelName)?></h6>
						</div>
						
						<?php
							/*
							echo $this->Form->input('author_id', array(
								'label'			=> 'Author (*)',
								'div'			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after'			=> '</div>',
								'error'			=> array('attributes' => array('wrap' => 'label', 'class' =>  'formRight error')),
								"empty"			=> "Please choose",
								'options'		=> $users
								));
							*/
						?>
						<?php
							echo $this->Form->input('title', array(
								'label'			=> 'Title (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error'))
							));
						?>
						<?php
							echo $this->Form->input('description', array(
								'label' 		=> 'Description (*)',
								'div'			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after'			=> '</div>',
								'error'			=>  array('attributes' => array('wrap' => 'label', 'class' => 'formRight error'))
							));
						?>
						<?php
							echo $this->Form->input('published_date', array(
								'type'			=> 'text',
								'id'			=> $time,
								'label'			=> 'Published Date (*)',
								'div'			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after'			=> '</div>',
								'error'			=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error'))
								));
						?>
						<?php
							//echo $this->Aimfox->printImageByImageId(1, array('class' => 'Bakso'));
							//echo $this->Form->input('Image.id', array('type' => 'hidden'));
							echo $this->Form->input('Image.attachment', array(
								'type'		=>	'file',
								'label'		=>	'Image',
								'div' 		=> 'formRow',
								'between' 	=> '<div class="formRight">',
								'after' 	=> '<div style="width:100%;float:left;display:block"><p>Recomended size 800 x 500<p></div></div>',
								'error' 	=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' => ''
							));
						?>
						<?php
							echo $this->Form->input('status', array(
								'label'			=> 'Status (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								"empty"			=> "Please choose",
								//"empty"			=> false,
								"default"		=> "1",
								'options' 		=> array("0"=>"Not Active","1"=>"Active")
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
<script>$(document).ready(function(){
	$( "#<?php echo $time?>" ).datepicker({ 
		dateFormat: 'yy-mm-dd',
		changeYear: true,
		yearRange: "1960:2014"
	});

	$("#<?php echo $time?>-select-status").chosen(); 
	$("#<?php echo $time?>-select-hub").chosen(); 
});</script>
