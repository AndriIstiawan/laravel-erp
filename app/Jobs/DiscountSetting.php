<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Discounts;
use App\Product;

class DiscountSetting implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $action;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($action, $id)
    {
        $this->action = $action;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $discount = Discounts::find($this->id);
        $discount->status = ($this->action == 'start'?'on':'off');
        $discount->save();
        $update_products_status = false;
        
        $products = Product::where('_id', '<>', $this->id);
        if(count($discount->categories) > 0){
            $categories = array_column($discount->categories, 'name');
            // dd($categories);
            $products = $products->whereIn('type', $categories );
        }
        
        if(count($discount->products) > 0){
            $discount_products = array_column($discount->products, '_id');
            // dd($categories);
            $products = $products->whereIn('_id', $discount_products );
        }

        if(count($discount->members) == 0){
            $update_products_status = true;
        }

        $discount_type = $discount->type;
        $discount_value = (float)$discount->value;
        $products_update = $products;
        $discount = $discount->toArray();

        if($this->action == 'start'){
            $products = $products->push('discounts', $discount);
            if($update_products_status){
                if($discount_type == 'price'){
                    $products_update = $products_update->increment('discount_price', $discount_value);
                }else{
                    $products_update = $products_update->increment('discount_percent', $discount_value);
                }
            }
        }else{
            $products = $products->pull('discounts', ['_id' => $this->id]);
            if($update_products_status){
                if($discount_type == 'price'){
                    $products_update = $products_update->decrement('discount_price', $discount_value);
                }else{
                    $products_update = $products_update->decrement('discount_percent', $discount_value);
                }
            }
        }
    }
}
