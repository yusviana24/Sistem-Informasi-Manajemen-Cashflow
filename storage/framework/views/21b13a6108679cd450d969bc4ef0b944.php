<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('layouts.components.meta-head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldPushContent('style'); ?>

    
</head>

<body>
    <div class="wrapper">
        <?php echo $__env->make('layouts.components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="main-panel">
            <?php echo $__env->make('layouts.components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="container">
                <div class="page-inner">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>

            <?php echo $__env->make('layouts.components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <?php echo $__env->make('layouts.components.script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldPushContent('script'); ?>

    
    <script>
        $(document).ready(function() {
            $('.select-add').select2({
                placeholder: 'Silahkan Pilih...',
                allowClear: true,
                dropdownParent: $('#modalBackdrop'),
                width: '100%',
                theme: 'bootstrap-5',
            });
        });
        $(document).on('shown.bs.modal', '.modalEdit', function() {
            const modal = $(this);
            modal.find('.select-edit').select2({
                placeholder: 'Silahkan Pilih...',
                allowClear: true,
                dropdownParent: modal,
                width: '100%',
                theme: 'bootstrap-5'
            });
        });
        $(document).on('hidden.bs.modal', '.modalEdit', function() {
            const modal = $(this);
            modal.find('.select-edit').select2('destroy');
        });
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search--dropdown .select2-search__field').placeholder =
                'Ketikan Pencarian...';
        });

        // $(document).ready(function() {
        //     $('.select-edit').select2({
        //         placeholder: 'Silahkan Pilih...',
        //         allowClear: true,
        //         dropdownParent: $('.modalEdit'),
        //         width: '100%',
        //         theme: 'bootstrap-5',
        //     });
        // });
        // $('select').on('select2:open', function() {
        //     $('.select2-search--dropdown .select2-search__field').attr('placeholder', 'Ketikan Pencarian...');
        // });


        setInterval(() => {
            fetch('/trigger-utang-reminder')
                .then(response => response.json())
                .then(data => {
                    console.log('Reminder dipicu:', data);
                })
                .catch(error => {
                    console.error('Gagal polling reminder:', error);
                });
        }, 60000); //tar tinggal ganti, sementara pake ini dulu bel, tadi nya aku nyoba pake corn, biar bisa otomatis
        setInterval(() => {
            fetch('/trigger-piutang-reminder')
                .then(response => response.json())
                .then(data => {
                    console.log('Reminder piutang dipicu:', data);
                })
                .catch(error => {
                    console.error('Gagal polling reminder piutang:', error);
                });
        }, 60000); // 60.000 itu satu menit brarti kalo satu jam tinngal x 60 = 1800000
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\PA-ABH\resources\views/layouts/home.blade.php ENDPATH**/ ?>