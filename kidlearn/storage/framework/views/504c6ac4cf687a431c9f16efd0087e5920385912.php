<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adauga o intrebare</h1>
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
                <form method="post" action="<?php echo e(route('questions.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">

                        <p class="text-secondary h4">Întrebarea :</p>
                        <textarea class="form-control" name="question" rows="6"><?php echo e(old('question')); ?></textarea>

                        <label for="class">Materia :</label>
                        <select class="form-control" name="subject">
                            <option value="" selected disabled hidden>Alege aici</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subject); ?> "><?php echo e($subject); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <label for="max_points">Puncte :</label>
                        <input type="number" step="0.01" class="form-control" name="max_points" value="<?php echo e(old('max_points')); ?>"/>

                    </div>


                    <button type="submit" class="btn btn-primary">Salvează datele</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/questions/create.blade.php ENDPATH**/ ?>