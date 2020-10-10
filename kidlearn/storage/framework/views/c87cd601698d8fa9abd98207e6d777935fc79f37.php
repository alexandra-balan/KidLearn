<?php $__env->startSection('main'); ?>
    <div><?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?></div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Materii</h1>

            <form method="GET"  action="<?php echo e(route('subjects.index')); ?>" class="row">
                <?php echo e(csrf_field()); ?>

                <div class="form-group col-sm-3">

                    <select class="form-control" name="sorter">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value="AscendentNume">A-Z</option>
                        <option value="DescendentNume">Z-A</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Sortează</button>
            </form>
            <br>

            <table class="table table-hover">
                <thead>

                <tr class="table-primary">
                    <td>Materie</td>
                    <td>Profesor</td>
                    <td>Clasă</td>
                    <td colspan="2"></td>
                </tr>

                </thead>
                <tbody>
                <div class="container">
                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $subject->studentClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-active">
                                <td><?php echo e($subject->subject); ?> </td>
                                <td><?php echo e($subject->teacher->name); ?></td>
                                <td><?php echo e($class->year); ?><?php echo e($class->label); ?></td>

                            <td>
                                <form action="<?php echo e(route('subjects.destroy', $subject->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-primary" type="submit">Șterge</button>
                                </form>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                </tbody>
            </table>
            <br>
            <?php if(Auth::user()->role == 'Profesor'): ?>
            <form method="get" action="<?php echo e(route('subjects.create')); ?>">
                <a href="<?php echo e(route('subjects.create')); ?>" class="btn btn-primary">
                    Adaugă o nouă materie
                </a>
            </form>
            <?php endif; ?>
            <?php echo $subjects->appends(['sorter' => $sorter])->render(); ?>

            <div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/subjects/index.blade.php ENDPATH**/ ?>