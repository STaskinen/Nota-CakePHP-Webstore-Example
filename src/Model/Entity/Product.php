<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $product_amount
 * @property string $product_code
 * @property string|null $product_desc
 * @property string $product_name
 * @property string|null $product_points
 * @property float $product_price
 * @property string $product_producer
 * @property string|null $product_store
 * @property string|null $product_url
 * @property string|null $product_img
 *
 * @property \App\Model\Entity\Keyword[] $keywords
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'product_amount' => true,
        'product_code' => true,
        'product_desc' => true,
        'product_name' => true,
        'product_points' => true,
        'product_price' => true,
        'product_producer' => true,
        'product_store' => true,
        'product_url' => true,
        'product_img' => true,
        'keywords' => true
    ];
}
