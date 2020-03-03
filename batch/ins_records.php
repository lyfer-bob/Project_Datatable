<?php
include 'lib/dbconfig.php';
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    echo 'Request method must be POST!';
}
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    echo 'Content type must be: application/json';
}
$json = file_get_contents('php://input');

if (empty($json)){
    echo "no input";
}else {
    //echo $json;
  
    $data = json_decode($json);
    //$date = new DateTime($data->ExecTime);
    //$batchnumber="bat".$date->getTimestamp();
    $batchnumber = "Bat".$data->ExecTime;
    echo "<pre>";
   echo "batchNumber $batchnumber Recieved ".$data->data_type ."--".$data->Total." Docs at ".$data->ExecTime;

    $importdata=[];
    $itemline=[];
    $ProductGroupID="";
    if ($data->data_type=='arInvoice'){
        $tempCRSO=0;
       $jj=0;
        foreach ($data->objects as $keys => $value) {
            //insert2mysql ($batchnumber,$data->data_type,$data->ExecTime,$value);
            //print_r($value);
            // echo "<br>";
             //$itemline[$keys]['shipping']= $value->shipping_cost;
              $vat=0;
             $tempDRdex = 0;
            //  if ($value->discount!=0) {
            //     $discEX = ($value->shipping_cost-abs($value->discount))/107*100;
            //  }else {
            //     $discEX = 0;
            //  }
           // $discEX = ($value->shipping_cost-abs($value->discount))/107*100;
             $discEX = abs($value->discount)/107*100;
             @$importdata['pay_amount']+= $value->pay_amount;
          
             $itemline[$jj][$keys]['ชำระโดย']= $value->pay_by;
             $itemline[$jj][$keys]['SO_Number']=$value->code;
             $itemline[$jj][$keys]['Discount']=$value->discount;
             $itemline[$jj][$keys]['shipping_cost']=$value->shipping_cost;
            //  $itemline[$keys]['channel_name']=extract_channel($value->channel_name);
             @$itemline[$jj][$keys]['DR - AR Trade Others - Shipping -> '.getCtlAccount($value->pay_by,$value->shipping_by)]+= $value->pay_amount;
             @$itemline[$jj][$keys][extract_channel($value->channel_name,"ship",'costsusp').'405200.999 CR - Logistic Inc.-Others->']=round($value->shipping_cost/107*100,4);
             @$itemline[$jj][$keys][extract_channel($value->channel_name,"ship",'costsusp').'606004.06 DR - Discount Expense(ค่าขนส่ง/สินค้า) -> ']=round($discEX,4);
             @$importdata['DR']['AR Trade Others - Shipping'.getCtlAccount($value->pay_by,$value->shipping_by)]+= $value->pay_amount;
             @$importdata['CR'][extract_channel($value->channel_name,"ship",'costsusp').'.405200.999 Logistic Inc.-Others']+=round($value->shipping_cost/107*100,4);
             @$importdata['DR'][extract_channel($value->channel_name,"ship",'costsusp').'.606004.06 - Discount Expense-']+=round($discEX,4);
           
             foreach ($value->item as $items => $num) {
                 if (empty($num->ProductGroupID)) {
                        echo $keys;
                        print_r($value->item);
                 }
                $ProductGroupID=$num->ProductGroupID;
                ////@$itemline[$keys][$ProductGroupID]+=1;
                @$itemline[$jj][$keys][$ProductGroupID]['channel_name']=$value->channel_name;
                @$itemline[$jj][$keys][$ProductGroupID]['DR - COG (บัญชีพัก) -> '.extract_channel($value->channel_name,$num->barcode,'costsusp').getCtlAccCost($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                @$itemline[$jj][$keys][$ProductGroupID]['CR - Sale (บัญชีพัก) -> '.extract_channel($value->channel_name,$num->barcode,'salesusp').getCtlAccIncome($ProductGroupID).">"]+=round(($num->PricePerUnit*$num->QTY)/107*100,4); 
                ////$tempCRSO+=round(($num->PricePerUnit*$num->QTY)/107*100,2);
                ////$vat+=round(($num->PricePerUnit*$num->QTY)/107*100,2);
                @$itemline[$jj][$keys][$ProductGroupID]['CR - FG-Goods in Transit 2C -> 49.118403.98>']+=$num->Item_cost*$num->QTY;
                @$importdata['CR'][extract_channel($value->channel_name,$num->barcode,'salesusp').getCtlAccIncome($ProductGroupID)]+=round(($num->PricePerUnit*$num->QTY)/107*100,4);
                @$importdata['DR'][extract_channel($value->channel_name,$num->barcode,'costsusp').getCtlAccCost($ProductGroupID)]+= $num->Item_cost*$num->QTY;  
                @$importdata['CR']['FG-Goods in Transit 2C-49.118403.98']+=$num->Item_cost*$num->QTY;

             }  
                // @$itemline[$jj][$keys]['VAT>>']=round($value->pay_amount*7/107,4);
                @$importdata['CR']['Out Put TAX-49.215209']+=round($value->pay_amount*7/107,4);
                $jj++;
        }
       // @$importdata['CR']['Out Put TAX -> 49.215209']=round($importdata['pay_amount']- $tempCRSO - @$importdata['CR']['Logistic Inc. - Others -> 49.405200.999'] - $importdata['CR']['Discount Expense(ค่าขนส่ง/สินค้า) -> 49.606004.06'],2);
        
        print_r($importdata);
        //echo $jj;
        echo "<br>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<br>"; 
       print_r($itemline);
        

    }elseif ( $data->data_type=='arReceive') {
           foreach ($data->objects as $keys => $value) {
            //insert2mysql ($batchnumber,$data->data_type,$data->ExecTime,$value);
            //print_r($value);
            // echo "<br>";
             //$itemline[$keys]['shipping']= $value->shipping_cost;
             //$itemline[$keys]['AR Trade Others - Shipping-> 49.113260.06']= $value->pay_amount;
            //  $itemline[$keys]['ชำระโดย']= $value->pay_by;
            //  $itemline[$keys]['SO_Number']=$value->code;
            //  @$itemline[$keys]['CR - AR Trade Others - Shipping -> '.getCtlAccount($value->pay_by,$value->shipping_by)]+= $value->pay_amount;
            //  @$itemline[$keys]['CR - Logistic Inc. - Others -> 49.405200.999']=round($value->shipping_cost/107*100,2);
            //  @$itemline[$keys]['CR - Discount Expense(ค่าขนส่ง/สินค้า) -> 49.606004.06']=round($value->discount);
            @$importdata['DR']['Cash in Transit - Shipping -> 49.111103.01']+= $value->pay_amount;
             @$importdata['CR']['AR Trade Others - Shipping -> '.getCtlAccount($value->pay_by,$value->shipping_by)]+= $value->pay_amount;
             //@$importdata['CR - Logistic Inc. - Others -> 49.405200.999']+=round($value->shipping_cost/107*100,2);
             //@$importdata['CR - Discount Expense(ค่าขนส่ง/สินค้า) -> 49.606004.06']+=round($value->discount);
             foreach ($value->item as $items => $num) {
                $ProductGroupID=$num->ProductGroupID;
                //@$itemline[$keys][$ProductGroupID]+=1;
                
                // @$itemline[$keys][$ProductGroupID]['DR - COG (บัญชีพักตามหมวดสินค้า) -> '.getCtlAccCost($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                // @$itemline[$keys][$ProductGroupID]['CR - Sale (บัญชีพักByหมวดสินค้า) -> '.getCtlAccIncome($ProductGroupID)]+=round(($num->PricePerUnit*$num->QTY)/107*100,2); 
                // @$itemline[$keys][$ProductGroupID]['CR - FG-Goods in Transit 2C -> 49.118403.98']+=$num->Item_cost*$num->QTY;
                @$importdata['DR']['FG-Goods in Transit 2C -> 49.118403.98']+=$num->Item_cost*$num->QTY;
                @$importdata['CR']['FG-Goods ->' .getCtlAccInventory($ProductGroupID)]+= $num->Item_cost*$num->QTY; 
                @$importdata['DR']['Sale (บัญชีพัก) -> 49'.getCtlAccIncome($ProductGroupID)]+=round(($num->PricePerUnit*$num->QTY)/107*100,2);
                @$importdata['CR']['ขายสินค้า -> 49'.getCtlAccIncomeEOD($ProductGroupID)]+=round(($num->PricePerUnit*$num->QTY)/107*100,2);  
                @$importdata['DR']['Cost of goods sold -> 49'.getCtlAccCost($ProductGroupID)]+= $num->Item_cost*$num->QTY;  
                @$importdata['CR']['COG -> 49'.getCtlAccCostEOD($ProductGroupID)]+= $num->Item_cost*$num->QTY;  
                
               
            //     $ProductGroupID=$num->ProductGroupID;
            //     $groupprice=$num->PricePerUnit*$num->QTY;
            //     $groupcost=$num->Item_cost*$num->QTY;
            // //     //echo "\n-$ProductGroupID-".$groupprice."--";
            //     @$itemline[$ProductGroupID]['price']+=$groupprice;
            //     @$itemline[$ProductGroupID]['cost']+=$groupcost;
            //     // $itemline[$ProductGroupID]+=array('VNEDBT'=>$batchnumber,
            //     //                                     // 'VNEDLN'=>$jj*1000,
            //     //                                     // 'VNJELN'=>$jj*1000,
            //     //                                     'VNEDDT'=>calc2julian($value->inv_date),
            //     //                                     'VNDGJ'=>calc2julian($value->inv_date),
            //     //                                     'VNUPMJ'=>calc2julian($value->inv_date),
            //     //                                     'VNDICJ'=>calc2julian($value->inv_date),
            //     //                                     'VNDSVJ'=>calc2julian($value->inv_date),
            //     //                                     'VNUPMT'=>splitdatetime($data->ExecTime),
            //     //                                     //'VNEXR'=>$value->tax_name,
            //     //                                     'VNEDTN'=>$keys,
            //     //                                     'VNDOC'=>$keys,
            //     //                                     'VNEXA'=>$value->code,
            //     //                                     'VNDCT'=>$doctype
            //     //                                             );
               
             }                                              
        }
        print_r($importdata);
        echo "<br>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<br>"; 
        //print_r($itemline);

    }elseif($data->data_type=='arCreditNote') { 
        $doctype = 'CH (CreditNote)';
        //cn type == ชำรุด  คงเหลือ //
        foreach ($data->objects as $keys => $value) {
            //insert2mysql ($batchnumber,$data->data_type,$data->ExecTime,$value);
            print_r($value);
            // echo "<br>";

            if ($value->is_payment =='รอชำระเงิน') {
                @$importdata['total']+= $value->total;
                //@$importdata['']+= $value->cn_type;
                @$itemline[$keys][extract_channel($value->channel_name,"ship",'costsusp').'.606004.06 DR - Discount Expense(ค่าขนส่ง/สินค้า) -> ']=round(($value->shipping-abs($value->discount))/107*100,4);
                @$itemline[$keys]['CR - AR Trade Others - Shipping -> '.getCtlAccount($value->pay_by,$value->shipping_by)]+= $value->total;
                @$importdata['CR']['AR Trade Others - Shipping -> '.getCtlAccount($value->pay_by,$value->shipping_by)]+= $value->total;
                @$importdata['DR']['Out Put Tax -> 49.215209']+=$value->vat;
                @$importdata['DR'][extract_channel($value->channel_name,"ship",'costsusp').'.606004.06 DR - Discount Expense(ค่าขนส่ง/สินค้า) -> ']+=round(($value->shipping-abs($value->discount))/107*100,4);
                @$itemline[$keys]['Total']=$value->total;
                @$itemline[$keys]['DR - vat>']=$value->vat;
                @$itemline[$keys]['is_payment']=$value->is_payment;

                foreach ($value->item as $items => $num) {
                    $ProductGroupID=$num->ProductGroupID;
                    
                    @$itemline[$keys][$ProductGroupID]['CR - COG (บัญชีพัก) -> '.extract_channel($value->channel_name,$num->barcode,'costsusp').getCtlAccCost($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                    @$itemline[$keys][$ProductGroupID]['DR - Sale (บัญชีพัก) -> '.extract_channel($value->channel_name,$num->barcode,'salesusp').getCtlAccIncome($ProductGroupID)]+=round(($num->PricePerUnit*$num->QTY)/107*100,2); 
                    @$itemline[$keys][$ProductGroupID]['DR - FG-Goods in Transit 2C -> 49.118403.98']+=$num->Item_cost*$num->QTY;
                  
                    @$importdata['CR']['COG (บัญชีพัก) -> '.extract_channel($value->channel_name,$num->barcode,'costsusp').getCtlAccCost($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                    @$importdata['DR']['Sale (บัญชีพัก) -> '.extract_channel($value->channel_name,$num->barcode,'salesusp').getCtlAccIncome($ProductGroupID)]+=round(($num->PricePerUnit*$num->QTY)/107*100,2); 
                    @$importdata['DR']['FG-Goods in Transit 2C -> 49.118403.98']+=$num->Item_cost*$num->QTY;
                    
                    
                //     $ProductGroupID=$num->ProductGroupID;
                //     $groupprice=$num->PricePerUnit*$num->QTY;
                //     $groupcost=$num->Item_cost*$num->QTY;
                // //     //echo "\n-$ProductGroupID-".$groupprice."--";
                //     @$itemline[$ProductGroupID]['price']+=$groupprice;
                //     @$itemline[$ProductGroupID]['cost']+=$groupcost;
                //     // $itemline[$ProductGroupID]+=array('VNEDBT'=>$batchnumber,
                //     //                                     // 'VNEDLN'=>$jj*1000,
                //     //                                     // 'VNJELN'=>$jj*1000,
                //     //                                     'VNEDDT'=>calc2julian($value->inv_date),
                //     //                                     'VNDGJ'=>calc2julian($value->inv_date),
                //     //                                     'VNUPMJ'=>calc2julian($value->inv_date),
                //     //                                     'VNDICJ'=>calc2julian($value->inv_date),
                //     //                                     'VNDSVJ'=>calc2julian($value->inv_date),
                //     //                                     'VNUPMT'=>splitdatetime($data->ExecTime),
                //     //                                     //'VNEXR'=>$value->tax_name,
                //     //                                     'VNEDTN'=>$keys,
                //     //                                     'VNDOC'=>$keys,
                //     //                                     'VNEXA'=>$value->code,
                //     //                                     'VNDCT'=>$doctype
                //     //                                             );
                
                    }  
                    

                }
                elseif ($value->is_payment =='ชำระเงินแล้ว') {
                    @$importdata['total']+= $value->total;
                    //@$importdata['']+= $value->cn_type;
                    @$itemline[$keys][extract_channel($value->channel_name,"ship",'costsusp').'.606004.06 DR - Discount Expense(ค่าขนส่ง/สินค้า) -> ']=round(($value->shipping-abs($value->discount))/107*100,4);
                    //@$itemline[$keys]['CR - AR Trade Others - Shipping -> '.getCtlAccount($value->pay_by,$value->shipping_by)]+= $value->total;
                    //@$importdata['CR']['AR Trade Others - Shipping -> '.getCtlAccount($value->pay_by,$value->shipping_by)]+= $value->total;
                    @$importdata['DR']['Out Put Tax -> 49.215209']+=$value->vat;
                    @$importdata['DR'][extract_channel($value->channel_name,"ship",'costsusp').'.606004.06 DR - Discount Expense(ค่าขนส่ง/สินค้า) -> ']+=round(($value->shipping-abs($value->discount))/107*100,4);
                    @$itemline[$keys]['Total']=$value->total;
                    @$itemline[$keys]['cn_type']=$value->cn_type;
                    @$itemline[$keys]['DR - vat>']=$value->vat;
                    @$itemline[$keys]['is_payment']=$value->is_payment;
                    foreach ($value->item as $items => $num) {
                        $ProductGroupID=$num->ProductGroupID;
                        @$itemline[$keys][$ProductGroupID]['CR - COG Sold-> '.extract_channel($value->channel_name,$num->barcode,'costsusp').getCtlAccCostEOD($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                        @$itemline[$keys][$ProductGroupID]['DR - Sale Return-> '.extract_channel($value->channel_name,$num->barcode,'salesusp').getCtlAccIncomeCN($ProductGroupID)]+=round(($num->PricePerUnit*$num->QTY)/107*100,2); 
                        
                        @$itemline[$keys][$ProductGroupID]['CR - Accu Expense -> 49.215201.099']= $value->total;
                        @$importdata['CR']['COG Sold-> '.extract_channel($value->channel_name,$num->barcode,'costsusp').getCtlAccCostEOD($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                        @$importdata['DR']['Sale Return-> '.extract_channel($value->channel_name,$num->barcode,'salesusp').getCtlAccIncomeCN($ProductGroupID)]+=round(($num->PricePerUnit*$num->QTY)/107*100,2); 
                      
                        @$importdata['CR']['Accu Expense -> 49.215201.099']+= $value->total;
                        if ($value->cn_type=='คงเหลือ'){
                            @$itemline[$keys][$ProductGroupID]['DR - FG-Goods -> '.getCtlAccInventory($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                            @$importdata['DR']['FG-Goods -> '.getCtlAccInventory($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                        }else{
                            @$itemline[$keys][$ProductGroupID]['DR - FG-Damage stock -> '.getCtlAccInventory($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                            @$importdata['DR']['FG-Damage stock  -> '.getCtlAccInventory($ProductGroupID)]+= $num->Item_cost*$num->QTY;
                        }
                    }
                }
        }

            //@$importdata['CR']['Out Put TAX -> 49.215209']=round($importdata['pay_amount']- $tempCRSO - @$importdata['CR']['Logistic Inc. - Others -> 49.405200.999'] - $importdata['CR']['Discount Expense(ค่าขนส่ง/สินค้า) -> 49.606004.06'],2);
        print_r($importdata);
        echo "<br>@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@<br>"; 
        print_r($itemline);         
        echo "<br><pre>";
        //print_r($itemline);
        //print_r($importdata);
        echo "<br>";
    }


    
}

function extract_channel($channel,$itemcode,$type) {
    //$rawretrive = $type.$channel."<>".$itemcode;
    if ($type=='salesusp'|| $type =='costsusp') {
        $rootA= "049110";
        $rootABA= "034";
        $rootABB= "035";
        $rootB= "049111";
        $rootBBA = "036";
        $rootBBB = "037";
        $rootBBC = "042";
        $rootBBD = "043";
        $rootBBE = "044";
        $rootC= "049045";
        $rootCBA = "036";
        $rootCBB = "037";
        
    }elseif ($type=='xxxx'){

    }

    $rootV ="Error";
    if (preg_match('/^10/i', $itemcode)) {
        $rootV = "036";
    }elseif (preg_match('/^20/i', $itemcode)){
        $rootV = "037";
    }elseif (preg_match('/^ship/i', $itemcode)){
        $rootV = "000";
    }
    else {
        $rootV = "Error_getBU".$itemcode;
    }   
    if (!empty($channel)) {
        if (preg_match('/inbound/i', $channel)){
            return $rootA.$rootABA.$rootV;
        }elseif (preg_match('/call/i', $channel)){
            return $rootA.$rootABA.$rootV;    
        }elseif (preg_match('/outbound/i', $channel)) {
            return $rootA.$rootABB.$rootV;
        }elseif (preg_match('/line/i', $channel)) {
            return $rootB.$rootBBA.$rootV;
        }elseif (preg_match('/facebook/i', $channel)) {
            return $rootB.$rootBBB.$rootV;
        }elseif (preg_match('/lazada/i', $channel)) {
            return $rootB.$rootBBC.$rootV;
        }elseif (preg_match('/shopee/i', $channel)) {
            return $rootB.$rootBBD.$rootV;
        }elseif (preg_match('/jd/i', $channel)) {
            return $rootB.$rootBBE.$rootV;
        }elseif (preg_match('/website/i', $channel)) {
            return $rootC.$rootV;
        }
    }else{
        return "Error";
    }

}

///ลูกหนี้การค้า AR  49.113240.135
function insert_AR($itemgroup,$VNAG) {
        $arr_ty['AR']=[];
        $arr_ty['AR']['VNAA']=0;
        $arr_ty['AR']['VNANI']='49.113240.135';
        $arr_ty['AR']['VNEXR1']='';
        $arr_ty['AR']['VNTXA1']='';
        $arr_ty['AR']['VNSTAM']=0;
        $arr_ty['AR']['VNAG']=$VNAG;
        $arr_ty['AR']['VNEDLN']=1000;
        $arr_ty['AR']['VNJELN']=1000;
        return $arr_ty;
}
//// ต้นทุน COST 49.520600.01
function insert_COST($itemgroup,$VNAG) {
        $arr_ty['COST']=[];
        $arr_ty['COST']['VNAA']=0;
        $arr_ty['COST']['VNANI']='49.520600.01';
        $arr_ty['COST']['VNEXR1']='';
        $arr_ty['COST']['VNTXA1']='';
        $arr_ty['COST']['VNSTAM']=0;
        $arr_ty['COST']['VNAG']=$VNAG;
        $arr_ty['COST']['VNEDLN']=2000;
        $arr_ty['COST']['VNJELN']=2000;
        return $arr_ty;
}
/// รายได้  Income 49.461100.01
function Insert_Income($itemgroup,$VNAG) {
        $arr_ty['Income']=[];
        $arr_ty['Income']['VNAA']= 0-$VNAG;
        $arr_ty['Income']['VNANI']='49.461100.01';
        $arr_ty['Income']['VNEXR1']='V';
        $arr_ty['Income']['VNTXA1']='OV7';
        $arr_ty['Income']['VNSTAM']=0;
        $arr_ty['Income']['VNAG']=0-$VNAG;
        $arr_ty['Income']['VNEDLN']=3000;
        $arr_ty['Income']['VNJELN']=3000;
        
        return $arr_ty;
}
//// สินค้าคงเหลือ Inventory 49.118403.01
function Insert_Inventory($itemgroup,$VNAG) {
        $arr_ty['Inventory']=[];
        $arr_ty['Inventory']['VNAA']=0;
        $arr_ty['Inventory']['VNANI']='49.118403.01';
        $arr_ty['Inventory']['VNEXR1']='';
        $arr_ty['Inventory']['VNTXA1']='';
        $arr_ty['Inventory']['VNSTAM']=0;
        $arr_ty['Inventory']['VNAG']=0-$VNAG;
        $arr_ty['Inventory']['VNEDLN']=4000;
        $arr_ty['Inventory']['VNJELN']=4000;
        
        
        return $arr_ty;
}
function insert_shipping($itemgroup,$VNAG) {
        $arr_ty['shipping']=[];
        $arr_ty['shipping']['VNAA']=$VNAG;
        $arr_ty['shipping']['VNANI']='Account CODE 1236789';
        $arr_ty['shipping']['VNEXR1']='';
        $arr_ty['shipping']['VNTXA1']='';
        $arr_ty['shipping']['VNSTAM']=0;
        $arr_ty['shipping']['VNAG']=$VNAG;
    
        return $arr_ty;
}

function getCtlAccount($pays_by,$shippings_by = null){
     $pay_by = strtoupper(preg_replace('/\s+|&/', '', $pays_by));
	if($pay_by == 'เก็บเงินปลายทาง' && !empty($shippings_by)){
        
		$shipping_by = strtoupper(preg_replace('/\s+|&/', '', $shippings_by));
		// // if($tran_str == 'KERRY' || $tran_str == 'DHL'){
		// // 	$shipping_by = trans('transport.'.$tran_str);
		// // }
		switch ($shipping_by) {
            case 'KERRY':
                $code = "49.113240.051 KERRY";
            break;
			case 'DHL':
			    $code = "49.113240.052 DHL";
			break;
			case 'BESTEXPRESS':
			    $code = "49.113240.053 BESTEXPRESS";
			break;
			case 'JTEXPRESS':
			    $code = "49.113240.054 JTEXPRESS";
			break;
			case 'SCGEXPRESS':
			    $code = "49.113240.055 SCGEXPRESS";
			break;
			case 'DELIVEREE':
			    $code = "49.113240.056 DELIVEREE";
			break;
			default:
			    $code = "error_shipcode".$shipping_by;
			break;
        }
        //$code = "49.113260.06";
	}
    elseif($pay_by == 'บัตรเครดิต' || $pay_by == 'COUNTERSERVICE'){
        $code = "49.113240.131 2c2p";
    }
    elseif($pay_by == 'SHOPEE'){
		$code = "49.113240.132 SHOPEE";
    }
    elseif($pay_by == 'LAZADA'){
		$code = "49.113240.133 LAZADA";
    }
    elseif($pay_by == 'JDCENTRAL'){
		$code = "49.113240.134 JDCENTRAL";
    }
    elseif($pay_by == 'โอนเงิน'){
		$code = "49.113240.135 โอนเงิน";
    }
    elseif($pay_by == 'ให้เป็นเครดิต'){
		$code = "49.113260.06 ให้เป็นเครดิต";
	}
    else{
		$code = "Error_payby-".$pay_by."-";
	}
    return $code;
    
}


function getCtlAccInventory($PgroupID){
    $groupID = strtoupper(preg_replace('/\s+|&/', '', $PgroupID));
   if(!empty($groupID)){

       switch ($groupID) {
           case '9': //FG-Health&SupplementFo
           $code = "49.118403.01 FG-Health&SupplementFo ";
           break;
           case '10': //FG-Beauty
           $code = "49.118403.02 FG-Beauty ";
           break;
           case '11': //FG-Home&Living
           $code = "49.118403.03 FG-Home&Living";
           break;
           case '12': //FG-Kitchen
           $code = "49.118403.04 FG-Kitchen";
           break;
           case '13': //FG-Fashion
           $code = "49.118403.05 FG-Fashion";
           break;
           case '14': //FG-Jewelry&Accessories
           $code = "49.118403.06 FG-Jewelry&Accessories";
           break;
           case '26': //FG-IT&Gadget
           $code = "49.118403.07 FG-IT&Gadget";
           break;
           case '24': //FG-สินค้า OTOP
           $code = "49.118403.08 FG-สินค้า OTOP";
           break;
           case '27': // FG-Set
           $code = "49.118403.09 FG-Set";
           break;
           case '28': // FG-Other
           $code = "49.118403.99 FG-Other";
           break;
           case '15': //FG-Tour
           $code = "49.118403.21 FG-Tour";
           break;
           default:
           $code = "Error_grp".$groupID;
           break;
       }
   
    return $code;
    }
}
function getCtlAccCost($PgroupID){
    $groupID = strtoupper(preg_replace('/\s+|&/', '', $PgroupID));
   if(!empty($groupID)){

    switch ($groupID) {
        case '9': //FG-Health&SupplementFo
        $code = ".520700.01 FG-Health&SupplementFo";
        break;
        case '10': //FG-Beauty
        $code = ".520700.02 FG-Beauty ";
        break;
        case '11': //FG-Home&Living
        $code = ".520700.03 FG-Home&Living ";
        break;
        case '12': //FG-Kitchen
        $code = ".520700.04 FG-Kitchen ";
        break;
        case '13': //FG-Fashion
        $code = ".520700.05 FG-Fashion ";
        break;
        case '14': //FG-Jewelry&Accessories
        $code = ".520700.06 FG-Jewelry&Accessories";
        break;
        case '26': //FG-IT&Gadget
        $code = ".520700.07 FG-IT&Gadget ";
        break;
        case '24': //FG-สินค้า OTOP
        $code = ".520700.08 FG-สินค้า OTOP ";
        break;
        case '27': // FG-Set
        $code = ".520700.09 FG-Set ";
        break;
        case '28': // FG-Other
        $code = ".520700.21 FG-Other ";
        break;
        case '15': //FG-Tour
        $code = ".520700.21 FG-Tour ";
        break;
        case '25': //FG-Packaging
        $code = ".520700.51 FG-Packaging ";
        break;
        default:
        $code = "Error_grpCost".$groupID;
        break;
    }

    return $code;
    }
      
}

function getCtlAccCostEOD($PgroupID){
    $groupID = strtoupper(preg_replace('/\s+|&/', '', $PgroupID));
   if(!empty($groupID)){
    switch ($groupID) {
        case '9': //FG-Health&SupplementFo
        $code = ".520600.01 FG-Health&SupplementFo ";
        break;
        case '10': //FG-Beauty
        $code = ".520600.02 FG-Beauty ";
        break;
        case '11': //FG-Home&Living
        $code = ".520600.03 FG-Home&Living ";
        break;
        case '12': //FG-Kitchen
        $code = ".520600.04 FG-Kitchen ";
        break;
        case '13': //FG-Fashion
        $code = ".520600.05 FG-Fashion ";
        break;
        case '14': //FG-Jewelry&Accessories
        $code = ".520600.06 FG-Jewelry&Accessories";
        break;
        case '26': //FG-IT&Gadget
        $code = ".520600.07 FG-IT&Gadget ";
        break;
        case '24': //FG-สินค้า OTOP
        $code = ".520600.08 FG-สินค้า OTOP ";
        break;
        case '27': // FG-Set
        $code = ".520600.09 FG-Set ";
        break;
        case '28': // FG-Other
        $code = ".520600.21 FG-Other ";
        break;
        case '15': //FG-Tour
        $code = ".520600.21 FG-Tour ";
        break;
        case '25': //FG-Packaging
        $code = ".520600.51 FG-Packaging ";
        break;
        default:
        $code = "Notfound".$groupID;
        break;
        }

    return $code;
    }
      
}

function getCtlAccIncome($PgroupID){
    $groupID = strtoupper(preg_replace('/\s+|&/', '', $PgroupID));
   if(!empty($groupID)){

       switch ($groupID) {
           case '9': //FG-Health&SupplementFo
           $code = ".461300.01 FG-Health&SupplementFo";
           break;
           case '10': //FG-Beauty
           $code = ".461300.02 FG-Beauty";
           break;
           case '11': //FG-Home&Living
           $code = ".461300.03 FG-Home&Living ";
           break;
           case '12': //FG-Kitchen
           $code = ".461300.04 FG-Kitchen ";
           break;
           case '13': //FG-Fashion
           $code = ".461300.05 FG-Fashion ";
           break;
           case '14': //FG-Jewelry&Accessories
           $code = ".461300.06 FG-Jewelry&Accessories";
           break;
           case '26': //FG-IT&Gadget
           $code = ".461300.07 FG-IT&Gadget ";
           break; 
           case '24': //FG-สินค้า OTOP
           $code = ".461300.08 FG-สินค้า OTOP ";
           break;
           case '27': //FG-สินค้า SET
           $code = ".461300.09 FG-สินค้า SET ";
           break;
           case '28': //FG-สินค้า Other
           $code = ".461300.99 FG-สินค้า Other ";
           break;
           default:
           $code = "Error_grpIncome".$groupID;
           break;
       }
   
   return $code;
 }
}
function getCtlAccIncomeEOD($PgroupID){
    $groupID = strtoupper(preg_replace('/\s+|&/', '', $PgroupID));
   if(!empty($groupID)){

       switch ($groupID) {
           case '9': //FG-Health&SupplementFo
           $code = ".461100.01 FG-Health&SupplementFo";
           break;
           case '10': //FG-Beauty
           $code = ".461100.02 FG-Beauty";
           break;
           case '11': //FG-Home&Living
           $code = ".461100.03 FG-Home&Living ";
           break;
           case '12': //FG-Kitchen
           $code = ".461100.04 FG-Kitchen ";
           break;
           case '13': //FG-Fashion
           $code = ".461100.05 FG-Fashion ";
           break;
           case '14': //FG-Jewelry&Accessories
           $code = ".461100.06 FG-Jewelry&Accessories";
           break;
           case '26': //FG-IT&Gadget
           $code = ".461100.07 FG-IT&Gadget ";
           break; 
           case '24': //FG-สินค้า OTOP
           $code = ".461100.08 FG-สินค้า OTOP ";
           break;
           case '27': //FG-สินค้า SET
           $code = ".461100.09 FG-สินค้า SET ";
           break;
           case '28': //FG-สินค้า Other
           $code = ".461100.99 FG-สินค้า Other ";
           break;
           default:
           $code = "Error_IncomEOD".$groupID;
           break;
       }
   
   return $code;
 }
}
function getCtlAccIncomeCN($PgroupID){
    $groupID = strtoupper(preg_replace('/\s+|&/', '', $PgroupID));
   if(!empty($groupID)){

       switch ($groupID) {
           case '9': //FG-Health&SupplementFo
           $code = ".461200.01 FG-Health&SupplementFo";
           break;
           case '10': //FG-Beauty
           $code = ".461200.02 FG-Beauty";
           break;
           case '11': //FG-Home&Living
           $code = ".461200.03 FG-Home&Living ";
           break;
           case '12': //FG-Kitchen
           $code = ".461200.04 FG-Kitchen ";
           break;
           case '13': //FG-Fashion
           $code = ".461200.05 FG-Fashion ";
           break;
           case '14': //FG-Jewelry&Accessories
           $code = ".461200.06 FG-Jewelry&Accessories";
           break;
           case '26': //FG-IT&Gadget
           $code = ".461200.07 FG-IT&Gadget ";
           break; 
           case '24': //FG-สินค้า OTOP
           $code = ".461200.08 FG-สินค้า OTOP ";
           break;
           case '27': //FG-สินค้า SET
           $code = ".461200.09 FG-สินค้า SET ";
           break;
           case '28': //FG-สินค้า Other
           $code = ".461200.99 FG-สินค้า Other ";
           break;
           default:
           $code = "Error_grpIncome".$groupID;
           break;
       }
   
   return $code;
 }
}
function splitdatetime($input_line){
    $splitdate = preg_split('/\s|:|-/', $input_line);
    return $splitdate[3].$splitdate[4].$splitdate[5];
}
   function insert2mysql ($seqnum,$type,$exet,$record){
        global $conn;
        $item_detail = json_encode($record->item,JSON_UNESCAPED_UNICODE);
       // $payment_date = empty($record->payment_date) ? NULL : $record->payment_date ;
       
        //selectDataFromMySQL
        if ($type=='arInvoice' || $type=='arReceive') {
            if ($type=="arInvoice") {
                $table="TaxInvoice_detail";
            }elseif($type=="arReceive") {
                $table="Receive_detail";
            }   
            $sql = "insert into ".$table." (BatchNumber,
                                                data_type,
                                                exec_time,
                                                lastupdated,
                                                so_number,
                                                invoice_number,
                                                service_number,
                                                po_date,
                                                discount,
                                                discountdetail,
                                                vat,
                                                shipping_cost,
                                                pay_amount,
                                                pay_by,
                                                payment_status,
                                                payment_date,
                                                shipping_by,
                                                shipping_date,
                                                shipping_package,
                                                service_code,
                                                remark,
                                                sell_by,
                                                postatus,
                                                tax_id,
                                                tax_name,
                                                billing_address,
                                                billing_province,
                                                billing_district,
                                                billing_subdistrict,
                                                billing_zipcode,
                                                customer_id,
                                                twoc2p_status,
                                                media_slot,
                                                items)
                                        VALUES ('$seqnum',
                                                '$type',
                                                '$exet',
                                                '$record->updated_at',
                                                '$record->code',
                                                '$record->inv_code',
                                                '$record->invoice_number',
                                                '$record->po_date',
                                                '$record->discount',
                                                '$record->discountdetail',
                                                '$record->vat',
                                                '$record->shipping_cost',
                                                '$record->pay_amount',
                                                '$record->pay_by',
                                                '$record->payment_status',
                                                '$record->payment_date',
                                                '$record->shipping_by',
                                                '$record->shipping_date',
                                                '$record->shipping_package',
                                                '$record->service_code',
                                                '$record->remark',
                                                '$record->sell_by',
                                                '$record->postatus',
                                                '$record->tax_id',
                                                '$record->tax_name',
                                                '$record->billing_address',
                                                '$record->billing_province',
                                                '$record->billing_district',
                                                '$record->billing_subdistrict',
                                                '$record->billing_zipcode',
                                                '$record->customer_id',
                                                '$record->twoc2p_status',
                                                '$record->media_slot',
                                                '$item_detail ') ";

                    //echo "<br>".$sql."<br>";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        }elseif($type=="arCreditNote"){
            $table="CrediteNote_detail";
             $sql = "insert into ".$table ."(BatchNumber,
                                                    data_type,
                                                    exec_time,
                                                    lastupdated,
                                                    cn_number,
                                                    invoice_number,
                                                    cn_type,
                                                    cn_status,
                                                    subtotal,
                                                    vat,
                                                    total,
                                                    customer_id,
                                                    remark,
                                                    items)
                                           VALUES ('$seqnum',
                                                    '$type',
                                                    '$exet',
                                                    '$record->lastupdated',
                                                    '$record->cn_number',
                                                    '$record->invoice_number',
                                                    '$record->cn_type',
                                                    '$record->cn_status',
                                                    '$record->sub',
                                                    '$record->vat',
                                                    '$record->total',
                                                    '$record->customer_id',
                                                    '$record->remark',
                                                     '$item_detail')";
                      //echo "<br>".$sql."<br>";
                      if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }                              

        }
      
        
        
        
    }

    function update_item2mysql ($type,$items,$service_id){
        global $conn;
        $update_sql = "UPDATE Receive_detail  SET items = JSON_INSERT(items ,$items ) WHERE service_number = $service_id";
        echo $update_sql."<br>";           
    }

    function insert2oracle ($record){
        global $oraconn;
        //selectDataFromMySQL
        $sql = "insert into 'F0911_Z1' () 
                VALUES ()";
        $output = $conn->query($sql);
        // if ($output ->num_rows > 0) {
        //     var_dump($output);
        // } else {
        //     echo "No results";
        // }
        
    }

    function calc2julian ($day){
        $strdate = preg_split('/-|:|\s+/', $day);
        $c = substr($strdate[0],0,2)-19;
        $YY = substr($strdate[0],2,2);
        $DDD = date('z', mktime(0, 0, 0, $strdate[1], $strdate[2], $strdate[0]))+1;
        $Julianft = $c.$YY.sprintf("%'.03d",$DDD);
        return $Julianft;
    }
    function mapfield(){
        $prepare_data=[];
        $prepare_data['VNEDUS']='HPS2JDE';
        $prepare_data['VNEDTY']='';
        $prepare_data['VNEDSQ']=0;    
        $prepare_data['VNEDCT']='';
        $prepare_data['VNEDTS']='';
        $prepare_data['VNEDFT']='';
        $prepare_data['VNEDER']='B';
        $prepare_data['VNEDDL']=0;
        $prepare_data['VNEDSP']='0';
        $prepare_data['VNEDTC']='A';
        $prepare_data['VNEDTR']='J';
        $prepare_data['VNEDGL']='';
        $prepare_data['VNEDAN']=0;
        $prepare_data['VNKCO']='00049';
        $prepare_data['VNEXTL']='';
        $prepare_data['VNPOST']='';
        $prepare_data['VNICU']='';
        $prepare_data['VNICUT']='';
        $prepare_data['VNDSYJ']='';
        $prepare_data['VNTICU']=0;
        $prepare_data['VNCO']='';
        $prepare_data['VNMCU']='';
        $prepare_data['VNOBJ']='';
        $prepare_data['VNSUB']='';
        $prepare_data['VNAM']='2';
        $prepare_data['VNAID']='';
        $prepare_data['VNSBL']='';
        $prepare_data['VNSBLT']='';
        $prepare_data['VNLT']='AA';
        $prepare_data['VNPN']=0;
        $prepare_data['VNAN8']=0;
        $prepare_data['VNCTRY']=0;
        $prepare_data['VNFY']=0;
        $prepare_data['VNFQ']='';
        $prepare_data['VNCRCD']='THB';
        $prepare_data['VNCRR']=.0000000;
        $prepare_data['VNHCRR']=.0000000;
        $prepare_data['VNHDGJ']='';
        $prepare_data['VNU']=.00;
        $prepare_data['VNUM']='';
        $prepare_data['VNGLC']='';
        $prepare_data['VNRE']='';
        $prepare_data['VNR1']='';
        $prepare_data['VNR2']='';
        $prepare_data['VNR3']='';
        $prepare_data['VNSFX']='';
        $prepare_data['VNODOC']=0;
        $prepare_data['VNODCT']='';
        $prepare_data['VNOSFX']='';
        $prepare_data['VNPKCO']='';
        $prepare_data['VNOKCO']='';
        $prepare_data['VNPDCT']='';
        $prepare_data['VNCN']='';
        $prepare_data['VNDKJ']='';
        $prepare_data['VNDKC']='';
        $prepare_data['VNASID']='';
        $prepare_data['VNBRE']='';
        $prepare_data['VNRCND']='';
        $prepare_data['VNSUMM']='';
        $prepare_data['VNPRGE']='';
        $prepare_data['VNTNN']='';
        $prepare_data['VNALT1']='';
        $prepare_data['VNALT2']='';
        $prepare_data['VNALT3']='';
        $prepare_data['VNALT4']='';
        $prepare_data['VNALT5']='V';
        $prepare_data['VNALT6']='';
        $prepare_data['VNALT7']='';
        $prepare_data['VNALT8']='';
        $prepare_data['VNALT9']='';
        $prepare_data['VNALT0']='';
        $prepare_data['VNALTT']='';
        $prepare_data['VNALTU']='';
        $prepare_data['VNALTV']='0';
        $prepare_data['VNALTW']='';
        $prepare_data['VNALTX']='';
        $prepare_data['VNALTZ']='';
        $prepare_data['VNDLNA']='';
        $prepare_data['VNCFF1']='';
        $prepare_data['VNCFF2']='';
        $prepare_data['VNASM']='';
        $prepare_data['VNBC']='';
        $prepare_data['VNVINV']='';
        $prepare_data['VNIVD']='0';
        $prepare_data['VNWR01']='';
        $prepare_data['VNPO']='';
        $prepare_data['VNPSFX']='';
        $prepare_data['VNDCTO']='';
        $prepare_data['VNLNID']=0;
        $prepare_data['VNWY']=0;
        $prepare_data['VNWN']=0;
        $prepare_data['VNFNLP']='';
        $prepare_data['VNOPSQ']=100;
        $prepare_data['VNJBCD']='';
        $prepare_data['VNJBST']='';
        $prepare_data['VNHMCU']='';
        $prepare_data['VNDOI']=0;
        $prepare_data['VNALID']=0;
        $prepare_data['VNALTY']=0;
        
        $prepare_data['VNTORG']='HPS';
        $prepare_data['VNREG#']=0;//VNREG#
        $prepare_data['VNPYID']=0;
        $prepare_data['VNUSER']='HPSBatch';
        $prepare_data['VNPID']='HPS0911Z1  ';
        $prepare_data['VNJOBN']='Ws01';
        $prepare_data['VNCRRM']='D';
        $prepare_data['VNACR']=0;
        $prepare_data['VNDGM']=0;
        $prepare_data['VNDGD']=0;
        $prepare_data['VNDGY']=0;
        $prepare_data['VNDG#']=0; //VNDG#
        $prepare_data['VNDICM']=0;
        $prepare_data['VNDICD']=0;
        $prepare_data['VNDICY']=0;
        $prepare_data['VNDIC#']=0; //VNDIC#
        $prepare_data['VNDSYM']=0;
        $prepare_data['VNDSYD']=0;
        $prepare_data['VNDSYY']=0;
        $prepare_data['VNDSY#']=0;  //VNDSY#
        $prepare_data['VNDKM']=0;
        $prepare_data['VNDKD']=0;
        $prepare_data['VNDKY']=0;
        $prepare_data['VNDK#']=0; //VNDK#
        $prepare_data['VNDSVM']=0;
        $prepare_data['VNDSVD']=0;
        $prepare_data['VNDSVY']=0;
        $prepare_data['VNDSV#']=0; //VNDSV#
        $prepare_data['VNHDGM']=0;
        $prepare_data['VNHDGD']=0;
        $prepare_data['VNHDGY']=0;
        $prepare_data['VNHDG#']=0; //VNHDG#
        $prepare_data['VNDKCM']=0;
        $prepare_data['VNDKCD']=0;
        $prepare_data['VNDKCY']=0;
        $prepare_data['VNDKC#']=0; //VNDKC#
        $prepare_data['VNIVDM']=0;
        $prepare_data['VNIVDD']=0;
        $prepare_data['VNIVDY']=0;
        $prepare_data['VNIVD#']=0; //VNIVD#
        $prepare_data['VNABR1']='';
        $prepare_data['VNABR2']='';
        $prepare_data['VNABR3']='';
        $prepare_data['VNABR4']='';
        $prepare_data['VNABT1']='';
        $prepare_data['VNABT2']='';
        $prepare_data['VNABT3']='';
        $prepare_data['VNABT4']='';
        $prepare_data['VNITM']=0;
        $prepare_data['VNPM01']=0;
        $prepare_data['VNPM02']=0;
        $prepare_data['VNPM03']=0;
        $prepare_data['VNPM04']=0;
        $prepare_data['VNPM05']=0;
        $prepare_data['VNPM06']=0;
        $prepare_data['VNPM07']=0;
        $prepare_data['VNPM08']=0;
        $prepare_data['VNPM09']=0;
        $prepare_data['VNPM10']=0;
        $prepare_data['VNBCRC']='THB';

        $prepare_data['VNTXITM']=0;
        $prepare_data['VNACTB']='';
       
        $prepare_data['VNCTAM']=0;
        
        $prepare_data['VNAGF']=0;
        $prepare_data['VNTKTX']=0;
        $prepare_data['VNDLNID']=0;
        $prepare_data['VNCKNU']=0;
        $prepare_data['VNBUPC']=0;
        $prepare_data['VNAHBU']='';
        $prepare_data['VNEPGC']='';
        $prepare_data['VNJPGC']='';
        $prepare_data['VNRC5']=0;
        $prepare_data['VNSFXE']=0;
        $prepare_data['VNOFM']=0;
        
        return  $prepare_data;
    }
    
$conn->close();
oci_close($oraconn);



  //$importdata+=$itemline;                                 
            //$itemline[$keys][$ProductGroupID]+=insert_shipping($value->pay_amount); 
    // foreach ($data->objects as $keys => $value) {
    //     $itemline=[];
    //     $ProductGroupID="";
    //     $jj = 0;
    //     foreach ($value->item as $items => $num) {
    //         if (!empty($items)){
    //              $ProductGroupID=$num->ProductGroupID;
    //              $groupprice=$num->PricePerUnit*$num->QTY;
    //              @$itemline[$keys][$ProductGroupID]['price']+=$groupprice;
    //             $jj++;
    //          }
            
    //          //$itemline[$keys][$num->ProductGroupID]+=mapfield();
    //         $itemline[$keys][$ProductGroupID]+=array('VNEDBT'=>$batchnumber,
    //                                                   'VNEDLN'=>$jj*1000,
    //                                                   'VNJELN'=>$jj*1000,
    //                                                   'VNEDDT'=>calc2julian($value->inv_date),
    //                                                   'VNDGJ'=>calc2julian($value->inv_date),
    //                                                   'VNUPMJ'=>calc2julian($value->inv_date),
    //                                                   'VNDICJ'=>calc2julian($value->inv_date),
    //                                                   'VNDSVJ'=>calc2julian($value->inv_date),
    //                                                   'VNUPMT'=>splitdatetime($data->ExecTime),
    //                                                   'VNEXR'=>$value->tax_name,
    //                                                   'VNEDTN'=>$keys,
    //                                                   'VNDOC'=>$keys,
    //                                                   'VNEXA'=>$value->code,
    //                                                   'VNDCT'=>$doctype
    //                                                 );
    //         $itemline[$keys][$ProductGroupID]+=insert_AR($value->pay_amount);      
    //         $itemline[$keys][$ProductGroupID]+=insert_COST($value->cost_amount); 
    //         $itemline[$keys][$ProductGroupID]+=Insert_Income($value->pay_amount); 
    //         $itemline[$keys][$ProductGroupID]+=Insert_Inventory($value->cost_amount);                                  
    //         //$itemline[$keys][$ProductGroupID]+=insert_shipping($value->pay_amount); 
        // }
        // $importdata+=$itemline;      
        // echo "@$keys@".$value->inv_code."--";
        // echo $jj."<br>";
        
       
        
    //}

 /*
    $data = json_decode($json);
    //print_r($data);
    //echo "Recieved ".$data->Total_INV." Docs at ".$data->ExecTime;
    $date = new DateTime($data->ExecTime);
    $batchnumber="HPS".$date->getTimestamp();
    //echo $batchnumber;
    $prepare_data=[];
    foreach ($data->objects as $items => $value) {
        $prepare_data['VNEDUS']='HPS2JDE';
        $prepare_data['VNEDTY']='';
        $prepare_data['VNEDSQ']=0;
        $prepare_data['VNEDTN']=$value->inv_code; // inv number 
        $prepare_data['VNEDCT']='';
        $prepare_data['VNEDLN']=$value->item->id *1000; //// ******
        $prepare_data['VNEDTS']='';
        $prepare_data['VNEDFT']='';
        $prepare_data['VNEDDT']=calc2julian($value->inv_date);
        $prepare_data['VNEDER']='B';
        $prepare_data['VNEDDL']=0;
        $prepare_data['VNEDSP']='0';
        $prepare_data['VNEDTC']='A';
        $prepare_data['VNEDTR']='J';
        $prepare_data['VNEDBT']=$batchnumber;
        $prepare_data['VNEDGL']=0;
        $prepare_data['VNEDAN']=0;
        $prepare_data['VNKCO']='HPS';
        $prepare_data['VNDCT']=cir2jde1.doc_type;
        $prepare_data['VNDOC']=$items;
        $prepare_data['VNDGJ']=calc2julian($value->inv_date);
        $prepare_data['VNJELN']='0; หรือ jnum';
        $prepare_data['VNEXTL']='';
        $prepare_data['VNPOST']='';
        $prepare_data['VNICU']=$batchnumber;
        $prepare_data['VNICUT']='G';
        $prepare_data['VNDICJ']=0;
        $prepare_data['VNDSYJ']=0;
        $prepare_data['VNTICU']=0;
        $prepare_data['VNCO']='';
        $prepare_data['VNANI']=''; //Account Number
        $prepare_data['VNAM']='2';
        $prepare_data['VNAID']=0;
        $prepare_data['VNMCU']=cir2jde1.bu;
        $prepare_data['VNOBJ']=cir2jde1.glaccount_cd;
        $prepare_data['VNSUB']=cir2jde1.sub;
        $prepare_data['VNSBL']='';
        $prepare_data['VNSBLT']='';
        $prepare_data['VNLT']='AA';
        $prepare_data['VNPN']=0;
        $prepare_data['VNCTRY']=0;
        $prepare_data['VNFY']=0;
        $prepare_data['VNFQ']='';
        $prepare_data['VNCRCD']='THB';
        $prepare_data['VNCRR']=0;
        $prepare_data['VNHCRR']=0;
        $prepare_data['VNHDGJ']=0;
        $prepare_data['VNAA']= $value->pay_amount * 100;
        $prepare_data['VNU']=0;
        $prepare_data['VNUM']='';
        $prepare_data['VNGLC']='';
        $prepare_data['VNRE']='';
        $prepare_data['VNEXA']=cir2jde1.explanation;
        $prepare_data['VNEXR']=cir2jde1.doc_type || cir2jde1.trans_no;
        $prepare_data['VNR1']='';
        $prepare_data['VNR2']='';
        $prepare_data['VNR3']='';
        $prepare_data['VNSFX']='';
        $prepare_data['VNODOC']=0;
        $prepare_data['VNODCT']=0;
        $prepare_data['VNOSFX']='';
        $prepare_data['VNPKCO']=0;
        $prepare_data['VNOKCO']=0;
        $prepare_data['VNPDCT']='';
        $prepare_data['VNAN8']=0;
        $prepare_data['VNCN']='';
        $prepare_data['VNDKJ']=0;
        $prepare_data['VNDKC']=0;
        $prepare_data['VNASID']='';
        $prepare_data['VNBRE']=0;
        $prepare_data['VNRCND']=0;
        $prepare_data['VNSUMM']=0;
        $prepare_data['VNPRGE']=0;
        $prepare_data['VNTNN']=0;
        $prepare_data['VNALT1']=0;
        $prepare_data['VNALT2']=0;
        $prepare_data['VNALT3']=0;
        $prepare_data['VNALT4']=0;
        $prepare_data['VNALT5']='';
        $prepare_data['VNALT6']=0;
        $prepare_data['VNALT7']=0;
        $prepare_data['VNALT8']=0;
        $prepare_data['VNALT9']=0;
        $prepare_data['VNALT0']=0;
        $prepare_data['VNALTT']=0;
        $prepare_data['VNALTU']=0;
        $prepare_data['VNALTV']=0;
        $prepare_data['VNALTW']=0;
        $prepare_data['VNALTX']=0;
        $prepare_data['VNALTZ']=0;
        $prepare_data['VNDLNA']=0;
        $prepare_data['VNCFF1']=0;
        $prepare_data['VNCFF2']=0;
        $prepare_data['VNASM']=0;
        $prepare_data['VNBC']='';
        $prepare_data['VNVINV']=0;
        $prepare_data['VNIVD']=0;
        $prepare_data['VNWR01']='';
        $prepare_data['VNPO']='';
        $prepare_data['VNPSFX']='';
        $prepare_data['VNDCTO']='';
        $prepare_data['VNLNID']=0;
        $prepare_data['VNWY']=0;
        $prepare_data['VNWN']=0;
        $prepare_data['VNFNLP']=0;
        $prepare_data['VNOPSQ']=0;
        $prepare_data['VNJBCD']='';
        $prepare_data['VNJBST']='';
        $prepare_data['VNHMCU']='';
        $prepare_data['VNDOI']=0;
        $prepare_data['VNALID']=0;
        $prepare_data['VNALTY']=0;
        $prepare_data['VNDSVJ']=0;
        $prepare_data['VNTORG']='HPS';
        $prepare_data['VNREG3']=0;//VNREG#
        $prepare_data['VNPYID']=0;
        $prepare_data['VNUSER']='MS238112';
        $prepare_data['VNPID']='HPS';
        $prepare_data['VNJOBN']='HPS';
        $prepare_data['VNUPMJ']=calc2julian($value->inv_date);
        $prepare_data['VNUPMT']= date("Hisa",$data->ExecTime);
        $prepare_data['VNCRRM']='D';
        $prepare_data['VNACR']=0;
        $prepare_data['VNDGM']=0;
        $prepare_data['VNDGD']=0;
        $prepare_data['VNDGY']=0;
        $prepare_data['VNDG3']=0; //VNDG#
        $prepare_data['VNDICM']=0;
        $prepare_data['VNDICD']=0;
        $prepare_data['VNDICY']=0;
        $prepare_data['VNDIC3']=0; //VNDIC#
        $prepare_data['VNDSYM']=0;
        $prepare_data['VNDSYD']=0;
        $prepare_data['VNDSYY']=0;
        $prepare_data['VNDSY3']=0;  //VNDSY#
        $prepare_data['VNDKM']=0;
        $prepare_data['VNDKD']=0;
        $prepare_data['VNDKY']=0;
        $prepare_data['VNDK3']=0; //VNDK#
        $prepare_data['VNDSVM']=0;
        $prepare_data['VNDSVD']=0;
        $prepare_data['VNDSVY']=0;
        $prepare_data['VNDSV3']=0; //VNDSV#
        $prepare_data['VNHDGM']=0;
        $prepare_data['VNHDGD']=0;
        $prepare_data['VNHDGY']=0;
        $prepare_data['VNHDG3']=0; //VNHDG#
        $prepare_data['VNDKCM']=0;
        $prepare_data['VNDKCD']=0;
        $prepare_data['VNDKCY']=0;
        $prepare_data['VNDKC3']=0; //VNDKC#
        $prepare_data['VNIVDM']=0;
        $prepare_data['VNIVDD']=0;
        $prepare_data['VNIVDY']=0;
        $prepare_data['VNIVD3']=0; //VNIVD#
        $prepare_data['VNABR1']='';
        $prepare_data['VNABR2']='';
        $prepare_data['VNABR3']='';
        $prepare_data['VNABR4']='';
        $prepare_data['VNABT1']='';
        $prepare_data['VNABT2']='';
        $prepare_data['VNABT3']='';
        $prepare_data['VNABT4']='';
        $prepare_data['VNITM']=0;
        $prepare_data['VNPM01']=0;
        $prepare_data['VNPM02']=0;
        $prepare_data['VNPM03']=0;
        $prepare_data['VNPM04']=0;
        $prepare_data['VNPM05']=0;
        $prepare_data['VNPM06']=0;
        $prepare_data['VNPM07']=0;
        $prepare_data['VNPM08']=0;
        $prepare_data['VNPM09']=0;
        $prepare_data['VNPM10']=0;
        $prepare_data['VNBCRC']='';
        $prepare_data['VNEXR1']='';
        $prepare_data['VNTXA1']='';
        $prepare_data['VNTXITM']=0;
        $prepare_data['VNACTB']='';
        $prepare_data['VNSTAM']=0;
        $prepare_data['VNCTAM']=0;
        $prepare_data['VNAG']=0;
        $prepare_data['VNAGF']=0;
        $prepare_data['VNTKTX']=0;
        $prepare_data['VNDLNID']=0;
        $prepare_data['VNCKNU']=0;
        $prepare_data['VNBUPC']=0;
        $prepare_data['VNAHBU']='';
        $prepare_data['VNEPGC']='';
        $prepare_data['VNJPGC']='';
        $prepare_data['VNRC5']=0;
        $prepare_data['VNSFXE']=0;
        $prepare_data['VNOFM']=0;

        // echo $items;
        // echo $value->code;
        // echo $value->po_date;
        // echo $value->discount;
        // echo $value->discountdetail;
        // echo $value->vat;
        // echo $value->shipping;
        // echo $value->pay_amount;
        // echo $value->pay_by;
        // echo $value->is_payment;
        // echo $value->payment_date;
        // echo $value->shipping_by;
        // echo $value->shipping_date;
        // echo $value->shipping_code;
        // echo $value->shipping_package;
        // echo $value->service_code;
        // echo $value->remark;
        // echo $value->sell_by;
        // echo $value->address;
        // echo $value->province;
        // echo $value->district;
        // echo $value->subdistrict;
        // echo $value->zipcode;
        // echo $value->postatus;
        // echo $value->tax_id;
        // echo $value->tax_name;
        // echo $value->billing_address;
        // echo $value->billing_province;
        // echo $value->billing_district;
        // echo $value->billing_subdistrict;
        // echo $value->billing_zipcode;
        // echo $value->contactpoint_id;
        // echo $value->channel_name;
        // echo $value->owner;
        // echo $value->created_at;
        // echo $value->updated_at;
        // echo $value->inv_code;
        // echo $value->inv_date;
        // echo $value->inv_user;
        // echo $value->twoc2p_status;
        // echo $value->media_slot;
      
    }
        //     $ProductGroupID=$num->ProductGroupID;
            //     $groupprice=$num->PricePerUnit*$num->QTY;
            //     $groupcost=$num->Item_cost*$num->QTY;
            // //     //echo "\n-$ProductGroupID-".$groupprice."--";
            //     @$itemline[$ProductGroupID]['price']+=$groupprice;
            //     @$itemline[$ProductGroupID]['cost']+=$groupcost;
            //     // $itemline[$ProductGroupID]+=array('VNEDBT'=>$batchnumber,
            //     //                                     // 'VNEDLN'=>$jj*1000,
            //     //                                     // 'VNJELN'=>$jj*1000,
            //     //                                     'VNEDDT'=>calc2julian($value->inv_date),
            //     //                                     'VNDGJ'=>calc2julian($value->inv_date),
            //     //                                     'VNUPMJ'=>calc2julian($value->inv_date),
            //     //                                     'VNDICJ'=>calc2julian($value->inv_date),
            //     //                                     'VNDSVJ'=>calc2julian($value->inv_date),
            //     //                                     'VNUPMT'=>splitdatetime($data->ExecTime),
            //     //                                     //'VNEXR'=>$value->tax_name,
            //     //                                     'VNEDTN'=>$keys,
            //     //                                     'VNDOC'=>$keys,
            //     //                                     'VNEXA'=>$value->code,
            //     //                                     'VNDCT'=>$doctype
            //     //                                             );

            
              //     $ProductGroupID=$num->ProductGroupID;
            //     $groupprice=$num->PricePerUnit*$num->QTY;
            //     $groupcost=$num->Item_cost*$num->QTY;
            // //     //echo "\n-$ProductGroupID-".$groupprice."--";
            //     @$itemline[$ProductGroupID]['price']+=$groupprice;
            //     @$itemline[$ProductGroupID]['cost']+=$groupcost;
            //     // $itemline[$ProductGroupID]+=array('VNEDBT'=>$batchnumber,
            //     //                                     // 'VNEDLN'=>$jj*1000,
            //     //                                     // 'VNJELN'=>$jj*1000,
            //     //                                     'VNEDDT'=>calc2julian($value->inv_date),
            //     //                                     'VNDGJ'=>calc2julian($value->inv_date),
            //     //                                     'VNUPMJ'=>calc2julian($value->inv_date),
            //     //                                     'VNDICJ'=>calc2julian($value->inv_date),
            //     //                                     'VNDSVJ'=>calc2julian($value->inv_date),
            //     //                                     'VNUPMT'=>splitdatetime($data->ExecTime),
            //     //                                     //'VNEXR'=>$value->tax_name,
            //     //                                     'VNEDTN'=>$keys,
            //     //                                     'VNDOC'=>$keys,
            //     //                                     'VNEXA'=>$value->code,
            //     //                                     'VNDCT'=>$doctype
            //     //                                             );
  */
?>