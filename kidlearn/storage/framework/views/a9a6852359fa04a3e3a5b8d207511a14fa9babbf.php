<?php $__env->startSection('main'); ?>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adauga o nota</h1>
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
                <br><br>


                       <span class="badge badge-pill badge-secondary "><h5>
                              <?php echo e($studentName); ?>

                           </h5></span>
                    <br><br>
                <form method="post" action="<?php echo e(route('storeGrade', $student_id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <div class="form-group">

                        <label for="grade"><h5><strong> Nota :</strong> </h5></label>
                        <select name="grade" class="form-control">
                            <option value="" selected disabled hidden>Alege o notă</option>
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
                        </select>


                        <label for="subject">Materia :</label>
                        <select  name="subject" class="form-control">
                            <option type="text" value="" selected disabled hidden>Alege aici</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subject); ?>"><?php echo e($subject); ?></option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <label for="semester">Semestru:</label>
                        <select name="semester" class="form-control">
                            <option value="" selected disabled hidden>Alege aici</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                        </select>

                        <label for="subject">Comentariu :</label>
                        <input type="text" class="form-control" name="comment" value="<?php echo e(old('comment')); ?>"/>

                    </div>


                    <button type="submit" class="btn btn-primary justify-content-between align-content-center">Adaugă nota</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\TestLaravel\kidlearn\resources\views/grades/create.blade.php ENDPATH**/ ?>