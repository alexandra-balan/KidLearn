<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Clase</h1>
            <form method="GET"  action="<?php echo e(route('studentClasses.index')); ?>" class="row">
                <?php echo e(csrf_field()); ?>

                <div class="form-group col-sm-3">

                    <select class="form-control" name="sorter">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value="Ascendent">A-Z</option>
                        <option value="Descendent">Z-A</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Sortează</button>
            </form>
            <br>
            <table class="table table-striped">
                <thead>
                <tr class="table-primary">

                    <td>Clasă</td>


                    <td colspan = 4></td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($class->year); ?><?php echo e($class->label); ?> </td>

                        <td>
                            <a href="<?php echo e(route('semiAnnualReport', $class->id)); ?>" class="btn btn-secondary">Raport semestrial</a>
                        </td>
                        <td>
                            <a href="<?php echo e(route('annualReport', $class->id)); ?>" class="btn btn-secondary">Raport anual</a>
                        </td>
                        <td>
                            <a href="<?php echo e(route('graduationRate',$class->id)); ?>" class="btn btn-secondary">Rata de absolvire</a>
                        </td>
                        <?php if(Auth::user()->role == 'Profesor'): ?>
                        <td>

                            <form action="<?php echo e(route('studentClasses.destroy',$class->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-primary" type="submit">Șterge
                                </button>
                            </form>
                        </td>
<?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php if(Auth::user()->role == 'Profesor'): ?>
            <form method="get" action="<?php echo e(route('studentClasses.create')); ?>">
                <a href="<?php echo e(route('studentClasses.create')); ?>" class="btn btn-primary">
                    Adaugă o nouă clasă
                </a>
            </form>
            <?php endif; ?>
            <?php echo $classes->appends(['sorter' => $sorter])->render(); ?>

            </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/studentClasses/index.blade.php ENDPATH**/ ?>