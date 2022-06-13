
@extends('admin.layout.main')
@section('content')
@php
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact us</title>
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12  mt-5">
                <h4>Chi tiết chiến dịch</h4><hr>
                @if (isset($detail))
                    <form action="{{route('detail_update',$detail->id)}}" method="POST">
                        {{ method_field('PUT') }}
                @else
                    <form action="{{route('detail_store',$campaign->id)}}" method="POST">    
                @endif
                    @csrf

                   
                    <div class="form-group">
                        <label for="subject">Tiêu đề</label>
                        <input type="text" class="form-control" name="subject" placeholder="Nhập tiêu đề" value="{{isset($detail->subject) ? $detail->subject :'' }}">
                        @error('subject') <span class="text-danger"> {{$message}}</span>  @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Gửi đến</label>
                        <select name="email"  id="send_to">
                            <option value="0" {{isset($detail->email) && $detail->email == 0 ? 'selected':'' }}>All</option>
                            <option id="insert_email" value="1" {{isset($detail->email) && $detail->email == 1 ? 'selected':'' }}>Email</option>
                        </select>
                        <div id="list_email">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Nội dung</label>
                        <textarea name="message" id="editor1" cols="30" rows="10" class="form-control">{{isset($detail->message) ? $detail->message :'' }}</textarea>
                        @error('message') <span class="text-danger"> {{$message}}</span>  @enderror
                    </div>

                    @if (isset($detail))
                        <button class="btn btn-primary">Sửa</button>
                    @else
                        <button class="btn btn-primary">Tạo</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
</body>
</html>
@endsection
