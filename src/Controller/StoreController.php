<?php
namespace App\Controller;

use App\Controller\AppController;

class StoreController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $products = $this->paginate($productsTable, $config);

        $this->set(compact('products'));
    }
}