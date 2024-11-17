<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        body {
            font-family: arial;

        }

        table {
            border-bottom: 4px solid #000;
            /* padding: 2px */
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }

        #warnatable th {
            padding-top: 12px;
            padding-bottom: 12px;
            /* text-align: left; */
            background-color: #0423aa;
            color: white;
            /* text-align: center; */
        }

        #warnatable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #warnatable tr:hover {
            background-color: #ddd;
        }

        .textmid {
            /* text-align: center; */
        }

        .signature {
            position: absolute;
            margin-top: 20px;
            text-align: right;
            right: 50px;
            font-size: 14px;
        }

        .date-container {
            font-family: arial;
            text-align: left;
            font-size: 14px;
        }
    </style>

    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td><img src="{{ public_path('assets/logo-sekolah.png') }}" alt="logo" width="140px"></td>
                <td class="tengah">
                    <h4>SMK NEGERI 3 MARABAHAN</h4>
                    <p>Jl. Purwosari No.KM. 6, Purwosari Baru, Kec. Tamban, Kabupaten Barito Kuala, Kalimantan Selatan
                        70566</p>
                </td>
            </tr>
        </table>
    </div>

    <center>
        <h5 class="mt-4">Riwayat Peminjaman petugas</h5>
    </center>



    <br>

    <table class='table table-bordered' id="warnatable">
        <thead>
            <tr>
                <th class="px-6 py-2">No</th>
                <th class="px-6 py-2">Nama Peminjam</th>
                <th class="px-6 py-2">Judul Buku</th>
                <th class="px-6 py-2">Jumlah</th>
                <th class="px-6 py-2">Tgl Pinjam</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php
            $grandTotal = 0;
            @endphp --}}

            @foreach ($peminjaman as $item)
                <tr>
                    <td class="px-6 py-6">{{ $loop->iteration }}</td>
                    <td class="px-6 py-2"><b>{{ $item->user->name }}</b></td>
                    <td class="px-6 py-2"><b>
                            {{ $item->masterbuku->judul }},{{ $item->masterbuku->tahun }}
                            <p class="text-body mt-2">
                        </b>Author: {{ $item->masterbuku->author }}</p>
                    </td>
                    <td class="px-6 py-2">{{ $item->jumlah }}</td>
                    <td class="px-6 py-2">
                        {{ \Carbon\Carbon::parse($item->tanggalpinjam)->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="date-container">
        Banjarmasin, <span class="formatted-date">{{ now()->format('d-m-Y') }}</span>
    </div>
    <p class="signature">(admin)</p>
</body>

</html>
