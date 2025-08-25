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
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBackdrop">
                        <i class="ti ti-plus"></i>
                        Catat <?php echo e($subtitle); ?>

                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="<?php echo e(route('money-out.index')); ?>" method="GET">
                        <div class="form-floating mb-3" style="width: 20%;">
                            <input type="month" class="form-control" id="periode" name="periode" placeholder="Periode"
                                value="<?php echo e(request('periode') ?? date('Y-m')); ?>" onchange="this.form.submit()">
                            <label for="periode"><i class="bi bi-calendar"></i> Periode</label>
                        </div>
                    </form>

                    <table id="datatable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="table-dark text-center">No</th>
                                <th class="table-primary nowrap">TRX ID</th>
                                <th class="table-primary">Category</th>
                                <th class="table-primary">Amount</th>
                                <th class="table-primary">Source</th>
                                <th class="table-primary">Payment To</th>
                                <th class="table-primary">Ext Reference</th>
                                <th class="table-primary not-print not-export-excel">Payment Proof</th>
                                <th class="table-primary">Payment Date</th>
                                <th class="table-primary">Payment Note</th>
                                <th class="table-primary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $moneyout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $type = [
                                        0 => 'Cash',
                                        1 => 'Bank Transfer',
                                        2 => 'Other',
                                    ];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td class="text-nowrap">
                                        <?php echo e($item->trx_id); ?>

                                        <span style="cursor: pointer;"
                                            onclick="copyToClipboard(this, '<?php echo e($item->trx_id); ?>')" title="Copy">
                                            <i class="ti ti-copy"></i>
                                        </span>
                                    </td>
                                    <td> <?php echo e($item->category->name); ?> </td>
                                    <td class="text-nowrap"> Rp. <?php echo e(number_format($item->amount, 0, ',', '.')); ?> </td>
                                    <td><?php echo e($type[$item->payment_method] ?? '-'); ?> </td>
                                    <td> <?php echo e($item->payment_to ?? '-'); ?> </td>
                                    <td> <?php echo e($item->ext_doc_ref ?? '-'); ?> </td>
                                    <td class="not-print not-export-excel">
                                        <?php if($item->proof): ?>
                                            <a href="<?php echo e(route('money-out.download', $item->proof)); ?>" target="_blank"
                                                class="btn btn-primary">
                                                <i class="ti ti-download"></i>
                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td> <?php echo e(\Carbon\Carbon::parse($item->payment_date)->format('d/m/Y')); ?></td>
                                    <td> <?php echo e($item->note ?? '-'); ?> </td>
                                    <td>
                                        <a href="#" class="custom-btn warning p-3" style="width: 34px; height:34px;"
                                            title="Edit" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit<?php echo e($item->trx_id); ?>">
                                            <i class="ti ti-edit" style="font-size: 20px; color: #000;"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade" id="modalBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalBackdropLabel">Catat <?php echo e($subtitle); ?></h1>
                    <button type="button" class="custom-btn red close-modal p-3" style="width: 16px; height: 16px;"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x" style="font-size: 16px; color: #fff;"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('moneyout.store')); ?>" method="post" class="needs-validation" novalidate
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="form_type" value="tambah">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category_id">Category<span class="text-danger">*</span></label>
                            <select name="category_id" class="select-add"
                                class="form-control <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option></option>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($categorys->id); ?> <?php echo e(old('category_id') == $categorys->id ? 'selected' : ''); ?>">
                                        <?php echo e($categorys->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category_id'];
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
                                    id="amount_idr" name="amount" placeholder="Amount" value="<?php echo e(old('amount')); ?>">
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
                        <div class="input-group has-validation mb-3">
                            <div class="form-floating is-invalid">
                                <input type="number" step="0.01"
                                    class="form-control <?php $__errorArgs = ['tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tax_id" name="tax"
                                    placeholder="tax" value="<?php echo e(old('tax')); ?>">
                                <label for="tax_id">Pajak</label>
                            </div>
                            <span class="input-group-text">%</span>
                            <?php $__errorArgs = ['tax'];
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
                        <div class="input-group has-validation mb-3">
                            <div class="form-floating is-valid">
                                <input type="text" class="form-control" id="tax_result" placeholder="Nilai Pajak"
                                    readonly>
                                <label for="tax_result">Total Pajak</label>
                            </div>
                            <span class="input-group-text">IDR</span>
                        </div>



                        <div class="mb-3">
                            <label for="payment_method">Payment Method<span class="text-danger">*</span></label>
                            <select name="payment_method" class="select-add"
                                class="form-control <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option></option>
                                <option value="0">Cash</option>
                                <option value="1">Bank Transfer</option>
                                <option value="2">Other</option>
                            </select>
                            <?php $__errorArgs = ['payment_method'];
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
                            <label for="proof" class="form-label">Proof (Opsional)</label>
                            <input type="file" class="form-control <?php $__errorArgs = ['proof'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="proof" name="proof">
                            <?php $__errorArgs = ['proof'];
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
                            <small class="text-danger">Format upload hanya mendukung extension PDF dan maksimal upload
                                5MB</small>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" id="ext_reference"
                                class="form-control <?php $__errorArgs = ['ext_doc_ref'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="ext_doc_ref"
                                value="<?php echo e(old('ext_doc_ref')); ?>" placeholder="External Document Reference">
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
                            <input type="text" id="to_pay"
                                class="form-control <?php $__errorArgs = ['payment_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="payment_to"
                                value="<?php echo e(old('payment_to')); ?>" placeholder="Payment To">
                            <label for="to_pay">Payment To (Opsional)</label>
                            <?php $__errorArgs = ['payment_to'];
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
                            <label for="pay_date">Payment Date<span class="text-danger">*</span></label>
                            <input type="date" id="pay_date"
                                class="form-control <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="payment_date"
                                value="<?php echo e(old('payment_date')); ?>" max="<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>">
                            <?php $__errorArgs = ['payment_date'];
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
                            <textarea class="form-control" placeholder="Note (Opsional)" id="note" name="note" style="height: 150px"></textarea>
                            <label for="note">Note (Opsional)</label>
                        </div>

                        <div class="mb-3">
                            <input type="hidden" name="utang" value="0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="utang_id"
                                    name="utang" value="1" style="border: 0.5px solid #ccc"
                                    <?php echo e(old('utang') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="utang_id">Tambah Utang</label>
                            </div>
                        </div>


                        <div class="<?php echo e(old('utang') ? '' : 'd-none'); ?>" id="utang_box">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalBackdropLabel">Catat Utang</h1>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="input-group has-validation mb-3">
                                        <div class="form-floating is-invalid">
                                            <input type="number"
                                                class="form-control <?php $__errorArgs = ['amount_utang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                id="amount_utang_idr" name="amount_utang" placeholder="Amount"
                                                value="<?php echo e(old('amount')); ?>" readonly>
                                            <label for="amount_utang_idr">Amount</label>
                                        </div>
                                        <span class="input-group-text">IDR</span>
                                        <?php $__errorArgs = ['amount_utang'];
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

                                <div class="mb-3">
                                    <label for="type">Payment Type<span class="text-danger">*</span></label>
                                    <select name="type"
                                        class="form-control <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option selected disabled>Pilih Type Pembayaran</option>
                                        <option value="full">Pembayaran Penuh</option>
                                        <option value="installment">Cicilan</option>
                                    </select>
                                    <?php $__errorArgs = ['type'];
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

                                <div class="input-group has-validation mb-3 d-none" id="installment">
                                    <div class="form-floating is-invalid">
                                        <input type="number" step="1"
                                            class="form-control <?php $__errorArgs = ['installement_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="installement_count_id" name="installement_count"
                                            placeholder="installement_count" value="<?php echo e(old('installement_count')); ?>">
                                        <label for="installement_count_id">Jumlah Cicilan</label>
                                    </div>
                                    <span class="input-group-text">X</span>
                                    <?php $__errorArgs = ['installement_count'];
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
                                    <input type="text" id="ext_reference" name="ext_doc_ref_utang"
                                        class="form-control <?php $__errorArgs = ['ext_doc_ref_utang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('ext_doc_ref_utang')); ?>" placeholder="External Document Reference">
                                    <label for="ext_reference">External Document Reference (Opsional)</label>
                                    <?php $__errorArgs = ['ext_doc_ref_utang'];
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
                                        class="form-control <?php $__errorArgs = ['payment_from_utang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="payment_from_utang" value="<?php echo e(old('payment_from_utang')); ?>"
                                        placeholder="Payment From">
                                    <label for="from_pay">Payment From (Opsional)</label>
                                    <?php $__errorArgs = ['payment_from_utang'];
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
                                    <label for="due_date_utang">Due Date<span class="text-danger">*</span></label>
                                    <input type="date" id="due_date_utang"
                                        class="form-control <?php $__errorArgs = ['due_date_utang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="due_date_utang" value="<?php echo e(old('due_date_utang')); ?>">
                                    <?php $__errorArgs = ['due_date_utang'];
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
                                    <textarea class="form-control" placeholder="Note (Opsional)" id="note_utang" name="note_utang"
                                        style="height: 150px"></textarea>
                                    <label for="note_utang">Note (Opsional)</label>
                                </div>
                                <?php $__errorArgs = ['note_utang'];
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    
    <?php $__currentLoopData = $moneyout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade modalEdit" id="modalEdit<?php echo e($item->trx_id); ?>" data-id="<?php echo e($item->trx_id); ?>"
            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditLabel<?php echo e($item->trx_id); ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditLabel<?php echo e($item->trx_id); ?>">Edit <?php echo e($title); ?>

                        </h1>
                        <button type="button" class="custom-btn red close-modal p-3" style="width: 16px; height: 16px;"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="ti ti-x" style="font-size: 16px; color: #fff;"></i>
                        </button>
                    </div>
                    <form action="<?php echo e(route('money-out.update', $item->trx_id)); ?>" method="post"
                        class="needs-validation" novalidate enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="form_type" value="edit-<?php echo e($item->trx_id); ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="category_id">Category<span class="text-danger">*</span></label>
                                <select name="category_id" class="select-edit"
                                    class="form-control <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option></option>
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($categorys->id); ?> <?php echo e(old('category_id') == $categorys->id ? 'selected' : ''); ?>"
                                            <?php echo e($item->category_id == $categorys->id ? 'selected' : ''); ?>>
                                            <?php echo e($categorys->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category_id'];
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
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <input type="number" step="0.01"
                                        class="form-control <?php $__errorArgs = ['tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tax_id"
                                        name="tax" placeholder="tax" value="<?php echo e(old('tax', $item->tax)); ?>">
                                    <label for="tax_id">Pajak</label>
                                </div>
                                <span class="input-group-text">%</span>
                                <?php $__errorArgs = ['tax'];
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


                            <div class=" mb-3">
                                <label for="payment_method">Payment Method<span class="text-danger">*</span></label>
                                <select name="payment_method" class="select-edit"
                                    class="form-control <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option></option>
                                    <option value="0" <?php echo e($item->payment_method == 0 ? 'selected' : ''); ?>>Cash
                                    </option>
                                    <option value="1" <?php echo e($item->payment_method == 1 ? 'selected' : ''); ?>>Bank
                                        Transfer</option>
                                    <option value="2" <?php echo e($item->payment_method == 2 ? 'selected' : ''); ?>>Other
                                    </option>
                                </select>
                                <?php $__errorArgs = ['payment_method'];
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
                                <label for="proof" class="form-label">Proof (Opsional)</label>
                                <input type="file" class="form-control <?php $__errorArgs = ['proof'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="proof" name="proof">
                                <small class="text-danger">Kosongkan jika tidak perlu, Format upload hanya mendukung
                                    extension PDF dan maksimal upload
                                    5MB</small>
                                <?php $__errorArgs = ['proof'];
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
                                <input type="text" id="ext_reference"
                                    class="form-control <?php $__errorArgs = ['ext_doc_ref'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="ext_doc_ref"
                                    value="<?php echo e(old('ext_doc_ref')); ?>" placeholder="External Document Reference">
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
                                <input type="text" id="to_pay"
                                    class="form-control <?php $__errorArgs = ['payment_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="payment_to"
                                    value="<?php echo e(old('payment_to', $item->payment_to)); ?>" placeholder="Payment To">
                                <label for="to_pay">Payment To (Opsional)</label>
                                <?php $__errorArgs = ['payment_to'];
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
                                <label for="pay_date">Payment Date<span class="text-danger">*</span></label>
                                <input type="date" id="pay_date"
                                    class="form-control <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="payment_date"
                                    value="<?php echo e(old('payment_date', \Carbon\Carbon::parse($item->payment_date)->format('Y-m-d'))); ?>"
                                    max="<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>">
                                <?php $__errorArgs = ['payment_date'];
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
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('utang_id');
            const utangDiv = document.getElementById('utang_box');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    utangDiv.classList.remove('d-none');
                } else {
                    utangDiv.classList.add('d-none');
                }
            });
        });

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
            var modalTambah = new bootstrap.Modal(document.getElementById('modalBackdrop'));
            <?php if(old('form_type') == 'tambah' && $errors->any()): ?>
                modalTambah.show();
            <?php endif; ?>
            document.getElementById('modalBackdrop').addEventListener("hidden.bs.modal", function() {
                window.location.reload();
            });
            document.querySelectorAll('.modalEdit').forEach(function(modal) {
                var modalInstance = new bootstrap.Modal(modal);

                var id = modal.getAttribute('data-id');

                <?php if($errors->any() && old('form_type')): ?>
                    var formType = '<?php echo e(old('form_type')); ?>';
                    if (formType.startsWith('edit-')) {
                        var errorEditId = formType.replace('edit-', '');
                        if (id === errorEditId) {
                            modalInstance.show();
                        }
                    }
                <?php endif; ?>

                modal.addEventListener("hidden.bs.modal", function() {
                    window.location.reload();
                });
                modal.addEventListener("show.bs.modal", function() {
                    resetValidation(document.getElementById('modalBackdrop'));
                });
            });
        });

        $(document).ready(function() {
            $("#datatable").DataTable({});
        });

        const amountInput = document.getElementById('amount_idr');
        const taxInput = document.getElementById('tax_id');
        const taxResult = document.getElementById('tax_result');

        function calculateTax() {
            const amount = parseFloat(amountInput.value) || 0;
            const taxPercent = parseFloat(taxInput.value) || 0;
            const taxAmount = (amount * taxPercent) / 100;

            // Tampilkan hasil ke field
            taxResult.value = taxAmount.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
        }

        amountInput.addEventListener('input', calculateTax);
        taxInput.addEventListener('input', calculateTax);

        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('pay_date');
            const today = new Date().toISOString().split('T')[0]; // Format: YYYY-MM-DD
            dateInput.max = today;
        });

        document.addEventListener("DOMContentLoaded", function() {
            const typeSelect = document.querySelector('select[name="type"]');
            const installmentGroup = document.getElementById('installment');

            function toggleInstallmentField() {
                if (typeSelect.value === 'installment') {
                    installmentGroup.classList.remove('d-none');
                } else {
                    installmentGroup.classList.add('d-none');
                }
            }

            toggleInstallmentField();

            typeSelect.addEventListener('change', toggleInstallmentField);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Sinkronisasi amount utama ke amount utang
            const mainAmountInput = document.getElementById('amount_idr');
            const utangAmountInput = document.getElementById('amount_utang_idr');
            if(mainAmountInput && utangAmountInput) {
                function syncUtangAmount() {
                    utangAmountInput.value = mainAmountInput.value;
                }
                mainAmountInput.addEventListener('input', syncUtangAmount);
                syncUtangAmount();
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.home', ['title' => 'Money Out'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PA-ABH\resources\views/page/data-master/money-out.blade.php ENDPATH**/ ?>