<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Sales Controller
 *
 */
class SalesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function index()
    // {
    //     $query = $this->Sales->find();
    //     $sales = $this->paginate($query);

    //     $this->set(compact('sales'));
    // }

    /**
     * View method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sale = $this->Sales->get($id, contain: []);
        $this->set(compact('sale'));
    }



    public function dashboard()
{
    $totalSales = $this->Sales->find()
        ->select(['total_sum' => 'SUM(total)'])
        ->first()
        ->total_sum ?? 0;

    $todaySales = $this->Sales->find()
        ->select(['total_sum' => 'SUM(total)'])
        ->where(['DATE(created)' => date('Y-m-d')])
        ->first()
        ->total_sum ?? 0;

    $this->set(compact('totalSales', 'todaySales'));
}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
   public function index()
{
    $Products = $this->fetchTable('Products');
    $Sales = $this->fetchTable('Sales');
    $SaleItems = $this->fetchTable('SaleItems');

    $sale = $Sales->newEmptyEntity();

    if ($this->request->is('post')) {

        $data = $this->request->getData();
        $items = json_decode($data['items'], true);

        if (empty($items)) {
            $this->Flash->error('Cart is empty');
            return $this->redirect(['action' => 'add']);
        }

        $sale->total = $data['total'];
        $Sales->save($sale);

        foreach ($items as $item) {

            $saleItem = $SaleItems->newEmptyEntity();

            $saleItem->sale_id = $sale->id;
            $saleItem->product_id = $item['id'];
            $saleItem->quantity = $item['qty'];
            $saleItem->price = $item['price'];

            $SaleItems->save($saleItem);

            $product = $Products->get($item['id']);
            $product->stock = max(0, $product->stock - $item['qty']);
            $Products->save($product);
        }

        return $this->redirect(['action' => 'receipt', $sale->id]);
    }

    $products = $Products->find()->all();
    $this->set(compact('sale', 'products'));
}


 public function add()
{
    $Products = $this->fetchTable('Products');
    $Sales = $this->fetchTable('Sales');
    $SaleItems = $this->fetchTable('SaleItems');

    $sale = $Sales->newEmptyEntity();

    if ($this->request->is('post')) {

        $data = $this->request->getData();
        $items = json_decode($data['items'], true);

        if (empty($items)) {
            $this->Flash->error('Cart is empty');
            return $this->redirect(['action' => 'add']);
        }

        $sale->total = $data['total'];
        $Sales->save($sale);

        foreach ($items as $item) {

            $saleItem = $SaleItems->newEmptyEntity();

            $saleItem->sale_id = $sale->id;
            $saleItem->product_id = $item['id'];
            $saleItem->quantity = $item['qty'];
            $saleItem->price = $item['price'];

            $SaleItems->save($saleItem);

            $product = $Products->get($item['id']);
            $product->stock = max(0, $product->stock - $item['qty']);
            $Products->save($product);
        }

        return $this->redirect(['action' => 'receipt', $sale->id]);
    }

    $products = $Products->find()->all();
    $this->set(compact('sale', 'products'));
}

    /**
     * Edit method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sale = $this->Sales->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('The sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
        $this->set(compact('sale'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);
        if ($this->Sales->delete($sale)) {
            $this->Flash->success(__('The sale has been deleted.'));
        } else {
            $this->Flash->error(__('The sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function receipt($id)
{
    $sale = $this->Sales->get($id, [
        'contain' => ['SaleItems' => ['Products']]
    ]);

    $this->set(compact('sale'));
}
}
