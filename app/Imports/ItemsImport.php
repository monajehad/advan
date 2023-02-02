<?php

namespace App\Imports;
use App\Models\ItemTradeNames;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\SystemConstant;
use App\Models\Item;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
// use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use App\Traits\FileUpload;
HeadingRowFormatter::default('none');

class ItemsImport implements ToCollection,WithHeadingRow ,WithDrawings
{
    use SkipsFailures,FileUpload;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        // Validator::make($collection->toArray(), [
        //     '*.ItemNo' => 'unique:items,item_no'
        // ],[
        //     '*.ItemNo.unique' => 'رقم الصنف مكرر'
        // ])->validate();
        foreach ($collection as $row)
        {

            //dd(file_get_contents($row['photoPath']));
            DB::transaction(function () use ($row){
                //dd(file_get_contents($row['photoPath']));
                $unit=SystemConstant::where('type','unit')->where('name','like','%'.$row['unit'].'%')->pluck('value')->first();
                $shape=SystemConstant::where('type','pharmaceutical_form')->where('name','like','%'.$row['shape'].'%')->pluck('value')->first();
                if ($unit) {
                    $data=[
                        "name"=>$row['name'],
                        "item_no"=>$row['ItemNo'],
                        "unit"=> $unit,
                        "pharmaceutical_form"=> $shape,
                        "status"=> $row['status'],
                        "user_id"=>Auth::id(),
                    ];
                    // if (file_exists($row['photoPath'])) {
                    //     $imageContents = file_get_contents($row['photoPath']);
                    //     $filePath = tempnam(sys_get_temp_dir(), 'items');
                    //     file_put_contents(public_path('uploads/items'), $imageContents);
                    //     $mimeType = mime_content_type($filePath);
                    //     $extension = File::mime2ext($mimeType);
                    //     // $row['photoPath']=$this->uploadFile(file_get_contents($row['photoPath']),'items');
                    //     $data['pharmaceutical_form']= \Str::random(10).'-'.time().'.'.$extension;
                    // }

                    $item=Item::create($data);
                    $names=explode('/',$row['tradeNames']);
                    if (count($names)>0) {
                        foreach ($names as $name) {
                            if (!empty($name)) {
                                ItemTradeNames::create([
                                    "trade_name"=>$name,
                                    "item_id"=>$item->id,
                                    "user_id"=>Auth::id(),

                                ]);
                            }

                        }
                    }

                }

            });
        }
    }
    public function drawings()
    {

    }
    // public function rules(): array
    // {
    //     return [
    //       "ItemNo"=>['unique:items,item_no'],
    //     ];
    // }
    // public function customValidationMessages()
    // {
    //     return [
    //         'ItemNo.unique' => 'رقم الصنف مكرر',
    //     ];
    // }
//     public function onFailure(Failure ...$failures)
// {
//     // Handle the failures how you'd like.
// }
}
