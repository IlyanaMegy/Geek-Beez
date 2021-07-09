<?php

namespace App\Factory;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Produit;

/**
 * Class OrderFactory
 * @package App\Factory
 */
class OrderFactory
{
    /**
     * Creates an order.
     *
     * @return Order
     */
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        return $order;
    }

    /**
     * Creates an item for a Produit.
     *
     * @param Produit $produit
     *
     * @return OrderItem
     */
    public function createItem(Produit $produit): OrderItem
    {
        $item = new OrderItem();
        $item->setProduit($produit);
        $item->setQuantity(1);

        return $item;
    }
}
