<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Keywords Controller
 *
 * @property \App\Model\Table\KeywordsTable $Keywords
 *
 * @method \App\Model\Entity\Keyword[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class KeywordsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $keywords = $this->paginate($this->Keywords);

        $this->set(compact('keywords'));
    }

    /**
     * View method
     *
     * @param string|null $id Keyword id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $keyword = $this->Keywords->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('keyword', $keyword);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $keyword = $this->Keywords->newEntity();
        if ($this->request->is('post')) {
            $keyword = $this->Keywords->patchEntity($keyword, $this->request->getData());
            if ($this->Keywords->save($keyword)) {
                $this->Flash->success(__('The keyword has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The keyword could not be saved. Please, try again.'));
        }
        $products = $this->Keywords->Products->find('list', ['limit' => 200]);
        $this->set(compact('keyword', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Keyword id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $keyword = $this->Keywords->get($id, [
            'contain' => ['Products']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $keyword = $this->Keywords->patchEntity($keyword, $this->request->getData());
            if ($this->Keywords->save($keyword)) {
                $this->Flash->success(__('The keyword has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The keyword could not be saved. Please, try again.'));
        }
        $products = $this->Keywords->Products->find('list', ['limit' => 200]);
        $this->set(compact('keyword', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Keyword id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $keyword = $this->Keywords->get($id);
        if ($this->Keywords->delete($keyword)) {
            $this->Flash->success(__('The keyword has been deleted.'));
        } else {
            $this->Flash->error(__('The keyword could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
