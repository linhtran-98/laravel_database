@extends('admin.main')
@section('content')
@include('admin.alert')
<div class="card-header">
  <div class="float-right">
    <a href="{{ route('products.index', ['status' => 'pending']) }}" class="btn" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(249, 249, 249))">Pending: <span class="font-weight-bold">{{ $pending }}</span></a>
    <a href="{{ route('products.index', ['status' => 'approve']) }}" class="btn" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(250, 244, 183))">Approve: <span class="font-weight-bold">{{ $approve }}</span></a>
    <a href="{{ route('products.index', ['status' => 'reject']) }}" class="btn" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(246, 198, 234))">Reject: <span class="font-weight-bold">{{ $reject }}</span></a>
    <a href="{{ request()->Url() }}" class="btn ml-4 text-dark" style="background-image: linear-gradient(to right, rgb(205, 240, 234), #ada0e5);"><span class="font-weight-bold">Bỏ lọc</span></a>
  </div>
</div>
<div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Danh mục</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th colspan="3">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $key => $value)
            <tr class="text-center">
              <td>{{ $value->name }}</td>
              <td>{{ $value->price }}</td>
              <td><img src="{{ asset('uploads/'.$value->image) }}" width="100px" alt="" srcset=""></td>
              <td>{{ $value->status }}</td>
              <td>
                @foreach ($category as $key => $cate)
                    @if ($cate->id == $value->category_id)
                        {{ $cate->name }}
                    @endif
                @endforeach
              </td>
              <td>{{ $value->created_at }}</td>
              <td>{{ $value->updated_at }}</td>
              <td class="text-center"><a class="btn" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(249, 249, 249))" href="{{ url('/products/detail/'.$value->product_id) }}">Chi tiết</a></td>
              <td class="text-center"><a class="btn" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(250, 244, 183))" href="{{ route('products.show', $value->product_id) }}">Sửa</a></td>
              <td class="text-center">
                <form id="deleteForm" action="{{ route('products.destroy', $value->product_id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input type="submit" class="btn" style="background: -webkit-linear-gradient(rgb(205, 240, 234), rgb(246, 198, 234))" value="Xóa">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <div class="pagination pagination-sm m-0 float-right">
        {{ $products->appends($_GET)->links() }}
      </div>
    </div>
  </div>
@endsection