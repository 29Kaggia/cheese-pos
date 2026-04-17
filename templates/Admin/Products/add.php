<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<div class="page">

  <!-- Header -->
  <div class="page-header">
    <p class="page-title">
      <?= __('Add Product') ?>
    </p>

    <?= $this->Html->link(
        '← Back',
        ['action' => 'index'],
        ['class' => 'btn btn-primary']
    ) ?>
  </div>

  <!-- Form Card -->
  <div class="card" style="padding: 20px; max-width: 500px;">

    <?= $this->Form->create($product) ?>

      <div style="margin-bottom: 12px;">
        <?= $this->Form->control('name', [
            'label' => 'Product Name',
            'class' => 'form-input'
        ]) ?>
      </div>

      <div style="margin-bottom: 12px;">
        <?= $this->Form->control('price', [
            'label' => 'Price (Ksh)',
            'class' => 'form-input'
        ]) ?>
      </div>

      <div style="margin-bottom: 12px;">
        <?= $this->Form->control('stock', [
            'label' => 'Stock Quantity',
            'class' => 'form-input'
        ]) ?>
      </div>

      <div style="margin-top: 20px;">
        <?= $this->Form->button(__('Save Product'), [
            'class' => 'btn btn-primary'
        ]) ?>
      </div>

    <?= $this->Form->end() ?>

  </div>

</div>