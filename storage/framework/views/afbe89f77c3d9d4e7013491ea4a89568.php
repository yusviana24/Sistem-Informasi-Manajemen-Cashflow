<?php $__env->startPush('style'); ?>
    <style>
        .table-primary {
            background: #170061 !important;
            color: #fff !important;
        }

        .btn-primary {
            border-radius: 15px 0 15px 0;
            padding: 5px 7px;
        }

        .modal-content {
            border-radius: 20px 0 20px 0;
            padding: 10px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        <?php echo e($title); ?>

                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="<?php echo e(route('piutang.index')); ?>" method="GET">
                        <div class="form-floating mb-3" style="width: 20%;">
                            <input type="month" class="form-control" id="periode" name="periode" placeholder="Periode"
                                value="<?php echo e(request('periode') ?? date('Y-m')); ?>" onchange="this.form.submit()">
                            <label for="periode"><i class="bi bi-calendar"></i> Periode</label>
                        </div>
                    </form>
                    <table id="datatable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="table-dark text-center" style="width: 2%">No</th>
                                <th class="table-primary" style="width: 10%">TRX ID</th>
                                <th class="table-primary" style="width: 10%">Amount</th>
                                <th class="table-primary" style="width: 10%">Due Date</th>
                                <th class="table-primary" style="width: 10%">From</th>
                                <th class="table-primary" style="width: 10%">Ext Reference</th>
                                <th class="table-primary" style="width: 10%">Payment Type</th>
                                <th class="table-primary" style="width: 10%">Sisa Utang</th>
                                <th class="table-primary not-print" style="width: 5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $status = [
                                    0 => 'Belum Lunas',
                                    1 => 'Lunas',
                                ];
                                $type = [
                                    'installment' => 'Cicilan',
                                    'full' => 'Pembayaran Penuh',
                                ];
                            ?>
                            <?php $__currentLoopData = $utang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td class="text-nowrap">
                                        <?php echo e($item->trx_id); ?>

                                        <span style="cursor: pointer;"
                                            onclick="copyToClipboard(this, '<?php echo e($item->trx_id); ?>')" title="Copy">
                                            <i class="ti ti-copy"></i>
                                        </span>
                                    </td>
                                    <td class="text-nowrap"> Rp. <?php echo e(number_format($item->amount, 0, ',', '.')); ?> </td>
                                    <td class="text-nowrap">
                                        <?php echo e(\Carbon\Carbon::parse($item->due_date)->locale('id')->translatedFormat('d F Y')); ?>

                                    </td>
                                    <td> <?php echo e($item->payment_from ?? '-'); ?> </td>
                                    <td>
                                        <?php echo e($item->ext_doc_ref ?? '-'); ?>

                                        <?php if(!empty($item->ext_doc_ref)): ?>
                                            <span style="cursor: pointer;"
                                                onclick="copyToClipboard(this, '<?php echo e($item->ext_doc_ref); ?>')" title="Copy">
                                                <i class="ti ti-copy"></i>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td> <?php echo e($type[$item->type]); ?> </td>
                                    <td>
                                        <?php if($item->type == 'installment'): ?>
                                            Rp. <?php echo e(number_format($item->installments->where('is_paid', false)->sum('amount'), 0, ',', '.')); ?>

                                        <?php else: ?>
                                            <?php echo e($item->is_paid ? 'Rp. 0' : 'Rp. ' . number_format($item->amount, 0, ',', '.')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="not-print">
                                        <?php if($item->type == 'installment'): ?>
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <span class="badge bg-<?php echo e($item->is_paid == 1 ? 'success' : 'danger'); ?>">
                                                    <?php echo e($status[$item->is_paid]); ?>

                                                </span>

                                                <a href="#" class="btn btn-info btn-sm" title="Edit"
                                                    data-bs-toggle="modal" data-bs-target="#modalLihat<?php echo e($item->trx_id); ?>">
                                                    <i class="ti ti-eye" style="font-size: 16x; color: #fff;"></i>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <span class="badge bg-<?php echo e($item->is_paid == 1 ? 'success' : 'danger'); ?>">
                                                    <?php echo e($status[$item->is_paid]); ?>

                                                </span>

                                                <form action="<?php echo e(route('utang.update-status', $item->trx_id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="text" name="is_paid"
                                                        value="<?php echo e($item->is_paid == 1 ? 0 : 1); ?>" hidden>
                                                    <button
                                                        class="btn btn-sm btn-<?php echo e($item->is_paid ? 'danger' : 'success'); ?>">
                                                        <i class="ti ti-status-change"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php $__currentLoopData = $utang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade modalLihat" id="modalLihat<?php echo e($item->trx_id); ?>" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLihatLabel<?php echo e($item->trx_id); ?>"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-xl">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLihatLabel<?php echo e($item->trx_id); ?>">Lihat
                            <?php echo e($title); ?>

                        </h1>
                        <button type="button" class="custom-btn red close-modal p-3" style="width: 16px; height: 16px;"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="ti ti-x" style="font-size: 16px; color: #fff;"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                            $installments = $item->installments;
                        ?>

                        <?php if($installments->count()): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $installments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cicilan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($cicilan->due_date)->translatedFormat('d F Y')); ?>

                                            </td>
                                            <td>Rp <?php echo e(number_format($cicilan->amount, 0, ',', '.')); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo e($cicilan->is_paid ? 'success' : 'danger'); ?>">
                                                    <?php echo e($cicilan->is_paid ? 'Lunas' : 'Belum Lunas'); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <form action="<?php echo e(route('utang.installment.update-status', $cicilan->id)); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="is_paid"
                                                        value="<?php echo e($cicilan->is_paid ? 0 : 1); ?>">
                                                    <button
                                                        class="btn btn-sm btn-<?php echo e($cicilan->is_paid ? 'danger' : 'success'); ?>">
                                                        <i class="ti ti-status-change"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        function copyToClipboard(element, text) {
            navigator.clipboard.writeText(text).then(() => {
                let icon = element.querySelector('i');
                icon.classList.remove('ti-copy');
                icon.classList.add('ti-circle-check');
                setTimeout(() => {
                    icon.classList.remove('ti-circle-check');
                    icon.classList.add('ti-copy');
                }, 3000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        function resetValidation(modalElement) {
            const inputs = modalElement.querySelectorAll('.is-invalid');
            inputs.forEach(input => input.classList.remove('is-invalid'));

            const feedbacks = modalElement.querySelectorAll('.invalid-feedback');
            feedbacks.forEach(fb => fb.remove());
        }

        document.addEventListener("DOMContentLoaded", function() {
            <?php if($errors->any() && old('form_type')): ?>
                var formType = '<?php echo e(old('form_type')); ?>';
                if (formType.startsWith('edit-')) {
                    var errorEditId = formType.replace('edit-', '');
                    document.querySelectorAll('.modalEdit').forEach(function(modal) {
                        var modalInstance = new bootstrap.Modal(modal);
                        var id = modal.getAttribute('data-id');

                        if (id === errorEditId) {
                            modalInstance.show();
                        }

                        modal.addEventListener("hidden.bs.modal", function() {
                            window.location.reload();
                        });

                        modal.addEventListener("show.bs.modal", function() {
                            if (typeof resetValidation === 'function') {
                                resetValidation(modal);
                            }
                        });
                    });
                }
            <?php endif; ?>
        });

        $(document).ready(function() {
            $("#datatable").DataTable({});
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.home', ['title' => 'Utang'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PA-ABH\resources\views/page/data-master/utang.blade.php ENDPATH**/ ?>