<?php require_once 'components/Appbar.php'; ?>
<div class="ms-[80px] w-[calc(100%-80px)] min-h-screen select-none">
    <div class="-ms-[80px] header relative">
        <div class="absolute inset-0 bg-gradient-to-r from-black via-transparent to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10"></div>

        <div class="absolute py-40 px-25 overflow-hidden z-20">
            <div class="flex items-center gap-2 mb-2">
                <img class="w-4" src="assets/brand/logo.png" alt="logo serie">
                <h1 class="font-bold text-xl text-gray-200 tracking-[0.4em]">SERIES</h1>
            </div>
            <h1 class="text-5xl font-bold text-white">THE MAD UNICORN</h1>
            <p class="description text-xl text-gray-200 max-w-xl">
                เล่าเรื่องราวของ "สันติ" เด็กหนุ่มจากดอยวาวี ที่มีความฝันอยากหลุดพ้นจากความยากจน
                โดยใช้ภาษาจีนที่เรียนรู้จากแม่เป็นเครื่องมือในการทำธุรกิจขนส่งพัสดุด่วน. สันติได้ก่อตั้งบริษัท "ธันเดอร์
                เอ็กซ์เพรส" ร่วมกับเพื่อนร่วมทีม เพื่อท้าชนกับบริษัทขนส่งยักษ์ใหญ่ที่เคยหักหลังเขา
            </p>
            <div class="mt-4 *:bg-white *:text-black *:px-5 *:py-2 *:font-bold *:rounded *:mr-2">
                <button>Play</button>
                <button>More Info</button>
            </div>
        </div>
        <img class="w-full h-[90vh] object-cover" src="content/Mad-Unicorn_1.jpg" />
    </div>
    <div class="relative z-30 -mt-[33vh] px-5">
        <h1 class="font-bold text-2xl">กำลังเป็นกระแส</h1>
        <div class="grid grid-cols-6 gap-4 py-6">
            <?php require 'list.mustache' ?>
            <div id="movie-list"></div>
        </div>
    </div>
</div>
<script>
    $.ajax({
        url: 'api/movie.php',
        dataType: 'json',
        success: function (data) {
            const template = document.getElementById('movie-template').innerHTML;
            const rendered = Mustache.render(template, { movies: data });
            document.getElementById('movie-list').innerHTML = rendered;
        }
    });
</script>