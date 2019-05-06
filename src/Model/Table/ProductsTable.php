<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\KeywordsTable|\Cake\ORM\Association\BelongsToMany $Keywords
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Keywords', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'keyword_id',
            'joinTable' => 'products_keywords'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->integer('product_amount')
            ->requirePresence('product_amount', 'create')
            ->allowEmptyString('product_amount', false);

        $validator
            ->scalar('product_code')
            ->maxLength('product_code', 50)
            ->requirePresence('product_code', 'create')
            ->allowEmptyString('product_code', false);

        $validator
            ->scalar('product_desc')
            ->allowEmptyString('product_desc');

        $validator
            ->scalar('product_name')
            ->maxLength('product_name', 50)
            ->requirePresence('product_name', 'create')
            ->allowEmptyString('product_name', false);

        $validator
            ->scalar('product_points')
            ->maxLength('product_points', 75)
            ->allowEmptyString('product_points');

        $validator
            ->numeric('product_price')
            ->greaterThanOrEqual('product_price', 0)
            ->requirePresence('product_price', 'create')
            ->allowEmptyString('product_price', false);

        $validator
            ->scalar('product_producer')
            ->maxLength('product_producer', 50)
            ->requirePresence('product_producer', 'create')
            ->allowEmptyString('product_producer', false);

        $validator
            ->scalar('product_store')
            ->maxLength('product_store', 50)
            ->allowEmptyString('product_store');

        $validator
            ->scalar('product_url')
            ->maxLength('product_url', 1000)
            ->allowEmptyString('product_url');

        $validator
            ->scalar('product_img')
            ->maxLength('product_img', 50)
            ->allowEmptyString('product_img');

        return $validator;
    }

    // function to find products that are part of a specific product category
    // aka have a specific keyword.
    public function findKeyword(Query $query, array $options) {
        return $this->find()
        ->distinct(['products.id'])
        ->matching('Keywords', function ($q) use ($options) {
            return $q->where(['Keywords.title IN' => $options['keywords']]);
        });
    }

    // Function for the freeform search.
    public function findSorted(Query $query, array $options) 
    {
        $searchTerm = $options['searchTerm'];
                $data = $this->find()
                    ->where(
                        ['product_name Like' => '%' . $searchTerm . '%']
                    );
                if ($data->isEmpty())
                {
                $data = $this->find()
                    ->where(
                        ['product_code =' => $searchTerm]
                    );
            }

                return $data;
    }
}
