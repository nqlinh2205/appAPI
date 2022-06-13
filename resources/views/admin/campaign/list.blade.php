

@extends('admin.layout.main')

@section('content')
    {{-- @extends('admin.campaign.layout') --}}
    <div class="panel-body" style="margin-bottom: 30px">
        <form action="{{route('campaign_store')}}" method="POST" class="form-horizontal">
        @csrf
            <div class="card">
                <h5 class="card-header">
                   Chiến dịch mới
                </h5>
                <div class="card-body row">
                    <label class="col-sm-2" for="task-name"><b>Chiến dịch</b></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="" name="name">
                    </div>
                    <!-- Add Task Button -->
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                            Thêm 
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- @if (count($tasks) > 0) --}}
        <div class="card">
            <h5 class="card-header">
                    Chiến dịch hiện tại
            </h5>
            <div class="card-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <!-- Table Headings -->
                            <thead>
                                <th>Tên chiến dịch</th>
                                <th>Hoạt động</th>
                                <th>Ngày thực hiện</th>
                                <th>Tình trạng</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($campaigns as $key => $campaign)
                                <tr>
                                    <td class="table-text"><div>{{$campaign->name}}</div></td>
                                    <td class="table-text"><div>
                                        @if ($campaign->status == 0)
                                            <a href="{{route('contact_index',$campaign->id)}}" class="btn btn-sm btn-primary">Soạn thảo</a>
                                        @else
                                        <a href="{{route('contact_index',$campaign->id)}}" class="btn btn-sm btn-warning">Sửa bản thảo</a>
                                        @endif
                                    <td class="table-text"><div>{{$campaign->date_active}}</div></td>
                                    <td class="table-text"><div>
                                        @if ($campaign->active == 0)
                                            <a href="{{route('campaign_send',$campaign->id)}}" class="btn btn-sm btn-primary">Gửi đi</a>
                                        @else
                                            <button href="#" class="btn btn-sm btn-secondary" disabled>Đã gửi</button>
                                        @endif
                                    </div></td>
                                    <td>
                                        <form action="{{route('campaign_delete',$campaign->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Xoá
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    {{-- @endif --}}

@endsection
