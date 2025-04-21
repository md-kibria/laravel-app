<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Variation extends Model
{
    // use HasTranslations;

    // public $translatable = ['name'];

    protected $fillable = ['name', 'type', 'price', 'variation_type_id'];

    public function variationType()
    {
        return $this->belongsTo(VariationType::class);
    }

    // public function discountRules()
    // {
    //     return $this->hasMany(DiscountRule::class);
    // }

    public function discountRuleX()
    {
        return $this->belongsTo(DiscountRule::class);
    }

    // app/Models/Variation.php

    public function discountRule()
    {
        return $this->hasOne(\App\Models\DiscountRule::class);
    }

    public function getFinalPriceAttribute()
    {
        $price = $this->price;
        $rule = $this->discountRule;

        if ($rule) {
            if ($rule->type === 'percentage') {
                $discount = ($price * $rule->value) / 100;
            } else {
                $discount = $rule->value;
            }

            return max(0, $price - $discount);
        }

        return $price;
    }

    public function getDiscountAmountAttribute()
    {
        $rule = $this->discountRule;

        if ($rule) {
            if ($rule->type === 'percentage') {
                return ($this->price * $rule->value) / 100;
            } else {
                return $rule->value;
            }
        }

        return 0;
    }

    public function getFinalPriceWithQuantityAttribute($price) {
        $quantity = $this->name;
        $rule = $this->discountRule;

        if ($rule) {
            if ($rule->type === 'percentage') {
                // $discount = ($price * $quantity) * (1-($rule->value / 100));
                return ($quantity) * (1-($rule->value / 100));
            } elseif ($rule->type === 'fixed') {
                // $discount = ($price * $quantity) - $rule->value;
                return ($price * $quantity) - $rule->value;
            } else {
                // $discount = 0;
                return $price * $quantity;
            }
        }

        return $price * $quantity;

        // (price×quantity)×(1−discount)
    }

    // AI suggesiotn
    public function getDiscountedPriceAttribute()
    {
        return $this->price - $this->discount_amount;
    }
}
