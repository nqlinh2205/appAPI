@extends('admin.layout.main')
@php

        // dd($order['data'][0]->billing);
@endphp
@section('content')
<h1 class="text-center">Danh sách đơn hàng</h1><br>
<br>
<span class="">Tổng số đơn hàng: 
    <h3 style="display:inline-block"><span class="badge badge-secondary">{{$order['meta']['total_results']}}</span></h3> 
    SP</span>
<table class="table table-striped">
        @if (Session::has('error'))
          <div class="alert alert-danger">
            {{Session::get('error')}}
          </div> 
        @endif
        @if (Session::has('success'))
          <div class="alert alert-success">
            {{Session::get('success')}}
          </div> 
        @endif
    <thead>
      <tr>
        {{-- <th scope="col">STT</th> --}}
        <th scope="col">ID đơn hàng</th>
        <th scope="col">Khách đặt</th>
        <th scope="col">Email</th>
        <th scope="col">SĐT</th>
        <th scope="col">địa chỉ giao hàng</th>
        <th scope="col">Ngày tạo</th>
        <th scope="col">Tổng giá</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($order['data'] as $item => $pd)
        <tr>
            <td>{{$pd->id }}</td>
            <td>{{$pd->billing->first_name .' '.$pd->billing->last_name}}</td>
            <td>{{$pd->billing->email }}</td>
            <td>{{$pd->billing->phone }}</td>
            <td>{{$pd->shipping->address_1 }}</td>
            <td>{{$pd->date_created }}</td>
            <td>{{$pd->total}}</td>
      
            <td>
                <span>
                    {!! Form::open(['route' => ['coupon_create',$pd->id ], 'method'=>'post']) !!}
                    {!! Form::token() !!}
                    {!! Form::submit('Tạo coupon',['class'=>'btn btn-success btn-sm']) !!}
                    {!! Form::close() !!}
                </span>
                
            </td>
        </tr>
        @endforeach
      
      
    </tbody>

   
  </table>
  <nav aria-label="...">
    <ul class="pagination">
        
        {{-- pre --}}
      @if ($order['meta']['previous_page'] == null)
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
      @else
        <li class="page-item ">
            <a class="page-link" href="{{url('order/page',['page'=>$order['meta']['previous_page']])}}">Previous</a>
        </li>
        @endif
      @for($i = 1 ; $i<= $order['meta']['total_pages']; $i++)
      
      {{-- index --}}
        @if ($i == $order['meta']['current_page'])
        <li class="page-item active">
            <a class="page-link" href="{{url('order/page',['page'=>$i])}}">{{$i}}</a>
          </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{url('order/page',['page'=>$i])}}">{{$i}}</a>
        </li>
        @endif
      @endfor
        {{-- next --}}
          @if ($order['meta']['next_page'] == null)
          <li class="page-item disabled">
            <a class="page-link" href="#" >Next</a>
          </li>
          @else
        <li>
          <a class="page-link" href="{{url('order/page',['page'=>$order['meta']['next_page']])}}">Next</a>
        </li>

          @endif
    </ul>
  </nav>
@endsection

