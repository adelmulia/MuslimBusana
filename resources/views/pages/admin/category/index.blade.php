@extends('layouts.admin')

@section('content')
      <!-- Begin Page Content -->
      <div class="container">
          <div class="main-wrapper">
               {{-- @if (session('success'))
               <div class="alert alert-success mb-2">{{ session('success') }}</div>
           @endif
         
           @if (session('error'))
               <div class="alert alert-danger">{{ session('error') }}</div>
           @endif --}}

          <!-- Page Heading -->

          <div class="content-header">
               <div class="container-fluid">
                 <div class="row mb-2">
                   <div class="col-sm-6">
                     <h1 class="m-0">Dashboard</h1>
                   </div><!-- /.col -->
                   <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                       <li class="breadcrumb-item"><a href="#">Home</a></li>
                       <li class="breadcrumb-item active">Dashboard v1</li>
                     </ol>
                   </div><!-- /.col -->
                 </div><!-- /.row -->
                 <div class="row">
                    <a href="{{ route('category.create')}}" class="btn btn-primary btn-sm sm-shadow ">
                         <i class="fas fa-plus fa-sm text-black">
                              Tambah Category
                         </i>
                    </a>
                 </div>
               </div><!-- /.container-fluid -->
             </div>
             <!-- /.content-header -->
         

          <div class="row">
               <div class="card-body">
                    <div class="table-responsive">
                         
                         <table class="table table-bordered width=100%" cellspacing="0" id="tabel_category">
                              <thead>
                                   <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   @forelse ($category as $item)
                                         <tr>
                                       
                                             <td>{{ $item->id }}</td>
                                             <td>{{ $item->name}}</td>
                                             <td>{{ $item->slug}}</td>
                                            
                                             <td>
                                             <a href="{{ route('category.edit', $item->id)}}" class="btn btn-info">
                                                  <i class="fa fa-pencil-alt"></i>
                                             </a>

                                             <form action="{{ route('category.destroy', $item->id)}}" method="POST" class="d-inline">
                                                  @csrf
                                                  @method('delete')
                                                  <button class="btn btn-danger">
                                                       <i class="fa fa-trash"></i>
                                                  </button>
                                             </form>
                                        </td>
                                   </tr>
                                   @empty
                                        <tr  class="text-center">
                                             <td colspan="4">Data Kosong</td>
                                        </tr>
                                   @endforelse
                                       
                              
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
       

        

        </div>
        
      
        <!-- /.container-fluid -->
@endsection

@push('dataTable')

<script>
    $(document).ready( function () {
    $('#tabel_category').DataTable();
} );
     </script>
@endpush


