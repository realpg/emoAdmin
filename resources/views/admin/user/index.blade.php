@extends('admin.layouts.app')

@section('content')

    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户账户管理 <span
                class="c-gray en">&gt;</span> 查询用户信息 <a class="btn btn-success radius r btn-refresh"
                                                        style="line-height:1.6em;margin-top:3px"
                                                        href="javascript:location.replace(location.href);" title="刷新"
                                                        onclick="location.replace('{{URL::asset('/admin/user/index')}}');"><i
                    class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">

        <div class="cl pd-5 mt-20">
            <span class="l">
                 <a href="javascript:;" onclick=""
                    class="btn btn-primary radius">
                     查询用户
                 </a>
            </span>
        </div>

        <div class="text-c">
            {{--<form action="{{URL::asset('/admin/user/index')}}" method="post" class="form-horizontal">--}}
                {{--{{csrf_field()}}--}}
                <input id="search_word" name="search_word" type="text" class="input-text" style="width:450px"
                       placeholder="公司名称\用户名称">
                <button type="submit" class="btn btn-success" id="" name="">
                    <i class="Hui-iconfont">&#xe665;</i> 搜索
                </button>
            {{--</form>--}}
        </div>
        <table class="table table-border table-bordered table-bg" style="margin-top: 3rem;">
            <thead>
            <tr class="text-c">
                <th width="40">ID</th>
                <th width="50">用户名</th>
                <th width="150">手机号</th>
                <th width="90">公司名称</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-c">
                <td>1</td>
                <td>111111</td>
                <td>4444444</td>
                <td>烦烦烦方法</td>
                <td class="td-manage">
                    <a style="text-decoration:none" onClick="admin_stop(this,'1')"
                       href="javascript:;"
                       title="启用">
                        <i class="Hui-iconfont">&#xe631;</i>
                    </a>
                    <a title="重置密码" href="edit"
                       class="ml-5" style="text-decoration:none">
                        <i class="icon iconfont icon-zhongzhimima"></i>
                        {{--<i class="Hui-iconfont">&#xe6df;</i>--}}
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        $(function () {

        });

        /*
         参数解释：
         title	标题
         url		请求的url
         id		需要操作的数据id
         w		弹出层宽度（缺省调默认值）
         h		弹出层高度（缺省调默认值）
         */
        /*用户员-启用*/
        function admin_stop(obj, id) {
            console.log("admin_stop id:" + id);
            layer.confirm('确认要启用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 0,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置管理员状态
                setAdminStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,' + id + ')" href="javascript:;" title="禁用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用', {icon: 5, time: 1000});
            });
        }

        /*用户员-停用*/
        function admin_start(obj, id) {
            layer.confirm('确认要禁用吗？', function (index) {
                //此处请求后台程序，下方是成功后的前台处理
                var param = {
                    id: id,
                    status: 1,
                    _token: "{{ csrf_token() }}"
                }
                //从后台设置管理员状态
                setAdminStatus('{{URL::asset('')}}', param, function (ret) {
                    if (ret.status == true) {

                    }
                })
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
                $(obj).remove();
                layer.msg('已禁用', {icon: 6, time: 1000});
            });
        }

    </script>
@endsection