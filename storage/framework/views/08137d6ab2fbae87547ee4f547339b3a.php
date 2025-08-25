<?php $__env->startPush('style'); ?>
    <style>
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard</h3>
            <h6 class="op-7 mb-2">Sistem Manajemen Keuangan TEKMT</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0"
                style="background: linear-gradient(90deg, #6a7687 0%, #bfc5ce 100%); border-radius: 16px;">
                <div class="card-body">
                    <div>
                        <div class="text-white fw-bold mb-5 d-flex align-items-center justify-content-between">
                            Total Saldo Awal
                            <a href="">
                                <i class="ti ti-arrow-right fs-1 text-white"></i>
                            </a>
                        </div>
                        <div class="card w-100 border-0 shadow-sm" style="height: 100px;">
                            <div class="card-body">
                                <div class="fs-3 fw-bold ">Rp.
                                    <?php echo e(number_format($saldo->amount ?? 0, 0, ',', '.')); ?></div>
                                <div class="-50 small"><?php echo e($saldo->created_at->format('d M Y')); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0"
                style="background: linear-gradient(90deg, #6a7687 0%, #bfc5ce 100%); border-radius: 16px;">
                <div class="card-body">
                    <div>
                        <div class="text-white fw-bold mb-5 d-flex align-items-center justify-content-between">
                            Total Money In
                            <a href="">
                                <i class="ti ti-arrow-right fs-1 text-white"></i>
                            </a>
                        </div>
                        <div class="card w-100 border-0 shadow-sm" style="height: 100px;">
                            <div class="card-body">
                                <div class="fs-3 fw-bold ">Rp.
                                    <?php echo e(number_format($countMoneyIn->sum('amount') ?? 0, 0, ',', '.')); ?></div>
                                <div class="-50 small"><?php echo e($countMoneyIn->count() ?? 0); ?> data from Money In</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0"
                style="background: linear-gradient(90deg, #6a7687 0%, #bfc5ce 100%); border-radius: 16px;">
                <div class="card-body">
                    <div>
                        <div class="text-white fw-bold mb-5 d-flex align-items-center justify-content-between">
                            Total Money Out
                            <a href="">
                                <i class="ti ti-arrow-right fs-1 text-white"></i>
                            </a>
                        </div>
                        <div class="card w-100 border-0 shadow-sm" style="height: 100px;">
                            <div class="card-body">
                                <div class="fs-3 fw-bold ">Rp.
                                    <?php echo e(number_format($countMoneyOut->sum('amount') ?? 0, 0, ',', '.')); ?></div>
                                <div class="-50 small"><?php echo e($countMoneyOut->count() ?? 0); ?> data from Money Out</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0"
                style="background: #e74c3c; border-radius: 16px;">
                <div class="card-body">
                    <div>
                        <div class="text-white fw-bold mb-5 d-flex align-items-center justify-content-between">
                            Total Utang
                            <a href="">
                                <i class="ti ti-arrow-right fs-1 text-white"></i>
                            </a>
                        </div>
                        <div class="card w-100 border-0 shadow-sm" style="height: 100px;">
                            <div class="card-body">
                                <div class="fs-3 fw-bold ">Rp.
                                    <?php echo e(number_format($countUtang->sum('amount') ?? 0, 0, ',', '.')); ?></div>
                                <div class="-50 small"><?php echo e($countUtang->count() ?? 0); ?> data from Utang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0"
                style="background: #e74c3c; border-radius: 16px;">
                <div class="card-body">
                    <div>
                        <div class="text-white fw-bold mb-5 d-flex align-items-center justify-content-between">
                            Total Piutang
                            <a href="">
                                <i class="ti ti-arrow-right fs-1 text-white"></i>
                            </a>
                        </div>
                        <div class="card w-100 border-0 shadow-sm" style="height: 100px;">
                            <div class="card-body">
                                <div class="fs-3 fw-bold ">Rp.
                                    <?php echo e(number_format($countPiutang->sum('amount') ?? 0, 0, ',', '.')); ?></div>
                                <div class="-50 small"><?php echo e($countPiutang->count() ?? 0); ?> data from Piutang</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <form method="GET" action="<?php echo e(route('index')); ?>" class="row mb-4">
                            <div class="col-md-4">
                                <label for="startMonth">Dari Bulan</label>
                                <input type="month" id="startMonth" name="startMonth" class="form-control"
                                    value="<?php echo e(request('startMonth', $startDate->format('Y-m'))); ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="endMonth">Sampai Bulan</label>
                                <input type="month" id="endMonth" name="endMonth" class="form-control"
                                    value="<?php echo e(request('endMonth', $endDate->format('Y-m'))); ?>">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-success me-2">Filter</button>
                                <a href="<?php echo e(route('index')); ?>" class="btn btn-danger">Reset</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-category">
                        <h4>Total Keuangan Selama <?php echo e($monthDiff); ?> Bulan</h4>
                        <?php echo e($startDate->format('F Y')); ?> - <?php echo e($endDate->format('F Y')); ?>

                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1>Rp. <?php echo e(number_format($overalltotal, 0, ',', '.')); ?></h1>
                    </div>
                    <div class="pull-in">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', ['title' => 'Dashboard'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PA-ABH\resources\views/page/index.blade.php ENDPATH**/ ?>