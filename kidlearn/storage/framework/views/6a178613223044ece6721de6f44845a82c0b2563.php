<?php $__env->startSection('main'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/diff.css')); ?>">
    <div class="card-deck">
        <div class="card border-primary mb-3" style="max-width: 20rem;">
            <div class="card-header">Raspunsul elevului</div>
            <div class="card-body">
                <h4 class="card-title"></h4>

                <p class="card-text"><?php echo html_entity_decode($studentAnswerNew, ENT_COMPAT); ?></p>
            </div>
        </div>
        <span></span>
        <div class="card border-primary mb-3" style="max-width: 20rem;">
            <div class="card-header">Raspunsul profesorului</div>
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text"><?php echo $teacherAnswerNew; ?></p>
            </div>
        </div>
        <div class="card border-primary mb-3" style="max-width: 20rem;">
            <div class="card-header">Diferențe</div>
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text"><?php echo $content; ?></p>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/difference/show.blade.php ENDPATH**/ ?>