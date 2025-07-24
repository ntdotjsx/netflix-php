<script src="package/plyr.min.js"></script>
<link rel="stylesheet" href="package/plyr.min.css">
<div class="flex flex-col justify-center items-center w-screen h-screen bg-black select-none">
    <?php require 'head.php' ?>
    <video id="player" playsinline controls data-poster="/path/to/poster.jpg">
        <track kind="captions" label="English captions" src="/path/to/captions.vtt" srclang="en" default />
    </video>
</div>
<script>
    const player = new Plyr('#player');
    window.player = player;

    $.ajax({
        url: 'api/movie.php',
        dataType: 'json',
        success: function (data) {
            if (data.length === 0) {
                console.log('NOT FOUND ISUS');
                return;
            }

            const movie = data[0];
            const videoSrc = 'api/stream.php?token=' + encodeURIComponent(movie.video_token);
            console.log('Video URL:', videoSrc);

            player.source = {
                type: 'video',
                sources: [
                    {
                        src: videoSrc,
                        type: 'video/mp4',
                    },
                ],
            };

            console.log('PLAY :', movie.title);
        },
        error: function () {
            alert('LOAD FAIL');
        },
    });


</script>