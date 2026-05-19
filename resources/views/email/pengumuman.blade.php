<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pengumuman Resmi Sekolah</title>
</head>
<body style="font-family: 'Segoe UI', Arial, sans-serif; background-color:#f4f6f8; padding:30px;">

    <div style="background:#ffffff; border-radius:8px; padding:30px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        
        {{-- Header --}}
        <div style="border-bottom:2px solid #004085; margin-bottom:20px; padding-bottom:10px;">
            <h2 style="color:#004085; margin:0;">PENGUMUMAN</h2>
            <p style="color:#666; margin:0;">{{ $namaSekolah }}</p>
        </div>

        {{-- Isi Pengumuman --}}
        <p style="color:#333; line-height:1.8; font-size:15px;">
            {{ $isi }}
        </p>

        {{-- Penutup --}}
        <p style="margin-top:30px; color:#555; font-size:14px;">
            Demikian pengumuman ini disampaikan untuk dapat diketahui dan dipatuhi sebagaimana mestinya.
        </p>

        {{-- Footer --}}
        <div style="border-top:1px solid #ddd; margin-top:30px; padding-top:15px; font-size:12px; color:#888;">
            <p>Hormat kami,</p>
            <p><strong>Admin {{ $namaSekolah }}</strong></p>
            <p style="margin-top:10px;">Email ini dikirim sistem oleh Admin.</p>
        </div>
    </div>

</body>
</html>
