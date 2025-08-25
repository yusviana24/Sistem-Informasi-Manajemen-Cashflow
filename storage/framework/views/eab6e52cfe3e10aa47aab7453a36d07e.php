<?php $__env->startPush('style'); ?>
    <style>
        .table-primary {
            background: #170061 !important;
            color: #fff !important;
        }

        .btn-primary,
        .btn-warning {
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
                    <form action="<?php echo e(route('money-in.index')); ?>" method="GET">
                        <div class="d-flex gap-4 items-center">
                            <div class="form-floating mb-3">
                                <input type="month" class="form-control" id="periode" name="periode"
                                    placeholder="Periode" value="<?php echo e(request('periode') ?? date('Y-m')); ?>"
                                    onchange="this.form.submit()">
                                <label for="periode"><i class="bi bi-calendar"></i> Periode</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="category_id" id="category_id" class="form-select"
                                    onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e(request('category_id') == $item->id ? 'selected' : ''); ?>><?php echo e($item->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label for="category_id"><i class="bi bi-calendar"></i> Category</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="source" id="source" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="0" <?php echo e(request('source') === '0' ? 'selected' : ''); ?>>Individual
                                    </option>
                                    <option value="1" <?php echo e(request('source') === '1' ? 'selected' : ''); ?>>Organisasi
                                    </option>
                                </select>
                                <label for="source"><i class="bi bi-calendar"></i> Source</label>
                            </div>
                        </div>
                    </form>

                    <table id="datatable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="table-dark text-center">No</th>
                                <th class="table-primary nowrap">TRX ID</th>
                                <th class="table-primary">Category</th>
                                <th class="table-primary">Amount</th>
                                <th class="table-primary">Method</th>
                                <th class="table-primary">Source</th>
                                <th class="table-primary">Payment From</th>
                                <th class="table-primary">Ext Reference</th>
                                <th class="table-primary not-print not-export-excel">Payment Proof</th>
                                <th class="table-primary">Payment Date</th>
                                <th class="table-primary">Payment Note</th>
                                <th class="table-primary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $type = [
                                    0 => 'Cash',
                                    1 => 'Bank Transfer',
                                    2 => 'Other',
                                ];
                                $source = [
                                    0 => 'Individual',
                                    1 => 'Organisasi',
                                ];
                            ?>
                            <?php $__currentLoopData = $moneyin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                    <td><?php echo e($type[$item->payment_method]); ?> </td>
                                    <td><?php echo e($source[$item->source]); ?></td>
                                    <td> <?php echo e($item->payment_from ?? '-'); ?> </td>
                                    <td> <?php echo e($item->ext_doc_ref ?? '-'); ?> </td>
                                    <td class="not-print not-export-excel text-center">
                                        <?php if($item->proof): ?>
                                            <a href="<?php echo e(route('money-in.download', $item->proof)); ?>" target="_blank"
                                                class="btn btn-primary">
                                                <i class="ti ti-download"></i>
                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>

                                    </td>
                                    <td> <?php echo e(\Carbon\Carbon::parse($item->payment_date)->format('d/m/Y')); ?></td>
                                    <td><?php echo e($item->note ?? '-'); ?></td>
                                    <td>
                                        <a href="#" class="custom-btn warning p-3" style="width: 34px; height: 34px;"
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
                <form action="<?php echo e(route('moneyin.store')); ?>" method="post" class="needs-validation" novalidate
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
                            <label for="source">Sumber<span class="text-danger">*</span></label>
                            <select name="source" class="select-add"
                                class="form-control <?php $__errorArgs = ['source'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option></option>
                                <option value="0">Individual</option>
                                <option value="1">Organisasi</option>
                            </select>
                            <?php $__errorArgs = ['source'];
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
                            <input type="text" id="from_pay"
                                class="form-control <?php $__errorArgs = ['payment_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="payment_from"
                                value="<?php echo e(old('payment_from')); ?>" placeholder="Payment From">
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
                            <input type="hidden" name="piutang" value="0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="piutang_id"
                                    name="piutang" value="1" style="border: 0.5px solid #ccc"
                                    <?php echo e(old('piutang') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="piutang_id">Tambah Piutang</label>
                            </div>
                        </div>

                        <div class="<?php echo e(old('piutang') ? '' : 'd-none'); ?>" id="piutang_box">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalBackdropLabel">Catat Piutang</h1>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="input-group has-validation mb-3">
                                        <div class="form-floating is-invalid">
                                            <input type="number"
                                                class="form-control <?php $__errorArgs = ['amount_piutang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                id="amount_piutang_idr" name="amount_piutang" placeholder="Amount"
                                                value="<?php echo e(old('amount')); ?>" readonly>
                                            <label for="amount_piutang_idr">Amount</label>
                                        </div>
                                        <span class="input-group-text">IDR</span>
                                        <?php $__errorArgs = ['amount_piutang'];
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
                                    <input type="text" id="ext_reference" name="ext_doc_ref_piutang"
                                        class="form-control <?php $__errorArgs = ['ext_doc_ref_piutang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('ext_doc_ref_piutang')); ?>"
                                        placeholder="External Document Reference">
                                    <label for="ext_reference">External Document Reference (Opsional)</label>
                                    <?php $__errorArgs = ['ext_doc_ref_piutang'];
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
                                        class="form-control <?php $__errorArgs = ['payment_from_piutang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="payment_from_piutang" value="<?php echo e(old('payment_from_piutang')); ?>"
                                        placeholder="Payment From">
                                    <label for="from_pay">Payment From (Opsional)</label>
                                    <?php $__errorArgs = ['payment_from_piutang'];
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
                                    <label for="type_piutang">Payment Type<span class="text-danger">*</span></label>
                                    <select name="type_piutang" class="form-control <?php $__errorArgs = ['type_piutang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="type_piutang">
                                        <option selected disabled>Pilih Type Pembayaran</option>
                                        <option value="full" <?php echo e(old('type_piutang') == 'full' ? 'selected' : ''); ?>>Pembayaran Penuh</option>
                                        <option value="installment" <?php echo e(old('type_piutang') == 'installment' ? 'selected' : ''); ?>>Cicilan</option>
                                    </select>
                                    <?php $__errorArgs = ['type_piutang'];
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

                                <div class="input-group has-validation mb-3 d-none" id="installment_piutang">
                                    <div class="form-floating is-invalid">
                                        <input type="number" step="1"
                                            class="form-control <?php $__errorArgs = ['installement_count_piutang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="installement_count_piutang_id" name="installement_count_piutang"
                                            placeholder="installement_count_piutang" value="<?php echo e(old('installement_count_piutang')); ?>">
                                        <label for="installement_count_piutang_id">Jumlah Cicilan</label>
                                    </div>
                                    <span class="input-group-text">X</span>
                                    <?php $__errorArgs = ['installement_count_piutang'];
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
                                    <label for="due_date_piutang">Due Date<span class="text-danger">*</span></label>
                                    <input type="date" id="due_date_piutang"
                                        class="form-control <?php $__errorArgs = ['due_date_piutang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="due_date_piutang" value="<?php echo e(old('due_date_piutang')); ?>">
                                    <?php $__errorArgs = ['due_date_piutang'];
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
                                    <textarea class="form-control" placeholder="Note (Opsional)" id="note_piutang" name="note_piutang"
                                        style="height: 150px"></textarea>
                                    <label for="note_piutang">Note (Opsional)</label>
                                </div>
                                <?php $__errorArgs = ['note_piutang'];
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
    

    
    <?php $__currentLoopData = $moneyin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <form action="<?php echo e(route('money-in.update', $item->trx_id)); ?>" method="post" class="needs-validation"
                        novalidate enctype="multipart/form-data">
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



                            <div class="mb-3">
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
                                <label for="source">Sumber<span class="text-danger">*</span></label>
                                <select name="source" class="select-edit"
                                    class="form-control <?php $__errorArgs = ['source'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option></option>
                                    <option value="0" <?php echo e($item->source == 0 ? 'selected' : ''); ?>>Individual</option>
                                    <option value="1" <?php echo e($item->source == 1 ? 'selected' : ''); ?>>Organisasi</option>
                                </select>
                                <?php $__errorArgs = ['source'];
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
            const checkbox = document.getElementById('piutang_id');
            const piutangDiv = document.getElementById('piutang_box');
            const typeSelectPiutang = document.getElementById('type_piutang');
            const installmentGroupPiutang = document.getElementById('installment_piutang');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    piutangDiv.classList.remove('d-none');
                } else {
                    piutangDiv.classList.add('d-none');
                }
            });

            function toggleInstallmentFieldPiutang() {
                if (typeSelectPiutang && installmentGroupPiutang) {
                    if (typeSelectPiutang.value === 'installment') {
                        installmentGroupPiutang.classList.remove('d-none');
                    } else {
                        installmentGroupPiutang.classList.add('d-none');
                    }
                }
            }
            if(typeSelectPiutang && installmentGroupPiutang) {
                toggleInstallmentFieldPiutang();
                typeSelectPiutang.addEventListener('change', toggleInstallmentFieldPiutang);
            }

            // Sinkronisasi amount utama ke amount piutang
            const mainAmountInput = document.getElementById('amount_idr');
            const piutangAmountInput = document.getElementById('amount_piutang_idr');
            if(mainAmountInput && piutangAmountInput) {
                function syncPiutangAmount() {
                    piutangAmountInput.value = mainAmountInput.value;
                }
                mainAmountInput.addEventListener('input', syncPiutangAmount);
                syncPiutangAmount();
            }
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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.home', ['title' => 'Money In'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PA-ABH\resources\views/page/data-master/money-in.blade.php ENDPATH**/ ?>