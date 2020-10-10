<?php $__env->startSection('main'); ?>

<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Adauga o noua clasa</h1>
        <div>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div><br />
            <?php endif; ?>
            <form method="post" action="<?php echo e(route('studentClasses.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="year">An</label>
                    <select class="form-control" name="year">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                        <option value='11'>11</option>
                        <option value='12'>12</option>

                    </select>

                </div>

                <div class="form-group">
                    <label for="label">Serie</label>
                    <input type="text" class="form-control" name="label"/>
                </div>

                <button type="submit" class="btn btn-primary">Adaugă clasa</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/studentClasses/create.blade.php ENDPATH**/ ?>