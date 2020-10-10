<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adauga un nou elev</h1>
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
                <form method="post" action="<?php echo e(route('students.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Nume complet :</label>
                        <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"/>


                        <label for="username">Nume de utilizator :</label>
                        <input type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>"/>


                        <label for="password"><?php echo e(__('Parolă')); ?></label>
                        <input id="password" type="password" class="form-control" name="password">


                        <label for="class">Clasă :</label>
                        <select class="form-control" name="class_list">
                            <option value="" selected disabled hidden>Alege o clasă</option>
                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($class['year']); ?> <?php echo e($class['label']); ?>"><?php echo e($class['year']); ?> <?php echo e($class['label']); ?>  </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Salvează datele</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/students/create.blade.php ENDPATH**/ ?>