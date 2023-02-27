<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SystemConstant;
use App\Models\Tender;
use App\Models\Client;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\Setting;
use App\Models\TenderItem;
use App\Models\ItemTradeNames;
use App\Models\CompetitorsItems;
use App\Models\Competitor;
use App\Models\Notification;
use App\Models\User;
use App\Models\ItemsAdded;
use App\Models\SuppliedTenderItems;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF;

use Illuminate\Support\Facades\Validator;


class TenderController extends Controller
{
    const PAGINATION_NO=20;

    use FileUploadTrait;
    public function index(Request $request )
    {


        // dd(Auth::user()->with('permissions')->get());
        $data=[];
        $currency_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','currency']])->orderBy('order')->get();
        $guarantee_type_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','guarantee_type']])->orderBy('order')->get();
        $tax_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','tax']])->orderBy('order')->get();
        $unit_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','unit']])->orderBy('order')->get();
        $company_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','company_branches']])->orderBy('order')->get();
        $sectors_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','sector_type']])->orderBy('order')->get();
        $order_tenders_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','order_tenders']])->orderBy('order')->get();
        $order_type_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','order_type']])->orderBy('order')->get();

        $users=User::select('id','name')->where('status',1)->orderBy('id','asc')->get();


        //$durations_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','supplying_duration']])->orderBy('order')->get();

        //$tender_types=SystemConstant::select('id','name','value','type')->where([['status',1],['type','tender_type']])->orderBy('order')->get();
        $allowed_type_arr=[];
        // foreach ($tender_types as  $tender_type) {
        //     // dd("tender_type_$value");
        //     if (Auth::user()->hasPermission("tender_type_$tender_type->value")) {
        //         $allowed_type_arr[]=$tender_type;
        //     }
        // }
        // dd();
        // $clients=Client::select('id','ar_name')->where('status',1)->get();
        $items=Item::select('id','name')->where('status',1)->get();
        $suppliers=Supplier::select('id','ar_name')->where('status',1)->get();
        $competitors=Competitor::select('id','name')->where('status',1)->get();

        $tenders=Tender::select('tenders.id','tenders.complete_status','branch_constants.name as branch_name','tenders.comany_branch','tenders.tender_no','tenders.representation_date','tenders.created_at','tenders.bid_status','clients.name as client')
        ->leftJoin('clients', function($join) {
            $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');

        })->leftJoin('system_constants as branch_constants', function($join) {
            $join->on('branch_constants.value', '=', 'tenders.comany_branch')->where('branch_constants.type','company_branches')->whereNull('branch_constants.deleted_at');
        });
        if($request->tender_no){
            $tenders = $tenders->where('tenders.tender_no','like','%'.$request->tender_no.'%');
        }
        if ($request->client) {
            $tenders = $tenders->where('tenders.client_id',$request->client);
        }
        if ($request->guarantee_type) {
            $tenders = $tenders->where('tenders.guarantee_type',$request->guarantee_type);
        }
        if ($request->branch) {
            $tenders = $tenders->where('tenders.comany_branch',$request->branch);
        }
        if ($request->tax) {
            $tenders = $tenders->where('tenders.tax',$request->tax);
        }
        if ($request->representation_date_to_search) {
            $request->representation_date_to_search=date('Y-m-d',strtotime($request->representation_date_to_search));
            $tenders = $tenders->where('tenders.representation_date','<=',$request->representation_date_to_search);
        }
        if ($request->representation_date_from_search) {
            $request->representation_date_from_search=date('Y-m-d',strtotime($request->representation_date_from_search));
            $tenders = $tenders->where('tenders.representation_date','>=',$request->representation_date_from_search);
        }
        if ($request->created_date_from_search) {
            $request->created_date_from_search=date('Y-m-d',strtotime($request->created_date_from_search));
            $tenders = $tenders->where('tenders.created_at','>=',$request->created_date_from_search);
        }
        if ($request->created_date_to_search) {
            $request->created_date_to_search=date('Y-m-d H:i:s',strtotime($request->created_date_to_search.'23:59:59'));
            $tenders = $tenders->where('tenders.created_at','<=',$request->created_date_to_search);
        }
        if ($request->order) {
            // dd($request->order);
            $order_name="";
            $order_type="desc";
            switch($request->order){
                case "1":
                    $order_name="id";
                    $order_type="asc";
                    break;
                case "2":
                    $order_name="id";
                break;
                case "3":
                    $order_name="representation_date";
                break;
                case "4":
                    $order_name="notification_receipt_date";
                break;
            }
            if ($request->order=='3'||$request->order=='4') {
                if ($request->order_way) {
                    switch ($request->order_way) {
                        case '1':
                            $order_type="asc";
                            break;

                        case '2':
                            $order_type="desc";
                            break;
                    }
                }else{
                    $order_type="desc";
                }
            }
            $tenders=$tenders->orderBy($order_name,$order_type);
        }else{
            $tenders=$tenders->orderBy('representation_date','desc');

        }
        // $user_id=Auth::id();
        // if($user_id == 1){

        // }else{
        //     $tenders=$tenders->whereRaw('FIND_IN_SET('.$user_id.',`users`)');
        // }




        $tenders=$tenders->paginate(self::PAGINATION_NO);
        $data['tenders']=$tenders;

        if($request->ajax()){
            $table_data=view('admin.tender.table-data',compact('data'))->render();
            return response()->json(['tenders'=>$table_data]);
        }
        $data['competitors']=$competitors;
        // $data['clients']=$clients;
        $data['items']=$items;
        $data['suppliers']=$suppliers;
        $data['currency_select']=$currency_select;
        $data['unit_select']=$unit_select;
        $data['guarantee_type_select']=$guarantee_type_select;
        $data['tax_select']=$tax_select;
        $data['company_select']=$company_select;
        $data['sectors_select']=$sectors_select;
        $data['order_tenders_select']=$order_tenders_select;
        $data['order_type_select']=$order_type_select;
        $data['users']=$users;


        // $items_data['items']=$items;

       // $data['durations_select']=$durations_select;

        return view('advan.admin.tender.index',compact('data','items'));
    }

