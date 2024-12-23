@extends('layout.admin')

@section('content')


<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<!-- Select2 CSS -->
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<title>Data Surat Disposisi</title>


<body>
    <div class="container-fluid">
        <div class="card">
          <div class="card-body" style="border-radius: 15px;">
              <h1 class="text-center mb-4">Edit Data Surat Disposisi</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                <form method="POST" action="{{ route('suratdisposisi.update', $item->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="id_mastercabang">Asal Surat</label>
                                        <select class="form-select" name="id_mastercabang" id="judulbuku" data-placeholder="PILIH JUDUL BUKU">
                                            <option></option>
                                            @foreach ($mastercabang as $item)
                                            <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tglterima">Tanggal Terima</label>
                                        <input value="{{ $item->tglterima }}" type="date" name="tglterima" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sifat">Sifat Surat</label>
                                        <input value="{{ $item->sifat }}" type="text" name="sifat" class="form-control" placeholder="Masukkan Sifat Surat" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="perihal">Perihal Surat</label>
                                        <textarea name="perihal" class="form-control" placeholder="Masukkan Perihal Surat" required>{{ $item->perihal }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="diteruskan">Diteruskan Kepada</label>
                                        <input value="{{ $item->diteruskan }}" type="text" name="diteruskan" class="form-control" placeholder="Masukkan Diteruskan Kepada" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea name="catatan" class="form-control" placeholder="Masukkan Catatan" required>{{ $item->catatan }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="disposisi">Disposisi</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="disposisi" id="disposisi1" value="Harap Penyelesaian Selanjutnya" {{ $item->disposisi == 'Harap Penyelesaian Selanjutnya' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi1">
                                                Harap Penyelesaian Selanjutnya
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="disposisi" id="disposisi2" value="Minta Saran / Pertimbangan" {{ $item->disposisi == 'Minta Saran / Pertimbangan' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi2">
                                                Minta Saran / Pertimbangan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="disposisi" id="disposisi3" value="Untuk Dipelajari" {{ $item->disposisi == 'Untuk Dipelajari' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi3">
                                                Untuk Dipelajari
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="disposisi" id="disposisi4" value="Untuk Dibicarakan" {{ $item->disposisi == 'Untuk Dibicarakan' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi4">
                                                Untuk Dibicarakan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="disposisi" id="disposisi5" value="Harap Mewakili Saya" {{ $item->disposisi == 'Harap Mewakili Saya' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi5">
                                                Harap Mewakili Saya
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="disposisi" id="disposisi6" value="Arsip" {{ $item->disposisi == 'Arsip' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi6">
                                                Arsip
                                            </label>
                                        </div>
                                    </div>



                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
</body>

























<!-- Optional JavaScript Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV7YyybLOtiN6bX3h+rXxy5lVX" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+pyRy4IhBQvqo8Rx2ZR1c8KRjuva5V7x8GA" crossorigin="anonymous">
</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$( '#judulbuku' ).select2( {
theme: "bootstrap-5",
width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
placeholder: $( this ).data( 'placeholder' ),
} );
</script>
@endsection
