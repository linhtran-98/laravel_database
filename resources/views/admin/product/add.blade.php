@extends('admin.main')
@section('content')
    @include('admin.alert')
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" required name="name" class="form-control" id="name" placeholder="Enter name...">
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" required name="title" class="form-control" id="title" placeholder="Enter title...">
            </div>
            
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" required name="price" class="form-control" id="price">
            </div>
            
            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" required name="image" class="form-control" id="image">
                <img src="" style="padding: 5px;" width="100px" alt="" id="product_img">
            </div>

            <div class="form-group">
                <label for="ckeditor_des">Chi tiết</label>
                <textarea class="form-control" required id="ckeditor_des" name="description"></textarea>
                <script>
                    CKEDITOR.replace( 'ckeditor_des' );
            </script>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn" style="background-image: linear-gradient(to right, rgb(205, 240, 234), rgb(249, 249, 249), rgb(246, 198, 234), rgb(250, 244, 183));">Tạo sản phẩm</button>
        </div>
    </form>
@endsection