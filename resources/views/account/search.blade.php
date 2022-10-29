@extends('layouts.app')

@section('content') 
<div class="row">
    <div class="col-12"> 
        <h1>Account List</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddAccountModal">
            Add Account
          </button>
    </div>





    <div class="col-12">
        
        <figure class="text-end">
            <blockquote class="blockquote">
              <p class="h6">共{{$accounts->count()}}筆資料</p>
        </figure>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>性別</th>
                    <th>生日</th>
                    <th>信箱</th>
                    <th>備註</th>
                    <th>編輯</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($accounts as $account)
                <tr>
                    <th>{{$account->id}}</th>
                    <th>{{$account->account}}</th>
                    <th>{{$account->name}}</th>

                    @if ($account->sex == '1')
                        <th>男</th>
                    @else 
                        <th>女</th>          
                    @endif


                    <th>{{date('Y年 m月 d日', strtotime($account->birthday))}}</th>
                    <th>{{$account->mail}}</th>
                    <th>{{$account->remark}}</th>

                    <th><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal{{$account->id}}">
                        Edit
                        </button></th>
                    <th><button class="btn btn-danger remove-from-cart delete" data-id="{{$account->id}}"><i class="fa fa-trash-o"></i>
                        Delete
                    </button></th>






<!-- Edit Modal -->
<div class="modal fade" id="EditModal{{$account->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="/accounts/{{$account->id}}" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="account">帳號：</label>
                    <input type="text" class="form-control" name="account" value="{{$account->account}}">
                </div>
            
                <div class="form-group">
                    <label for="name">姓名：</label>
                    <input type="text" class="form-control" name="name" value="{{$account->name}}">
                </div>
            
                <div class="form-group">
                    <label for="sex">性別：</label>
            
                    @if ($account->sex == 'male')
                    <input type="radio" name="sex" value="1" checked="checked"> 男
                    <input type="radio" name="sex" value="0"> 女
                    @else
                    <input type="radio" name="sex" value="1"> 男
                    <input type="radio" name="sex" value="0" checked="checked"> 女
                    @endif
            
                </div>
            
                
                <div class="form-group">
                    <label for="birthday">出生日期：</label>
                    <input type="date" class="form-control" name="birthday" value="{{$account->birthday}}">
                </div>
            
                <div class="form-group">
                    <label for="mail">信箱：</label>
                    <input type="text" class="form-control" name="mail" value="{{$account->mail}}">
                </div>
            
                <div class="form-group">
                    <label for="remark">備註：</label>
                    <input type="text" class="form-control" name="remark" value="{{$account->remark}}">
                </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          <div class="form-group">
            <input class="btn btn-primary" type="submit" name="creat_account" value="修改帳戶"> 
            @csrf
            @method('PUT')
        </div>
    </div>
    
    </form>


        </div>
      </div>
    </div>
  </div>
<!--END Edit Modal -->

                </tr>
                    
                @endforeach

            </tbody> 
            

    </table>
    
    </div>

    {{-- {{$accounts->links()}}  --}}



</div>





<!-- Add Modal -->
<div class="modal fade" id="AddAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            @include('inc.message')
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{ url('/accounts') }}" method="post">

                <div class="form-group">
                    <label for="account">帳號：</label>
                    <input type="text" class="form-control" name="account">
                </div>
            
                <div class="form-group">
                    <label for="name">姓名：</label>
                    <input type="text" class="form-control" name="name">
                </div>
            
                <div class="form-group">
                    <label for="sex">性別：</label>
                    <input type="radio" name="sex" value="1"> 男
                    <input type="radio" name="sex" value="0"> 女
                </div>
                <div class="form-group">
                    <label for="birthday">出生日期：</label>
                    <input type="date" class="form-control" name="birthday">
                </div>
            
                <div class="form-group">
                    <label for="mail">信箱：</label>
                    <input type="text" class="form-control" name="mail">
                </div>
            
                <div class="form-group">
                    <label for="remark">備註：</label>
                    <textarea class="form-control" name="remark" id="" cols="30" rows="10"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="creat_account" value="新增帳戶"> 
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                  </div>
            </form>
        </div>
      </div>
    </div>
  </div>
<!--END Add Modal -->






@endsection

@section('script')

    <script type="text/javascript">

$(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                        
                    }
                });
            }
        });

    </script>

@endsection



