
@extends('layout')
@section('content')
<style type="text/css">
    body{margin-top:20px;
        background:#eee;
    }
    /* E-commerce */
    .product-box {
      padding: 0;
      border: 1px solid #e7eaec;
  }
  .product-box:hover,
  .product-box.active {
      border: 1px solid transparent;
      -webkit-box-shadow: 0 3px 7px 0 #a8a8a8;
      -moz-box-shadow: 0 3px 7px 0 #a8a8a8;
      box-shadow: 0 3px 7px 0 #a8a8a8;
  }
  .product-imitation {
      text-align: center;
      padding: 90px 0;
      background-color: #f8f8f9;
      color: #bebec3;
      font-weight: 600;
  }
  .cart-product-imitation {
      text-align: center;
      padding-top: 30px;
      height: 80px;
      width: 80px;
      background-color: #f8f8f9;
  }
  .product-imitation.xl {
      padding: 120px 0;
  }
  .product-desc {
      padding: 20px;
      position: relative;
  }
  .ecommerce .tag-list {
      padding: 0;
  }
  .ecommerce .fa-star {
      color: #d1dade;
  }
  .ecommerce .fa-star.active {
      color: #f8ac59;
  }
  .ecommerce .note-editor {
      border: 1px solid #e7eaec;
  }
  table.shoping-cart-table {
      margin-bottom: 0;
  }
  table.shoping-cart-table tr td {
      border: none;
      text-align: right;
  }
  table.shoping-cart-table tr td.desc,
  table.shoping-cart-table tr td:first-child {
      text-align: left;
  }
  table.shoping-cart-table tr td:last-child {
      width: 80px;
  }
  .product-name {
      font-size: 16px;
      font-weight: 600;
      color: #676a6c;
      display: block;
      margin: 2px 0 5px 0;
  }
  .product-name:hover,
  .product-name:focus {
      color: #1ab394;
  }
  .product-price {
      font-size: 14px;
      font-weight: 600;
      color: #ffffff;
      background-color: #1ab394;
      padding: 6px 12px;
      position: absolute;
      top: -32px;
      right: 0;
  }
  .product-detail .ibox-content {
      padding: 30px 30px 50px 30px;
  }
  .image-imitation {
      background-color: #f8f8f9;
      text-align: center;
      padding: 200px 0;
  }
  .product-main-price small {
      font-size: 10px;
  }
  .product-images {
      margin: 0 20px;
  }

  .ibox {
      clear: both;
      margin-bottom: 25px;
      margin-top: 0;
      padding: 0;
  }
  .ibox.collapsed .ibox-content {
      display: none;
  }
  .ibox.collapsed .fa.fa-chevron-up:before {
      content: "\f078";
  }
  .ibox.collapsed .fa.fa-chevron-down:before {
      content: "\f077";
  }
  .ibox:after,
  .ibox:before {
      display: table;
  }
  .ibox-title {
      -moz-border-bottom-colors: none;
      -moz-border-left-colors: none;
      -moz-border-right-colors: none;
      -moz-border-top-colors: none;
      background-color: #ffffff;
      border-color: #e7eaec;
      border-image: none;
      border-style: solid solid none;
      border-width: 3px 0 0;
      color: inherit;
      margin-bottom: 0;
      padding: 14px 15px 7px;
      min-height: 48px;
  }
  .ibox-content {
      background-color: #ffffff;
      color: inherit;
      padding: 15px 20px 20px 20px;
      border-color: #e7eaec;
      border-image: none;
      border-style: solid solid none;
      border-width: 1px 0;
  }
  .ibox-footer {
      color: inherit;
      border-top: 1px solid #e7eaec;
      font-size: 90%;
      background: #ffffff;
      padding: 10px 15px;
  }
</style>



<div class="container">
    <div>
        <div class="row">
            <div class="col">
                <span>商品名稱:</span>
                <input type="text" class="form-control" id="product">
            </div>
            <div class="col">
                <span>廠牌:</span>
                <input type="text" class="form-control" id="Vendor">
            </div>
            <div class="col">
                <span>指定價格:</span>
                <input type="number" class="form-control" id="sprice">
            </div>
            <div class="col">
                <span>上架時間</span>
                <select id="addtime" class="form-control">
                    <option value="desc">遞增</option>
                    <option value="asc">遞減</option>
                </select>
            </div>
    </div>

    <span>價格區間:</span>
    <div class="row">
        <div class="col">
          <input type="number" class="form-control" id="startprice" >
      </div>
      <div><span>~</span></div>
      <div class="col">
          <input type="number" class="form-control" id="endprice">
      </div>
  </div>

  <div class="row">
    <div class="col">
        <input type="button" id="search" onclick="searchitem('')" class="btn btn-primary" value="search">
    </div>
</div>




