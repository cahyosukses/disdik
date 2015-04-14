<div class="span2">    
    <style>.nav-list > li > a { font-size: 11px; }</style>
    <div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list">
            <li class="nav-header">USERS</li>
            <li><a href="<?php echo site_url('forum/admin/user_edit/'.$this->session->userdata('forum_user_id')); ?>">Profil Ku</a></li>
            <li><a href="<?php echo site_url('forum/admin/user_create'); ?>">User Baru</a></li>
            <li><a href="<?php echo site_url('forum/admin/user_view'); ?>">Lihat Semua</a></li>
            <li class="divider"></li>
            <li class="nav-header">ROLES</li>
            <li><a href="<?php echo site_url('forum/admin/role_create'); ?>">Buat Role Baru</a></li>
            <li><a href="<?php echo site_url('forum/admin/role_view'); ?>">Lihat Semua</a></li>
            <li class="nav-header">THREAD DAN KATEGORI</li>
            <li><a href="<?php echo site_url('forum/admin/category_create'); ?>">Kategori Baru</a></li>
            <li><a href="<?php echo site_url('forum/admin/category_view'); ?>">Semua Kategori</a></li>
            <li><a href="<?php echo site_url('forum/admin/thread_view'); ?>">Semua Thread</a></li>
        </ul>
    </div>
</div>