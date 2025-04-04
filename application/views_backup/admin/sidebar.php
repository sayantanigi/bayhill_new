<?php $settings = $this->Adminmodel->get('settings', true, 'settingId', '1'); ?>
<div data-simplebar class="sidebar-menu-scroll">
    <div id="sidebar-menu">
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>
            <li class="<?= (!empty($page) && $page == 'dashboard')? 'mm-active' : ''; ?>">
                <a href="<?=base_url('admin/dashboard')?>" class="waves-effect"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="<?= (!empty($page) && $page == 'cms')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'cms')? 'mm-active' : ''; ?>">
                    <i class="fa fa-bookmark"></i>
                    <span>CMS</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li class="<?= (!empty($subpage) && $subpage == 'about_us')? 'mm-active' : ''; ?>">
                        <a href="<?= base_url('admin/cms/about_us') ?>" class="<?= (!empty($subpage) && $subpage == 'about_us')? 'mm-active' : ''; ?>">
                            <span class="hide-menu">About Us</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= base_url('admin/cms/privacy') ?>" class="">
                            <span class="hide-menu">Privacy Policy</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= base_url('admin/cms/terms') ?>" class="">
                            <span class="hide-menu">Terms & Condition</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= base_url('admin/cms/help') ?>" class="">
                            <span class="hide-menu">Help & Support</span>
                        </a>
                    </li>
                    <li class="<?= (!empty($subpage) && $subpage == 'faq')? 'mm-active' : ''; ?>">
                        <a href="<?= base_url('admin/faq') ?>" class="<?= (!empty($subpage) && $subpage == 'faq')? 'mm-active' : ''; ?>">
                            <span class="hide-menu">FAQ</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?= (!empty($subpage) && $subpage == 'trainer_list')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'trainer')? 'mm-active' : ''; ?>">
                   <i class="fa fa-bookmark"></i>
                   <span>Manage Trainer</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li class="<?= (!empty($page) && $page == 'Trainers')? 'mm-active' : ''; ?>">
                        <a href="<?= base_url('admin/trainer') ?>" class="<?= (!empty($subpage) && $subpage == 'trainer')? 'active' : ''; ?>">
                            <span class="hide-menu">Trainers List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?= (!empty($subpage) && $subpage == 'course_list')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'courses')? 'mm-active' : ''; ?>">
                   <i class="fa fa-bookmark"></i>
                   <span>Manage Course</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li class="<?= (!empty($page) && $page == 'Courses')? 'mm-active' : ''; ?>">
                        <a href="<?= base_url('admin/course') ?>" class="<?= (!empty($subpage) && $subpage == 'courses')? 'active' : ''; ?>">
                            <span class="hide-menu">Course List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?= (!empty($subpage) && $subpage == 'contact_list')? 'mm-active' : ''; ?>">
                <a href="javascript: void(0);" class="has-arrow waves-effect <?= (!empty($page) && $page == 'contact')? 'mm-active' : ''; ?>">
                   <i class="fa fa-bookmark"></i>
                   <span>Manage Contact</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li class="<?= (!empty($page) && $page == 'Contact')? 'mm-active' : ''; ?>">
                        <a href="<?= base_url('admin/contact') ?>" class="<?= (!empty($subpage) && $subpage == 'contact')? 'active' : ''; ?>">
                            <span class="hide-menu">Contact List</span>
                        </a>
                    </li>
                </ul>
            </li>
       </ul>
    </div>
</div>
</div>
<!-- Left Sidebar End -->