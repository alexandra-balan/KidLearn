<?php $__env->startSection('main'); ?>
    <div><?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?></div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Students</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td colspan=4>Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Auth::user()->role == 'Student' && $student->user_id == Auth::user()->id): ?>
                        <tr>
                            <td><?php echo e($student->id); ?></td>
                            <td><?php echo e($student->name); ?> </td>

                            <td>
                                <a href="<?php echo e(route('students.show',$student->id)); ?>" class="btn btn-primary">Details</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if(Auth::user()->role == 'Teacher'): ?>
                        <tr>
                            <td><?php echo e($student->id); ?></td>
                            <td><?php echo e($student->name); ?> </td>
                            <td>
                                <a href="<?php echo e(route('students.show',$student->id)); ?>" class="btn btn-primary">Details</a>
                            </td>
                            <td>
                                <form method="get" action="<?php echo e(route('createGrade', $student->id)); ?>">
                                    <input type="hidden" name="class_id" value="<?php echo e($student->class_id); ?>">
                                    <a href="<?php echo e(route('createGrade',$student->id)); ?>" class="btn btn-primary">Add
                                        grade</a>
                                </form>
                            </td>
                        </tr>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\resources\views/students/index.blade.php ENDPATH**/ ?>