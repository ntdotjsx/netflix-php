<script src="package/plyr.min.js"></script>
<link rel="stylesheet" href="package/plyr.min.css">
<!-- playsinline controls data-poster="/path/to/poster.jpg" -->
<div class="flex flex-col justify-center items-center w-screen h-screen bg-black select-none">
    <?php require_once 'head.php' ?>
    <video id="player" playsinline controls data-poster="/path/to/poster.jpg">
        <source src="content/<?= $_GET['id'] ?>.mp4" type="video/mp4" />
        <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default />
    </video>
</div>
<script>
    const player = new Plyr('#player');
    window.player = player;
</script>