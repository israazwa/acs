<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Livestreaming</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">
    <table role="presentation" style="width:100%; border-collapse:collapse; background-color:#f4f4f4;">
        <tr>
            <td align="center" style="padding:20px;">
                <table role="presentation" style="width:600px; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background:#f97316; padding:20px; text-align:center; color:#fff;">
                            <h2 style="margin:0; font-size:24px;"> Livestreaming Sedang Berlangsung</h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:20px; color:#333;">
                            <p>Halo <strong>{{ $user->name ?? 'Siswa' }}</strong>,</p>
                            <p>Livestreaming untuk pelajaran <strong>{{ $video->pelajaran->nama }}</strong> sedang berlangsung.</p>
                            <p><strong>Judul:</strong> {{ $video->judul_video }}</p>
                            <p><strong>Deskripsi:</strong> {{ $video->deskripsi }}</p>
                            <p style="margin:20px 0;">
                                <a href="{{ $video->streaming_url }}" 
                                   style="display:inline-block; padding:12px 20px; background:#f97316; color:#fff; text-decoration:none; border-radius:5px; font-weight:bold;">
                                    Bergabung ke Livestreaming
                                </a>
                            </p>
                            <p>Terima kasih,</p>
                            <p><em>Admin</em></p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f4f4f4; padding:15px; text-align:center; font-size:12px; color:#666;">
                            Email ini dikirim otomatis oleh sistem.<br>
                            Mohon tidak membalas email ini.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
