<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-sm-9 offset-sm-1">
            <h1 class="display-3">Corecteaza acest raspuns</h1>
            <div>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div><br/>
                <?php endif; ?>


                    <div class="list-group">
                        <a href="#"
                           class="list-group-item list-group-item-action flex-column align-items-start list-group-item-dark">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"></h5>
                                <span class="badge badge-pill badge-secondary">
                                <small class="h6">Puncte: <?php echo e($question->max_points); ?></small>
                                </span>
                            </div>
                            <p class="mb-1 h4 font-weight-bold">
                                <?php echo e($question->question); ?>

                            </p>
                            <br>
                            <span class="badge badge-pill badge-secondary">
                                <small class="h6"><?php echo e($question->subject->subject); ?></small>
                            </span>

                        </a>

                    </div>
                    <br>
                    <br>

                <form method="post" action="<?php echo e(route('storeTeacherAnswer', $studentAnswerId)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <p class="text-secondary h4">Adaugă răspunsul tău:</p>
                        <textarea class="form-control" name="answer" rows="6"><?php echo e($studentAnswer->answer); ?></textarea>


                        <label for="points">Points:</label>

                        <input type="number" step="0.01" class="form-control" max="<?php echo e($question->max_points); ?>" name="points" value="<?php echo e(old('points')); ?>"/>


                        
                        
                        
                        
                        
                        
                        

                    </div>


                    <button type="submit" class="btn btn-primary">Salvează datele</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/teacherAnswers/create.blade.php ENDPATH**/ ?>