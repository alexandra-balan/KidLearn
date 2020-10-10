<?php $__env->startSection('main'); ?>
    <div><?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?></div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Raspunsurile tale</h1>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    
                    
                    <td>Răspuns</td>
                                        <td>Puncte obtinute </td>
                    <td colspan=4></td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $studentAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="table-active">








                        <td>
                            <p style="width: 20rem;
                                      overflow: hidden;
                                      white-space: nowrap;
                                      text-overflow: ellipsis;">
                                <?php echo e($answer['answer']); ?>

                            </p>
                        </td>
                        <?php if($answer['teacher_answers']['points'] >= 0.00): ?>
                            <td><?php echo e($answer['teacher_answers']['points']); ?></td>
                            <td>
                                <form method="get" action="<?php echo e(route('difference.show', $answer['teacher_answers']['id'])); ?>">
                                    <a href="<?php echo e(route('difference.show', $answer['teacher_answers']['id'])); ?>" class="btn btn-primary">Vezi diferențele
                                    </a>
                                </form>
                            </td>

                        <?php else: ?>
                            <td>0</td>

                            <td> Încă nu a fost corectat</td>

                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/studentAnswers/show.blade.php ENDPATH**/ ?>