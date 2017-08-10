<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>
    <link rel="stylesheet" href="{{asset('css/pintuer.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
    <div class="logo margin-big-left fadein-top">
        <h1>宇元农场后台管理中心</h1>
    </div>
    <div class="head-l"><a class="button button-little bg-red" href="/Boss"><span class="icon-power-off"></span>返回商城后台</a> </div>
</div>
<div class="leftnav">
    <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
    <h2><span class="icon-caret-right"></span>分类管理</h2>
    <ul>
        <li><a href="{{route('category.index')}}" ><span class="icon-tags"></span>分类列表</a></li>
        <li><a href="{{route('category.create')}}"><span class="icon-pencil-square-o"></span>添加分类</a></li>
    </ul>
    <h2><span class="icon-caret-right"></span>农产品管理</h2>
    <ul>
        <li><a href="{{route('dish.index')}}" ><span class="icon-tags"></span>产品列表</a></li>
        <li><a href="{{route('dish.create')}}"><span class="icon-pencil-square-o"></span>添加产品</a></li>
    </ul>
   {{--<h2><span class="icon-caret-right"></span>区域管理</h2>
    <ul style="display:none">
        <li><a href="{{route('area.index')}}" ><span class="icon-tags"></span>区域列表</a></li>
        <li><a href="{{route('area.create')}}"><span class="icon-pencil-square-o"></span>添加区域</a></li>
    </ul>--}}
    <h2><span class="icon-caret-right"></span>大棚管理</h2>
    <ul>
        <li><a href="{{route('house.index')}}"><span class="icon-tags"></span>大棚列表</a></li>
        <li><a href="{{route('house.create')}}" ><span class="icon-pencil-square-o"></span>添加大棚</a></li>
    </ul>
    <h2><span class="icon-caret-right"></span>菜地管理</h2>
    <ul>
        <li><a href="{{route('ground.index')}}" ><span class="icon-tags"></span>菜地列表</a></li>
        <li><a href="{{route('ground.create')}}"><span class="icon-pencil-square-o"></span>添加菜地</a></li>
    </ul>
    <h2><span class="icon-caret-right"></span>交易管理</h2>
    <ul>
        <li><a href="{{route('order.index')}}" ><span class="icon-tags"></span>订单列表</a></li>
        <li><a href="{{route('record.index')}}" ><span class="icon-tags"></span>种菜记录表</a></li>
        <li><a href="{{route('packaged.index')}}" ><span class="icon-tags"></span>包裹列表</a></li>
    </ul>
    <h2><span class="icon-caret-right"></span>用户相关</h2>
    <ul>
        <li><a href="{{route('userback')}}" ><span class="icon-tags"></span>用户反馈</a></li>
        <li><a href="{{route('admininvoice')}}" ><span class="icon-tags"></span>发票申请</a></li>

    </ul>
</div>
<ul class="bread">
    <li><a href="{{route('admin')}}"  class="icon-home"> 首页</a></li>
    <li><b>当前语言：</b><span style="color:red;">中文</span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</ul>

