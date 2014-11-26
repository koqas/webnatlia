<!--sidebar nav start-->
     <ul class="nav nav-pills nav-stacked custom-nav">
        <?php foreach($menu as $menu):
            $current  = ($menu["CmsMenu"]["id"] == $sidebar_id ) ? "active" : "";
        ?>
            <li><a href="<?php echo $this->webroot . $menu["CmsMenu"]["url"]?>" title="<?php echo $menu["CmsMenu"]["name"]?>">
                <i class="fa fa-home"></i> <span><?php echo $menu["CmsMenu"]["name"]?></span></a></li>
        <?php endforeach;?>
     </ul>
<!--sidebar nav end-->