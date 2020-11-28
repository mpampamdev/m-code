<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
<?php $uri = strtolower($this->uri->segment(2));
      $getMenu = $this->Core_model->get_main_menu();
?>
<?php foreach ($getMenu->result() as $menu): ?>
  <?php  $url_menu = ($menu->type == "controller") ? site_url(ADMIN_ROUTE."/$menu->controller") : $menu->controller?>
          <?php $getSubMenu = $this->Core_model->get_main_menu($menu->id_menu); ?>
          <?php if ($getSubMenu->num_rows() > 0): ?>
            <?php if (is_allowed("sidebar_view_".str_replace(" ","_",$menu->menu))): ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#menus<?=$menu->id_menu?>" aria-expanded="false" aria-controls="error">
                <i class="<?=$menu->icon?> menu-icon"></i>
                <span class="menu-title"><?=ucwords($menu->menu)?></span>
                <i class="menu-arrow"></i>
              </a>
                <div class="collapse" id="menus<?=$menu->id_menu?>">
                   <ul class="nav flex-column sub-menu">
                <?php foreach ($getSubMenu->result() as $sub_menu): ?>
                  <?php  $url_sub_menu = ($sub_menu->type == "controller") ? site_url(ADMIN_ROUTE."/$sub_menu->controller") : $sub_menu->controller?>
                  <?php if (is_allowed("sidebar_view_".str_replace(" ","_",$sub_menu->menu))): ?>
                    <li class="nav-item">
                      <a class="nav-link <?=$sub_menu->controller == $uri ? 'active':''?>" target="<?=$sub_menu->target?>" href="<?=$url_sub_menu?>">
                        <i class="mdi mdi-checkbox-blank-circle-outline"></i>&nbsp;<?=ucwords($sub_menu->menu)?>
                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
                    </ul>
                  </div>
                </li>
              <?php endif; ?>
            <?php else: ?>
              <?php if (is_allowed("sidebar_view_".str_replace(" ","_",$menu->menu))): ?>
                <li class="nav-item <?=$menu->controller == $uri ? 'active':''?>">
                  <a class="nav-link" target="<?=$menu->target?>" href="<?=$url_menu?>">
                    <i class="<?=$menu->icon?> menu-icon"></i>
                    <span class="menu-title"><?=ucwords($menu->menu)?></span>
                  </a>
                </li>
              <?php endif; ?>
          <?php endif; ?>
<?php endforeach; ?>

  </ul>
</nav>
