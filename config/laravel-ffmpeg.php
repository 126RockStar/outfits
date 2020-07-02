<?php

return [
    'ffmpeg' => [
        'binaries' => env('FFMPEG_BINARIES', 'C:/FFmpeg/bin/ffmpeg.exe'),
        'threads'  => 12,
    ],

    'ffprobe' => [
        'binaries' => env('FFPROBE_BINARIES', 'C:/FFmpeg/bin/ffprobe.exe'),
    ],

    'timeout' => 3600,

    'enable_logging' => true,
];
