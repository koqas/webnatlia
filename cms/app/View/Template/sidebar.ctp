<!--sidebar nav start-->
     <ul class="nav nav-pills nav-stacked custom-nav">
<<<<<<< HEAD
        <?php foreach($menu as $menu):?>
            <li> <a href="<?php echo $this->webroot . $menu["CmsMenu"]["url"]?>" title="<?php echo $menu["CmsMenu"]["name"]?>">
                <i class="fa fa-home"></i> <span><?php echo $menu["CmsMenu"]["name"]?></span></a></li>
                <?php
					if(!empty($menu["CmsSubmenu"])) {
						echo "<strong>".count($menu['CmsSubmenu'])."</strong>";
					}
				?>
=======
        <?php foreach($menu as $menu):
            $current  = ($menu["CmsMenu"]["id"] == $sidebar_id ) ? "active" : "";
        ?>
            <li><a href="<?php echo $this->webroot . $menu["CmsMenu"]["url"]?>" title="<?php echo $menu["CmsMenu"]["name"]?>">
                <i class="fa fa-home"></i> <span><?php echo $menu["CmsMenu"]["name"]?></span></a></li>
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
        <?php endforeach;?>
     </ul>
<!--sidebar nav end-->