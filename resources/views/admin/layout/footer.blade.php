
<!-- jQuery -->
<script src="{{asset('template/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
{{-- <script src="{{asset('template/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script> --}}
<!-- AdminLTE App -->
<script src="{{asset('template/admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('template/admin/dist/js/demo.js')}}"></script> --}}
<script src="{{asset('template/admin/js/main.js')}}"></script>

<script type="text/javascript">
    $("#send_to").change(function(){
        var value = $(this).val();
        if(value==1){
            $('#list_email').html(
                '<div class="form-group"><label for="email">Email</label><input required type="text" class="form-control" name="list_email" placeholder="" value="{{old('email')}}">@error('email') <span class="text-danger"> {{$message}}</span>  @enderror </div>'
            );
        }
        if(value==0){
            $('#list_email').html('')
        }
    })
</script>
<script>
    $(document).ready(function(){
        if($("#send_to").val()==1){
            $('#list_email').html(
                '<div class="form-group"><label for="email">Email</label><input required type="text" class="form-control" name="list_email" placeholder="" value="{{isset($detail->list_email) ? $detail->list_email :'' }}">@error('email') <span class="text-danger"> {{$message}}</span>  @enderror </div>'
            );
        }
    })
</script>
@yield('footer')