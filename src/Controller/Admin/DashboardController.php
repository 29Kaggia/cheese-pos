<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 */
class DashboardController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Dashboard->find();
        $dashboard = $this->paginate($query);

        $this->set(compact('dashboard'));
    }

    /**
     * View method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dashboardEntity = $this->Dashboard->get($id, contain: []);
        $this->set(compact('dashboardEntity'));
    }


    public function dashboard()
{
    $Products = $this->fetchTable('Products');

    $lowStock = $Products->find()
        ->where(['stock <' => 5])
        ->all();

    $totalProducts = $Products->find()->count();

    $this->set(compact('lowStock', 'totalProducts'));
}
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dashboardEntity = $this->Dashboard->newEmptyEntity();
        if ($this->request->is('post')) {
            $dashboardEntity = $this->Dashboard->patchEntity($dashboardEntity, $this->request->getData());
            if ($this->Dashboard->save($dashboardEntity)) {
                $this->Flash->success(__('The dashboard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard could not be saved. Please, try again.'));
        }
        $this->set(compact('dashboardEntity'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dashboardEntity = $this->Dashboard->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dashboardEntity = $this->Dashboard->patchEntity($dashboardEntity, $this->request->getData());
            if ($this->Dashboard->save($dashboardEntity)) {
                $this->Flash->success(__('The dashboard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dashboard could not be saved. Please, try again.'));
        }
        $this->set(compact('dashboardEntity'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dashboard id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dashboardEntity = $this->Dashboard->get($id);
        if ($this->Dashboard->delete($dashboardEntity)) {
            $this->Flash->success(__('The dashboard has been deleted.'));
        } else {
            $this->Flash->error(__('The dashboard could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
