<?php
$NAV_LINK = [
    'Movie' => '/movie',
    'Serie' => '/serie'
];
?>

<div
    class="fixed top-0 left-0 h-screen w-20 text-white flex flex-col justify-between items-center py-6 z-50">
    <a href="/" class="mb-6">
        <img src="assets/brand/logo.png" class="w-5" alt="Logo">
    </a>

    <div class="flex flex-col gap-6 items-center *:hover:scale-110 *:transition-transform">
        <?php foreach ($NAV_LINK as $label => $a) { ?>
            <a href="<?= $a ?>" title="<?= $label ?>">
                <div class="w-6">
                    <?= file_get_contents('assets/icons/' . strtolower($label) . '.svg') ?>
                </div>
            </a>
        <?php } ?>
    </div>

    <div class="acc mt-6">
        <img class="w-10 rounded-lg border-1 border-white/5" src="assets/profile/03.jpg" alt="Profile">
    </div>
</div>