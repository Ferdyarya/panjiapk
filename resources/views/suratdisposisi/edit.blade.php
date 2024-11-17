@extends('layout.admin')

@section('content')


<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

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

                                    {{-- <div class="form-group">
                                        <label for="nmrsurat">Nomor Surat</label>
                                        <input value="{{ $item->nmrsurat }}" type="text" name="nmrsurat" class="form-control" placeholder="Masukkan Nomor Surat" required>
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="tglterima">Tanggal Terima</label>
                                        <input value="{{ $item->tglterima }}" type="date" name="tglterima" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="asal">Asal Surat</label>
                                        <input value="{{ $item->asal }}" type="text" name="asal" class="form-control" placeholder="Masukkan Asal Surat" required>
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

























<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
@endsection
