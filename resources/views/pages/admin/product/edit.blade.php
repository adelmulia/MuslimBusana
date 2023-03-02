@extends('layouts.admin')

@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>  
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
                <form action="{{ route('product.update', $data->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                       <label for="name">Nama Produk</label>
                       <input type="text" class="form-control" value="{{ $data->name }}" name="name" placeholder="Masukan nama produk">
                  </div>
                  <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="" class="form-control">
                        <option value="{{ $data->category_id }}">{{ $data->category->name }}</option>
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
                    <input type="number" class="form-control" value="{{ $data->price }}" name="price" placeholder="Masukan harga produk">
                  </div>
                  <div class="form-group">
                    <label for="weight">Berat</label>
                    <input type="number" class="form-control" value="{{ $data->weight }}" name="weight" placeholder="Masukan berat produk">
                  </div>
                  <div class="form-group d-flex flex-column">
                    <label for="description">Deskripsi Produk</label>
                    <textarea name="description"  id="" cols="30" rows="10" >
                      {{ $data->description }}
                    </textarea>
                  </div>
                  <div class="form-group d-flex flex-column">
                    <img height="100" width="100" src="{{ asset('storage/uploads/' . $data->image) }}"  alt="">
                    <label for="image">image</label>
                    <input type="file" class="form-control" name="image">
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                </div>
                  

                  <button type="submit" class="btn btn-primary btn-block form-control">
                       Simpan
                  </button>
                </form>
              </div>
            </div>

        

        </div>
        <!-- /.container-fluid -->
@endsection