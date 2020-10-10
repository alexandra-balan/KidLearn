<?php $__env->startSection('main'); ?>
    <div><?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?></div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Raspunsurile corectate</h1>
            <br>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    
                    

                    <td>Răspunsul corectat</td>
                    <td>Materie</td>
                    <td>Elev</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="table-active">
                        <td>
                            <p
                               style="
                                           display: -webkit-box;
                                            -webkit-line-clamp: 3;
                                            -webkit-box-orient: vertical;
                                            overflow:hidden;
                                            text-overflow: ellipsis;
                                          ">
                                <?php echo e($answer->teacherAnswer); ?>

                            </p></td>
                        <td><?php echo e($answer->subject); ?> </td>
                        <td><?php echo e($answer->name); ?> </td>
                        <td>
                        <form method="get" action="<?php echo e(route('difference.show', $answer->tId)); ?>">
                            <a href="<?php echo e(route('difference.show', $answer->tId)); ?>" class="btn btn-primary">Vezi diferențele
                            </a>
                        </form></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo $answers->render(); ?>

            <div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/teacherAnswers/index.blade.php ENDPATH**/ ?>