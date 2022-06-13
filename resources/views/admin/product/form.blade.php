@extends('admin.layout.main')

    
@section('content')
@if(!isset($product))
<h1 class="text-center"> Thêm danh mục sản phẩm</h1><br>
@else
<h1 class="text-center"> Sửa sản phẩm</h1><br>
@endif
<a href="{{url('product/page',['page'=>1])}}" class="btn btn-primary mb-5">Xem danh sách sản phẩm</a><br>

<div class="form-data "> 
    @if(!isset($product))
        {!! Form::open(['route' => 'product_store', 'method'=>'POST', 'enctype'=>"multipart/form-data"]) !!}
    @else
        {!! Form::open(['route' =>['product_update',$product['id']], 'method'=>'post', 'enctype'=>"multipart/form-data"]) !!}
    @endif
    
    <div class="form-group">
        {!! Form::label('name', 'Tên sản phẩm', []) !!}
        {!! Form::text('name',isset($product)? $product['name'] : '', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('regular_price', 'Giá bán', []) !!}
        {!! Form::text('regular_price',  isset($product)? $product['regular_price'] : '', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('stock_quantity', 'Số lượng tồn kho', []) !!}
        {!! Form::text('stock_quantity',  isset($product)? $product['stock_quantity'] : '', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('short_description', 'Mô tả ngắn gọn', []) !!}
        {!! Form::text('short_description',isset($product)? $product['short_description'] : '', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Mô tả', []) !!}
        {!! Form::textarea('description',  isset($product)? $product['description'] : '', ['class'=>'form-control', 'placeholder'=>'Nhập mô tả']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('categories', 'Danh mục', []) !!}<br>
        <select name="category" id="">
            @foreach ($category as $key => $cate )
                <option value="{{$cate->id}}">{{$cate->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        
        
        {!! Form::label('images', 'link ảnh', []) !!} <br>
        @if (isset($product))
            <img src="{{ $product['images'][0]->src }}" alt="" width="300" class="mb-3">
        @endif
        {!! Form::text('images','', ['class'=>'form-control']) !!}
    </div>
    <div class="submit-form-btn">
        @if(!isset($product))
            {!! Form::submit('Thêm danh mục',['class'=>'btn btn-success mt-3']) !!} 
        @else
            {!! Form::submit('Cập nhật',['class'=>'btn btn-success mt-3']) !!}
        @endif
        
    </div>
    {!! Form::close() !!} 
</div>


@endsection

