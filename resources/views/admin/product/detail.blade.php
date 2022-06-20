@extends('admin.main')
@section('content')
@include('admin.alert')
<section class="content">
    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="col-12">
              <img src="{{ asset('uploads/'.$product->image) }}" width="100px" class="product-image" alt="Product Image">
            </div>
            {{-- <div class="col-12 product-image-thumbs">
              <div class="product-image-thumb active"><img src="{{ asset('uploads/'.$product->image) }}" alt="Product Image"></div>
              <div class="product-image-thumb" ><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
              <div class="product-image-thumb" ><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
              <div class="product-image-thumb" ><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
              <div class="product-image-thumb" ><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
            </div> --}}
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">{{ $product->name }}</h3>
            <small> {{ $product->created_at }} </small>
            <p>{{ $product->title }}</p>
            <div class="bg-gray py-2 px-3 mt-4">
              <h2 class="mb-0">
                {{ number_format($product->price, '0', '.', '.').' đ' }}
              </h2>
            </div>

            <div class="row mt-4">
              <nav class="w-100">
                <div class="nav nav-tabs" id="product-tab" role="tablist">
                  <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                </div>
              </nav>
              <div class="tab-content p-3" id="nav-tabContent">
                <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {!! $product->description !!}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="d-flex justify-content-end m-3">
        <a class="btn btn-primary mr-3 text-dark" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(250, 244, 183))" href="{{ route('products.show', $product->product_id) }}">Sửa</a>
        <form action="{{ route('products.destroy', $product->product_id) }}" method="post">
          @csrf
          @method('DELETE')
          <input type="submit" class="btn btn-danger text-dark" value="Xóa" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(246, 198, 234))">
        </form>
      </div>
    </div>
    <!-- /.card -->

  </section>
@endsection