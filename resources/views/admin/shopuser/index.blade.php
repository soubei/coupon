@extends('admin.layouts.main')
@section('content')
     <section class="content">
         <div class="panel panel-primary">
             <div class="panel-heading">
                 <h3 class="panel-title">商品兑换列表</h3>
             </div>
             <div class="panel-body">
                 @include('admin.shopuser.filter')
                 <table class="table table-bordered table-hover text-center">
                     <tr>
                         <th  style="width: 5%">ID</th>
                         <th  style="width: 10%">用户</th>
                         <th  style="width: 5%">商品</th>
                         <th  style="width: 5%">兑换积分</th>
						 <th  style="width: 5%">姓名/电话/地址</th>
                         <th  style="width: 5%">发货状态</th>
						 <th  style="width: 10%">物流信息</th>
						 <th  style="width: 10%">添加时间</th>
                         <th  style="width: 10%">操作</th>
                     </tr>
                     @foreach($data as $item)
                         <tr>
                             <td>
                                 {{ $item->id }}
                             </td>
                             <td>
							     <a href="/admin/member?id={{ $item->uid }}"> {{$item->member_name}}</a>
                             </td>							 
                             <td>
                                   <a href="/admin/shop?shopID={{ $item->couponsshopid }}">{{$item->shoptitle}}</a>
                             </td>
                             <td>
                                 {{$item->score}}
                             </td>
                             <td>
                                  {{$item->address}}
                             </td>								 
                             <td>
                                @if($item->status==0)
									<strong style="color:red">未发货</strong>
								@else
									<strong style="color:green">已发货</strong>
								@endif                                
                             </td>
                             <td>
                                 {{$item->orderno}}
                             </td>							 
                             <td>
                                 {{$item->created_at}}
                             </td>						 
                             <td>
							 <a href="{{ route('shopuser.edit', ['id' => $item->getKey()]) }}" class="btn btn-primary btn-xs">修改</a>
                                 <button class="btn btn-danger btn-xs"
                                         data-url="{{route('shopuser.destroy', ['id' => $item->getKey()])}}"
                                         data-toggle="modal"
                                         data-target="#delete-modal"
                                 >
                                     删除
                                 </button>
                             </td>
                         </tr>
                     @endforeach
                 </table>
                 <div class="clearfix">
                     <div class="pull-left" style="margin: 0;">
                         <p>总共 <strong style="color: red">{{ $data->total() }}</strong> 条</p>
                     </div>
                 <div class="pull-right" style="margin: 0;">
                     {!! $data->appends(['status' => $status, 'uid' =>$uid, 'shopid' =>$shopid, 'start_at' => $start_at, 'end_at' => $end_at])->links() !!}
                 </div>
                 </div>
             </div>
         </div>

     </section><!-- /.content -->
@endsection
@section("after.js")
     @include('admin.layouts.delete',['title'=>'操作提示','content'=>'你确定要删除这个用户免单劵吗?'])
@endsection