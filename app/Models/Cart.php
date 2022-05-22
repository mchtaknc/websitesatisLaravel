<?php

namespace App\Models;

class Cart
{
    public $items = null;
    //public $totalQty = 0;
    public $totalPrice = 0;
    public $taxPrice = 0;
    public $taxTotal = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            //$this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->taxPrice = $oldCart->taxPrice;
            $this->taxTotal = $oldCart->taxTotal;
        }
    }

    public function add($item, $domain, $theme, $id)
    {
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'domain' => $domain,
            'theme' => $theme,
            'item' => $item
        ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] = 1;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        //$this->totalQty++;
        $total = 0;
        foreach ($this->items as $value) {
            $total += $value['price'];
        }
        $this->totalPrice = $total;
        $this->taxPrice = $total * 0.18;
        $this->taxTotal = $total * 1.18;
    }
}
