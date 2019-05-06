<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Keywords']
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $keywords = $this->Products->Keywords->find('list', ['limit' => 200]);
        $this->set(compact('product', 'keywords'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Keywords']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $keywords = $this->Products->Keywords->find('list', ['limit' => 200]);
        $this->set(compact('product', 'keywords'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // From here start the new homemade controller functions

    // The base Webstore view method/function
    public function webstore()
    {  
        // Functionality transferred to search.
        /* 
        $category = $this->request->getQuery('type');
        if ($category != null && $category !== 'all' ) {
            $category = $this->request->getQuery('type');
            $products = $this->paginate(
                $this->Products->find(
                    'keyword', 
                    [
                        'keywords' => $category
                    ]
                )
            );
            $this->set(compact('products'));
        } else {
            $products = $this->paginate($this->Products, ['limit' => 42]);
            $this->set(compact('products'));
        }
         */
        
        // loading the Keywords to be used as product categories. Should be renamed.
        $this->loadModel('Keywords');
        $keywords = $this->Keywords->find('all', [
            'order' => 'Keywords.id ASC'
        ]);
        $this->set(compact('keywords'));

        

    }

    // The search function, AJAX
    public function search()
    {
        // Get the GET request query info
        // What is being searched for
        $keywords = $this->request->getQuery('query');
        // And how
        $searchType = $this->request->getQuery('searchType');
        
        if ($searchType == 'Free') {
            // The Freeform search
            // Call the findSorted from the ProductsTable, paginate the results and pass them on.
                $data = $this->Products->find('Sorted', ['searchTerm' => $keywords]);

            $products = $this->paginate($data, ['limit' => 42]);
                
            $this->set(compact('products'));
        } else if ($searchType == 'Keyword') {
            // The category search
            // Call findKeyword from the ProductsTable telling it to find the products that 
            // are linked to the provided keyword, paginate the results and pass them on.
            if ($keywords != null && $keywords !== 'all' ) {
                $products = $this->paginate(
                    $this->Products->find(
                        'keyword', 
                        [
                            'keywords' => $keywords
                        ]
                    )
                );
                $this->set(compact('products'));
            } else {
                // If not specified, just send back all products.
                $products = $this->paginate($this->Products, ['limit' => 42]);
                $this->set(compact('products'));
            }
        }
    }

    // For showing product info in the More Info links.
    public function show($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        $this->set('product', $product);
    }

    // Info function for shopping cart AJAX Calls
    public function info($id = null)
    {

        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        $this->set('product', $product);
    }

}