<div class="album py-5 row" id="itemlist">
    @foreach($productlists as $case)
    <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box">
                <div class="product-imitation" style="background-image:url({{ route('image.displayImage',$case->image) }});background-size:cover;">
                </div>
                <div class="product-desc">
                    <span class="product-price">
                        ${{$case->sprice}}
                    </span>
                    <small class="text-muted">類型:筆電</small></br>
                    <small class="text-muted">廠牌:{{$case->Vendor}}</small>
                    <a href="#" class="product-name">產品名稱:{{$case->product}}</a>

                    <div class="small m-t-xs">
                        {{$case->produce}}
                    </div>
                    <div class="m-t text-righ">
                        <a href="#" class="btn btn-xs btn-outline btn-primary">加入購物車</a>
                        <span><i class="fa fa-heart"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<nav aria-label="Page navigation example" id="pages">
  <ul class="pagination">
    <li class="page-item">
      <div class="page-link" aria-label="Previous" onclick="searchitem('1')">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </div>
</li>
@for($i=0;$i<$pages;$i++)
<li class="page-item <?php if($i==0){echo 'active';} ?> "><span class="page-link" href="#" onclick="searchitem('{{$i+1}}')">{{$i+1}}</span></li>
@endfor
<li class="page-item">
    <div class="page-link" aria-label="Next" onclick="searchitem('<?php if($pages>0){ echo "2";}else{echo '1';} ?>')">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
    </div>
</li>
</ul>
</nav>
</div>

<script>
$( document ).ready(function() {
    var page = 1;
    var Vendor = $("#Vendor").val();
    var price = $("#sprice").val();
    var _token   = $('meta[name="csrf-token"]').attr('content');
    var obj = {};
    obj.Vendor = Vendor;
    obj.sprice = price;
    obj.product = $("#product").val();
    obj.startprice = $("#startprice").val();
    obj.endprice = $("#endprice").val();
    obj.addtime = $("#addtime").val();
    obj.pages = 1;
    obj._token = _token;
    localStorage.setItem('tempobjec',JSON.stringify(obj));
});


  function searchitem(pagetext=''){
      var page = 1;
      var Vendor = $("#Vendor").val();
      var price = $("#sprice").val();
      var _token   = $('meta[name="csrf-token"]').attr('content');
      if(pagetext != ''){
        var page = pagetext;
        var objs = localStorage.getItem('tempobjec');
        var obj = JSON.parse(objs);
        obj.pages = page;
        localStorage.setItem('tempobjec',JSON.stringify(obj));
      }else{
        var objs = localStorage.getItem('tempobjec');
        var obj = JSON.parse(objs);
        obj.Vendor = Vendor;
        obj.sprice = price;
        obj.product = $("#product").val();
        obj.startprice = $("#startprice").val();
        obj.endprice = $("#endprice").val();
        obj.addtime = $("#addtime").val();
        obj.pages = 1;
        obj._token = _token;
        localStorage.setItem('tempobjec',JSON.stringify(obj));
      }
      var objs = localStorage.getItem('tempobjec');
      var obj = JSON.parse(objs);
      $.ajax({
        url: "ajaxrequest",
        type:"POST",
        data:obj,
      success:function(response){
          if(response.status=='success'){
            var html = '';
            for (var i = 0; i < response.itemlist.length; i++) {
                html += '<div class="col-md-3"><div class="ibox"><div class="ibox-content product-box">';
                html += '<div class="product-imitation" style="background-image:url(image/'+response.itemlist[i].image+');background-size:cover;"></div><div class="product-desc"><span class="product-price">$'+response.itemlist[i].sprice+'</span><small class="text-muted">類型:筆電</small></br><small class="text-muted">廠牌:'+response.itemlist[i].Vendor+'</small><a href="#" class="product-name">產品名稱:'+response.itemlist[i].product+'</a><div class="small m-t-xs">'+response.itemlist[i].produce+'</div> <div class="m-t text-righ"><a href="#" class="btn btn-xs btn-outline btn-primary">加入購物車</a><span><i class="fa fa-heart"></i></span></div></div>';
                html += '</div></div></div>';
            }
            document.getElementById('itemlist').innerHTML = html;


            perpages = "'"+response.prepage+"'";
            nextpages = "'"+response.nextpage+"'";
            var pagehtml = '<nav aria-label="Page navigation example" id="pages"><ul class="pagination"><li class="page-item"><div class="page-link" aria-label="Previous" onclick="searchitem('+perpages+')"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></div></li>';
            for (var i = 0; i <response.pages; i++) {
                pages = "'"+(i+1)+"'";
                if((i+1)==page){
                    pagehtml += '<li class="page-item active"><span class="page-link" onclick="searchitem('+pages+')" >'+(i+1)+'</span></li>';
                }else{
                  pagehtml += '<li class="page-item"><span class="page-link" onclick="searchitem('+pages+')" >'+(i+1)+'</span></li>';  
                }
                
            }
            pagehtml += '<li class="page-item"><div class="page-link" aria-label="Next" onclick="searchitem('+nextpages+')"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></div></li></ul></nav>';

            document.getElementById('pages').innerHTML = pagehtml;
        }else{
            alert(response.text);
        }
    },
});
  }
</script>
@endsection