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

        <h3 id=judul style="text-decoration: underline;">SURAT PEMBERITAHUAN</h3>

        {{-- <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
            <img src="/img/logo-Universitas Bina Insani.png"
                 style="width: 210mm; height: 297mm; margin: 0;" />
        </div> --}}

        <p>Mahasiswa yang bernama dibawah ini</p>

        <table>
            {{-- @foreach ($data as $da) --}}
            
            <tr>


               {{-- {{ dd($data)}} --}}
                <td style="width: 30%; text-align: left;">Nama &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $data->nama  }}</td>
                {{-- <th style="position:fixed;"></th> --}}
                {{-- <td style="width:  0%; ">{{ $dp->nama }}</td> --}}
            </tr>
            <tr>
                <td style="width: 30%; text-align: left;">NIM &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{ $data->nim }} </td>
                {{-- <th style="width: 5%; text-align: center;">:</th> --}}
                {{-- <td style="width: 10%">{{ $dp->universitas }}</td> --}}
            </tr>
            <tr>
                <td style="width: 30%; text-align: left;">Universitas &nbsp; : {{ $data->universitas }} </td>
            </tr>
            {{-- @endforeach --}}

           
        </table>

        <p>menyatakan bahwa yang bersangkutan Dinyatakan belum diterima sebagai peserta magang dikarenakan belum memenuhi kualifikasi yang dibutuhkan oleh PT Pelabuhan Indonesia.</p>


        <div class="center" style="margin-top: 175px;">
            <img src="/img/logo-Universitas Bina Insani.png" alt="" style="background-color: black" height="90" width="90">
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