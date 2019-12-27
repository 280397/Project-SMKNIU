<!-- Sidebar -->
<ul class="sidebar navbar-nav">

    <!-- QUERY MENU -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`,`user_menu`.`ikon`, `menu`
                    FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC
";

    $menu = $this->db->query($queryMenu)->result_array();
    ?>
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('user/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <?php foreach ($menu as $m) : ?>



        <!-- LOOPING MENU -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT *
                        FROM `user_sub_menu` JOIN `user_menu`
                        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                        WHERE `user_sub_menu`.`menu_id` = $menuId
                        AND `user_sub_menu`.`is_active` = 1
       
       ";
        $subMenu = $this->db->query($querySubMenu)->result_array();

        ?>
        <!-- dropdown -->

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="<?= $m['ikon']; ?>"></i>
                <span><?= $m['menu']; ?></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <?php foreach ($subMenu as $sm) : ?>
                    <a class="dropdown-item" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title']; ?></span>
                    </a>

                <?php endforeach; ?>
            </div>
        </li>
    <?php endforeach; ?>
</ul>