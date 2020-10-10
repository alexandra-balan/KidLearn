<?php $__env->startSection('main'); ?>
    <div><?php if(session()->get('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?></div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Utilizatori</h1>

            <form method="POST" action="<?php echo e(route('filter')); ?>" class="row">
                <?php echo e(csrf_field()); ?>

                <div class="form-group col-sm-3">

                    <select class="form-control" name="filter">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value="Profesor">Profesori</option>
                        <option value="Elev">Elevi</option>
                        <option value="Administrator">Administratori</option>
                        <option value="N/A">Fără rol</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrează</button>
            </form>

            <br>


            
            
            
            
            
            
            
            
            
            
            

            <div class="container justify-content-center">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nume</td>
                        <td>Nume de utlizator</td>
                        <td colspan=4>Rol</td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td><?php echo e($user->name); ?> </td>
                            <td><?php echo e($user->username); ?> </td>
                            <td><?php echo e($user->role); ?> </td>

                            <td>
                                <form method="get" action="<?php echo e(route('admin.edit', $user->id)); ?>">
                                    <a href="<?php echo e(route('admin.edit',$user->id)); ?>" class="btn btn-primary">Modifică datele
                                    </a>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
            <div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/admin/index.blade.php ENDPATH**/ ?>