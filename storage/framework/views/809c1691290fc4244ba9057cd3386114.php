<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <div class="section-kicker">People</div>
            <h1 class="section-title mb-1">Manage users</h1>
            <p class="text-muted mb-0">All registered accounts and their access level.</p>
        </div>

        <form method="GET" class="d-flex gap-2">
            <input type="text" name="q" class="form-control" placeholder="Search name or email..." value="<?php echo e(request('q')); ?>">
            <button class="btn btn-outline-dark">Search</button>
        </form>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Bookings</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($u->name); ?></td>
                        <td><?php echo e($u->email); ?></td>
                        <td><?php echo e($u->booking_count); ?></td>
                        <td>
                            <span class="badge <?php echo e($u->role === 'admin' ? 'bg-warning text-dark' : 'bg-secondary'); ?>">
                                <?php echo e(ucfirst($u->role)); ?>

                            </span>
                        </td>
                        <td><?php echo e($u->created_at->format('d M Y')); ?></td>
                        <td class="d-flex gap-2">
                            <form action="<?php echo e(route('admin.users.role', $u)); ?>" method="POST" class="d-flex gap-1">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <select name="role" class="form-select form-select-sm" style="width:110px;">
                                    <option value="user" <?php echo e($u->role === 'user' ? 'selected' : ''); ?>>User</option>
                                    <option value="admin" <?php echo e($u->role === 'admin' ? 'selected' : ''); ?>>Admin</option>
                                </select>
                                <button class="btn btn-sm btn-primary">Save</button>
                            </form>
                            <form action="<?php echo e(route('admin.users.destroy', $u)); ?>" method="POST"
                                  onsubmit="return confirm('Delete this user permanently?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center py-5">No users found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <?php echo e($users->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/users/index.blade.php ENDPATH**/ ?>