    public function get_clients(Request $request)
    {
        $clients= [];
        if($request->has('q')){
            $search = $request->q;
            $clients =Client::select("id", "name")->with('specialty')
                ->where('status',1)
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($clients);
    }
    public function add(Request $request)
    {
    //    dd($request->users);
        $validation=Validator::make($request->all(),$this->rules(),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        if(!$request->tender_file)
            return response()->json(['status'=>false,'error'=>'يجب رفع ملف المناقصة']);



        if (Tender::where([['client_id',$request->client],['tender_no',$request->tender_no],['sector',$request->sector]])->count()>0) {
            return response()->json(['status'=>false,'error'=>'لا يمكن تكرار نفس المناقصة للعميل في نفس الفرع']);
        }

        if ($request->items && $request->quantity && $request->unit) {

            $items_added=new ItemsAdded();
            $items_added->items=json_encode($request->items);
            $items_added->quantities=json_encode($request->quantity);
            $items_added->units=json_encode($request->unit);
            $items_added->user_id=Auth::id();
            $items_added->save();

            if((count($request->items)!=count($request->quantity))||(count($request->items)!=count($request->unit)))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم في شاشة أصناف المناقصة']);
            if($this->emptyElementExists($request->items)||$this->emptyElementExists($request->quantity)||$this->emptyElementExists($request->unit))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم في شاشة أصناف المناقصة']);
        }


        if ($request->sitems && $request->notes && $request->suppliers && $request->sprice&&$request->trade_names&&$request->expired_at&&$request->durations) {
            if ((count($request->sitems)!=count($request->notes))||(count($request->sitems)!=count($request->suppliers))||(count($request->sitems)!=count($request->sprice))||
            (count($request->sitems)!=count($request->expired_at)) || (count($request->sitems)!=count($request->durations)))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم في شاشة بيانات عروض الاسعار']);

            if($this->emptyElementExists($request->sitems)||$this->emptyElementExists($request->suppliers)||$this->emptyElementExists($request->sprice)||$this->emptyElementExists($request->expired_at)
            ||$this->emptyElementExists($request->durations))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم في شاشة بيانات عروض الاسعار']);
        }


        $tender_id='';
        DB::transaction( function () use($request, &$tender_id)
        {

            if ($request->guarantee_file) {
                $insert_data['guarantee_file'] =$this->uploadFile($request->guarantee_file,'tenders');
            }
            // guarantee_file
            $insert_data=[
                'client_id'=>$request->client,
                'tender_no'=>$request->tender_no,
                'guarantee_type'=>$request->guarantee_type,
                'guarantee_rate'=>$request->guarantee_rate,
                'transfer_price'=>$request->transfer_price,
                'currency'=>$request->currency,
                'tax'=>$request->tax,
                'sector'=>$request->sector,
                'comany_branch'=>$request->company_branch,
                'users'=>implode(',',$request->users),
                'user_id'=>Auth::id(),
            ];
            $insert_data['representation_date']= date('Y-m-d',strtotime($request->representation_date));

            if ($request->tender_file) {
                $insert_data['tender_file']=$this->uploadFile($request->tender_file,'tenders');
            }
            if ($request->referral_file) {
                $insert_data['referral_file']=$this->uploadFile($request->referral_file,'tenders');
            }

            if($request->manager)
                $insert_data['manager']=$request->manager;
            if($request->guarantee_value)
                $insert_data['guarantee_value']=$request->guarantee_value;
            if($request->guarantee_no)
                $insert_data['guarantee_no']=$request->guarantee_no;
            if($request->receipt_file)
                $insert_data['notification_file']=$this->uploadFile($request->receipt_file,'tenders');
            if($request->receipt_date)
                $insert_data['notification_receipt_date']= date('Y-m-d',strtotime($request->receipt_date));
            $insert_data['guarantee_status']= (isset($request->get_guarantee))? 1: 0;
            $insert_data['bid_status']= 0;
            if($request->prices_file)
                $insert_data['suppliers_prices_file']=$this->uploadFile($request->prices_file,'tenders');

            $tender=Tender::create($insert_data);

            if ($request->items && $request->quantity && $request->unit) {
                $items=$request->items;
                $quantitys=$request->quantity;
                $units=$request->unit;
                for ($i=0; $i <count($items) ; $i++) {
                        TenderItem::create([
                            'item_id'=>$items[$i],
                            'item_quantity'=>$quantitys[$i],
                            'type'=>'1',
                            'accepted_item'=>0,
                            'unit'=>$units[$i],
                            'tender_id'=>$tender->id,
                            'user_id'=>Auth::id(),
                        ]);
                }
            }
            if ($request->sitems && $request->durations && $request->suppliers && $request->sprice&&$request->trade_names&&$request->expired_at&&$request->notes) {
                $sitems=$request->sitems;
                $durations=$request->durations;
                $notes=$request->notes;
                $suppliers=$request->suppliers;
                $sprice=$request->sprice;
                $trade_names=$request->trade_names;
                $expired_at=$request->expired_at;
                for ($i=0; $i <count($sitems) ; $i++) {
                    $expired_at[$i]= date('Y-m-d',strtotime($expired_at[$i]));
                    TenderItem::create([
                        'item_id'=>$sitems[$i],
                        // 'item_quantity'=>$squantitys[$i],
                        'item_price'=>$sprice[$i],
                        'supplier_id'=>$suppliers[$i],
                        'trade_name'=>$trade_names[$i],
                        'expired_date'=>$expired_at[$i],
                        'type'=>'2',
                        'tender_id'=>$tender->id,
                        'duration'=>$durations[$i],
                        'notes'=>$notes[$i],
                        // 'price_accepted'=>$accepted[$i],
                        'user_id'=>Auth::id(),
                    ]);
                }
            }
            if ($request->pitems && $request->ten_prices && $request->ten_notes) {
                $pitems=$request->pitems;
                $ten_prices=$request->ten_prices;
                $ten_notes=$request->ten_notes;
                if (!empty(array_filter($ten_prices, function ($a) { return $a !== null;}))) {
                    for ($i=0; $i <count($pitems) ; $i++) {
                        DB::table('tender_items')
                        ->where('item_id',$pitems[$i])
                        ->where('type',1)
                        ->where('tender_id',$tender->id)
                        ->update([
                            'item_price'=>$ten_prices[$i],
                            'notes'=>$ten_notes[$i],
                        ]);
                    }
                }
            }

            $tender_id=$tender->id;
        });
        return response()->json(['status'=>true,'success'=>'تم إضافة بيانات المناقصة بنجاح','tender_id'=>$tender_id]);

    }
    public function duplicate_tender_to_branch(Request $request)
    {
        if ($request->tender_duplicate_id) {
            if (!$request->to_company_branch) {
                return response()->json(['status'=>false,'error'=>'يجب اختيار الفرع']);
            }
            $tender=Tender::where('id',$request->tender_duplicate_id)->first();
            if (!$tender)
                return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);

            if (Tender::where([['id','!=',$tender->id],['client_id',$tender->client_id],['tender_no',$tender->tender_no],['comany_branch',$request->to_company_branch]])->count()>0) {
                return response()->json(['status'=>false,'error'=>'المناقصة مضافة للفرع مسبقاً']);
            }
            DB::transaction( function () use($request,$tender){
                $newTender = $tender->replicate();
                $newTender->created_at = Carbon::now();
                $newTender->comany_branch = $request->to_company_branch;
                $newTender->save();

                $items=TenderItem::where([['tender_id',$tender->id],['type',1]])->get()->toArray();
                // dd($items);
                foreach ($items as $key => $value) {
                    $value['tender_id']= $newTender->id;
                    $value['created_at']= Carbon::now();
                    $value['updated_at'] = Carbon::now();
                    $value['supplied_quantity'] = 0;
                    $value['item_price'] = 0;
                    $value['notes'] = null;
                    $value['accepted_item'] = 0;
                    TenderItem::create($value);

                }

            });
            return response()->json(['status'=>true,'success'=>'تم تكرار المناقصة لفرع آخر']);

        }
        return response()->json(['status'=>false,'error'=>'يجب تحديد المناقصة']);
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $validation=Validator::make($request->all(),$this->rules(),$this->messages());
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }


        if ($request->items && $request->quantity && $request->unit) {

            $items_added=new ItemsAdded();
            $items_added->items=json_encode($request->items);
            $items_added->quantities=json_encode($request->quantity);
            $items_added->units=json_encode($request->unit);
            $items_added->user_id=Auth::id();
            $items_added->save();

            if((count($request->items)!=count($request->quantity))||(count($request->items)!=count($request->unit)))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم في شاشة أصناف المناقصة']);
            if($this->emptyElementExists($request->items)||$this->emptyElementExists($request->quantity)||$this->emptyElementExists($request->unit))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم في شاشة أصناف المناقصة']);
        }


        if ($request->sitems && $request->notes && $request->suppliers && $request->sprice&&$request->trade_names&&$request->expired_at&&$request->durations) {
            if ((count($request->sitems)!=count($request->notes))||(count($request->sitems)!=count($request->suppliers))||(count($request->sitems)!=count($request->sprice))||
            (count($request->sitems)!=count($request->expired_at)) || (count($request->sitems)!=count($request->durations)))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم في شاشة بيانات عروض الاسعار']);

            if($this->emptyElementExists($request->sitems)||$this->emptyElementExists($request->suppliers)||$this->emptyElementExists($request->sprice)||$this->emptyElementExists($request->expired_at)
            ||$this->emptyElementExists($request->durations))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم في شاشة بيانات عروض الاسعار']);
        }

        if (!$request->hidden)
            return response()->json(['status'=>false,'success'=>'المناقصة غير مضافة']);
        $tender=Tender::where('id',$request->hidden)->first();
        if (!$tender)
            return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);
        if (Tender::where([['id','!=',$tender->id],['client_id',$request->client],['tender_no',$request->tender_no],['comany_branch',$request->company_branch]])->count()>0) {
            return response()->json(['status'=>false,'error'=>'المناقصة مضافة للفرع مسبقاً']);
        }
        // dd($request->company_branch , $tender,$tender->comany_branch);

