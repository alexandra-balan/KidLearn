<?php $__env->startSection('main'); ?>

    <div class="row">

        <div class="col-sm-12">
            <h1 class="display-3"><?php echo e($name); ?></h1>
            <h2 class="display-6">Note</h2>

            <span class="badge badge-pill badge-secondary "> <h5> Media ta generală este <?php echo e($medie); ?>

            </h5>  </span>
            <br> <br>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <td>Notă</td>
                    <td>Semestru</td>
                    <td>Comentariu</td>
                    <td>Materie</td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="table-active">
                        <td><?php echo e($student->grade); ?></td>
                        <td><?php echo e($student->semester); ?></td>
                        <td><?php echo e($student->comment); ?></td>
                        <td><?php echo e($student->subject); ?></td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
            <a href="<?php echo e(route('grades.show', $id)); ?>" class="btn btn-primary">Vezi toate notele </a>

                
            
            

            
            
            
            
            
            


            <br> <br>
            <br> <br>
            <h2 class="display-5">Punctaje obtinute</h2>
            <span class="badge badge-pill badge-secondary"><h5>Scorul tău total este de <?php echo e($punctaj); ?> de puncte
                </h5> </span>
            <br> <br>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <td>Întrebare</td>
                    <td>Răspunsul tău</td>
                    <td>Punctaj obținut</td>
                    <td>Status</td>

                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="table-active">
                        <td>
                            <p style="max-width: 20rem;
                                      overflow: hidden;
                                      white-space: nowrap;
                                      text-overflow: ellipsis;">
                                <?php echo e($answer->question->question); ?>

                            </p>
                        </td>
                        <td>
                            <p style="width: 20rem;
                                      overflow: hidden;
                                      white-space: nowrap;
                                      text-overflow: ellipsis;">
                                <?php echo e($answer->answer); ?>

                            </p>
                        </td>
                        <?php if($answer->teacherAnswers['points']): ?>
                            <td><?php echo e($answer->teacherAnswers['points']); ?></td>
                        <td>
                            <form method="get" action="<?php echo e(route('difference.show', $answer->teacherAnswers['id'])); ?>">
                                <a href="<?php echo e(route('difference.show', $answer->teacherAnswers['id'])); ?>" class="btn btn-primary">Vezi diferențele
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

            <a href="<?php echo e(route('studentAnswers.show', $id)); ?>" class="btn btn-primary">Vezi toate răspunsurile </a>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/students/show.blade.php ENDPATH**/ ?>