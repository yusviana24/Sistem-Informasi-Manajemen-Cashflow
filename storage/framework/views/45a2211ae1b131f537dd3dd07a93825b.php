<?php $__env->startPush('style'); ?>
    <style>
        .table-primary {
            background: #170061 !important;
            color: #fff !important;
        }

        .btn-primary {
            border-radius: 15px 0 15px 0;
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
                                <th class="table-primary" style="width: 10%">Collection ID</th>
                                <th class="table-primary" style="width: 10%">Amount</th>
                                <th class="table-primary" style="width: 10%">Due Date</th>
                                <th class="table-primary" style="width: 10%">From</th>
                                <th class="table-primary" style="width: 10%">Ext Reference</th>
                                <th class="table-primary" style="width: 10%">Payment Type</th>
                                <th class="table-primary" style="width: 10%">Status</th>
                                <th class="table-primary" style="width: 10%">Sisa Piutang</th>
                                <th class="table-primary not-print not-export-excel" style="width: 5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $piutang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td class="text-nowrap">
                                        <?php echo e($item->collection_id); ?>

                                        <span style="cursor: pointer;"
                                            onclick="copyToClipboard(this, '<?php echo e($item->collection_id); ?>')" title="Copy">
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
                                    <td> <?php echo e($item->type == 'installment' ? 'Cicilan' : 'Pembayaran Penuh'); ?> </td>
                                    <td>
                                        <span class="badge bg-<?php echo e($item->is_paid == 1 ? 'success' : 'danger'); ?>">
                                            <?php echo e($item->is_paid == 1 ? 'Lunas' : 'Belum Lunas'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php if($item->type == 'installment'): ?>
                                            Rp. <?php echo e(number_format($item->installments->where('is_paid', false)->sum('amount'), 0, ',', '.')); ?>

                                        <?php else: ?>
                                            <?php echo e($item->is_paid ? 'Rp. 0' : 'Rp. ' . number_format($item->amount, 0, ',', '.')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="not-print not-export-excel">
                                        <?php if($item->type == 'installment'): ?>
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <a href="#" class="btn btn-info btn-sm" title="Lihat Cicilan"
                                                    data-bs-toggle="modal" data-bs-target="#modalLihat<?php echo e($item->collection_id); ?>">
                                                    <i class="ti ti-eye" style="font-size: 16x; color: #fff;"></i>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <form action="<?php echo e(route('piutang.update-status', $item->collection_id)); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <input type="text" name="is_paid" value="<?php echo e($item->is_paid == 1 ? 0 : 1); ?>" hidden>
                                                <button class="btn btn-sm btn-<?php echo e($item->is_paid ? 'danger' : 'success'); ?>">
                                                    <i class="ti ti-status-change"></i>
                                                </button>
                                            </form>
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




    
    <?php $__currentLoopData = $piutang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade modalLihat" id="modalLihat<?php echo e($item->collection_id); ?>" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLihatLabel<?php echo e($item->collection_id); ?>"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-xl">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLihatLabel<?php echo e($item->collection_id); ?>">Lihat
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
                                            <td><?php echo e(\Carbon\Carbon::parse($cicilan->due_date)->translatedFormat('d F Y')); ?></td>
                                            <td>Rp <?php echo e(number_format($cicilan->amount, 0, ',', '.')); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo e($cicilan->is_paid ? 'success' : 'danger'); ?>">
                                                    <?php echo e($cicilan->is_paid ? 'Lunas' : 'Belum Lunas'); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <form action="<?php echo e(route('piutang.installment.update-status', $cicilan->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="is_paid" value="<?php echo e($cicilan->is_paid ? 0 : 1); ?>">
                                                    <button class="btn btn-sm btn-<?php echo e($cicilan->is_paid ? 'danger' : 'success'); ?>">
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
    

    
    <?php $__currentLoopData = $piutang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade modalEdit" id="modalEdit<?php echo e($item->collection_id); ?>" data-id="<?php echo e($item->collection_id); ?>"
            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditLabel<?php echo e($item->collection_id); ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditLabel<?php echo e($item->collection_id); ?>">Edit
                            <?php echo e($title); ?>

                        </h1>
                        <button type="button" class="custom-btn red close-modal p-3" style="width: 16px; height: 16px;"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="ti ti-x" style="font-size: 16px; color: #fff;"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('piutang.update', $item->collection_id)); ?>" method="post"
                        class="needs-validation" novalidate enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="form_type" value="edit-<?php echo e($item->collection_id); ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="input-group has-validation mb-3">
                                    <div class="form-floating is-invalid">
                                        <input type="number" class="form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="amount_idr" name="amount" placeholder="Amount"
                                            value="<?php echo e(old('amount', $item->amount)); ?>">
                                        <label for="amount_idr">Amount</label>
                                    </div>
                                    <span class="input-group-text">IDR</span>
                                    <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" id="ext_reference" name="ext_doc_ref"
                                    class="form-control <?php $__errorArgs = ['ext_doc_ref'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('ext_doc_ref', $item->ext_doc_ref)); ?>"
                                    placeholder="External Document Reference">
                                <label for="ext_reference">External Document Reference (Opsional)</label>
                                <?php $__errorArgs = ['ext_doc_ref'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" id="from_pay"
                                    class="form-control <?php $__errorArgs = ['payment_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="payment_from"
                                    value="<?php echo e(old('payment_from', $item->payment_from)); ?>" placeholder="Payment From">
                                <label for="from_pay">Payment From (Opsional)</label>
                                <?php $__errorArgs = ['payment_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="due_date">Due Date<span class="text-danger">*</span></label>
                                <input type="date" id="due_date"
                                    class="form-control <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="due_date"
                                    value="<?php echo e(old('due_date', \Carbon\Carbon::parse($item->due_date)->format('Y-m-d'))); ?>">
                                <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Note (Opsional)" id="note" name="note" style="height: 150px"><?php echo e(old('note', $item->note)); ?></textarea>
                                <label for="note">Note (Opsional)</label>
                            </div>
                            <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </form>
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

<?php echo $__env->make('layouts.home', ['title' => 'Piutang'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PA-ABH\resources\views/page/data-master/piutang.blade.php ENDPATH**/ ?>