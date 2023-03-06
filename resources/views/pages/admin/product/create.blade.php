@extends('layouts.admin')

@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Product</h1>  
          </div>

          @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="card-shadow">
              <div class="card-body">
                <form action="{{ route('product.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                       <label for="image">Nama Produk</label>
                       <input type="text" class="form-control" name="name" placeholder="Masukan nama produk">
                  </div>
                  <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="" class="form-control">
                        <option value=""> Pilih Kategori Barang</option>
                        @forelse ($category as $result)
                            <option value="{{ $result->id }}"> {{ $result->name }}</option>
                        @empty
                            <option value="">Kategori tidak ada</option>
                        @endforelse
                    </select>
                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                  </div>
                  <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" name="price" placeholder="Masukan harga produk">
                  </div>
                  <div class="form-group">
                    <label for="weight">Berat</label>
                    <input type="number" class="form-control" name="weight" placeholder="Masukan berat produk">
                  </div>
                  <div class="form-group d-flex flex-column">
                    <label for="description">Deskripsi Produk</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="image">image</label>
                    <input type="file" class="form-control" name="image" required>
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                </div>
                  

                  <button type="submit" class="btn btn-primary btn-block form-control">
                       Simpan
                  </button>
                </form>
              </div>
            </div>

        

        </div>
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

        <!-- /.container-fluid -->
@endsection

