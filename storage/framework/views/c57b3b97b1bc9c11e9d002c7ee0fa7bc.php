<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('layouts.components.meta-head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <style>
        body {
            background: rgb(11, 74, 161);
            background: radial-gradient(circle, rgba(11, 74, 161, 1) 0%, rgba(5, 58, 129, 1) 0%, rgba(255, 255, 255, 1) 100%);
        }

        .btn-primary {
            background: #0b4aa1 !important;
        }

        .login-card {
            width: 25%;
            opacity: 0.95;
        }

        @media (max-width: 992px) {
            .login-card {
                width: 50%;
            }
        }

        @media (max-width: 576px) {
            .login-card {
                width: 90%;
                padding: 1rem !important;
            }

            .card-header h2 {
                font-size: 1.5rem;
            }

            .card-header img {
                max-width: 45%;
            }
        }
    </style>

</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-5 login-card">
            <div class="card-header bg-transparent border-0">
                <div class="d-flex justify-content-center align-items-center mb-4">
                    <img src="<?php echo e(asset('assets/img/finance/logo_tapp.png')); ?>" alt="" class="w-50 img-fluid me-3">
                    <img src="<?php echo e(asset('assets/img/finance/tekmt.png')); ?>" alt="" class="w-50 img-fluid">
                </div>
                <h2 class="text-center fw-bold text-uppercase">Login</h2>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('login.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-check mt-1">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault" style="user-select: none">
                                Show Password
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const flexCheckDefault = document.getElementById('flexCheckDefault');
        flexCheckDefault.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = flexCheckDefault.checked ? 'text' : 'password';
        })
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\PA-ABH\resources\views/page/auth/signin.blade.php ENDPATH**/ ?>