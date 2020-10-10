<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Modifica datele utilizatorului</h1>
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
                <form method="post" action="<?php echo e(route('admin.update', $user->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="form-group">
                        <label for="name">Nume :</label>
                        <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>"/>


                        <label for="username">Nume de utilizator :</label>
                        <input type="text" class="form-control" name="username" value="<?php echo e($user->username); ?>"/>


                        <label for="class">Rol :</label>
                        <select class="form-control" name="role">
                            <option value="" selected disabled hidden>Choose here</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Profesor">Profesor</option>
                            <option value="Elev">Elev</option>
                        </select>

                    </div>


                    <button type="submit" class="btn btn-primary">Salvează modificările</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/admin/edit.blade.php ENDPATH**/ ?>