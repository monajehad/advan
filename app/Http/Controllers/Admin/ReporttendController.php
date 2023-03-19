<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Item;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Models\Tender;
use App\Models\Client;
use App\Models\TenderItem;
use App\Models\Competitor;
use App\Models\CompetitorsItems;
use App\Models\Setting;
use App\Models\SystemConstant;
use PDF;
// use Auth;

class ReporttendController extends Controller
{
    public function index()
    {
        $data=[];
        $items=Item::select('id','name')->get();
        $data['items']=$items;
        $data['branch']=SystemConstant::select('id','name','value','type')->where([['status',1],['type','company_branches']])->orderBy('order')->get();
        $data['currency']=SystemConstant::select('id','name','value','type')->where([['status',1],['type','currency']])->orderBy('order')->get();
        return view('tenders.report.index',compact('data'));
    }
    public function exportExcel(Request $request)
    {
        // dd($request->all());
        if ($request->report_type==1) {

            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','tenders.tender_no','clients.name as client','items.name as item','tender_items.expired_date','suppliers.ar_name as supplier')
            ->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })
            ;
            if ($request->tender) {
                $tenders = $tenders->where('tenders.id',$request->tender);
            }
            if ($request->created_date_from) {
                $request->created_date_from=date('Y-m-d',strtotime($request->created_date_from));
                $tenders = $tenders->where('tenders.created_at','>=',$request->created_date_from);
            }

            if ($request->created_date_to) {
                $request->created_date_to=date('Y-m-d H:i:s',strtotime($request->created_date_to.'23:59:59'));
                $tenders = $tenders->where('tenders.created_at','<=',$request->created_date_to);
            }

