<div class="main-header">
    <div class="main-header-logo">
        <div class="logo-header" data-background-color="dark" style="background-color: #053a81 !important">
            <a href="index.html" class="logo">
                <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="ti ti-menu-2"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="ti ti-menu-2"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <?php if(Auth::user()->photo): ?>
                                <img src="<?php echo e(asset('user/photo/' . Auth::user()->photo)); ?>" alt="..."
                                    class="avatar-img rounded-circle" />
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/img/profile.jpg')); ?>" alt="..."
                                    class="avatar-img rounded-circle" />
                            <?php endif; ?>
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold"><?php echo e(Auth::user()->name); ?></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <?php if(Auth::user()->photo): ?>
                                            <img src="<?php echo e(asset('user/photo/' . Auth::user()->photo)); ?>"
                                                alt="image profile" class="avatar-img rounded" />
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/img/profile.jpg')); ?>" alt="image profile"
                                                class="avatar-img rounded" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="u-text">
                                        <h4><?php echo e(Auth::user()->name); ?></h4>
                                        <p class="text-muted"><?php echo e(Auth::user()->email); ?></p>
                                        <a href="<?php echo e(route('profil.index')); ?>"
                                            class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
<?php /**PATH C:\laragon\www\PA-ABH\resources\views/layouts/components/navbar.blade.php ENDPATH**/ ?>