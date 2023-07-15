<!DOCTYPE html>
<head>
    <title>Contoh Surat Pemberitahuan</title>
    <meta charset="utf-8">
    <style>
        #judul{
            text-align:center;
        }

        #halaman{
            width: auto; 
            height: auto; 
            /* position: absolute;  */
            padding-top: 30px; 
            padding-left: 30px; 
            padding-right: 30px; 
            padding-bottom: 80px;
        }

    </style>

</head>

<body>
    <div id=halaman>

        <h3 id=judul style="text-decoration: underline;">SURAT PERNYATAAN</h3>

        {{-- <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
            <img src="/img/logo-Universitas Bina Insani.png"
                 style="width: 210mm; height: 297mm; margin: 0;" />
        </div> --}}

        <p>mahasiswa yang bernama dibawah ini</p>

        <table>
            @foreach ($dataPribadi as $dp)
            <tr>
                <td style="width: 30%; text-align: left;">Nama : {{ $dp->nama }}</td>
                {{-- <th style="position:fixed;"></th> --}}
                {{-- <td style="width:  0%; ">{{ $dp->nama }}</td> --}}
            </tr>
            <tr>
                <td style="width: 30%; text-align: left;">Universitas : {{ $dp->universitas }}</td>
                {{-- <th style="width: 5%; text-align: center;">:</th> --}}
                {{-- <td style="width: 10%">{{ $dp->universitas }}</td> --}}
            </tr>
            @endforeach

           
        </table>

        <p>menyatakan bahwa yang bersangkutan Dinyatakan diterima sebagai peserta magang di PT. Pelabuhan Indonesia.</p>


        <div class="center" style="margin-top: 175px;">
            <span style="font-size: medium; justify-content:end;" >Mengetahui,</span><br><br><br><br>
            <span style="font-size: medium; ">Direktur Pengelolaan SDM</span>
        </div>
      

        {{-- <div style="width: 50%; text-align: left; float: right;">Purwodadi, 20 Januari 2020</div><br>
        <div style="width: 50%; text-align: left; float: right;">Yang bertanda tangan,</div><br><br><br><br><br>
        <div style="width: 50%; text-align: left; float: right;">Arbrian Abdul Jamal</div>
    --}}
    </div>
    
</body>

</html>