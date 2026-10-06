<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; class GoodsReceipt extends Model { protected $fillable=['po_id','received_by','delivery_note','quantity','condition','notes','status']; public function po(){return $this->belongsTo(PurchaseOrder::class,'po_id');} }
