<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\productlist;
use DB;
use App\Quotation;
use Response;
use Illuminate\Support\Facades\Storage;

class AjaxController extends Controller
{
	public $limitnum = 8;
    public function showlist()
    {
        $productlisttotle = productlist::all();
        $pages = ceil(sizeof($productlisttotle)/$this->limitnum);
        $sql = "select * from productlists ORDER BY add_time DESC  LIMIT ".$this->limitnum." OFFSET 0;";
        $productlists = DB::select($sql);
      	return view('ajaxrequest', compact('productlists'), compact('pages'));
    }

    public function store(Request $request)
    {
        $postdata = $request->all();
        $wherepostdata = $this->wherepostdata($postdata);
        $returnproductlistsql = $this->returnproductlistsql($wherepostdata);
        $productlists = DB::select($returnproductlistsql['select'],$returnproductlistsql['value']);
        $producttotle = DB::select($returnproductlistsql['toaleselect'],$returnproductlistsql['value']);
        $pages = ceil(sizeof($producttotle)/$this->limitnum);
        $pre_page = $this->pre_page($pages,$wherepostdata['pages']);
        $next_page = $this->next_page($pages,$wherepostdata['pages']);
        #$coronacases = productlist::where('Vendor',$postdata['Vendor'])->orderBy('id')->take(10)->get();
        #create or update your data here
        if(!empty($productlists)){
        	return response()->json(['status'=>'success','itemlist'=>$productlists,'pages'=>$pages,'prepage'=>$pre_page,'nextpage'=>$next_page/*,'texts'=>$returnproductlistsql*/]);
        }else{
        	return response()->json(['status'=>'error','text'=>'無商品資訊']);
        }
    }

    public function pre_page($total,$crpage){
    	$page1 = 1;
    	if($crpage==1){
    		$page1 = 1;
    	}else{
    		if($total>=$crpage){
    			$page1 = $crpage-1;
    		}
    	}
    	return $page1;
    }


    public function next_page($total,$crpage){
    	$page1 = 1;
    	if($crpage==1){
    		if($total>$crpage){
    			$page1 = $crpage+1;
    		}
    	}else{
    		if($total>$crpage){
    			$page1 = $crpage+1;
    		}else{
    			if($total<=$crpage){
    				$page1 = $total;
    			}
    		}
    	}
    	return $page1;
    }


    public function returnproductlistsql($wherepostdata){
        $whereand = $this->whereand($wherepostdata['filed']);
        $priceinterval = $this->priceinterval($wherepostdata['Interval']);
        $pagenum = $this->returnstartpagenum($wherepostdata['pages']);
    	if(!empty($wherepostdata['value'])){
    		if(!empty($priceinterval)){
        		$limitsql = "select * from productlists where ".$whereand.' AND '.$priceinterval." ORDER BY add_time ".$wherepostdata['addtime']." LIMIT ".$this->limitnum." OFFSET ".$pagenum.";";

        		$sql = "select * from productlists where ".$whereand.' AND '.$priceinterval." ORDER BY add_time ".$wherepostdata['addtime']." ;";
        	}else{
        		$limitsql = "select * from productlists where ".$whereand." ORDER BY add_time ".$wherepostdata['addtime']." LIMIT ".$this->limitnum." OFFSET ".$pagenum.";";

        		$sql = "select * from productlists where ".$whereand." ORDER BY add_time ".$wherepostdata['addtime'].";";
        	}
    		$arrsql = array(
    			'select'=>$limitsql,
    			'toaleselect'=>$sql,
    			'value'=>$wherepostdata['value']
    		);
    	}else{
    		if(!empty($priceinterval)){
        		$limitsql = "select * from productlists where ".$priceinterval." ORDER BY add_time ".$wherepostdata['addtime']."  LIMIT ".$this->limitnum." OFFSET ".$pagenum.";";

        		$sql = "select * from productlists where ".$priceinterval." ORDER BY add_time ".$wherepostdata['addtime'].";";
        	}else{
        		$limitsql = "select * from productlists ORDER BY add_time ".$wherepostdata['addtime']."  LIMIT ".$this->limitnum." OFFSET ".$pagenum.";";

        		$sql = "select * from productlists ORDER BY add_time ".$wherepostdata['addtime'].";";
        	}
    		$arrsql = array(
    			'select'=>$limitsql,
    			'toaleselect'=>$sql,
    			'value'=>array()
    		);
    	}
    	return $arrsql;
    }

    public function returnstartpagenum($pages){
    	if($pages==1){
    		return 0;
    	}else{
    		return ($pages-1)*$this->limitnum;
    	}
    }

    public function whereand($arrfiledvalue=array()){
    	$where = '';
    	for ($i=0; $i < sizeof($arrfiledvalue); $i++) { 
    		if(sizeof($arrfiledvalue)==($i+1)){
    			$where .= $arrfiledvalue[$i]." = :".$arrfiledvalue[$i]." ";
    		}else{
    			$where .= $arrfiledvalue[$i]." = :".$arrfiledvalue[$i]." AND ";
    		}
    	}
    	return $where;
    }

    public function priceinterval($price_arr){
    	$sql = '';
    	if(isset($price_arr['startprice'])&&isset($price_arr['endprice'])){
    		$sql = ' sprice BETWEEN '.$price_arr['startprice'].' AND '.$price_arr['endprice'];
    	}
    	return $sql;
    }


    public function wherepostdata($postdata){
    	$arr = array();
    	$arr['filed'] = array();
    	$arr['value'] = array();
    	$arr['addtime'] = 'DESC';
    	$arr['pages'] = 1;
    	$arr['Interval'] = array();
    	$postdefault = $this->postdefault();
    	foreach ($postdata as $key => $value) {
    		if(!empty($value)&&isset($postdefault[$key])){
    			switch ($key) {
    				case 'pages':
    					$arr['pages'] = intval($value);
    					break;
    				
    				case 'startprice':
    				case 'endprice':
    					$arr['Interval'][$key] = $value;
    					break;

    				case 'addtime':
    					if($value=='desc'||$value=='asc'){
    						$arr['addtime'] = $value;
    					}
    					break;

    				default:
    					$arr['filed'][] = $key;
    					$arr['value'][$key] = $value;
    					break;
    			}
    		}
    	}
    	return $arr;
    }

    public function postdefault(){
    	return array(
    		'Vendor'=>'',
    		'oprice'=>'',
    		'product'=>'',
    		'sprice'=>'',
    		'startprice'=>'',
    		'endprice'=>'',
    		'addtime'=>'',
    		'pages'=>'',
    	);
    }
}