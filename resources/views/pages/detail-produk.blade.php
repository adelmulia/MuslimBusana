@extends('layouts.main')

@section('content')
     <!-- breadcrumb -->
     <div class="container">
          <nav>
              <ol class=" breadcrumb bg-transparent pl-0">
                  <li class=" breadcrumb-item "><a href=" # ">Category</a></li>
                  <li class=" breadcrumb-item active " aria-current=" page ">Single Product</li>
              </ol>
          </nav>
      </div>
      <!-- akhir breadcrumb -->
  
      <!-- single product -->
      <section class="single-product ">
          <div class="container">
              <div class="row">
                  <div class="col-lg-5">
                      <figure class="figure">
                          <img src="{{ url('frontend/img/single/1.png') }}" class="figure-img img-fluid">
                          {{-- <figcaption class="figure-caption product-thumbnail-container d-flex  justify-content-between">
                              <a href="">
                                  <img src="{{ url('frontend/img/single/thumbnail/1.png') }}">
                              </a>
                              <a href="">
                                  <img src="{{ url('frontend/img/single/thumbnail/2.png') }}">
                              </a>
                              <a href="">
                                  <img src="{{ url('frontend/img/single/thumbnail/3.png') }}">
                              </a>
                              <a href="">
                                  <img src="{{ url('frontend/img/single/thumbnail/4.png') }}">
                              </a>
                          </figcaption> --}}
                      </figure>
                  </div>
  
                  <div class="col-lg-4">
                      <h3>{{ $data->name }}</h3>
                      <p class="text-muted">IDR. @currency($data->price)</p>
                      <button type="button" class="btn btn-sm" style="background-color: #EAEAEF; color: white;"><i
                              class="fas fa-minus-circle"></i></button>
                      <span class="mx-2">20</span>
                      <button type="button" class="btn btn-sm btn-success" style="color: white;"><i
                              class="fas fa-plus-circle"></i></button>
  
                      <div class="btn-product">
                          <a href="cart.html" class="btn btn-warning">Add to Cart</a>
                      </div>
  
                      <div class="designed-by">
                          <h5>Designed by</h5>
                          <div class="row">
                              <div class="col-2">
                                  <img src="{{ url('frontend/img/single/2.png') }}" alt="">
                              </div>
                              <div class="col">
                                  <h4>Anne Montgery</h4>
                                  <p>14.2K <span> Followers</span></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- akhir single product -->
  
      <!-- product description & review -->
      <section class="product-description p-5 ">
          <div class="container">
              <div class="row">
                  <div class="col-lg-9">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"
                                  role="tab" aria-controls="description" aria-selected="true">Product Description</a>
                          </li>
                       
  
                      </ul>
                      <div class="tab-content p-3" id="myTabContent">
                          <div class="tab-pane fade show active product-review" id="description" role="tabpanel"
                              aria-labelledby="description-tab">
                             <p>{{ $data->description }}</p>
                          </div>

  
  
                      </div>
                  </div>
  
              </div>
          </div>
      </section>
      <!-- akhir product description & review -->
@endsection