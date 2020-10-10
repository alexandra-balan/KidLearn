<?php $__env->startSection('main'); ?>
    <div><?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?></div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Elevi</h1>

            <form method="GET"  action="<?php echo e(route('students.index')); ?>" class="row">
                <?php echo e(csrf_field()); ?>

                <div class="form-group col-sm-3">

                    <select class="form-control" name="filter">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value="AscendentNume">A-Z</option>
                        <option value="DescendentNume">Z-A</option>
                        <option value="AscendentScor">Cel mai mic punctaj</option>
                        <option value="DescendentScor">Cel mai mare punctaj</option>
                    </select>
                </div>
                <button type="submit" onsubmit="sorting()" class="btn btn-primary">Sortează</button>
            </form>
<br>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <td>Nume</td>
                    <td>Clasa</td>
                    <td>Scor</td>
                    <td colspan=4></td>
                </tr>
                </thead>
                <tbody>
                <div class="container">


                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Auth::user()->role == 'Elev' ): ?>


                        <tr class="table-active">
                            <td><?php echo e($student->name); ?> </td>

                            <td><?php echo e($student->classes->year); ?> <?php echo e($student->classes->label); ?> </td>
                            <td><?php echo e($student->score); ?> </td>
                            <?php if(Auth::user()->id == $student->user_id): ?>
                            <td>
                                <a href="<?php echo e(route('students.show',$student->id)); ?>" class="btn btn-primary">Detalii</a>
                            </td>
                                <?php else: ?> <td></td>
                                <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                    <?php if(Auth::user()->role == 'Profesor'): ?>
                        <tr class="table-active">
                            <td><?php echo e($student->name); ?> </td>
                            <td><?php echo e($student->classes->year); ?> <?php echo e($student->classes->label); ?> </td>
                            <td><?php echo e($student->score); ?> </td>
                            <td>
                                <a href="<?php echo e(route('students.show',$student->id)); ?>" class="btn btn-primary">Detalii</a>
                            </td>
                            <td>
                                <form method="get" action="<?php echo e(route('createGrade', $student->id)); ?>">
                                    <input type="hidden" name="class_id" value="<?php echo e($student->class_id); ?>">
                                    <a href="<?php echo e(route('createGrade',$student->id)); ?>" class="btn btn-primary">
                                        Adaugă notă
                                    </a>
                                </form>
                            </td>
                        </tr>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                </tbody>
            </table>
            <?php if(Auth::user()->role == 'Profesor'): ?>
            <form method="get" action="<?php echo e(route('students.create')); ?>">
                <a href="<?php echo e(route('students.create')); ?>" class="btn btn-primary">
                    Adaugă un nou elev
                </a>
            </form>
            <?php endif; ?>


            <?php echo $students->appends(['filter' => $filter])->render(); ?>

            <div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/students/index.blade.php ENDPATH**/ ?>