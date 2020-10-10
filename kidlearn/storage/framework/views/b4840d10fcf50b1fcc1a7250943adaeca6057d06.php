<?php $__env->startSection('main'); ?>

    <div class="row">

        <div class="col-sm-12">
            <h1 class="display-3"><?php echo e($name); ?></h1>
            <h2 class="display-6">Note</h2>

            <span class="badge badge-pill badge-secondary "> <h5> Media ta generală este <?php echo e($medie); ?>

            </h5>  </span>
            <br> <br>
            <div class="container">
                <form method="GET"  action="<?php echo e(route('grades.show', $id)); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group form-row justify-content-lg-start">
                        <span style="margin-left: 1em;"> </span>

                    <select class="form-control col-sm-3" name="sorter">
                        <option value="" selected disabled hidden>--Sortează--</option>
                        <option value="Ascendent">Crescator</option>
                        <option value="Descendent">Descrescator</option>
                    </select>
                    <span style="margin-left: 3em;"></span>
                    <select class="form-control col-sm-3" name="filter">
                        <option value="" selected disabled hidden>--Filtrează--</option>
                        <?php $__currentLoopData = $uniqueSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subject); ?>"><?php echo e($subject); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <span style="margin-left: 2em;"></span>
                    <button type="submit" class="btn btn-primary">Aplică</button>

                    </div>
                </form>
            </div>

            <br>

            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <td>Notă</td>
                    <td>Semestru</td>
                    <td>Comentariu</td>
                    <td>Materie</td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="table-active">
                        <td><?php echo e($student->grade); ?></td>
                        <td><?php echo e($student->semester); ?></td>
                        <td><?php echo e($student->comment); ?></td>
                        <td><?php echo e($student->subject); ?></td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>


            
            
            

            
            
            
            
            
            



            <?php echo $students->appends(['sorter' => $sorter, 'filter' => $filter])->render(); ?>


        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/grades/show.blade.php ENDPATH**/ ?>