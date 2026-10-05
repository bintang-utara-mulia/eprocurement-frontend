<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; class Quotation extends Model { protected $fillable=['rfq_id','vendor_id','price','document_path','notes','status']; protected $casts=['price'=>'decimal:2']; public function rfq(){return $this->belongsTo(Rfq::class);} public function vendor(){return $this->belongsTo(User::class,'vendor_id');} }
