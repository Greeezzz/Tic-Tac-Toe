<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex flex-col items-center">
                    <h1 class="text-3xl font-extrabold mb-6 text-blue-600">Tic-Tac-Toe</h1>

                    <!-- Pilihan Tingkat Kesulitan -->
                    <div class="flex justify-center items-center gap-2 mb-4">
                        <span class="text-gray-500 font-medium">Difficulty:</span>
                        <div class="relative group">
                            <select wire:model="difficulty" class="px-4 py-2 border rounded-lg text-gray-700 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="easy">Easy</option>
                                <option value="medium">Medium</option>
                                <option value="hard">Hard</option>
                            </select>
                            <div class="absolute bottom-full mb-1 hidden group-hover:block bg-black text-white text-xs px-2 py-1 rounded shadow-lg">
                                Choose the AI difficulty level
                            </div>
                        </div>
                    </div>

                    <!-- Papan Tic-Tac-Toe -->
                    <div class="grid grid-cols-3 gap-2 w-72 mx-auto">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $board; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowIndex => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colIndex => $cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    wire:click="play(<?php echo e($rowIndex); ?>, <?php echo e($colIndex); ?>)"
                                    class="h-24 w-24 flex items-center justify-center bg-gray-100 border border-gray-300 cursor-pointer hover:bg-gray-200 transition-all duration-200
                                    <?php echo e(in_array([$rowIndex, $colIndex], $winningCombo ?? []) ? 'bg-green-200 animate-pulse' : ''); ?>"
                                >
                                    <!--[if BLOCK]><![endif]--><?php if($cell): ?>
                                        <span class="text-5xl font-bold fade-in <?php echo e($cell === 'X' ? 'text-blue-500' : 'text-red-500'); ?>">
                                            <?php echo e($cell); ?>

                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <!-- Status Permainan -->
                    <!--[if BLOCK]><![endif]--><?php if($winner): ?>
                        <div class="mt-4 text-green-600 font-bold text-lg">
                            Player <?php echo e($winner); ?> wins!
                        </div>
                    <?php elseif($draw): ?>
                        <div class="mt-4 text-yellow-600 font-bold text-lg">
                            It's a draw!
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <!-- Tombol Reset -->
                    <div class="text-center mt-4">
                        <button wire:click="resetBoard"
                            class="px-6 py-2 bg-gradient-to-r from-blue-500 to-green-500 text-white font-bold rounded-lg shadow-md hover:shadow-lg hover:from-green-500 hover:to-blue-500 transition-all duration-300">
                            Reset Game
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\tiktakto\resources\views/livewire/game.blade.php ENDPATH**/ ?>