            $tenders=$tenders->leftJoin('tender_items', function($join) use($request){
                $join->on('tenders.id', '=', 'tender_items.tender_id')->where('tender_items.type',2)
               ->whereNull('tender_items.deleted_at');
            })->leftJoin('tender_items as t_it', function($join) use($request){
                $join->on('tender_items.tender_id', '=', 't_it.tender_id')->whereRaw('t_it.item_id = tender_items.item_id')
               ->whereNull('t_it.deleted_at')->where('t_it.type',1)->where('t_it.accepted_item',1);
            })->leftJoin('items', function($join) {
                $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
            })->leftJoin('suppliers', function($join) {
                $join->on('suppliers.id', '=', 'tender_items.supplier_id')->whereNull('suppliers.deleted_at');
            })->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })
            ->where('tender_items.expired_date','<',Carbon::now()->format('Y-m-d'))

            ->orderBy('tenders.id')->get();
            // dd($tenders);
            @ob_start();
                echo  chr(239) . chr(187) . chr(191);
            $items_table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>المناقصة</th>
            <th>المؤسسة</th>
            <th>فرع الشركة</th>
            <th>اسم الصنف</th>
            <th>المورد</th>
            <th>تاريخ الانتهاء</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
            if (count($tenders)>0) {
               foreach ($tenders as $key=>$tender) {
                   $i=$key+1;
                $items_table.="
                <tr>
                    <td>". $i  ."</td>
                    <td class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                    <td>".  $tender->client."</td>
                    <td>".  $tender->branch_name."</td>
                    <td>".  $tender->item." </td>
                    <td> ". $tender->supplier ."</td>
                    <td> ". $tender->expired_date ."</td>
                </tr>
                ";
               }
            }else{
                $items_table.="
                <tr>
                    <td style='text-align:center;font-weight:bold;' colspan=\"7\">لا يوجد أصناف منهية</td>
                </tr>
                ";
            }
            $items_table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export') {

                echo $items_table;
                $filename="الأصناف المنهية";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");

            }else if($request->val=='pdf'){
                $filename="الأصناف المنهية";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender1', compact('tenders','filename'));
                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // PDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('l','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                ob_end_clean();

                TCPDF::Output('tender.pdf');
            }else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$items_table]);
            }

        }elseif ($request->report_type==2) {

            if(!$request->item){

                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار الصنف');
                    return back()->withInput();
                }else if ($request->val=='pdf') {
                    session()->flash('error','يجب اختيار الصنف');
                    return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار الصنف']);
                 }
            }
            $item_name=Item::where('id',$request->item)->pluck('name')->first();
            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','currency.name as currency_name','tenders.tender_no','clients.name as client','suppliers.ar_name as supplier','t_it2.id as it','t_it.supplied_quantity','items.name as item_name','t_it.item_quantity as tender_quantity','t_it2.item_quantity as supplier_quantity','t_it.item_price as tender_price','t_it2.item_price as supplier_price','t_it.accepted_item')
            ->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })
            ->where('t_it.item_id',$request->item);
            if ($request->created_date_from) {
                $request->created_date_from=date('Y-m-d',strtotime($request->created_date_from));
                $tenders = $tenders->where('tenders.created_at','>=',$request->created_date_from);
            }

            if ($request->created_date_to) {
                $request->created_date_to=date('Y-m-d H:i:s',strtotime($request->created_date_to.'23:59:59'));
                $tenders = $tenders->where('tenders.created_at','<=',$request->created_date_to);
            }
            $tenders=$tenders->leftJoin('tender_items as t_it', function($join) use($request){
                $join->on('tenders.id', '=', 't_it.tender_id')->where('t_it.type',1)
                ->whereNull('t_it.deleted_at');
            })
            ->leftJoin('tender_items as t_it2', function($join) use($request){
                $join->on('t_it.tender_id', '=', 't_it2.tender_id')->whereRaw('t_it2.item_id = t_it.item_id')
                ->whereNull('t_it2.deleted_at')->where('t_it2.type',2);
            })->leftJoin('items', function($join) {
                $join->on('items.id', '=', 't_it.item_id')->whereNull('items.deleted_at');
            })->leftJoin('suppliers', function($join) {
                $join->on('t_it2.supplier_id', '=', 'suppliers.id')->whereNull('suppliers.deleted_at');
            })->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('system_constants as currency', function($join) {
                $join->on('currency.value', '=', 'tenders.currency')->where('currency.type','currency')->whereNull('currency.deleted_at');
            })

            ->get()->groupBy('id');
            // dd($tenders);
            // ->get()->groupBy('id');
            $min_prices_items=$tenders->map(function($data,$key){
                return[
                    'tender_id'=>$key,
                    'it'=>$data->where('supplier_price', $data->min('supplier_price'))->pluck('it')->first(),
                ];
            })->toArray();
            $min_prices=array_column($min_prices_items, 'it','tender_id');


            @ob_start();
                echo  chr(239) . chr(187) . chr(191);
            $items_table="
                <table border='1' class='table table-bordered text-center'>
                <thead>
                <tr>
                <th>#</th>
                <th>رقم المناقصة</th>
                <th> المؤسسة</th>
                <th> فرع الشركة</th>
                <th>اسم الصنف</th>
                <th>كمية المناقصة</th>
                <th>سعر المناقصة</th>
                <th> العملة</th>
                <th>المورد</th>
                <th>سعر المورد</th>
                <th>نتيجة الترسية</th>
                <th>الكمية الموردة</th>
                </tr>
                </thead>
                <tbody style='text-align:center;'>
                ";
                // dd($tenders);
             if(count($tenders)>0){
                $i=0;
                foreach ($tenders as $key => $tender) {
                    foreach ($tender as $k =>  $item) {
                        $i++;
                        $supplied_quantity='';
                        $accept_bg="";
                    //     if ($item->accepted_item==1) {
                    //         $item->accepted_item="نعم";
                    //         $accept_bg="";
                    //    }elseif ($item->accepted_item==0) {
                    //         $item->accepted_item="جاري";

                    //    }
                    //    dd($min_prices, );
                    // dd($min_prices["$item->id"]);
                    if (!empty($item->supplier_price)) {
                        if (array_key_exists($item->id,$min_prices) && $min_prices["$item->id"]==$item->it) {
                            $color="yellow !important";
                            $accepted= $item->accepted_item;
                            $supplied_quantity=$item->supplied_quantity;

                        }else{
                         $color="unset";
                         $accepted='جاري';
                         $supplied_quantity='';

                         }
                    }else{
                        $color="unset";
                        $accepted= $item->accepted_item;
                    }
                    $accept_bg="";
                            if ($item->accepted_item==1) {
                            $item->accepted_item="نعم";
                            $accept_bg="#68c168";
                       }elseif ($item->accepted_item==0) {
                            $item->accepted_item="جاري";

                       }
                       $items_table.="
                     <tr style='background-color:".$color.";'>
                         <td>". $i  ."</td>
                         <td class='get-tender' data-id='$item->id'>".  $item->tender_no."</td>
                         <td>".  $item->client."</td>
                         <td>".  $item->branch_name."</td>
                         <td>".  $item->item_name." </td>
                         <td>".  $item->tender_quantity ." </td>
                         <td>".  $item->tender_price ." </td>
                         <td>".  $item->currency_name ." </td>
                         <td> ". $item->supplier ."</td>
                         <td> ". $item->supplier_price ."</td>
                         <td style='background-color:".$accept_bg."'> ". $item->accepted_item."</td>
                         <td> ". $supplied_quantity."</td>
                     </tr>
                     ";
                    }
                }
             }else{
                $items_table.="
                <tr>
                    <td  colspan=\"12\" style='text-align:center;font-weight:bold;'>$item_name غير موجود بأي مناقصة</td>
                </tr>
                ";
            }
            $items_table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export') {

               echo $items_table;
               $filename=" تقرير" . $item_name;
               header("Content-Type: application/xls");
               header("Content-Disposition: attachment; filename=".$filename.".xls");
               header("Pragma: no-cache");
               header("Expires: 0");

            }else if($request->val=='pdf'){

                    $filename=" تقرير تفاصيل الصنف  " . $item_name;
                    $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                    $view = View::make('/admin/pdf/tender2', compact('tenders','filename','item_name'));
                    $html_content = $view->render();
                    // $html_content = $items_table;

                    $lg = Array();

                    $lg['a_meta_charset'] = 'UTF-8';

                    $lg['a_meta_dir'] = 'rtl';

                    $lg['a_meta_language'] = 'ar';

                    $lg['w_page'] = 'page';



                    TCPDF::setHeaderCallback(function($pdf) use ($setting){


                    });

                    TCPDF::setFooterCallback(function($pdf) {

                    $pdf->SetY(-9);

                    $pdf->SetFont('arial', '', 9);

                    $pdf->Line(0, 285, 250, 285, '');

                    $pdf->WriteHTML('<table>

                    <tr>

                    <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                    <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                    </tr>

                    </table>',true, false, true, false, '');

                    });
                    TCPDF::setLanguageArray($lg);

                    TCPDF::SetFont('arial', '', 14);

                    TCPDF::SetAutoPageBreak(true, 12);
                    TCPDF::SetMargins(5, 15, 5, 5);
                    TCPDF::SetTitle($filename);

                    // PDF::SetMargins(5,5,5,5);
                    TCPDF::AddPage('l','A4');
                    TCPDF::writeHTML($html_content, true, false, true, false, '');

                    TCPDF::SetTitle($filename);

                    TCPDF::setRTL(true);
                    ob_end_clean();

                    TCPDF::Output('tender.pdf');

            }else if ($request->val=='view') {
               return response()->json(['status'=>true,'table'=>$items_table]);
           }

        }elseif ($request->report_type==3) {

            $item=Item::where('id',$request->item)->first();


            $tenders=Tender::select('tenders.id','tenders.tender_no','branch_constants.name as branch_name','clients.name as client','items.name as item_name','items.item_no','t_it.item_quantity as tender_quantity')
            ->leftJoin('tender_items as t_it', function($join) use($request){
                $join->on('tenders.id', '=', 't_it.tender_id')->where('t_it.type',1)
                ->whereNull('t_it.deleted_at');
            })
            ->join('items', function($join) {
                $join->on('items.id', '=', 't_it.item_id')->whereNull('items.deleted_at');
             }) ->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            });
            if($request->item){
                $tenders=$tenders->where('t_it.item_id',$request->item);
            }
            $tenders=$tenders->get();

            // dd( $tenders);
            @ob_start();
                echo  chr(239) . chr(187) . chr(191);
            $items_table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>المناقصة</th>
            <th>فرع الشركة</th>
            <th>المؤسسة</th>
            <th>رقم الصنف</th>
            <th>اسم الصنف</th>
            <th>الكمية</th>
            </tr>
            </thead>
            <tbody style='text-align:center'>
            ";
            if (count($tenders)>0) {
                foreach ($tenders as $key=>$item) {
                    $i=$key+1;
                    $items_table.="
                    <tr>
                        <td>". $i  ."</td>
                        <td class='get-tender' data-id='$item->id'>".  $item->tender_no."</td>
                        <td>".  $item->branch_name."</td>
                        <td>".  $item->client."</td>
                        <td>".  $item->item_no."</td>
                        <td>".  $item->item_name."</td>
                        <td> ". $item->tender_quantity ."</td>
                    </tr>
                    ";
                }
            }else{
                $items_table.="
                <tr>
                    <td style='text-align:center;font-weight:bold;' colspan=\"7\">لا يوجد أصناف </td colspan='2'>
                </tr>
                ";
            }
            $items_table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export') {
                echo $items_table;
                $filename="أرصدة الأصناف";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename="أرصدة الأصناف";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender3', compact('tenders','filename'));
                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('l','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                ob_end_clean();

                TCPDF::Output('tender.pdf');
             } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$items_table]);
            }

        }elseif ($request->report_type==4) {

            if(!$request->client){
                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار المؤسسة');
                    return back()->withInput();
                }else if ($request->val=='pdf') {
                    // session()->flash('error','يجب اختيار المؤسسة');
                    // return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار المؤسسة']);
                }
            }
            $client_name=Client::where('id',$request->client)->pluck('ar_name')->first();


            $tenders=Tender::select('tenders.id','sector_constants.name as sector_name','tenders.bid_status','tenders.complete_status','branch_constants.name as branch_name','tenders.created_at','tenders.tender_no','tenders.guarantee_no','tenders.transfer_price',
            'tenders.representation_date','tenders.notification_receipt_date','tenders.manager','tenders.guarantee_rate','tenders.guarantee_status','tenders.guarantee_value'
            ,'currency_constants.name as curreny_name','tax_constants.name as tax_name','guarantee_type_constants.name as guarantee_type_name')
            ->leftJoin('system_constants as currency_constants', function($join) {
                $join->on('currency_constants.value', '=', 'tenders.currency')->where('currency_constants.type','currency')->whereNull('currency_constants.deleted_at');
            })->leftJoin('system_constants as tax_constants', function($join) {
                $join->on('tax_constants.value', '=', 'tenders.tax')->where('tax_constants.type','tax')->whereNull('tax_constants.deleted_at');
            })->leftJoin('system_constants as guarantee_type_constants', function($join) {
                $join->on('guarantee_type_constants.value', '=', 'tenders.guarantee_type')->where('guarantee_type_constants.type','guarantee_type')->whereNull('guarantee_type_constants.deleted_at');
            })->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })->leftJoin('system_constants as sector_constants', function($join) {
                $join->on('sector_constants.value', '=', 'tenders.sector')->where('sector_constants.type','sector_type')->whereNull('sector_constants.deleted_at');
            })
            ->where('client_id',$request->client)
            ->get();
            if(count($tenders)>0){
            $ids = $tenders->pluck('id')->toArray();
            $ids = join(',', $ids);


            $tender_items=  DB::Select("
                SELECT t_it2.tender_id,t_it2.item_id, t_it2.item_quantity AS tender_quantity,t_it2.notes,t_it2.item_price AS tender_price,t_it2.accepted_item,i.name AS item,sys_const.name AS unit_name , shape_const.name AS shape_name
                ,item_trade_names.trade_name ,i.item_no,s.duration,s.expired_date
                ,sup.ar_name AS supplier_name,s.supplier_price
                FROM tender_items t_it2
                LEFT JOIN(
                SELECT t.tender_id AS s_t,t.item_id AS s_i,t.item_price AS supplier_price,t.trade_name, t.supplier_id AS supplier,t.duration,t.expired_date
                FROM tender_items t
                JOIN
                (
                SELECT ts.item_id, MIN(ts.item_price) AS minVal,ts.tender_id
                FROM tender_items ts
                WHERE ts.deleted_at IS NULL AND ts.type = 2
                GROUP BY ts.item_id,ts.tender_id
                ) t2 ON t.item_price = t2.minVal AND t.item_id = t2.item_id AND t.tender_id = t2.tender_id AND t.deleted_at IS NULL
                ) s ON s.s_t=t_it2.tender_id AND s.s_i=t_it2.item_id
                LEFT OUTER
                JOIN items i ON i.id = t_it2.item_id AND i.deleted_at IS NULL
                LEFT OUTER
                JOIN suppliers sup ON sup.id = s.supplier AND sup.deleted_at IS NULL
                LEFT OUTER
                JOIN system_constants sys_const ON sys_const.value = t_it2.unit AND sys_const.type='unit' AND sys_const.deleted_at IS NULL
                LEFT OUTER
                JOIN system_constants shape_const ON shape_const.value = i.pharmaceutical_form AND shape_const.type='pharmaceutical_form' AND shape_const.deleted_at IS NULL
                LEFT OUTER
                JOIN item_trade_names ON item_trade_names.id = s.trade_name AND item_trade_names.deleted_at IS NULL
                WHERE `t_it2`.`tender_id` IN($ids) AND `t_it2`.`deleted_at` IS NULL AND `t_it2`.`type` = 1
                ORDER BY t_it2.tender_id DESC
            ");

            // dd($tenders , $tender_items);


            $t_table='';
            foreach ($tenders as $key => $tender) {
                $t_table.="<table border='1' class='table table-bordered text-center'>
                <thead>
                <tr>
                    <th>#</th>
                    <th>المناقصة</th>
                    <th>فرع الشركة</th>
                    <th>القطاع</th>
                    <th>العميل</th>
                    <th>نوع الكفالة</th>
                    <th>نسبة الكفالة</th>
                    <th>قيمة الكفالة</th>
                    <th>رقم كفالة دخول العطاء</th>
                    <th>الضريبة</th>
                    <th>العملة</th>
                    <th>سعر التحويل</th>
                    <th>الشخص المسؤول</th>
                    <th>تاريخ تقديم المناقصة</th>
                    <th>تاريخ استلام أمر التوريد</th>
                    <th>تم استرداد الكفالة؟</th>
                    <th>حالة العطاء</th>
                    <th>المناقصة منجزة؟</th>
                </tr>
                </thead>
                <tbody>
                ";
                $i=$key+1;
                $row_color='';
                if($tender->guarantee_status==1)
                    $tender->guarantee_status="نعم";
                elseif($tender->guarantee_status==0)
                    $tender->guarantee_status="لا";
                if($tender->bid_status==1){
                    $tender->bid_status="جاري الترسية";
                }elseif($tender->bid_status==0){
                    $tender->bid_status="لم يتم الترسية";
                }elseif($tender->bid_status==2){
                    $tender->bid_status="تم الترسية";
                }
                if($tender->complete_status==1){
                    $row_color='#6cff742b';

                    $tender->complete_status="نعم";
                }elseif($tender->complete_status==0){
                $row_color='unset';

                    $tender->complete_status="لا";
                }
                $t_table.="
                    <tr style=\"background-color:$row_color\">
                        <td>". $i  ."</td>
                        <td class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                        <td>".  $tender->branch_name."</td>
                        <td>".  $tender->sector_name."</td>
                        <td>".  $client_name." </td>
                        <td> ". $tender->guarantee_type_name ."</td>
                        <td> ". $tender->guarantee_rate ."</td>
                        <td> ". $tender->guarantee_value ."</td>
                        <td> ". $tender->guarantee_no ."</td>
                        <td> ". $tender->tax_name ."</td>
                        <td> ". $tender->curreny_name ."</td>
                        <td> ". $tender->transfer_price ."</td>
                        <td> ". $tender->manager ."</td>
                        <td> ". $tender->representation_date ."</td>
                        <td> ". $tender->notification_receipt_date ."</td>
                        <td> ". $tender->guarantee_status ."</td>
                        <td> ". $tender->bid_status."</td>
                        <td> ".$tender->complete_status."</td>
                    </tr>
                    <tr>
                        <td colspan=\"18\" style='text-align:center;font-weight:bold;color:white;background-color:blue'>بيانات أصناف المناقصة</td>
                    </tr>
                ";
                $items_table="
                <table border='1' width='100%'>
                <thead>
                <tr>
                    <th colspan='1'>#</th>
                    <th colspan='2'>اسم الصنف</th>
                    <th colspan='2'>الاسم التجاري</th>
                    <th colspan='2'>الشكل</th>
                    <th colspan='2'>الكمية</th>
                    <th colspan='2'>سعر المناقصة</th>
                    <th colspan='1'> الوحدة</th>
                    <th colspan='2'> المورد</th>
                    <th colspan='1'> سعر المورد</th>
                    <th colspan='1'>نتيجة الترسية</th>
                    <th colspan='1'>تاريخ الانتهاء</th>
                    <th colspan='1'>مدة التوريد بالأيام</th>
                </tr>
                </thead>
                <tbody>

                ";
                $j=0;
               foreach ( $tender_items as $key => $value) {


                   if ($value->tender_id==$tender->id) {
                        $j=$j+1;
                        $accept_color="";
                    if ( $value->accepted_item==1) {
                        $value->accepted_item="نعم";
                        $accept_color="#68c168";
                    }elseif ($value->accepted_item==0) {
                        $value->accepted_item="جاري";
                        $accept_color="";
                    }
                    $items_table.="
                        <tr>
                            <td colspan='1' style='text-align:center;background-color:".$accept_color."'>". $j  ."</td>
                            <td colspan='2' style='text-align:center;background-color:".$accept_color."'>".  $value->item."</td>
                            <td colspan='2' style='text-align:center;background-color:".$accept_color."'>".  $value->trade_name."</td>
                            <td colspan='2' style='text-align:center;background-color:".$accept_color."'> " .$value->shape_name."</td>
                            <td colspan='2' style='text-align:center;background-color:".$accept_color."'> ". $value->tender_quantity ."</td>
                            <td colspan='2' style='text-align:center;background-color:".$accept_color."'> ". $value->tender_price ."</td>
                            <td colspan='1' style='text-align:center;background-color:".$accept_color."'> ". $value->unit_name ."</td>
                            <td colspan='2' style='text-align:center;background-color:".$accept_color."'> ". $value->supplier_name ."</td>
                            <td colspan='1' style='text-align:center;background-color:".$accept_color."'> ". $value->supplier_price ."</td>
                            <td colspan='1' style='text-align:center;background-color:".$accept_color."'> ". $value->accepted_item ."</td>
                            <td colspan='1' style='text-align:center;background-color:".$accept_color."'> ". $value->expired_date ."</td>
                            <td colspan='1' style='text-align:center;background-color:".$accept_color."'> ". $value->duration ."</td>
                        </tr> ";
                   }
               }
               $items_table.="
               </tbody>
               </table>
               ";
               $t_table.= '<tr><td colspan=\'18\'>'.$items_table."</td></tr>
               </tbody>
               </table>";
            }
        }else{
            $t_table="
            <table border='1'>
            <tbody>
            <tr>
            <td colspan=\"18\" style='text-align:center;font-weight:bold;color:white;background-color:blue'>لا يوجد أي مناقصة لهذه المؤسسة</td>

           </tr>
            </tbody>
            </table>
            ";
        }
            if ($request->val=='export') {
                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $t_table;
                $filename="تقرير تفاصيل المؤسسة";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename="تقرير تفاصيل المؤسسة";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender4', compact('tenders','tender_items','filename','client_name'));
                $html_content = $view->render();
                // $html_content = $items_table;


                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('l','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$t_table]);
            }
        }elseif ($request->report_type==5) {

            if(isset($request->tender[0])){
                $tender_id=$request->tender[0];

            }else{
                $tender_id=null;

            }
            if(!$request->item){
                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار الصنف');
                    return back()->withInput();
                }else if ($request->val=='pdf') {
                    session()->flash('error','يجب اختيار الصنف');
                    return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار الصنف']);
                }
            }


            // $item=Item::where('id',$request->item)->first();
            // $item_name=$item->name;
            // if (!$item) {
            //     if ($request->val=='export') {
            //         session()->flash('error','الصنف غير موجود');
            //         return back()->withInput();
            //     }else if ($request->val=='view') {
            //         return response()->json(['status'=>false,'data'=>'الصنف غير موجود']);
            //     }
            // }

            $items_table='';
                $items=Item::whereIn('id',$request->item)->get();
            foreach ($items as $item) {

                $item_name=$item->name;

                $data=Tender::select('tenders.tender_no','tender_items.item_id','items.name as item_name',
                'branch_constants.name as branch_name','tenders.id as tender_id','clients.name as client','tender_items.item_quantity','tender_items.item_price')
                ->leftJoin('system_constants as branch_constants', function($join) {
                    $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
                })->leftJoin('tender_items', function($join) {
                    $join->on('tender_items.tender_id', '=', 'tenders.id')->whereNull('tender_items.deleted_at');
                })->leftJoin('items', function($join) {
                    $join->on('items.id', '=', 'tender_items.item_id')->whereNull('tender_items.deleted_at');
                })->leftJoin('clients', function($join) {
                    $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
                })->where('tender_items.item_id',$item->id);

                if($tender_id){
                    $data = $data->where('tenders.id',$tender_id);
                }

                if ($request->created_date_from) {
                    $request->created_date_from=date('Y-m-d',strtotime($request->created_date_from));
                    $data = $data->where('tenders.created_at','>=',$request->created_date_from);
                }

                if ($request->created_date_to) {
                    $request->created_date_to=date('Y-m-d H:i:s',strtotime($request->created_date_to.'23:59:59'));
                    $data = $data->where('tenders.created_at','<=',$request->created_date_to);
                }

                if ($request->branch) {
                    $data = $data->where('tenders.comany_branch',$request->branch);
                }

                if ($request->currency) {
                    $data = $data->where('tenders.currency',$request->currency);
                }

                if($request->client){
                     $data = $data->where('tenders.client_id',$request->client);
                }



// currency
                $data=$data->orderby('tenders.id','desc')->get();

             $c_items=CompetitorsItems::
                select('competitors_items.item_price','competitors_items.tender_id','competitors_items.competitor_id',
                'competitors_items.currency_id','s.name as curreny_name','competitors_items.id','competitors_items.item_id','competitors_items.note','competitors.name as c_name','competitors.color')
                ->where('competitors_items.item_id',$item->id)
                ->leftJoin('competitors', function($join) {
                    $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
                })->leftJoin('system_s as s', function($join) {
                    $join->on('competitors_items.currency_id', '=', 's.value')->where('s.type','currency')->whereNull('s.deleted_at');
                })->get();

                $com_names =  $c_items->groupBy('c_name');
                if ($request->val=='export'){
                 @ob_start();
                    echo  chr(239) . chr(187) . chr(191);
                }
                $items_table.="<table border='1' class='table table-bordered text-center'>
                <thead>
                <tr>
                    <th>رقم المناقصة</th>
                    <th> اسم الموسسة / العميل</th>
                    <th>فرع الشركة</th>
                    <th>اسم الصنف</th>
                    <th>الكمية</th>
                    <th>سعر الشركة</th>";
                if ($c_items) {
                    foreach ($com_names as $key=>$c) {
                        $color = '';
                        if($c){
                            $color = $c[0]->color;
                        }
                        $items_table.="<th style='background-color:".$color."'>".$key."</th>";
                    }
                }
                $items_table.="</tr>
                </thead>
                <tbody style='text-align:center'>";

                if (count($data )>0) {
                    foreach ($data  as $key=>$item) {
                        $i=$key+1;


                        $items_table.="
                        <tr>
                            <td class='get-tender' data-id='$item->tender_id'>".  $item->tender_no."</td>
                            <td>".  $item->client."</td>
                            <td>".  $item->branch_name."</td>
                            <td>".  $item->item_name." </td>
                            <td>".  $item->item_quantity." </td>
                            <td>".$item->item_price."</td>";

                            if ($c_items) {



                                $min=[];
                                $res=null;
                                foreach ($c_items as $c) {

                                    if ($c->tender_id==$item->tender_id && $c->item_id==$item->item_id) {
                                        array_push($min,$c->item_price);
                                        // var_dump($min);
                                        $res = min($min);
                                    }
                                }


                                foreach ($com_names as $key=>$c_name) {
                                    $i = 0;
                                    $check = 0;
                                    foreach($c_name as $c){
                                    // return $item;
                                    // return $c_name;
                                    //
                                    if ($c->tender_id==$item->tender_id && $c->item_id==$item->item_id) {
                                        $check = 1;
                                        if($res == $c->item_price){
                                            $items_table.="<td style='background-color:".$c->color."; font-size: 16px; color: red; font-weight: 900;
                                            ' >".$c->item_price." &nbsp;". $c->curreny_name ."  <br>  ".$c->note."</td>";

                                        }else{

                                            $items_table.="<td style='background-color:".$c->color."' >".$c->item_price." &nbsp;". $c->curreny_name ." <br> ".$c->note."</td>";
                                        }
                                        $i=0;
                                    }else{
                                        // $items_table.="<td style='background-color:".$c->color."'></td>";
                                        $i++;
                                    }

                                    }
                                    if($i>0 and $check == 0){
                                        $items_table.="<td style='background-color:".$c->color."'></td>";
                                    }
                                    // return $i;
                                }
                            }

                            $items_table.="</tr>
                        ";


                    }
                }else{
                    $items_table.="
                    <tr>
                        <td  style='text-align:center;font-weight:bold;' colspan=\"6\">لا يوجد أسعار ل $item_name  لدى المنافسين </td>
                    </tr>";
                }
                $items_table.="</tbody></table>";

            }
            if ($request->val=='export'){
                echo $items_table;
                $filename="الأسعار المنافسة";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename="الأسعار المنافسة";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender5', compact('c_items','data','filename','item_name'));
                $html_content = $view->render();
                // $html_content = $items_table;


                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('l','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            } else if ($request->val=='view') {
                // return $items_table;
                // $items_table = html_entity_decode($items_table);

                return response()->json(['status'=>true,'table'=>$items_table]);
            }
        }elseif ($request->report_type==6) {
            if(!$request->tender){
                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار المناقصة');
                    return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار المناقصة']);
                }
            }

            $tender=Tender::select('tenders.id','branch_constants.name as branch_name','sector_constants.name as sector_name','tenders.guarantee_rate','tenders.guarantee_value','tenders.guarantee_status','tenders.tender_no','tenders.guarantee_no','tenders.transfer_price','tenders.created_at'
            ,'tenders.representation_date','tenders.bid_status','tenders.complete_status','tenders.notification_receipt_date','tenders.manager','clients.name as client'
            ,'currency_constants.name as curreny_name','tax_constants.name as tax_name','guarantee_type_constants.name as guarantee_type_name')
            ->where('tenders.id',$request->tender)
            ->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('system_constants as currency_constants', function($join) {
                $join->on('currency_constants.value', '=', 'tenders.currency')->where('currency_constants.type','currency')->whereNull('currency_constants.deleted_at');
            })->leftJoin('system_constants as tax_constants', function($join) {
                $join->on('tax_constants.value', '=', 'tenders.tax')->where('tax_constants.type','tax')->whereNull('tax_constants.deleted_at');
            })->leftJoin('system_constants as guarantee_type_constants', function($join) {
                $join->on('guarantee_type_constants.value', '=', 'tenders.guarantee_type')->where('guarantee_type_constants.type','guarantee_type')->whereNull('guarantee_type_constants.deleted_at');
            })->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })->leftJoin('system_constants as sector_constants', function($join) {
                $join->on('sector_constants.value', '=', 'tenders.sector')->where('sector_constants.type','sector_type')->whereNull('sector_constants.deleted_at');
            })
            ->first();
            $tender->items=TenderItem::where('tender_id',$tender->id)
            ->select("tender_items.id as it_id",'tender_items.accepted_item','tender_items.item_quantity',
            'tender_items.item_price','tender_items.duration','unit_constants.name as unit_name','tender_items.expired_date',
            'item_trade_names.trade_name','tender_items.item_id',
            'tender_items.type',
            'items.name as item','items.item_no','suppliers.ar_name as supplier_name')
            ->leftJoin('items', function($join) {
                $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
            })->leftJoin('suppliers', function($join) {
                $join->on('suppliers.id', '=', 'tender_items.supplier_id')->whereNull('suppliers.deleted_at');
            })->leftJoin('system_constants as unit_constants', function($join) {
                $join->on('unit_constants.value', '=', 'tender_items.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
            })->leftJoin('item_trade_names', function($join) {
                $join->on('item_trade_names.id', '=', 'tender_items.trade_name')->whereNull('item_trade_names.deleted_at');
            })
            ->get();
            // $tender->competitorsItems=CompetitorsItems::select('items.name as item','competitors_items.item_price','competitors.name as competitor')
            // ->where('competitors_items.tender_id',$tender->id)
            // ->leftJoin('items', function($join) {
            //     $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
            // })->leftJoin('competitors', function($join) {
            //     $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
            // })->get();


            $comp=Competitor::orderby('id','desc')->get(['id','name','color']);

            $tender->competitorsItems=CompetitorsItems::
            select('competitors_items.id','items.name as item','competitors_items.item_price','competitors_items.competitor_id',
            'competitors_items.item_id','competitors.color')
            ->where('competitors_items.tender_id',$tender->id)
            ->leftJoin('competitors', function($join) {
                $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
            })->leftJoin('items', function($join) {
                $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
            })->orderby('competitors_items.id','desc')
            ->get();

            $min_prices=DB::select("
                SELECT t.id
                FROM tender_items t
                JOIN
                (
                SELECT ts.item_id, MIN(ts.item_price) AS minVal,ts.tender_id
                FROM tender_items ts
                WHERE ts.deleted_at IS NULL AND ts.tender_id=$tender->id AND ts.deleted_at IS NULL AND ts.type = 2
                GROUP BY ts.item_id,ts.tender_id
                ) t2 ON t.item_price = t2.minVal AND t.item_id = t2.item_id AND t.tender_id = t2.tender_id AND t.deleted_at IS NULL
            ");
            $min_prices=collect($min_prices);
            @ob_start();
            echo  chr(239) . chr(187) . chr(191);
            if ( $tender->guarantee_status==1) {
                $tender->guarantee_status="نعم";
            }elseif ($tender->guarantee_status==0) {
                $tender->guarantee_status="لا";
            }
            if ( $tender->bid_status==1) {
                $tender->bid_status="جاري الترسية";
            }elseif ($tender->bid_status==0) {
                $tender->bid_status="لم يتم الترسية";
            }elseif ($tender->bid_status==2) {
                $tender->bid_status="تم الترسية";
            }
            $row_color='';
            if ($tender->complete_status==1) {
                $row_color='#6cff742b';

                $tender->complete_status="نعم";
            }elseif ($tender->complete_status==0) {
                $row_color='unset';

                $tender->complete_status="لا";
            }

            // return $tender;
            $tender_table="
                <table border='1' class='table table-bordered text-center'>
                <thead>
                <tr>
                    <td  style='text-align:center;font-weight:bold;color:white;background-color:blue' colspan=\"17\">بيانات المناقصة
                    </td>
                </tr>
                <tr>
                <th>المناقصة</th>
                <th>فرع الشركة</th>
                <th>القطاع</th>
                <th>العميل</th>
                <th>نوع الكفالة</th>
                <th>نسبة الكفالة</th>
                <th>قيمة الكفالة</th>
                <th>رقم كفالة دخول العطاء</th>
                <th>الضريبة</th>
                <th>العملة</th>
                <th>سعر التحويل</th>
                <th>الشخص المسؤول</th>
                <th>تاريخ تقديم المناقصة</th>
                <th>تاريخ استلام أمر التوريد</th>
                <th>تم استرداد الكفالة؟</th>
                <th>حالة العطاء</th>
                <th>منجزة؟</th>
                </tr>
                </thead>
                <tbody>

            ";
            // dd($tender);
            $tender_table.="
                <tr style=\"background-color:$row_color\">
                    <td style='text-align:center;' class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                    <td style='text-align:center;'>".  $tender->branch_name."</td>
                    <td style='text-align:center;'>".  $tender->sector_name."</td>
                    <td style='text-align:center;'>".  $tender->client." </td>
                    <td style='text-align:center;'> ". $tender->guarantee_type_name ."</td>
                    <td style='text-align:center;'> ". $tender->guarantee_rate."</td>
                    <td style='text-align:center;'> ". $tender->guarantee_value ."</td>
                    <td style='text-align:center;'> ". $tender->guarantee_no ."</td>
                    <td style='text-align:center;'> ". $tender->tax_name ."</td>
                    <td style='text-align:center;'> ". $tender->curreny_name ."</td>
                    <td style='text-align:center;'> ". $tender->transfer_price ."</td>
                    <td style='text-align:center;'> ". $tender->manager ."</td>
                    <td style='text-align:center;'> ". $tender->representation_date ."</td>
                    <td style='text-align:center;'>  ". $tender->notification_receipt_date ."</td>
                    <td style='text-align:center;'>  ". $tender->guarantee_status ."</td>
                    <td style='text-align:center;'> ". $tender->bid_status ."</td>
                    <td style='text-align:center;'> ". $tender->complete_status ."</td>
                </tr>
                <tr>
                    <td colspan=\"17\" style='text-align:center;font-weight:bold; color:white;background-color:blue'>بيانات أصناف المناقصة</td>
                </tr>

            ";
            $items_table="
            <table border='1' style='width:100%'  class='table table-bordered text-center'>
            <thead>
            <tr>
            <th colspan='2'>#</th>
            <th colspan='3'>رقم الصنف</th>
            <th colspan='3'>اسم الصنف</th>
            <th colspan='2'>الكمية</th>
            <th colspan='2'>السعر</th>
            <th colspan='3'>الوحدة</th>
            <th colspan='2'>نتيجة الترسية </th>
            </tr>
            </thead>
            <tbody style='text-align:center'>
            ";
            $items_suppliers_table="
            <table border='1' style='width:100%'  class='table table-bordered text-center'>
            <thead>
            <tr>
            <th colspan='1'>#</th>
            <th colspan='3'>رقم الصنف</th>
            <th colspan='3'>اسم الصنف</th>
            <th colspan='3'>الاسم التجاري</th>
            <th colspan='2'>المورد</th>
            <th colspan='1'>السعر</th>
            <th colspan='2'>تاريخ الانتهاء</th>
            <th colspan='3'>مدة التوريد بالأيام</th>
            </tr>
            </thead>
            <tbody style='text-align='center'>
            ";
            $items_competitors_table="
            <table border='1'style='width:100%'  class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>اسم الصنف</th>
            ";
            foreach($tender->competitorsItems as $item){
                foreach($comp as $c){

                    if($item->competitor_id == $c->id){
                        $items_competitors_table.="<th style='background-color:".$c->color."'>".$c->name."</th>";
                    }
                }

            }

            // if ($comp) {
            //     foreach ($comp as $c) {
            //         $items_competitors_table.="<th style='background-color:".$c->color."'>".$c->name."</th>";
            //     }
            // }
            $items_competitors_table.="</tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
            $j=0;   $i=0;
            // dd($tender);
            foreach ( $tender->items as $key => $value) {

                if ($value->type==1) {

                    ++$j;
                    $accept_bg="";
                    if ( $value->accepted_item==1) {
                        $value->accepted_item="نعم";
                        $accept_bg="#68c168";
                    }elseif ($value->accepted_item==0) {
                        $value->accepted_item="جاري";
                        $accept_bg="";
                    }
                    $items_table.="
                        <tr>
                            <td colspan='2' style='text-align:center;'>".$j  ."</td>
                            <td colspan='3' style='text-align:center;'>".  $value->item_no."</td>
                            <td colspan='3' style='text-align:center;'>".  $value->item."</td>
                            <td colspan='2' style='text-align:center;'>".  $value->item_quantity."</td>
                            <td colspan='2' style='text-align:center;'>".  $value->item_price."</td>
                            <td colspan='3' style='text-align:center;'> ". $value->unit_name ."</td>
                            <td colspan='2' style='text-align:center; background-color:". $accept_bg."'> ". $value->accepted_item ."</td>

                        </tr>

                    ";
                }elseif ($value->type==2) {
                    ++$i;

                    // if ( $value->price_accepted==1) {
                    //     $value->price_accepted="نعم";
                    // }elseif ($value->price_accepted==0) {
                    //     $value->price_accepted="لا";
                    // }
                    $color=($min_prices->contains('id',$value->it_id) )? 'yellow !important':'unset';
                    $items_suppliers_table.="
                        <tr style=\"background-color:$color;\">
                            <td colspan='1' style='text-align:center'>".$i  ."</td>
                            <td colspan='3' style='text-align:center'>".  $value->item_no."</td>
                            <td colspan='3' style='text-align:center'>".  $value->item."</td>
                            <td colspan='3' style='text-align:center'>".  $value->trade_name."</td>
                            <td colspan='2' style='text-align:center'>".  $value->supplier_name."</td>
                            <td colspan='1' style='text-align:center'> ". $value->item_price ."</td>
                            <td colspan='2' style='text-align:center'> ". $value->expired_date ."</td>
                            <td colspan='3' style='text-align:center'> ". $value->duration ."</td>

                        </tr>

                    ";
                }
            }
            $n=0;
            foreach ( $tender->items as $key => $value) {
                $n++;
                $items_competitors_table.="
                    <tr>
                        <td  style='text-align:center'>".$n ."</td>
                        <td  style='text-align:center'>".  $value->item."</td>";
                        // if ($comp ) {
                        //     foreach ($comp as $c) {
                        //         $items_data=$tender->competitorsItems->where('competitor_id',$c->id)->where('item_id',$value->item_id);

                        //             $items_competitors_table.="<td style='background-color:".$c->color."'>";
                        //             $data="";
                        //             if($items_data){
                        //                 foreach($items_data as $it){
                        //                     $data.=$it->item_price.' ';
                        //                 }
                        //                 $items_competitors_table.=$data;
                        //             }


                        //         $items_competitors_table.="</td>";
                        //     }
                        // }

                        foreach($tender->competitorsItems as $item){

                            if($item->item_id ==  $value->item_id){
                                $items_competitors_table.="<td style='background-color:".$item->color."'> ";
                                $items_competitors_table.=$item->item_price.' ';
                                $items_competitors_table.="</td>";
                            }else{
                                $items_competitors_table.="<td style='background-color:".$item->color."'> ---";

                                $items_competitors_table.="</td>";
                            }


                        }



                        $items_competitors_table.="</tr>
                 ";
            }
            $items_table.="
            </tbody>
            </table>
            ";
            $items_suppliers_table.="
            </tbody>
            </table>
            ";
            $items_competitors_table.="
            </tbody>
            </table>
            ";
            $tender_table.="<tr> <td colspan='17'>". $items_table."</td></tr>";
            $tender_table.= "
             <tr>
                <td  style='text-align:center;font-weight:bold;color:white;background-color:blue' colspan=\"17\">بيانات تسعير المناقصة
                </td>
            </tr>
            ";
            $tender_table.= "<tr> <td colspan='17'>". $items_suppliers_table."</td></tr>";
            $tender_table.= "
             <tr>
                <td colspan=\"17\"  style='text-align:center;font-weight:bold; color:white;background-color:blue'>
                تقييم الأسعار
                </td>
            </tr>
            ";
            $tender_table.= "<tr> <td colspan='17'>". $items_competitors_table."</td></tr>";
            $tender_table.="
            </tbody>
            </table>

            ";
            if ($request->val=='export') {
                echo $tender_table;
                $filename="تقرير تفاصيل المناقصة";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$tender_table]);
            }
        }elseif ($request->report_type==7){
            if(!$request->item){
                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار الصنف');
                    return back()->withInput();
                }else if ($request->val=='pdf') {
                    session()->flash('error','يجب اختيار الصنف');
                    return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار الصنف']);
                }
            }
            $item_name=Item::where('id',$request->item)->pluck('name')->first();
            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','tenders.tender_no','clients.name as client','t_it.supplied_quantity','items.name as item_name','t_it.item_quantity as tender_quantity','t_it.item_price as tender_price','t_it.accepted_item')
            ->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })
            ->where('t_it.item_id',$request->item);
            if ($request->created_date_from) {
                $request->created_date_from=date('Y-m-d',strtotime($request->created_date_from));
                $tenders = $tenders->where('tenders.created_at','>=',$request->created_date_from);
            }

            if ($request->created_date_to) {
                $request->created_date_to=date('Y-m-d H:i:s',strtotime($request->created_date_to.'23:59:59'));
                $tenders = $tenders->where('tenders.created_at','<=',$request->created_date_to);
            }
            $tenders=$tenders->join('tender_items as t_it', function($join) use($request){
                $join->on('tenders.id', '=', 't_it.tender_id')->where('t_it.type',1)->where('t_it.accepted_item',1)
                ->whereNull('t_it.deleted_at');
            })->leftJoin('clients', function($join){
                $join->on('clients.id', '=', 'tenders.client_id')
                ->whereNull('clients.deleted_at');
            })->leftJoin('items', function($join){
                $join->on('items.id', '=', 't_it.item_id')
                ->whereNull('items.deleted_at');
            })
            ->get();

            $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>رقم المناقصة</th>
            <th> المؤسسة</th>
            <th> فرع الشركة</th>
            <th>اسم الصنف</th>
            <th>كمية المناقصة</th>
            <th>الكمية الموردة</th>
            <th>توريد كلي / جزئي ؟</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
            if(count($tenders)>0){
                foreach ($tenders as $key => $tender) {
                    $supply_type="";
                    $color="";
                    if ($tender->tender_quantity>$tender->supplied_quantity && $tender->supplied_quantity !=0) {
                        $supply_type="جزئي";
                        $color="yellow";
                    }else  if ($tender->tender_quantity==$tender->supplied_quantity) {
                        $supply_type="كلي";
                        $color="green";
                    }
                    $i=$key+1;
                    $table.="
                        <tr>
                            <td>". $i  ."</td>
                            <td class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                            <td>".  $tender->client." </td>
                            <td>".  $tender->branch_name." </td>
                            <td>".  $tender->item_name." </td>
                            <td> ". $tender->tender_quantity ."</td>
                            <td> ". $tender->supplied_quantity ."</td>
                            <td style='background-color: $color'> ". $supply_type ."</td>".
                        "</tr>";
                }
            }else{
                $table.="
                <tr>
                    <td  style='text-align:center;font-weight:bold;' colspan=\"8\"> الصنف $item_name غير موجود بأي مناقصة </td>
                </tr>
                ";
            }
            $table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export'){
                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $table;
                $filename="حركات الصنف $item_name";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename="حركات الصنف $item_name";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender7', compact('tenders','filename'));
                $html_content = $view->render();
                // $html_content = $items_table;


                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('l','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$table]);
            }
        }elseif ($request->report_type==8){
            if(!$request->tender_status){
                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار حالة المناقصة');
                    return back()->withInput();
                }else if ($request->val=='pdf') {
                    session()->flash('error','يجب اختيار حالة المناقصة');
                    return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار حالة المناقصة']);
                }
            }
            $tender_status='';
            $tender_status_name='';
            if ($request->tender_status==1) {
            $tender_status_name='المناقصات المنجزة';
                $tender_status=1;
            }else if ($request->tender_status==2) {
            $tender_status_name='المناقصات غير المنجزة';

                $tender_status=0;
            }
            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','sector_constants.name as sector_name','tenders.tender_no','clients.name as client')
            ->where('tenders.complete_status',$tender_status);
            if ($request->created_date_from) {
                $request->created_date_from=date('Y-m-d',strtotime($request->created_date_from));
                $tenders = $tenders->where('tenders.created_at','>=',$request->created_date_from);
            }

            if ($request->created_date_to) {
                $request->created_date_to=date('Y-m-d H:i:s',strtotime($request->created_date_to.'23:59:59'));
                $tenders = $tenders->where('tenders.created_at','<=',$request->created_date_to);
            }
            $tenders=$tenders->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })->leftJoin('system_constants as sector_constants', function($join) {
                $join->on('sector_constants.value', '=', 'tenders.sector')->where('sector_constants.type','sector_type')->whereNull('sector_constants.deleted_at');
            })
            ->get();
            $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>المناقصة</th>
            <th>فرع الشركة</th>
            <th>القطاع</th>
            <th>المؤسسة</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
            if(count($tenders)>0){
                foreach ($tenders as $key => $tender) {
                    $i=$key+1;
                    $table.="
                        <tr>
                            <td>". $i  ."</td>
                            <td class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                            <td>".  $tender->branch_name." </td>
                            <td>".  $tender->sector_name." </td>
                            <td> ". $tender->client ."</td>
                        </tr>";
                }
            }else{
                $table.="
                <tr>
                    <td  style='text-align:center;font-weight:bold;' colspan=\"5\"> لا يوجد مناقصات </td>
                </tr>
                ";
            }
            $table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export'){
                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $table;
                $filename=" $tender_status_name";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename=" $tender_status_name";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender8', compact('tenders','filename'));
                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('P','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$table]);
            }
        }elseif ($request->report_type==9){
            if(!$request->guarantee){
                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار حالة الكفالة');
                    return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار حالة الكفالة']);
                }
            }
            $guarantee='';
            $guarantee_name='';
            if ($request->guarantee==1) {
            $guarantee_name='الكفالة المستردة';
                $guarantee=1;
            }else if ($request->guarantee==2) {
            $guarantee_name='الكفالة غير المستردة';

                $guarantee=0;
            }
            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','sector_constants.name as sector_name','tenders.tender_no','clients.name as client',)
            ->where('tenders.guarantee_status',$guarantee);
            if ($request->created_date_from) {
                $request->created_date_from=date('Y-m-d',strtotime($request->created_date_from));
                $tenders = $tenders->where('tenders.created_at','>=',$request->created_date_from);
            }

            if ($request->created_date_to) {
                $request->created_date_to=date('Y-m-d H:i:s',strtotime($request->created_date_to.'23:59:59'));
                $tenders = $tenders->where('tenders.created_at','<=',$request->created_date_to);
            }
            $tenders=$tenders->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })->leftJoin('system_constants as sector_constants', function($join) {
                $join->on('sector_constants.value', '=', 'tenders.sector')->where('sector_constants.type','sector_type')->whereNull('sector_constants.deleted_at');
            })
            ->get();
            $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
            <th>#</th>
            <th>المناقصة</th>
            <th>فرع الشركة</th>
            <th>القطاع</th>
            <th>المؤسسة</th>
            </tr>
            </thead>
            <tbody style='text-align:center;'>
            ";
            if(count($tenders)>0){
                foreach ($tenders as $key => $tender) {
                    $i=$key+1;
                    $table.="
                        <tr>
                            <td>". $i  ."</td>
                            <td class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                            <td>".  $tender->branch_name." </td>
                            <td>".  $tender->sector_name." </td>
                            <td> ". $tender->client ."</td>
                        </tr>";
                }
            }else{
                $table.="
                <tr>
                    <td  style='text-align:center;font-weight:bold;' colspan=\"5\"> لا يوجد مناقصات </td>
                </tr>
                ";
            }
            $table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export'){
                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $table;
                $filename="المناقصات بنوع $guarantee_name";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename="المناقصات بنوع $guarantee_name";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender9', compact('tenders','filename'));
                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('P','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$table]);
            }
            // dd( $tenders);
        }elseif ($request->report_type==10){

            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','tenders.notification_receipt_date','tenders.tender_no','clients.name as client_name')
            ->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })
            ;
            if ($request->tender) {
                $tenders = $tenders->where('tenders.id',$request->tender);
            }
            $tenders = $tenders->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->get();
            $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
                <th>#</th>
                <th>المناقصة</th>
                <th>المؤسسة</th>
                <th>فرع الشركة</th>
                <th>اسم الصنف</th>
                <th>الاسم التجاري</th>
                <th>تاريخ استلام أمر التوريد</th>
                <th>مدة التوريد</th>
            </tr>
            </thead>
            <tbody style='text-align:center'>
            ";
            if(count($tenders)>0){
                $ids = $tenders->pluck('id')->toArray();
                $ids = join(',', $ids);


                $tender_items=  DB::Select("
                    SELECT t_it2.tender_id,i.name AS item
                    ,item_trade_names.trade_name,s.duration

                    FROM tender_items t_it2
                    LEFT JOIN(
                    SELECT t.tender_id AS s_t,t.item_id AS s_i,t.duration,t.trade_name
                    FROM tender_items t
                    JOIN
                    (
                    SELECT ts.item_id, MIN(ts.item_price) AS minVal,ts.tender_id
                    FROM tender_items ts
                    WHERE ts.deleted_at IS NULL AND ts.type = 2
                    GROUP BY ts.item_id,ts.tender_id
                    ) t2 ON t.item_price = t2.minVal AND t.item_id = t2.item_id AND t.tender_id = t2.tender_id AND t.deleted_at IS NULL
                    ) s ON s.s_t=t_it2.tender_id AND s.s_i=t_it2.item_id
                    LEFT OUTER
                    JOIN items i ON i.id = t_it2.item_id AND i.deleted_at IS NULL

                    LEFT OUTER
                    JOIN item_trade_names ON item_trade_names.id = s.trade_name AND item_trade_names.deleted_at IS NULL
                    WHERE `t_it2`.`tender_id` IN($ids) AND `t_it2`.`deleted_at` IS NULL AND `t_it2`.`type` = 1 AND t_it2.accepted_item=1
                    ORDER BY t_it2.tender_id DESC
                ");

                if (count($tender_items)>0) {
                    foreach ($tenders as $key => $tender) {
                        $i=$key+1;

                        foreach ($tender_items as $item) {
                            if ($item->tender_id==$tender->id) {

                                $date="";
                                // Declare a date
                                if ($tender->notification_receipt_date &&$item->duration ) {

                                    $date = date_create($tender->notification_receipt_date );

                                    // Use date_add() function to add date object
                                    date_add($date, date_interval_create_from_date_string("$item->duration days"));
                                    $date =date_format($date, "Y-m-d") ;
                                }


                                // Display the added date
                                // echo date_format($date, "Y-m-d");
                                $table.="
                                <tr>
                                    <td>". $i  ."</td>
                                    <td class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                                    <td>".  $tender->client_name." </td>
                                    <td>".  $tender->branch_name." </td>

                                    <td>". $item->item  ."</td>
                                    <td>".  $item->trade_name ."</td>
                                    <td>".  $tender->notification_receipt_date ."</td>
                                    <td>".  $date ."</td>
                                    </tr>
                                ";
                            }
                        }

                    }
                }else{
                    $table.="
                    <tr>
                        <td  style='text-align:center;font-weight:bold;' colspan=\"8\">لا يوجد أصناف للمناقصة </td>
                    </tr>
                    ";
                }


            }else{
                $table.="
                <tr>
                    <td  style='text-align:center;font-weight:bold;' colspan=\"8\">لا يوجد أصناف للمناقصة </td>
                </tr>
                ";
            }
            $table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export'){
                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $table;
                $filename="الأصناف غير الموردة";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename="الأصناف غير الموردة";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender10', compact('tender_items','tenders','filename'));
                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('L','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$table]);
            }

        }elseif ($request->report_type==11){
            if(!$request->item){

                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار الصنف');
                    return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار الصنف']);
                 }
            }
            $item_name=Item::where('id',$request->item)->pluck('name')->first();
            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','item_trade_names.trade_name','tenders.representation_date','tenders.tender_no','clients.name as client','suppliers.ar_name as supplier','t_it2.id as it','items.name as item_name','t_it2.item_price as supplier_price')
            ->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })
            ->where('t_it2.item_id',$request->item);
            if ($request->created_date_from) {
                $request->created_date_from=date('Y-m-d',strtotime($request->created_date_from));
                $tenders = $tenders->where('tenders.created_at','>=',$request->created_date_from);
            }

            if ($request->created_date_to) {
                $request->created_date_to=date('Y-m-d H:i:s',strtotime($request->created_date_to.'23:59:59'));
                $tenders = $tenders->where('tenders.created_at','<=',$request->created_date_to);
            }
            $tenders=$tenders->
            leftJoin('tender_items as t_it2', function($join) use($request){
                $join->on('tenders.id', '=', 't_it2.tender_id')
                ->whereNull('t_it2.deleted_at')->where('t_it2.type',2);
            })->leftJoin('items', function($join) {
                $join->on('items.id', '=', 't_it2.item_id')->whereNull('items.deleted_at');
            })->leftJoin('suppliers', function($join) {
                $join->on('t_it2.supplier_id', '=', 'suppliers.id')->whereNull('suppliers.deleted_at');
            })->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('item_trade_names', function($join) {
                $join->on('item_trade_names.id', '=', 't_it2.trade_name')->whereNull('item_trade_names.deleted_at');
            })
            ->orderBy('tenders.id','desc')->get()->groupBy('id');
            //  dd($tenders);
            // ->get()->groupBy('id');
            $min_prices_items=$tenders->map(function($data,$key){
                return[
                    'tender_id'=>$key,
                    'it'=>$data->where('supplier_price', $data->min('supplier_price'))->pluck('it')->first(),
                ];
            })->toArray();
            $min_prices=array_column($min_prices_items, 'it','tender_id');


            @ob_start();
                echo  chr(239) . chr(187) . chr(191);
            $items_table="
                <table border='1' class='table table-bordered text-center'>
                <thead>
                <tr>
                <th>#</th>
                <th>المناقصة</th>
                <th> المؤسسة</th>
                <th>فرع الشركة</th>
                <th>تاريخ تقديم المناقصة</th>
                <th>اسم الصنف</th>
                <th>الاسم التجاري</th>
                <th>المورد</th>
                <th>سعر المورد</th>
                </tr>
                </thead>
                <tbody style='text-align:center;'>
                ";
                // dd($tenders);
             if(count($tenders)>0){
                $i=0;
                foreach ($tenders as $key => $tender) {
                    foreach ($tender as $k =>  $item) {
                        $i++;

                    if (!empty($item->supplier_price)) {
                        if (array_key_exists($item->id,$min_prices) && $min_prices["$item->id"]==$item->it) {
                            $color="yellow !important";
                        }else{
                         $color="unset";
                         }
                    }else{
                        $color="unset";
                    }

                       $items_table.="
                     <tr style='background-color:".$color.";'>
                         <td>". $i  ."</td>
                         <td class='get-tender' data-id='$item->id'>".  $item->tender_no."</td>
                         <td>".  $item->client."</td>
                         <td>".  $item->branch_name."</td>
                         <td>".  $item->representation_date." </td>
                         <td>".  $item->item_name." </td>
                         <td>".  $item->trade_name." </td>
                         <td> ". $item->supplier ."</td>
                         <td> ". $item->supplier_price ."</td>
                     </tr>
                     ";
                    }
                }
             }else{
                $items_table.="
                <tr>
                    <td  colspan=\"9\" style='text-align:center;font-weight:bold;'>$item_name غير مسعر من قبل أي مورد</td>
                </tr>
                ";
            }
            $items_table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export') {

               echo $items_table;
               $filename=" تقرير أسعار الموردين ل " . $item_name;
               header("Content-Type: application/xls");
               header("Content-Disposition: attachment; filename=".$filename.".xls");
               header("Pragma: no-cache");
               header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename=" تقرير أسعار الموردين ل " . $item_name;
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender11', compact('tenders','filename'));
                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('L','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            }else if ($request->val=='view') {
               return response()->json(['status'=>true,'table'=>$items_table]);
           }

        }elseif ($request->report_type==12){
            // $tenders=Tender::select('tenders.id','tenders.tender_no','unit_constants.name as unit_name','clients.name as client','items.name as item','t_it.item_quantity','t_it2.item_price as supplier_price','suppliers.ar_name as supplier')
            // ->where('tenders.complete_status',0);
            // if ($request->tender) {
            //     $tenders = $tenders->where('tenders.id',$request->tender);
            // }

            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','tenders.tender_no','clients.name as client_name')
            ->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })
            ->where('tenders.complete_status',0);
            if ($request->tender) {
                $tenders = $tenders->where('tenders.id',$request->tender);
            }
            $tenders = $tenders->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->get();
            $table="
                    <table border='1' class='table table-bordered text-center'>
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>المناقصة</th>
                    <th>المؤسسة</th>
                    <th>فرع الشركة</th>
                    <th>اسم الصنف</th>
                    <th>الاسم التجاري</th>
                    <th>الوحدة</th>
                    <th>المورد</th>
                    <th>سعر الشراء</th>
                    <th>الكمية</th>
                    <th>الكمية الموردة</th>
                    <th>الكمية المتبقية</th>

                    </tr>
                    </thead>
                    <tbody style='text-align:center'>
                    ";
            if(count($tenders)>0){
                $ids = $tenders->pluck('id')->toArray();
                $ids = join(',', $ids);


                $tender_items=  DB::Select("
                    SELECT t_it2.tender_id,t_it2.item_quantity AS tender_quantity,t_it2.item_price AS tender_price,i.name AS item,sys_const.name AS unit_name,t_it2.item_quantity,t_it2.supplied_quantity, (t_it2.item_quantity - t_it2.supplied_quantity) AS remain_quantity
                    ,item_trade_names.trade_name,s.supplier_price
                    ,sup.ar_name AS supplier_name,s.supplier_price
                    FROM tender_items t_it2
                    LEFT JOIN(
                    SELECT t.tender_id AS s_t,t.item_id AS s_i,t.item_price AS supplier_price,t.trade_name, t.supplier_id AS supplier
                    FROM tender_items t
                    JOIN
                    (
                    SELECT ts.item_id, MIN(ts.item_price) AS minVal,ts.tender_id
                    FROM tender_items ts
                    WHERE ts.deleted_at IS NULL AND ts.type = 2
                    GROUP BY ts.item_id,ts.tender_id
                    ) t2 ON t.item_price = t2.minVal AND t.item_id = t2.item_id AND t.tender_id = t2.tender_id AND t.deleted_at IS NULL
                    ) s ON s.s_t=t_it2.tender_id AND s.s_i=t_it2.item_id
                    LEFT OUTER
                    JOIN items i ON i.id = t_it2.item_id AND i.deleted_at IS NULL
                    LEFT OUTER
                    JOIN suppliers sup ON sup.id = s.supplier AND sup.deleted_at IS NULL

                    LEFT OUTER
                    JOIN system_constants sys_const ON sys_const.value = t_it2.unit AND sys_const.type='unit' AND sys_const.deleted_at IS NULL
                    LEFT OUTER
                    JOIN item_trade_names ON item_trade_names.id = s.trade_name AND item_trade_names.deleted_at IS NULL
                    WHERE `t_it2`.`tender_id` IN($ids) AND `t_it2`.`deleted_at` IS NULL AND `t_it2`.`type` = 1
                    AND t_it2.accepted_item=1
                    AND t_it2.supplied_quantity< t_it2.item_quantity
                    ORDER BY t_it2.tender_id DESC
                ");

                if (count($tender_items)>0) {
                    foreach ($tenders as $key => $tender) {
                        $i=$key+1;

                        foreach ($tender_items as $item) {
                            if ($item->tender_id==$tender->id) {
                                $table.="
                                <tr>
                                    <td>". $i  ."</td>
                                    <td class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                                    <td>".  $tender->client_name." </td>
                                    <td>".  $tender->branch_name." </td>

                                    <td>". $item->item  ."</td>
                                    <td>".  $item->trade_name ."</td>
                                    <td>".  $item->unit_name ."</td>
                                    <td>".  $item->supplier_name ."</td>
                                    <td>".  $item->supplier_price ."</td>
                                    <td>".  $item->item_quantity ."</td>
                                    <td>".  $item->supplied_quantity ."</td>
                                    <td>".  $item->remain_quantity ."</td>
                                    </tr>
                                ";
                            }
                        }

                    }
                }else{
                    $table.="
                    <tr>
                        <td  style='text-align:center;font-weight:bold;' colspan=\"12\">لا يوجد أصناف غير موردة </td>
                    </tr>
                    ";
                }


            }else{
                $table.="
                <tr>
                    <td  style='text-align:center;font-weight:bold;' colspan=\"12\">لا يوجد أصناف غير موردة </td>
                </tr>
                ";
            }
            $table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export'){
                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $table;
                $filename="الأصناف غير الموردة";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            }else if($request->val=='pdf'){
                $filename="الأصناف غير الموردة";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();

                $view = View::make('/admin/pdf/tender12', compact('tenders','tender_items','filename'));
                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('L','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$table]);
            }
            // dd($tender_items,$tenders);

        }elseif ($request->report_type==13){

            $tenders=Tender::select('tenders.id','branch_constants.name as branch_name','tenders.bid_status','tenders.tender_no','clients.name as client_name')
            ->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })
            ->where('tenders.bid_status',1)
            ;
            if ($request->tender) {
                $tenders = $tenders->where('tenders.id',$request->tender);
            }
            $tenders = $tenders->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->get();
            $table="
            <table border='1' class='table table-bordered text-center'>
            <thead>
            <tr>
                <th>#</th>
                <th>المناقصة</th>
                <th>المؤسسة</th>
                <th>فرع الشركة</th>
                <th>حالة العطاء</th>
            </tr>
            </thead>
            <tbody style='text-align:center'>
            ";



            if(count($tenders)>0){
                $idds = $tenders->pluck('id')->toArray();
                $ids = join(',', $idds);


                $tender_items=  DB::Select("
                    SELECT t_it2.tender_id,i.name AS item , i.item_no,t_it2.item_price
                    ,item_trade_names.trade_name,t_it2.item_id
                    FROM tender_items t_it2
                    LEFT JOIN(
                    SELECT t.tender_id AS s_t,t.item_id AS s_i,t.trade_name
                    FROM tender_items t
                    JOIN
                    (
                    SELECT ts.item_id, MIN(ts.item_price) AS minVal,ts.tender_id
                    FROM tender_items ts
                    WHERE ts.deleted_at IS NULL AND ts.type = 2
                    GROUP BY ts.item_id,ts.tender_id
                    ) t2 ON t.item_price = t2.minVal AND t.item_id = t2.item_id AND t.tender_id = t2.tender_id AND t.deleted_at IS NULL
                    ) s ON s.s_t=t_it2.tender_id AND s.s_i=t_it2.item_id
                    LEFT OUTER
                    JOIN items i ON i.id = t_it2.item_id AND i.deleted_at IS NULL
                    LEFT OUTER
                    JOIN item_trade_names ON item_trade_names.id = s.trade_name AND item_trade_names.deleted_at IS NULL
                    WHERE `t_it2`.`tender_id` IN($ids) AND `t_it2`.`deleted_at` IS NULL AND `t_it2`.`type` = 1 AND t_it2.accepted_item=0
                    ORDER BY t_it2.tender_id DESC
                ");

                // return $tender_items;
                if (count($tender_items)>0) {
                    $items_not_in=array_column($tender_items,'item_id');

                    // dd($ids,$items_not_in);
                    $competitorsItems=CompetitorsItems::select('competitors_items.tender_id','items.item_no','competitors_items.item_id','competitors_items.item_price','competitors.name as competitor')
                    ->whereIn('competitors_items.tender_id',$idds)
                    ->whereIn('competitors_items.item_id',$items_not_in)
                    ->leftJoin('competitors', function($join) {
                        $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
                    })->leftJoin('items', function($join) {
                        $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
                    })->get();
                    //dd($tenders , $items_not_in,$tender_items,$competitorsItems);
                    foreach ($tenders as $key => $tender) {
                        $i=$key+1;
                        if ($tender->bid_status==1) {
                            $tender->bid_status="جاري الترسية";
                        }
                        $table.="
                        <tr>
                        <td colspan=\"5\"  style='text-align:center;font-weight:bold; color:white;background-color:blue'>
                        بيانات المناقصة
                        </td>
                        </tr>
                            <tr>
                                <td>". $i  ."</td>
                                <td class='get-tender' data-id='$tender->id'>".  $tender->tender_no."</td>
                                <td>".  $tender->client_name." </td>
                                <td>".  $tender->branch_name." </td>
                                <td>". $tender->bid_status  ."</td>
                            </tr>
                            ";
                        $i_table="
                            <table border='1' class='table table-bordered text-center'>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الصنف</th>
                                <th>الاسم التجاري</th>
                                <th>السعر</th>
                            </tr>
                            </thead>
                            <tbody style='text-align:center'>
                            ";
                            $n=0;
                        foreach ($tender_items as $item) {
                            if ($item->tender_id==$tender->id) {
                                $n++;
                                $i_table.="
                                    <tr>
                                    <td> $n</td>
                                    <td>". $item->item_no ."</td>
                                    <td>".  $item->item ."</td>
                                    <td>".  $item->item_price ."</td>
                                    </tr>
                                ";
                            }
                        }
                        $i_table.="</tbody>
                        </table>";
                        $table.="
                        <tr>
                            <td colspan=\"5\"  style='text-align:center;font-weight:bold; color:white;background-color:blue'>
                            أصناف المناقصة
                            </td>
                        </tr>
                        <tr>
                            <td colspan='5'>$i_table<td>
                        </tr>";
                        $ctable="
                        <table border='1' class='table table-bordered text-center'>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الصنف</th>
                            <th>الشركة المنافسة</th>
                            <th>السعر</th>
                        </tr>
                        </thead>
                        <tbody style='text-align:center'>
                        ";
                        foreach ($competitorsItems as $k=>$citem) {
                            $j=++$k;
                            if ($citem->tender_id==$tender->id) {
                                $ctable.="
                                <tr>
                                    <td>". $j  ."</td>
                                    <td>".  $citem->item_no."</td>
                                    <td>".  $citem->competitor." </td>
                                    <td>". $citem->item_price  ."</td>

                                    </tr>
                                ";
                            }

                        }
                        $ctable.="</tbody>
                        </table>";
                        $table.="
                        <tr>
                        <td colspan=\"5\"  style='text-align:center;font-weight:bold; color:white;background-color:blue'>
                        الأسعار المنافسة
                        </td>
                        </tr>
                        <tr>
                        <td colspan='5'>$ctable<td>
                        </tr>";

                    }
                }else{
                    $table.="
                    <tr>
                        <td  style='text-align:center;font-weight:bold;' colspan=\"5\">لا يوجد أصناف  </td>
                    </tr>
                    ";
                }


            }else{
                $table.="
                <tr>
                    <td  style='text-align:center;font-weight:bold;' colspan=\"54\">لا يوجد أصناف  </td>
                </tr>
                ";
            }
            $table.="
            </tbody>
            </table>
            ";
            if ($request->val=='export'){
                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $table;
                $filename="الأصناف التي لم يتم ترسيتها";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            } else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$table]);
            }

        }elseif ($request->report_type==14){
                if(!$request->tender){
                    if ($request->val=='export') {
                        session()->flash('error','يجب اختيار المناقصة');
                        return back()->withInput();
                    }else if ($request->val=='view') {
                        return response()->json(['status'=>false,'data'=>'يجب اختيار المناقصة']);
                    }
                }

            $tender=Tender::select('tenders.id','branch_constants.name as branch_name','sector_constants.name as sector_name','tenders.guarantee_rate','tenders.guarantee_value','tenders.guarantee_status','tenders.tender_no','tenders.guarantee_no','tenders.transfer_price','tenders.created_at'
            ,'tenders.representation_date','tenders.bid_status','tenders.complete_status','tenders.notification_receipt_date','tenders.manager','clients.name as client'
            ,'currency_constants.name as curreny_name','tax_constants.name as tax_name','guarantee_type_constants.name as guarantee_type_name')
            ->where('tenders.id',$request->tender)
            ->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('system_constants as currency_constants', function($join) {
                $join->on('currency_constants.value', '=', 'tenders.currency')->where('currency_constants.type','currency')->whereNull('currency_constants.deleted_at');
            })->leftJoin('system_constants as tax_constants', function($join) {
                $join->on('tax_constants.value', '=', 'tenders.tax')->where('tax_constants.type','tax')->whereNull('tax_constants.deleted_at');
            })->leftJoin('system_constants as guarantee_type_constants', function($join) {
                $join->on('guarantee_type_constants.value', '=', 'tenders.guarantee_type')->where('guarantee_type_constants.type','guarantee_type')->whereNull('guarantee_type_constants.deleted_at');
            })->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })->leftJoin('system_constants as sector_constants', function($join) {
                $join->on('sector_constants.value', '=', 'tenders.sector')->where('sector_constants.type','sector_type')->whereNull('sector_constants.deleted_at');
            })
            ->first();
            $tender->items=TenderItem::where('tender_id',$tender->id)
            ->select("tender_items.id as it_id",'tender_items.accepted_item','tender_items.item_quantity',
            'tender_items.item_price','tender_items.duration','unit_constants.name as unit_name','tender_items.expired_date',
            'item_trade_names.trade_name','tender_items.item_id',
            'tender_items.type',
            'items.name as item','items.item_no','suppliers.ar_name as supplier_name')
            ->leftJoin('items', function($join) {
                $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
            })->leftJoin('suppliers', function($join) {
                $join->on('suppliers.id', '=', 'tender_items.supplier_id')->whereNull('suppliers.deleted_at');
            })->leftJoin('system_constants as unit_constants', function($join) {
                $join->on('unit_constants.value', '=', 'tender_items.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
            })->leftJoin('item_trade_names', function($join) {
                $join->on('item_trade_names.id', '=', 'tender_items.trade_name')->whereNull('item_trade_names.deleted_at');
            })
            ->get();
            // $tender->competitorsItems=CompetitorsItems::select('items.name as item','competitors_items.item_price','competitors.name as competitor')
            // ->where('competitors_items.tender_id',$tender->id)
            // ->leftJoin('items', function($join) {
            //     $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
            // })->leftJoin('competitors', function($join) {
            //     $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
            // })->get();


            $comp=Competitor::orderby('id','desc')->get(['id','name','color']);

            $tender->competitorsItems=CompetitorsItems::
            select('competitors_items.id','items.name as item','competitors_items.item_price','competitors_items.competitor_id',
            'competitors_items.item_id','competitors.color')
            ->where('competitors_items.tender_id',$tender->id)
            ->leftJoin('competitors', function($join) {
                $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
            })->leftJoin('items', function($join) {
                $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
            })->orderby('competitors_items.id','desc')
            ->get();

            $min_prices=DB::select("
                SELECT t.id
                FROM tender_items t
                JOIN
                (
                SELECT ts.item_id, MIN(ts.item_price) AS minVal,ts.tender_id
                FROM tender_items ts
                WHERE ts.deleted_at IS NULL AND ts.tender_id=$tender->id AND ts.deleted_at IS NULL AND ts.type = 2
                GROUP BY ts.item_id,ts.tender_id
                ) t2 ON t.item_price = t2.minVal AND t.item_id = t2.item_id AND t.tender_id = t2.tender_id AND t.deleted_at IS NULL
            ");
            $min_prices=collect($min_prices);
            @ob_start();
            echo  chr(239) . chr(187) . chr(191);
            if ( $tender->guarantee_status==1) {
                $tender->guarantee_status="نعم";
            }elseif ($tender->guarantee_status==0) {
                $tender->guarantee_status="لا";
            }
            if ( $tender->bid_status==1) {
                $tender->bid_status="جاري الترسية";
            }elseif ($tender->bid_status==0) {
                $tender->bid_status="لم يتم الترسية";
            }elseif ($tender->bid_status==2) {
                $tender->bid_status="تم الترسية";
            }
            $row_color='';
            if ($tender->complete_status==1) {
                $row_color='#6cff742b';

                $tender->complete_status="نعم";
            }elseif ($tender->complete_status==0) {
                $row_color='unset';

                $tender->complete_status="لا";
            }

            // return $tender;
            $tender_table="";
            // dd($tender);

            $items_table="
            <table border='1' style='width:100%'  class='table table-bordered text-center'>
            <thead>
            <tr>
            <th colspan='2'>#</th>
            <th colspan='3'>رقم الصنف</th>
            <th colspan='3'>اسم الصنف</th>
            <th colspan='2'>الكمية</th>
            <th colspan='2'>السعر</th>
            <th colspan='3'>الوحدة</th>
            </tr>
            </thead>
            <tbody style='text-align:center'>
            ";


            $j=0;   $i=0;
            // dd($tender);
            foreach ( $tender->items as $key => $value) {

                if ($value->type==1 && $value->accepted_item==1) {

                    ++$j;
                    $accept_bg="";
                    if ( $value->accepted_item==1) {
                        // $value->accepted_item="نعم";
                        $accept_bg="#68c168";
                    }elseif ($value->accepted_item==0) {
                        // $value->accepted_item="جاري";
                        $accept_bg="";
                    }
                    $items_table.="
                        <tr>
                            <td colspan='2' style='text-align:center;'>".$j  ."</td>
                            <td colspan='3' style='text-align:center;'>".  $value->item_no."</td>
                            <td colspan='3' style='text-align:center;'>".  $value->item."</td>
                            <td colspan='2' style='text-align:center;'>".  $value->item_quantity."</td>
                            <td colspan='2' style='text-align:center;'>".  $value->item_price."</td>
                            <td colspan='3' style='text-align:center;'> ". $value->unit_name ."</td>

                        </tr>

                    ";
                }elseif ($value->type==2) {
                    ++$i;


                    $color=($min_prices->contains('id',$value->it_id) )? 'yellow !important':'unset';

                }
            }

            $items_table.="
            </tbody>
            </table>
            ";

            $tender_table.=$items_table;

            if ($request->val=='export') {
                // echo $tender_table;
                // $filename="تقرير الاصناف التي تمت ترسيتها ";
                // header("Content-Type: application/xls");
                // header("Content-Disposition: attachment; filename=".$filename.".xls");
                // header("Pragma: no-cache");
                // header("Expires: 0");


                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $items_table;
                $filename="تقرير الاصناف التي تمت ترسيتها ";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");

            }else if($request->val=='pdf'){
                $filename="تقرير الاصناف التي تمت ترسيتها";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();
// return $tender;
                $view = View::make('/admin/pdf/tender14', compact('tender','filename'));

                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('L','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            }else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$tender_table]);
            }

        }elseif ($request->report_type==15){
            if(!$request->tender){
                if ($request->val=='export') {
                    session()->flash('error','يجب اختيار المناقصة');
                    return back()->withInput();
                }else if ($request->val=='view') {
                    return response()->json(['status'=>false,'data'=>'يجب اختيار المناقصة']);
                }
            }

            $tender=Tender::select('tenders.id','branch_constants.name as branch_name','sector_constants.name as sector_name','tenders.guarantee_rate','tenders.guarantee_value','tenders.guarantee_status','tenders.tender_no','tenders.guarantee_no','tenders.transfer_price','tenders.created_at'
            ,'tenders.representation_date','tenders.bid_status','tenders.complete_status','tenders.notification_receipt_date','tenders.manager','clients.name as client'
            ,'currency_constants.name as curreny_name','tax_constants.name as tax_name','guarantee_type_constants.name as guarantee_type_name')
            ->where('tenders.id',$request->tender)
            ->leftJoin('clients', function($join) {
                $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('system_constants as currency_constants', function($join) {
                $join->on('currency_constants.value', '=', 'tenders.currency')->where('currency_constants.type','currency')->whereNull('currency_constants.deleted_at');
            })->leftJoin('system_constants as tax_constants', function($join) {
                $join->on('tax_constants.value', '=', 'tenders.tax')->where('tax_constants.type','tax')->whereNull('tax_constants.deleted_at');
            })->leftJoin('system_constants as guarantee_type_constants', function($join) {
                $join->on('guarantee_type_constants.value', '=', 'tenders.guarantee_type')->where('guarantee_type_constants.type','guarantee_type')->whereNull('guarantee_type_constants.deleted_at');
            })->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            })->leftJoin('system_constants as sector_constants', function($join) {
                $join->on('sector_constants.value', '=', 'tenders.sector')->where('sector_constants.type','sector_type')->whereNull('sector_constants.deleted_at');
            })
            ->first();

          $competitorsItems=CompetitorsItems::select('competitors_items.id','competitors_items.awarded','competitors_items.item_id','items.name as item','competitors_items.item_price','competitors_items.competitor_id','competitors.name as competitor','competitors_items.currency_id','competitors_items.note','s.name as curreny_name')
            ->where('competitors_items.tender_id',$tender->id)->where('competitors_items.awarded',1)
            ->leftJoin('items', function($join) {
                $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
            })->leftJoin('competitors', function($join) {
                $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
            })->leftJoin('system_constants as s', function($join) {
                $join->on('competitors_items.currency_id', '=', 's.value')->where('s.type','currency')->whereNull('s.deleted_at');
            })->get();
            $tender_table="";

             $items_table="
            <table border='1' style='width:100%'  class='table table-bordered text-center'>
            <thead>
            <tr>
            <th colspan='2'>#</th>
            <th colspan='2'>اسم الصنف</th>
            <th colspan='2'>السعر</th>
            <th colspan='2'>العملة</th>
            <th colspan='2'>الشركة المنافسة</th>
            <th colspan='2'>ملاحظات</th>
            </tr>
            </thead>
            <tbody style='text-align:center'>
            ";



            $j=0;   $i=0;
            // dd($tender);
            foreach ($competitorsItems as  $citem) {


                    ++$j;

                    $items_table.="
                        <tr>
                            <td colspan='2' style='text-align:center;'>".$j  ."</td>
                            <td colspan='2' style='text-align:center;'>".  $citem->item."</td>
                            <td colspan='2' style='text-align:center;'>".  $citem->item_price."</td>
                            <td colspan='2' style='text-align:center;'>".  $citem->curreny_name."</td>
                            <td colspan='2' style='text-align:center;'>".  $citem->competitor."</td>
                            <td colspan='2' style='text-align:center;'> ". $citem->note ."</td>

                        </tr>

                    ";

            }

            $items_table.="
            </tbody>
            </table>
            ";

            $tender_table.=$items_table;
            if ($request->val=='export') {
                // echo $tender_table;
                // $filename="تقرير الاصناف التي تمت ترسيتها على المنافسين ";
                // header("Content-Type: application/xls");
                // header("Content-Disposition: attachment; filename=".$filename.".xls");
                // header("Pragma: no-cache");
                // header("Expires: 0");

                @ob_start();
                echo  chr(239) . chr(187) . chr(191);
                echo $tender_table;
                $filename="تقرير الاصناف التي تمت ترسيتها على المنافسين ";
                header("Content-Type: application/xls");
                header("Content-Disposition: attachment; filename=".$filename.".xls");
                header("Pragma: no-cache");
                header("Expires: 0");


            }else if($request->val=='pdf'){
                $filename="تقرير الاصناف التي تمت ترسيتها على المنافسين ";
                $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();
// return $tender;
                $view = View::make('/admin/pdf/tender15', compact('competitorsItems','filename'));

                $html_content = $view->render();
                // $html_content = $items_table;

                $lg = Array();

                $lg['a_meta_charset'] = 'UTF-8';

                $lg['a_meta_dir'] = 'rtl';

                $lg['a_meta_language'] = 'ar';

                $lg['w_page'] = 'page';



                TCPDF::setHeaderCallback(function($pdf) use ($setting){


                });

                TCPDF::setFooterCallback(function($pdf) {

                $pdf->SetY(-9);

                $pdf->SetFont('arial', '', 9);

                $pdf->Line(0, 285, 250, 285, '');

                $pdf->WriteHTML('<table>

                <tr>

                <td width="40%" style="font-size:9px;text-align:right">طبع بواسطة : '.Auth::user()->name.'</td>

                <td width="60%" style="font-size:9px;text-align:left">تاريخ الطباعة : '.date('Y-m-d').' - الساعة :'.date('H:i:s').'</td>

                </tr>

                </table>',true, false, true, false, '');

                });
                TCPDF::setLanguageArray($lg);

                TCPDF::SetFont('arial', '', 14);

                TCPDF::SetAutoPageBreak(true, 12);
                TCPDF::SetMargins(5, 15, 5, 5);
                TCPDF::SetTitle($filename);

                // TCPDF::SetMargins(5,5,5,5);
                TCPDF::AddPage('P','A4');
                TCPDF::writeHTML($html_content, true, false, true, false, '');

                TCPDF::SetTitle($filename);

                TCPDF::setRTL(true);
                // ob_end_clean();

                TCPDF::Output('tender.pdf');
            }else if ($request->val=='view') {
                return response()->json(['status'=>true,'table'=>$tender_table]);
            }

        }
    }
    public function get_clients(Request $request)
    {
        $clients= [];
        if($request->has('q')){
            $search = $request->q;
            $clients =Client::select("id", "ar_name")
                ->where('status',1)
                ->where('ar_name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($clients);
    }
    public function get_items(Request $request)
    {

        $items= [];
        if($request->has('q')){

            $search = $request->q;
            $items =Item::select("id", "name")
                ->where('status',1)
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($items);
    }

    public function get_tenders(Request $request)
    {
        $tenders= [];
        if($request->has('q')){
            $search = $request->q;
            $tenders =Tender::select("tenders.id","tenders.users",'branch_constants.name as branch_name', "tenders.tender_no",'clients.name as client')
            ->leftJoin('clients', function($join)
            {
               $join->on('clients.id','=','tenders.client_id')->whereNull('clients.deleted_at');
            })->leftJoin('system_constants as branch_constants', function($join) {
                $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
            });

            // dd($user_id);
            // ->where('tenders.status',1)
            $tenders=$tenders->where('clients.name', 'LIKE', "%$search%")
            ->orWhere('tenders.tender_no', 'LIKE', "%$search%");

            $user_id=Auth::id();
            if($user_id == 1){
                // dd($user_id);
            }else{
                $tenders=$tenders->whereRaw('FIND_IN_SET('.$user_id.',`users`)');
            }

            $tenders=$tenders->get();
        }


        return response()->json($tenders);
    }
}


