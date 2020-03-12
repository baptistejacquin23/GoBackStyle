<?php

namespace App\Http\Controllers;

use App\Code;
use App\Promotion;

class ApiController extends Controller
{
    public function findPromotions($codeParam){
        try {
            $code = Code::where('name', $codeParam)->first();
            if ($code != null){
                $validPromotions = Promotion::where("code_id", $code->id )->get();
                if (count($validPromotions) !== 0){
                    return $validPromotions;
                }else{
                    return response()->json([
                        'error' => 'Aucune promotion pour ce code',
                    ]);
                }
            }else{
                return response()->json([
                    'error' => 'Code promo non connu',
                ]);
            }
        }catch (\Exception $e){
            $message = null;
            return $e;
        }
    }
}
