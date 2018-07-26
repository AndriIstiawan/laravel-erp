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

        $discount = $discount->toArray();
        if($this->action == 'start'){
            $products = $products->push('discounts', $discount);
        }else{
            $products = $products->pull('discounts', ['_id' => $this->id]);
        }
    }
}
