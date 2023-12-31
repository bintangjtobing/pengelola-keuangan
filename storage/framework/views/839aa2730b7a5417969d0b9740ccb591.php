<?php $__env->startSection('container'); ?>
    <section class="mb-32">
        <h1 class="mt-2 mb-3 text-4xl font-semibold"><?php echo e($data[0]->kategori); ?> <span class="text-sm text-gray-500 font-normal">
                #<?php echo e($data[0]->no_feedback); ?> </span></h1>
        <div class="mb-7 flex items-center gap-2">
            <div
                class="py-0.5 px-5
            <?php switch($data[0]->progres):
                case ('draft'): ?>
                    bg-yellow-200 text-yellow-800 border-yellow-300
                    <?php break; ?>

                <?php case ('on going'): ?>
                    bg-green-200 text-green-800 border-green-300
                    <?php break; ?>

                <?php case ('cancel'): ?>
                    bg-gray-200 text-gray-800 border-gray-300
                    <?php break; ?>

                <?php default: ?>
                    bg-blue-200 text-blue-800 border-blue-300
            <?php endswitch; ?>
            text-sm border-2 w-fit rounded-full">
                <?php echo e($data[0]->progres); ?>

            </div>
            <p class="text-sm text-gray-500"><span
                    class="font-semibold"><?php echo e($data[0]->progres_dev_by->username ?? '--'); ?></span> <span
                    class="<?php echo e($data[0]->progres_by == null ? 'hidden' : ''); ?>"><span>
                        <?php switch($data[0]->progres):
                            case ('on going'): ?>
                                sedang mengerjakan
                            <?php break; ?>

                            <?php case ('cancel'): ?>
                                batal mengerjakan
                            <?php break; ?>

                            <?php default: ?>
                                menyelesaiakan
                        <?php endswitch; ?>
                    </span> issue ini</span></p>
        </div>
        <div class="grid grid-cols-5 gap-3">
            <div class="col-span-4 bg-white rounded-md shadow-md px-5 pt-5 pb-8">
                <div class="flex items-center gap-2 mb-3">
                    <figure>
                        <img class="w-10 h-10 rounded-full"
                            src=" <?php echo e($data[0]->users_id->foto ?? 'https://res.cloudinary.com/du0tz73ma/image/upload/v1700278579/default-profile_y2huqf.jpg'); ?>"
                            alt="Rounded avatar">
                    </figure>
                    <div>
                        <p class="text-sm text-gray-700"><?php echo e($data[0]->users_id->username); ?></p>
                        <p class="text-xs text-gray-700"><?php echo e($data[0]->created_at); ?></p>
                    </div>
                </div>
                <div class="text-gray-500 ml-12">
                    <?php echo $data[0]->deskripsi; ?>

                </div>

                <hr class="w-full mt-8 mb-5">
                <p class="ml-12 mb-3 text-gray-800 font-medium text-lg">Lampiran</p>
                <?php if(isset($data[0]->lampiran)): ?>
                    <div class="ml-12 relative">
                        <img class="h-32" src="<?php echo e($data[0]->lampiran); ?>" alt="lampiran">
                        <a target="blank" href="<?php echo e($data[0]->lampiran); ?>"
                            class="w-32 h-32 text-dark-500 flex items-center justify-center absolute opacity-0 hover:opacity-50 rounded-md top-0 bg-gray-300">
                            Lihat
                        </a>
                    </div>
                <?php else: ?>
                    <span class="text-gray-400 text-xs ml-12">Tidak ada lampiran</span>
                <?php endif; ?>

                <hr class="w-full mt-8 mb-5">
                <?php if($data[0]->progres == 'draft'): ?>
                    <form action="/on_going" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <input type="hidden" name="id" value="<?php echo e($data[0]->id); ?>">
                        <button type="submit"
                            class="py-2 px-5 ml-12 bg-green-600 rounded-xl text-white font-medium text-sm">Mulai
                            Kerjakan</button>
                    </form>
                <?php elseif($data[0]->progres == 'on going' && $data[0]->progres_by == auth()->user()->id): ?>
                    <div class="flex items-center gap-3 w-fit">
                        <form action="/cancel_done" method="POST">
                            <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($data[0]->id); ?>">
                            <button type="submit"
                                class="py-2 px-5 ml-12 bg-red-600 rounded-xl text-white font-medium text-sm">Batal
                                mengerjakan</button>
                        </form>
                        <form action="/done" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="id" value="<?php echo e($data[0]->id); ?>">
                            <button type="submit"
                                class="py-2 px-5 bg-blue-600 rounded-xl text-white font-medium text-sm">Tandai Telah
                                Selesai</button>
                        </form>
                    </div>
                <?php elseif($data[0]->progres == 'cancel'): ?>
                    <form action="/on_going" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <input type="hidden" name="id" value="<?php echo e($data[0]->id); ?>">
                        <button type="submit"
                            class="py-2 px-5 ml-12 bg-green-600 rounded-xl text-white font-medium text-sm">Mulai
                            Kerjakan</button>
                    </form>
                <?php elseif($data[0]->progres == 'done'): ?>
                    <button type="submit"
                        class="py-2 px-5 ml-12 bg-blue-600 rounded-xl text-white font-medium text-sm">Selesai</button>
                <?php else: ?>
                    <button disabled type="submit"
                        class="py-2 px-5 ml-12 bg-green-300 rounded-xl text-white font-medium text-sm">Mulai
                        Kerjakan</button>
                <?php endif; ?>
            </div>
            <div class="bg-white p-5 rounded-md shadow-md h-fit">
                <p class="text-xs text-gray-500">Tugas diberikan ke pada:</p>
                <p class="text-gray-700 text-sm font-medium mt-1">Dev Octans Finance</p>

                <p class="text-xs text-gray-500 mt-3">Diselasikan oleh</p>
                <p class="text-gray-700 text-sm font-medium mt-1">
                    <?php echo e($data[0]->progres == 'done' ? $data[0]->progres_dev_by->username : '--' ?? '--'); ?></p>

                <p class="text-xs text-gray-500 mt-3">Status</p>
                <p class="text-gray-700 text-sm font-medium mt-1"><?php echo e($data[0]->progres); ?></p>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bahari/Desktop/octans/pengelola-keuangan/resources/views/dashboard/admin/feedback/layouts/detail_feedback.blade.php ENDPATH**/ ?>