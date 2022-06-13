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
            <div class="col-md-6 offset-md-3 mt-5">
                <h4>Contact us</h4><hr>

                <form action="{{route('send.email')}}" method="POST">
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
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{old('name')}}">
                        @error('name') <span class="text-danger"> {{$message}}</span>  @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="{{old('email')}}">
                        @error('email') <span class="text-danger"> {{$message}}</span>  @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Enter your subject" value="{{old('subject')}}">
                        @error('subject') <span class="text-danger"> {{$message}}</span>  @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                        @error('message') <span class="text-danger"> {{$message}}</span>  @enderror
                    </div>

                    <button class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
</body>
</html>