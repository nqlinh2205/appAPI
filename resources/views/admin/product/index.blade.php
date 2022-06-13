@extends('admin.layout.main')
@php

        // dd($product['data'][0]->name);
@endphp
@section('content')
<h1 class="text-center">Danh mục sản phẩm</h1><br>
<a href="{{route('product_create')}}" class="btn btn-primary mb-5">Thêm sản phẩm</a>
<br>
<span class="">Tổng số sản phẩm: 
    <h3 style="display:inline-block"><span class="badge badge-secondary">{{$product['meta']['total_results']}}</span></h3> 
    SP</span>
<table class="table table-striped">
    <thead>
      <tr>
        {{-- <th scope="col">STT</th> --}}
        <th scope="col">Tên</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Giá</th>
        <th scope="col">SL tồn kho</th>
        <th scope="col">Quản lý</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($product['data'] as $item => $pd)
        <tr>
            {{-- <th scope="row">{{$item+1}}</th> --}}
             <td>{{$pd->name}}</td>
            <td>
                @foreach ($pd->images as $img)
                    <img src="{{$img->src}}" alt="" width="100">
                @endforeach
            </td>
            <td>{{$pd->regular_price}}</td>
            <td>{{$pd->stock_quantity}}</td>
            <td>
                <span>
                    {!! Form::open(['route' => ['product_destroy',$pd->id], 'method'=>'delete','onsubmit'=>'return confirm("Bạn muốn xoá??")'])  !!}
                    {!! Form::submit('Xoá',['class'=>'btn btn-danger btn-sm']) !!}
                </span>
                <span>
                    {!! Form::close() !!}
                    <a href="{{route('product_edit',$pd->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                </span>
            </td>
        </tr>
        @endforeach
      
      
    </tbody>

   
  </table>
  <nav aria-label="...">
    <ul class="pagination">
        
        {{-- pre --}}
      @if ($product['meta']['previous_page'] == null)
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
      @else
        <li class="page-item ">
            <a class="page-link" href="{{url('product/page',['page'=>$product['meta']['previous_page']])}}">Previous</a>
        </li>
        @endif
      @for($i = 1 ; $i<= $product['meta']['total_pages']; $i++)
      
      {{-- index --}}
        @if ($i == $product['meta']['current_page'])
        <li class="page-item active">
            <a class="page-link" href="{{url('product/page',['page'=>$i])}}">{{$i}}</a>
          </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{url('product/page',['page'=>$i])}}">{{$i}}</a>
        </li>
        @endif
      @endfor
        {{-- next --}}
          @if ($product['meta']['next_page'] == null)
          <li class="page-item disabled">
            <a class="page-link" href="#" >Next</a>
          </li>
          @else
        <li>
          <a class="page-link" href="{{url('product/page',['page'=>$product['meta']['next_page']])}}">Next</a>
        </li>

          @endif
    </ul>
  </nav>
@endsection

