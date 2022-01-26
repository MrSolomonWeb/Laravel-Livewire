<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $order_number
 * @property string $status
 * @property float $grand_total
 * @property int $item_count
 * @property boolean $is_paid
 * @property string $payment_method
 * @property string $shipping_fullname
 * @property string $shipping_address
 * @property string $shipping_city
 * @property string $shipping_state
 * @property string $shipping_zipcode
 * @property string $shipping_phone
 * @property string $notes
 * @property string $billing_fullname
 * @property string $billing_address
 * @property string $billing_city
 * @property string $billing_state
 * @property string $billing_zipcode
 * @property string $billing_phone
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property OrderItem[] $orderItems
 */
class Order extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'order_number', 'status', 'grand_total', 'item_count', 'is_paid', 'payment_method', 'shipping_fullname', 'shipping_address', 'shipping_city', 'shipping_state', 'shipping_zipcode', 'shipping_phone', 'notes', 'billing_fullname', 'billing_address', 'billing_city', 'billing_state', 'billing_zipcode', 'billing_phone', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
global $s;
        return $this->hasMany('App\OrderItem');
    }
}
