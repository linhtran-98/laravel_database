@extends('admin.main')
@section('content')
    @include('admin.alert')
    <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" placeholder="Enter name...">
            </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn" style="background-image: linear-gradient(to right, rgb(205, 240, 234), rgb(249, 249, 249), rgb(246, 198, 234), rgb(250, 244, 183));">Sửa sản phẩm</button>
        </div>
    </form>
@endsection