        DB::transaction( function () use($request,$tender,&$tender_id)
        {
            if($request->users){
                $implode_users=implode(',',$request->users);
            }else{
                $implode_users=null;
            }

            $update_arr=[
                'client_id'=>$request->client,
                'tender_no'=>$request->tender_no,
                'guarantee_type'=>$request->guarantee_type,
                'guarantee_rate'=>$request->guarantee_rate,
                'transfer_price'=>$request->transfer_price,
                'currency'=>$request->currency,
                'tax'=>$request->tax,
                'sector'=>$request->sector,
                'comany_branch'=>$request->company_branch,
                'users'=> $implode_users,
                'user_id'=>Auth::id(),
            ];
            $update_arr['representation_date']= date('Y-m-d',strtotime($request->representation_date));

            if ($request->guarantee_file) {
                if (!empty($tender->guarantee_file)) {
                    $this->removeFile($tender->guarantee_file);
                }
                $update_arr['guarantee_file']=$this->uploadFile($request->guarantee_file,'tenders');
            }
            if ($request->tender_file) {
                if(!empty($tender->tender_file))
                    $this->removeFile($tender->tender_file);
                $update_arr['tender_file']=$this->uploadFile($request->tender_file,'tenders');
            }
            if ($request->referral_file) {
                if(!empty($tender->referral_file))
                    $this->removeFile($tender->referral_file);
                $update_arr['referral_file']=$this->uploadFile($request->referral_file,'tenders');
            }


            if($request->manager)
                $update_arr['manager']=$request->manager;
            if(!empty($request->receipt_file)){
                if(!empty($tender->notification_file))
                    $this->removeFile($tender->notification_file);
                $update_arr['notification_file']=$this->uploadFile($request->receipt_file,'tenders');
            }
            if($request->prices_file){
                if(!empty($tender->suppliers_prices_file))
                    $this->removeFile($tender->suppliers_prices_file);
                $update_arr['suppliers_prices_file']=$this->uploadFile($request->prices_file,'tenders');
            }

            if($request->guarantee_value)
                $update_arr['guarantee_value']=$request->guarantee_value;
            if($request->guarantee_no)
                $update_arr['guarantee_no']=$request->guarantee_no;

            if($request->receipt_date)
                $update_arr['notification_receipt_date']= date('Y-m-d',strtotime($request->receipt_date));

            $update_arr['guarantee_status']= (isset($request->get_guarantee))? 1: 0;
            $update_arr['bid_status']= $request->bid_status;

            $tender->update($update_arr);

            // TenderItem::where([['tender_id',$tender->id],['type',1]])->delete();
            if ($request->items && $request->quantity && $request->unit) {
                $items=$request->items;
                $quantitys=$request->quantity;
                $units=$request->unit;
                $prices=$request->prices;
                for ($i=0; $i <count($items) ; $i++) {
                    // $item=TenderItem::select('accepted_item','supplied_quantity')->where([['tender_id',$tender->id],['item_id',$items[$i]],['type',1]])
                    // ->whereNotNull('deleted_at')->orderBy('id', 'desc')->first();
                    TenderItem::updateOrCreate(
                        ['tender_id' => $tender->id, 'type' => 1 ,'item_id'=> $items[$i]],
                        ['item_quantity' => $quantitys[$i],'user_id'=>Auth::id(),'unit'=>$units[$i]]
                    );
                    // $update_a=[
                    //     'item_id'=>$items[$i],
                    //     'item_quantity'=>$quantitys[$i],
                    //     'type'=>'1',
                    //     'unit'=>$units[$i],
                    //     'item_price'=>$prices[$i],
                    //     'tender_id'=>$tender->id,
                    //     'user_id'=>Auth::id(),

                    // ];
                    // if ($item) {
                    //     $update_a['accepted_item']=$item->accepted_item;
                    //     $update_a['supplied_quantity']=$item->supplied_quantity;
                    // }else{
                    //     $update_a['accepted_item']=0;

                    // }
                    // TenderItem::create($update_a);
                }
                TenderItem::where([['tender_id',$tender->id],['type',1]])->whereNotIn('item_id',$request->items)->delete();
            }else{
            TenderItem::where([['tender_id',$tender->id],['type',1]])->delete();

            }
            TenderItem::where([['tender_id',$tender->id],['type',2]])->delete();

            if ($request->sitems && $request->durations && $request->suppliers && $request->sprice&&$request->trade_names&&$request->expired_at&&$request->notes) {
                $sitems=$request->sitems;
                $durations=$request->durations;
                $notes=$request->notes;
                $suppliers=$request->suppliers;
                $sprice=$request->sprice;
                $trade_names=$request->trade_names;
                $expired_at=$request->expired_at;
                // dd($durations, $notes);
                for ($i=0; $i <count($sitems) ; $i++) {
                    $expired_at[$i]= date('Y-m-d',strtotime($expired_at[$i]));
                    TenderItem::create([
                        'item_id'=>$sitems[$i],
                        // 'item_quantity'=>$squantitys[$i],
                        'item_price'=>$sprice[$i],
                        'duration'=>$durations[$i],
                        'notes'=>$notes[$i],
                        'supplier_id'=>$suppliers[$i],
                        'trade_name'=>$trade_names[$i],
                        'expired_date'=>$expired_at[$i],
                        'type'=>'2',
                        'tender_id'=>$tender->id,

                        // 'price_accepted'=>$accepted[$i],
                        'user_id'=>Auth::id(),
                    ]);
                }
            }
            if ($request->pitems && $request->ten_prices && $request->ten_notes) {
                $pitems=$request->pitems;
                $ten_prices=$request->ten_prices;
                $ten_notes=$request->ten_notes;
                if (!empty(array_filter($ten_prices, function ($a) { return $a !== null;}))) {
                    for ($i=0; $i <count($pitems) ; $i++) {
                        DB::table('tender_items')
                        ->where('item_id',$pitems[$i])
                        ->where('type',1)
                        ->where('tender_id',$tender->id)
                        ->update([
                            'item_price'=>$ten_prices[$i],
                            'notes'=>$ten_notes[$i],
                        ]);
                    }
                }
            }
            $tender_id=$tender->id;
        });
        return response()->json(['status'=>true,'success'=>'تم حفظ بيانات المناقصة بنجاح','tender_id'=>$tender_id]);
    }
    public function get_tender(Request $request,$id)
    {
        $tender=$this->select_tender($id);
        $array_users = explode(',',$tender->users);
        $users=User::select('id','name')->where('status',1)->orderBy('id','asc')->get();

        $option='';
        foreach($users as $a){
            $selected = '';
            if(in_array($a->id,$array_users)){
                $selected = 'selected';
            }
            $option.= '<option value="'.$a->id.'" '.$selected.' >'.$a->name.'</option>';
        }
        $type1_items=TenderItem::where([['tender_id',$tender->id],['type',1]])->pluck('item_id')->toArray();
        $type2_items=TenderItem::where([['tender_id',$tender->id],['type',2]])->pluck('item_id')->toArray();
        $tender->items_not_in=array_diff($type1_items,$type2_items);

        //get_competitors_prices
        $tender_data=[];
        $competitors=Competitor::select('id','name')->where('status',1)->get();
        $tenderItems=TenderItem::select('tender_items.item_id','items.name as item')
        ->where([['tender_items.tender_id',$tender->id],['type',1]])
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
        })->get();
        $competitorsItems=CompetitorsItems::select('competitors_items.id','competitors_items.awarded','competitors_items.item_id','items.name as item','competitors_items.item_price','competitors_items.competitor_id','competitors.name as competitor','competitors_items.currency_id','competitors_items.note')
        ->where('competitors_items.tender_id',$tender->id)
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
        })->leftJoin('competitors', function($join) {
            $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
        })->get();
        $tender_data['competitors']=$competitors;
        $tender_data['tenderItems']=$tenderItems;
        $tender_data['competitorsItems']=$competitorsItems;
        $tender_data['tender_id']=$tender->id;

        // return $tender_data['competitorsItems'];
        $currency_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','currency']])->orderBy('order')->get();
        $assesment=view('admin.tender.sub.assesment_edit',compact('tender_data','currency_select'))->render();


        // get_accepted_items
        // $tender=Tender::where('id',$id)->first();
        $item_id=$request->item_id;
        $accepting='';
        if (!$tender)
            return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);
        $tenderItems=TenderItem::select('tender_items.item_id','items.name as item','tender_items.accepted_item','tender_items.has_priority')
            ->where([['tender_items.tender_id',$tender->id],['type',1]])
            ->leftJoin('items', function($join) {
                $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
            });
        if(isset($request->item_id)){


            if($request->item_id == 0){

                $items=$tenderItems->get();
                $tenderItems=$tenderItems->get();
                $items_data=[];
                $items_data['tenderItems']=$tenderItems;
                $items_data['tender_id']=$tender->id;
                $accepting=view('admin.tender.sub.table-data-accepting-items',compact('items_data','items'))->render();
                // return response()->json(['status'=>true,'data'=>$data,'item_id'=>$item_id]);
            }else{
                $items=$tenderItems->get();
                $tenderItems=$tenderItems->where('tender_items.item_id',$request->item_id);
                $tenderItems=$tenderItems->get();
                $items_data=[];
                $items_data['tenderItems']=$tenderItems;
                $items_data['tender_id']=$tender->id;
                $accepting=view('admin.tender.sub.table-data-accepting-items',compact('items_data','items'))->render();
                // return response()->json(['status'=>true,'data'=>$data,'item_id'=>$item_id]);
            }

        }else{

            $items=$tenderItems->get();
            $tenderItems=$tenderItems->get();
            $items_data=[];
            $items_data['tenderItems']=$tenderItems;
            $items_data['tender_id']=$tender->id;
            $accepting=view('admin.tender.sub.accepting-items_edit',compact('items_data','items'))->render();
            // return response()->json(['status'=>true,'data'=>$data,'item_id'=>$item_id]);

        }


        // get_supplied_items

        $tender_supply_data=[];
        $tenderItems=TenderItem::select('tender_items.item_id','items.name as item')
        ->where([['tender_items.tender_id',$tender->id],['type',1],['accepted_item',1]])
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
        })->get();
        $supplied_items=SuppliedTenderItems::select('supplied_tender_items.id','items.name as item','supplied_tender_items.item_id','supplied_tender_items.quantity','supplied_tender_items.date')
        ->where('supplied_tender_items.tender_id',$tender->id)
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'supplied_tender_items.item_id')->whereNull('items.deleted_at');
        })->get();
        $tender_supply_data['tenderItems']=$tenderItems;
        $tender_supply_data['supplied_items']=$supplied_items;
        $tender_supply_data['tender_id']=$tender->id;
        $supplied_data=view('admin.tender.sub.suppy-items-modal-body',compact('tender_supply_data'))->render();
        // return response()->json(['status'=>true,'supplied_data'=>$supplied_data]);



        return response()->json(['status'=>true,'tender'=>$tender,'assesment'=>$assesment,'tender_data'=>$tender_data,'currency_select'=>$currency_select,'accepting'=>$accepting,'item_id'=>$item_id,'supplied_data'=>$supplied_data,'option'=>$option]);

    }
    public function save_competitors_prices(Request $request)
    {

        // return $request;
        $validation=Validator::make($request->all(),[
            'tender_id'=>'required'
        ],[
            'tender_id.required'=>'يجب تحديد المناقصة',
          ]);
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }


        // dd($request->all());
        $tender=Tender::where('id',$request->tender_id)->first();
        if (!$tender)
            return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);
        if ($request->citems&&$request->cprices&&$request->competitors) {
            //
            // note
            if($this->emptyElementExists($request->citems)||$this->emptyElementExists($request->cprices)||$this->emptyElementExists($request->competitors) ||$this->emptyElementExists($request->currency_id))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم']);

            if ((count($request->citems)!=count($request->cprices))||(count($request->citems)!=count($request->competitors)) ||(count($request->citems)!=count($request->currency_id)))
                return response()->json(['status'=>false,'error'=>'يجب تحديد كل القيم']);
        }

        DB::transaction( function () use($request,$tender)
        {
            CompetitorsItems::where('tender_id',$tender->id)->delete();
            if ($request->citems&&$request->cprices&&$request->competitors&&$request->currency_id) {
                $citems=$request->citems;
                $cprices=$request->cprices;
                $competitors=$request->competitors;
                $currency_id=$request->currency_id;
                $note=$request->note;
                $awarded=explode(',',$request->awarded);

                // awarded
                for ($i=0; $i <count($citems) ; $i++) {
                    CompetitorsItems::create([
                        'item_id'=>$citems[$i],
                        'item_price'=>$cprices[$i],
                        'competitor_id'=>$competitors[$i],
                        'currency_id'=>$currency_id[$i],
                        'note'=>$note[$i],
                        'awarded'=>$awarded[$i],
                        'tender_id'=>$tender->id,
                        'user_id'=>Auth::id(),
                    ]);
                }
            }

        });
        return response()->json(['status'=>true,'success'=>'تم حفظ بيانات تقييم الأسعار بنجاح','data'=>$tender]);

    }
    public function save_accepted_items(Request $request)
    {
        // return $request;
        $validation=Validator::make($request->all(),[
            'tender_id'=>'required'
        ],[
            'tender_id.required'=>'يجب تحديد المناقصة',
        ]);
        $tender=Tender::where('id',$request->tender_id)->first();
        if (!$tender)
            return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);

        $accepted=explode(',',$request->accepted);
        $priority=explode(',',$request->priority);
        $items=explode(',',$request->items);
        // return count($items);

    //    return $priority[1];
        // dd($request->all());
        DB::transaction( function () use($request,$tender,$accepted,$priority,$items)
        {
           for ($i=0; $i < count($items); $i++) {
               $item=$items[$i];
               $accept_val=$accepted[$i];
               $prioritys=$priority[$i];
               $item_data=TenderItem::where([['item_id',$item],['tender_id',$tender->id]])->first();
               $item_data->accepted_item=$accept_val;
               $item_data->has_priority=$prioritys;
               $item_data->update();
           }

           if($tender->bid_status == 0){
            $tender->bid_status=1;
            $tender->save();
           }

        });
        return response()->json(['status'=>true,'success'=>'تم حفظ بيانات الترسية بنجاح','data'=>$tender]);
    }

    public function get_item($id)
    {

        if(isset($id)){
            $item=Item::where([['items.id',$id],['items.status',1]])
            ->select('items.id','items.item_no','items.name','shape_constants.name as shape_name')
            ->leftJoin('system_constants as shape_constants', function($join) {
                $join->on('shape_constants.value', '=', 'items.pharmaceutical_form')->where('shape_constants.type','pharmaceutical_form')->whereNull('shape_constants.deleted_at');
            })
            ->first();
            $item->names=ItemTradeNames::where('item_id',$item->id)->select('id','trade_name')->get();

            if(!$item)
                return response()->json(['status'=>false,'error'=>'الصنف غير موجود']);

            return response()->json(['status'=>true,'item'=>$item]);
        }
    }
    public function get_competitors_prices($id)
    {
        $tender=Tender::where('id',$id)->first();
        if (!$tender)
            return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);

        $tender_data=[];
        $competitors=Competitor::select('id','name')->where('status',1)->get();
        $tenderItems=TenderItem::select('tender_items.item_id','items.name as item')
        ->where([['tender_items.tender_id',$tender->id],['type',1]])
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
        })->get();
        $competitorsItems=CompetitorsItems::select('competitors_items.id','competitors_items.item_id','items.name as item','competitors_items.item_price','competitors_items.competitor_id','competitors.name as competitor','competitors_items.currency_id','competitors_items.note')
        ->where('competitors_items.tender_id',$tender->id)
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
        })->leftJoin('competitors', function($join) {
            $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
        })->get();
        $tender_data['competitors']=$competitors;
        $tender_data['tenderItems']=$tenderItems;
        $tender_data['competitorsItems']=$competitorsItems;
        $tender_data['tender_id']=$tender->id;
        // dd($tender_data);
        // return $tender_data;

        $currency_select=SystemConstant::select('id','name','value','type')->where([['status',1],['type','currency']])->orderBy('order')->get();


        $assesment=view('admin.tender.sub.assesment',compact('tender_data','currency_select'))->render();
        return response()->json(['status'=>true,'assesment'=>$assesment]);

    }
    public function get_supplied_items($id)
    {
        $tender=Tender::where('id',$id)->first();
        if (!$tender)
            return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);
        $tender_supply_data=[];
        $tenderItems=TenderItem::select('tender_items.item_id','items.name as item')
        ->where([['tender_items.tender_id',$tender->id],['type',1],['accepted_item',1]])
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
        })->get();
        $supplied_items=SuppliedTenderItems::select('supplied_tender_items.id','items.name as item','supplied_tender_items.item_id','supplied_tender_items.quantity','supplied_tender_items.date')
        ->where('supplied_tender_items.tender_id',$tender->id)
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'supplied_tender_items.item_id')->whereNull('items.deleted_at');
        })->get();
        $tender_supply_data['tenderItems']=$tenderItems;
        $tender_supply_data['supplied_items']=$supplied_items;
        $tender_supply_data['tender_id']=$tender->id;
        $supplied_data=view('admin.tender.sub.suppy-items-modal-body',compact('tender_supply_data'))->render();
        return response()->json(['status'=>true,'supplied_data'=>$supplied_data]);
    }
    public function delete_supplied_item(Request $request)
    {
        if(!$request->id)
            return response()->json(['status'=>false,'error'=>'لم يتم تحديد الصنف']);
        $supplied_item=SuppliedTenderItems::select('id','tender_id','item_id','quantity')->where('id',$request->id)->first();
        if(!$supplied_item)
            return response()->json(['status'=>false,'error'=>'الصنف غير موجود في توريد الأصناف']);
        DB::transaction(function () use ($request,&$supplied_item){
            SuppliedTenderItems::where('id',$supplied_item->id)->delete();
            TenderItem::where([['tender_id',$supplied_item->tender_id],['type',1],['item_id',$supplied_item->item_id]])
            ->whereNull('deleted_at')->update(['supplied_quantity'=>DB::raw("supplied_quantity-$supplied_item->quantity")]);
        });

        return response()->json(['status'=>true,'success'=>'تم حذف الصنف من التوريد بنجاح']);
    }



    public function get_accepted_items(Request $request,$id)
    {

        // return $request;
        // $items=Item::select('id','name')->where('status',1)->get();

        $item_id=$request->item_id;
        $tender=Tender::where('id',$id)->first();
        if (!$tender)
            return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);
        $tenderItems=TenderItem::select('tender_items.item_id','items.name as item','tender_items.accepted_item','tender_items.has_priority')
            ->where([['tender_items.tender_id',$tender->id],['type',1]])
            ->leftJoin('items', function($join) {
                $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
            });
        if(isset($request->item_id)){


            if($request->item_id == 0){

                $items=$tenderItems->get();
                $tenderItems=$tenderItems->get();
                $items_data=[];
                $items_data['tenderItems']=$tenderItems;
                $items_data['tender_id']=$tender->id;
                $data=view('admin.tender.sub.table-data-accepting-items',compact('items_data','items'))->render();
                return response()->json(['status'=>true,'data'=>$data,'item_id'=>$item_id]);
            }else{
                $items=$tenderItems->get();
                $tenderItems=$tenderItems->where('tender_items.item_id',$request->item_id);
                $tenderItems=$tenderItems->get();
                $items_data=[];
                $items_data['tenderItems']=$tenderItems;
                $items_data['tender_id']=$tender->id;
                $data=view('admin.tender.sub.table-data-accepting-items',compact('items_data','items'))->render();
                return response()->json(['status'=>true,'data'=>$data,'item_id'=>$item_id]);
            }

        }else{

            $items=$tenderItems->get();
            $tenderItems=$tenderItems->get();
            $items_data=[];
            $items_data['tenderItems']=$tenderItems;
            $items_data['tender_id']=$tender->id;
            $data=view('admin.tender.sub.accepting-items',compact('items_data','items'))->render();
            return response()->json(['status'=>true,'data'=>$data,'item_id'=>$item_id]);

        }




    }
    public function save_supplied_items(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'tender_id'=>'required','item'=>'required','quantity'=>'required|numeric','date'=>'required'
        ],[
            'tender_id.required'=>'يجب تحديد المناقصة',
            'item.required'=>'يجب تحديد الصنف',
            'quantity.required'=>'يجب إدخال الكمية',
            'quantity.numeric'=>'يجب أن تكون الكمية رقم',
            'date.required'=>'يجب تحديد تاريخ التوريد',
          ]);
        if ($validation->fails()) {
            return response()->json(['status'=>false,'error'=>$validation->errors()->first()]);
        }
        $tenderItems=TenderItem::select('tender_items.tender_id','tender_items.item_id','tender_items.supplied_quantity','tender_items.item_quantity')
        ->where([['tender_id',$request->tender_id],['type',1],['item_id',$request->item]])->whereNull('deleted_at')->first();
         if (!$tenderItems)
            return response()->json(['status'=>false,'error'=>'الصنف غير موجود في المناقصة']);
        $request->date= date('Y-m-d',strtotime($request->date));

        if ($tenderItems->supplied_quantity==$tenderItems->item_quantity)
            return response()->json(['status'=>false,'error'=>'تم توريد الكمية بشكل كلي']);

        if(($tenderItems->supplied_quantity+$request->quantity)<=$tenderItems->item_quantity){
            DB::transaction(function () use ($request,&$tenderItems){
                SuppliedTenderItems::create([
                    'tender_id'=>$tenderItems->tender_id,
                    'quantity'=>$request->quantity,
                    'date'=>$request->date,
                    'item_id'=>$tenderItems->item_id,
                    'user_id'=>Auth::id(),
                ]);
                $new_q=$tenderItems->supplied_quantity+$request->quantity;
                TenderItem::where([['tender_id',$tenderItems->tender_id],['type',1],['item_id',$tenderItems->item_id]])
                ->whereNull('deleted_at')->update(['supplied_quantity'=>$new_q]);
                $quantity_data=DB::Select("
                    SELECT
                    SUM(tender_items.item_quantity) AS quantity_sum , SUM(tender_items.supplied_quantity) AS supplied_quantity_sum
                    FROM
                    tender_items
                    WHERE tender_items.`tender_id` =$tenderItems->tender_id AND tender_items.`deleted_at` IS NULL
                    AND tender_items.`type` = 1 AND tender_items.accepted_item=1
                ");
                foreach ($quantity_data as $data ) {

                    if (($data->quantity_sum-$data->supplied_quantity_sum)==0) {
                        Tender::where('id',$tenderItems->tender_id)->update(['complete_status'=>1]);
                    }
                }


            });
        }else{
            return response()->json(['status'=>false,'error'=>'الكمية المحددة غير متوفرة']);
        }
        return response()->json(['status'=>true,'success'=>'تم الإضافة بنجاح']);

    }
    public function delete(Request $request)
    {
        if(!$request->id)
        return response()->json(['status'=>false,'error'=>'لم يتم تحديد المناقصة']);
        $tender=Tender::where('id',$request->id)->first();
        if(!$tender)
            return response()->json(['status'=>false,'error'=>'المناقصة غير موجودة']);
        DB::transaction( function () use($request,&$tender){
            if (!empty($tender->guarantee_file)) {
                $this->removeFile($tender->guarantee_file);
            }
            if (!empty($tender->notification_file)) {
                $this->removeFile($tender->notification_file);
            }
            if (!empty($tender->suppliers_prices_file)) {
                $this->removeFile($tender->suppliers_prices_file);
            }
            $this->removeFile($tender->tender_file);
            $this->removeFile($tender->referral_file);


            $delete=$tender->delete();
        });
        return response()->json(['status'=>true,'success'=>'تم حذف المناقصة بنجاح']);
    }
    public function delete_check(Request $request)
    {
        // if(!$request->id)
        // return response()->json(['status'=>false,'error'=>'لم يتم تحديد المناقصة']);
        // $tender=Tender::where('id',$request->id)->first();
        // if(!$tender)
        //     return response()->json(['status'=>false,'error'=>'المناقصة غير موجودة']);
        $array = $request->get('array');


        DB::transaction( function () use($request,$array){

            foreach ($array as $key => $value) {

                $tender=Tender::where('id',$value)->first();

                if (!empty($tender->guarantee_file)) {
                    $this->removeFile($tender->guarantee_file);
                }
                if (!empty($tender->notification_file)) {
                    $this->removeFile($tender->notification_file);
                }
                if (!empty($tender->suppliers_prices_file)) {
                    $this->removeFile($tender->suppliers_prices_file);
                }
                $this->removeFile($tender->tender_file);
                $this->removeFile($tender->referral_file);

                $delete=$tender->delete();
            }



        });
        return response()->json(['status'=>true,'success'=>'تم حذف المناقصات المحددة بنجاح','data'=>1]);
    }



    public function show_tender($id)
    {
        $tender=$this->select_tender($id);
        $tender->compatitors=Competitor::orderby('id','desc')->get(['id','name','color']);
        // $tender->competitorsItems=Competitor::leftJoin('competitors_items', function($join) {
        //     $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors_items.deleted_at');
        // })->leftJoin('items', function($join) {
        //     $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
        // })->select('competitors.id as competitor','competitors_items.item_id','competitors.name as competitor_name','items.name as item','competitors_items.item_price')->get();
        // dd($tender->competitorsItems);
        $tender->competitorsItems=CompetitorsItems::
        select('competitors_items.id','competitors_items.note','items.name as item','currency_constants.name as curreny_name','competitors_items.item_price','competitors_items.competitor_id','competitors_items.item_id')
        ->where('competitors_items.tender_id',$tender->id)
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'competitors_items.item_id')->whereNull('items.deleted_at');
        })->leftJoin('system_constants as currency_constants', function($join) {
            $join->on('currency_constants.value', '=', 'competitors_items.currency_id')->where('currency_constants.type','currency')->whereNull('currency_constants.deleted_at');
        })->orderby('competitors_items.id','desc')
        // ->leftJoin('competitors', function($join) {
        //     $join->on('competitors.id', '=', 'competitors_items.competitor_id')->whereNull('competitors.deleted_at');
        // })
        ->get();
    //    dd( $tender->competitorsItems);
        $items=TenderItem::select('item_id', 'supplier_id','item_price')
        ->where([['tender_id',$tender->id],['type',2]])->whereNull('deleted_at')->get()->groupBy('item_id');
        // dd($items);
        $min_suppliers_prices=$items->map(function($data,$it){
            return
                 $data->where('item_price', $data->min('item_price'))->pluck('supplier_id')->first()

            ;
        })->toArray();
        if(count($min_suppliers_prices)>0){
            $tender->min_suppliers_prices=$min_suppliers_prices;
        }else{
            $tender->min_suppliers_prices=[];

        }



        //  عرض الترسية
        $tenderItems=TenderItem::select('tender_items.item_id','items.name as item','tender_items.accepted_item','tender_items.has_priority')
        ->where([['tender_items.tender_id',$id],['type',1]])
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
        })->get();


        //  عرض التوريد
        $supplied_items=SuppliedTenderItems::select('supplied_tender_items.id','items.name as item','supplied_tender_items.item_id','supplied_tender_items.quantity','supplied_tender_items.date')
        ->where('supplied_tender_items.tender_id',$id)
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'supplied_tender_items.item_id')->whereNull('items.deleted_at');
        })->get();

        // dd( $tender->min_suppliers_prices);
        //  return   $tender ;

        $show_data=view('admin.tender.sub.show',compact('tender','tenderItems','supplied_items'))->render();
        // dd( $show_data);
        return response()->json(['status'=>true,'show_data'=>$show_data]);
    }
    public function add_new_trade_name(Request $request)
    {
        // dd($request->all());
        if ($request->to_item_id && $request->new_trade_name) {
            $item=Item::where('id',$request->to_item_id)->first();
            if (!$item) {
                return response()->json(['status'=>false,'error'=>'حدث خطأ ما حاول مرة أخرى']);
            }
            $create=ItemTradeNames::create([
                'trade_name'=>$request->new_trade_name,
                'item_id'=>$item->id,
                'user_id'=>Auth::id()
            ]);
            if (!$create) {
                return response()->json(['status'=>false,'error'=>'حدث خطأ ما حاول مرة أخرى']);
            }
            return response()->json(['status'=>true,"success"=>"تم إضافة الاسم التجاري",'data'=>['name'=>$create->trade_name,'id'=>$create->id]]);

        }
        return response()->json(['status'=>false,'error'=>'يجب ادخال الاسم التجاري']);

    }
    private function select_tender($id)
    {
        $tender=Tender::select('tenders.id','tenders.users','tenders.bid_status','tenders.suppliers_prices_file','tenders.guarantee_rate','tenders.comany_branch','tenders.sector','branch_constants.name as branch_name','sector_constants.name as sector_name','tenders.guarantee_status','tenders.guarantee_value','tenders.tender_no','tenders.guarantee_type','tenders.guarantee_no','tenders.transfer_price','tenders.guarantee_file','tenders.notification_file','tenders.tender_file','tenders.referral_file', 'tenders.currency'
        ,'tenders.tax','tenders.representation_date','tenders.notification_receipt_date','tenders.manager','tenders.client_id','clients.ar_name as client'
        ,'currency_constants.name as curreny_name','tax_constants.name as tax_name','guarantee_type_constants.name as guarantee_type_name')
        ->where('tenders.id',$id)
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
        if(!$tender){
            return response()->json(['status'=>false,'success'=>'المناقصة غير موجودة']);
        }
        $tender->items=TenderItem::where('tender_id',$tender->id)
        ->select('tender_items.item_id','tender_items.duration','tender_items.notes','tender_items.unit','item_trade_names.trade_name as trade_item_name','tender_items.expired_date','tender_items.accepted_item','tender_items.item_quantity','tender_items.item_price','tender_items.supplier_id','tender_items.type',
        'items.name as item','items.item_no','shape_constants.name as shape_name','suppliers.ar_name as supplier_name','unit_constants.name as unit_name','tender_items.notes','tender_items.duration','tender_items.trade_name')
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'tender_items.item_id')->whereNull('items.deleted_at');
        })->leftJoin('suppliers', function($join) {
            $join->on('suppliers.id', '=', 'tender_items.supplier_id')->whereNull('suppliers.deleted_at');
        })->leftJoin('system_constants as unit_constants', function($join) {
            $join->on('unit_constants.value', '=', 'tender_items.unit')->where('unit_constants.type','unit')->whereNull('unit_constants.deleted_at');
        })->leftJoin('system_constants as shape_constants', function($join) {
            $join->on('shape_constants.value', '=', 'items.pharmaceutical_form')->where('shape_constants.type','pharmaceutical_form')->whereNull('shape_constants.deleted_at');
        })->leftJoin('item_trade_names', function($join) {
            $join->on('item_trade_names.id', '=', 'tender_items.trade_name')->whereNull('item_trade_names.deleted_at');
        })
        ->get();
        if ($tender->items) {
            $items=$tender->items->pluck('item_id')->unique()->toArray();
            $itemsn=Item::whereIn('items.id',$items)
            ->leftJoin('item_trade_names', function($join) {
                $join->on('item_trade_names.item_id', '=', 'items.id')->whereNull('item_trade_names.deleted_at');
            })
            ->select('item_trade_names.trade_name','item_trade_names.item_id','item_trade_names.id')
            ->get()
            ->groupBy('item_id');
            // dd($itemsn);
            $tender->items_names=$itemsn;
        }
        // dd($tender->items->pluck('item_id')->unique()->toArray());
        return $tender;
    }
    private function emptyElementExists($arr)
    {
        return array_search(null, $arr) !== false;
    }
    public function validate_unique_supplier_item($tender,$items,$suppliers)
    {
        // foreach ($items as $key => $value) {
        //     # code...
        // }
    }

    public function generate_tender_pdf(Request $request)
    {
        //dd($request->all());
        if ($request->t_id) {
            $tender_id=$request->t_id;
            $setting=Setting::where('id',1)->select('logo','ar_name','en_name')->first();
            $tender=Tender::select('tenders.id','tenders.bid_status','branch_constants.name as branch_name','sector_constants.name as sector_name','tenders.guarantee_rate','tenders.guarantee_value','tenders.guarantee_status','tenders.tender_no','tenders.guarantee_no','tenders.transfer_price','tenders.created_at'
            ,'tenders.representation_date','tenders.notification_receipt_date','tenders.manager','clients.ar_name as client'
            ,'currency_constants.name as curreny_name','clients.id as client_id','clients.mobile as client_mobile','clients.address as client_address','tax_constants.name as tax_name','guarantee_type_constants.name as guarantee_type_name')
            ->where('tenders.id',$request->t_id)
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
            $tender->items=  DB::Select("
                SELECT t_it2.tender_id,t_it2.item_id, t_it2.item_quantity AS tender_quantity,t_it2.notes,t_it2.item_price AS tender_price,t_it2.accepted_item,i.name AS item,sys_const.name AS unit_name
                ,s.trade_name,shape_const.name AS shape_name,i.item_no,s.duration,s.expired_date,item_trade_names.trade_name
                FROM tender_items t_it2
                LEFT JOIN(
                SELECT t.tender_id AS s_t,t.item_id AS s_i,t.trade_name,t.duration,t.expired_date
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
                LEFT OUTER
                JOIN system_constants sys_const ON sys_const.value = t_it2.unit AND sys_const.type='unit' AND sys_const.deleted_at IS NULL
                LEFT OUTER
                JOIN system_constants shape_const ON shape_const.value = i.pharmaceutical_form AND shape_const.type='pharmaceutical_form' AND shape_const.deleted_at IS NULL
                WHERE `t_it2`.`tender_id`=$tender->id AND `t_it2`.`deleted_at` IS NULL AND `t_it2`.`type` = 1
                ORDER BY t_it2.tender_id DESC

            ");
            if (!empty($request->notes)) {
                $tender->notes= $request->notes;
            }
            //dd( $tender);
            // $view = \View::make('/admin/pdf/tender_data', compact('tender'));
            $view = View::make('/admin/pdf/tender', compact('tender'));
            $html_content = $view->render();
            $lg = Array();

                    $lg['a_meta_charset'] = 'UTF-8';

                    $lg['a_meta_dir'] = 'rtl';

                    $lg['a_meta_language'] = 'ar';

                    $lg['w_page'] = 'page';



                    TCPDF::setHeaderCallback(function($pdf) use ($setting){

                        // $pdf->SetY(5);

                        // $pdf->SetFont('arial', '', 9);

                        // $pdf->WriteHTML('<table width="100%" cellpadding="4" style="padding-top:2px;padding-bottom:2px;">


                        //         <tr  width="100%">

                        //         <td width="100%" style="font-size:12px;text-align:center;border:none">
                        //             <table width="100%">
                        //                 <tr>
                        //                     <td width="10%"></td>
                        //                     <td width="10%" style="text-align:right;"><img src="'.$setting->logo.'" width="52px"></td>
                        //                     <td width="40%" style="font-size:12px;text-align:right;line-height:50px"><b>'.$setting->ar_name.' '.date('Y').'</b></td>
                        //                     <td width="40%" style="font-size:12px;text-align:right;line-height:50px"><b>'.$setting->en_name.'</b></td>
                        //                 </tr>
                        //             </table>
                        //         </td>



                        //         </tr>

                        // </table>');
                //         $myPageWidth = $pdf->getPageWidth();
                // $myPageHeight = $pdf->getPageHeight();
                // $myX = ( $myPageWidth / 2 ) - 75;
                // $myY = ( $myPageHeight / 2 ) + 25;
                // $pdf->StartTransform();
                // $pdf->Rotate(50, $myX, $myY);
                // $pdf->SetFont("arial", "", 175);
                // $pdf->SetTextColor(8, 8,8,0.1);
                // $pdf->Text($myX, $myY,"مسودة");
                // $pdf->StopTransform();

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
                    TCPDF::SetMargins(5, 25, 5, 5);
                    TCPDF::SetTitle('تقرير أسعار المناقصة');

                    // PDF::SetMargins(5,5,5,5);
                    TCPDF::AddPage('P','A4');
                    TCPDF::writeHTML($html_content, true, false, true, false, '');

                    TCPDF::SetTitle('تقرير أسعار المناقصة');

                    TCPDF::setRTL(true);

                    TCPDF::Output('tender.pdf');
        }else{
            return response()->json(['status'=>false,'error'=>'حدث خطأ ما ، حاول مرة أخرى']);
        }
    }
    public function show_upcoming_tenders()
    {
        $notifications=Notification::where('notifications.user_id',Auth::id())->where('read_flag',1)
        ->leftJoin('tenders', function($join) {
            $join->on('tenders.id', '=', 'notifications.tender_id')->whereNull('tenders.deleted_at');
        })->select('tenders.tender_no','notifications.*')
        ->get();
        foreach ($notifications as $noti) {

            Notification::where('id',$noti->id)
            ->update(['read_flag'=>0]);
        }
        // dd($notifications);
        if (count($notifications)>0) {
            return response()->json(['status'=>true,"notifications"=>$notifications]);
        }else{
            return response()->json(['status'=>false,'error'=>'لا يوجد اشعارات']);
        }

    }

    public function get_upcoming_tender()
    {
        $tenders=DB::select("
            SELECT tenders.id ,tenders.tender_no, tenders.representation_date
            FROM tenders
            WHERE tenders.representation_date < CURDATE() AND tenders.deleted_at IS NULL
        ");

        $tenders2=DB::select("
        SELECT tenders.id,tenders.tender_no , tenders.representation_date
        FROM tenders
        WHERE tenders.deleted_at IS NULL
        ");
        // return $tenders2;
        $upcoming_tenders=[];
        foreach ($tenders as $tender) {
            $now = time();

            $date = strtotime($tender->representation_date);
            $diff = abs($now -  $date);
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if($days==1){
                // $id=User::where('username','admin')->pluck('id')->first();
                $id=User::where('tender_alert',1)->get();

                if($id){
                    foreach ($id as $i) {
                        Notification::insert([
                            'tender_id'=>$tender->id,
                            'user_id'=> $i->id,
                            'read_flag'=> 1,
                            'type'=> 1,

                        ]);



                    }
                }

                $mgs_sms="غداً موعد تسليم مناقصة ".$tender->tender_no;
                $mobile=0;
                \App\Http\Helpers\Helpers::SendSms($mgs_sms,$mobile,0,'TenderController-get_upcoming_tender1');
            }

        }
        foreach ($tenders2 as $tender) {
            $now = time();

            $date = strtotime($tender->representation_date);
            $diff = abs($now -  $date);
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if($days==2){
                $id=User::where('tender_alert',1)->get();
                if($id){
                    foreach ($id as $i) {
                        Notification::insert([
                            'tender_id'=>$tender->id,
                            'user_id'=> $i->id,
                            'read_flag'=> 1,
                            'type'=> 2,

                        ]);


                    }
                }

                $mgs_sms="متبقى يومين لموعد تسليم مناقصة ".$tender->tender_no;
                $mobile=0;
                \App\Http\Helpers\Helpers::SendSms($mgs_sms,$mobile,0,'TenderController-get_upcoming_tender2');
            }
        }
    }
    public function tenders_for_calender(Request $request)
    {

        // $data = Event::whereDate('start', '>=', $request->start)
        // ->whereDate('end',   '<=', $request->end)
        // ->get(['id', 'title', 'start', 'end']);

        $data=Tender::select('tenders.id as tender_id',DB::raw("CONCAT(tenders.tender_no ,' ',clients.ar_name ) AS title")
       ,'tenders.complete_status','tenders.bid_status',
        'tenders.representation_date as start','tenders.representation_date as end')
        ->leftJoin('clients', function($join) {
            $join->on('clients.id', '=', 'tenders.client_id')->whereNull('clients.deleted_at');
        })
        ->whereDate('tenders.representation_date', '>=', $request->start)
        ->whereDate('tenders.representation_date',   '<=', $request->end);
        $user_id=Auth::id();
        if($user_id == 1){

        }else{
            $data=$data->whereRaw('FIND_IN_SET('.$user_id.',`users`)');
        }
        $data=$data->get();

        foreach ($data as $key => $value) {
            // if ($value->complete_status==0) {
            //     $value->color='red';
            // }else if($value->complete_status==2) {
            //     $value->color='green';
            // }else if($value->complete_status==1) {
            //     $value->color='gray';
            // }

            if ($value->bid_status==0) {
                $value->color='#ff00004d';
            }else if($value->bid_status==2) {
                $value->color='#0080004d';
            }else if($value->bid_status==1) {
                $value->color='#eee';
            }


        }

// return $data;
        //  $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
        //  dd( $data);
        return response()->json($data);

    }

    private function rules()
    {
        return[
            'client'=>'required',
            'tender_no'=>'required',
            'company_branch'=>'required',
            'sector'=>'required',
            'guarantee_type'=>'required',
            'guarantee_rate'=>'required|numeric',
            'currency'=>'required',
            'representation_date'=>'required',
            'transfer_price'=>'required|numeric',
            'tax'=>'required',
            'guarantee_file'=>'mimes:jpg,jpeg,gif,png',
            'tender_file'=>'mimes:doc,docx,odt,pdf,dot',
            'referral_file'=>'mimes:doc,docx,odt,pdf,dot',
            'receipt_file'=>'mimes:doc,docx,odt,pdf,dot',
            'prices_file'=>'mimes:pdf',
        ];
    }
    private function messages()
    {
        return[
            'client.required'=>'يجب اختيار العميل',
            'tender_no.required'=>'يجب إدخال رقم المناقصة',
            'guarantee_type.required'=>'يجب اختيار نوع الكفالة',
            'company_branch.required'=>'يجب اختيار فرع الشركة',
            'sector.required'=>'يجب اختيار نوع القطاع',
            'tax.required'=>'يجب اختيار الضريبة',
            'representation_date.required'=>'يجب اختيار تاريخ تقديم المناقصة',
            'currency.required'=>'يجب اختيار العملة',
            'guarantee_rate.numeric'=>'يجب أن تكون نسبة الكفالة رقم',
            'guarantee_rate.required'=>'يجب إدخال نسبة الكفالة',
            'transfer_price.required'=>'يجب إدخال سعر التحويل',
            'guarantee_file.mimes'=>'يجب أن يكون امتداد صورة الكفالة jpg,jpeg,gif,png فقط',
            'tender_file.mimes'=>'امتداد ملف المناقصة غير مسموح به',
            'referral_file.mimes'=>'امتداد ملف الاحالة / الترسية غير مسموح به',


            'receipt_file.mimes'=>'امتداد ملف الاشعار غير مسموح به',
            'prices_file.mimes'=>'امتداد ملف الاسعار المسموح به pdf فقط',
            "transfer_price.numeric"=>"يجب أن يكون سعر التحويل رقم",

        ];
    }
}
