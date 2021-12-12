<?php

namespace App\Controllers;

use App\Models\ModelBarang;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelBarang = new ModelBarang();
        helper('number');
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'List Roti',
            'barang' => $this->ModelBarang->getBarang(),
            'cart' => \Config\Services::cart(),
            'isi' => 'v_home'
        ];
        echo view('layout/v_wrapper', $data);
    }

    //CRUD Shopping Cart

    public function cek()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        $data = json_encode($response);
        echo '<pre>';
        print_r($response);
        echo '</pre>';
    }

    //insert shopping cart
    public function add()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id' => $this->request->getPost('id'),
            'qty' => 1,
            'price' => $this->request->getPost('price'),
            'name' => $this->request->getPost('name'),
            'options' => array(
                'berat' => $this->request->getPost('berat'),
                'gambar' => $this->request->getPost('gambar'),
            )
        ));
        session()->setFlashdata('pesan', 'Barang berhasil dimasukkan ke keranjang');
        return redirect()->to(base_url('home'));
    }

    //clear shopping cart
    public function clear()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        session()->setFlashdata('pesan', 'Isi keranjang berhasil dibersihkan.');
        return redirect()->to(base_url('home/cart'));
    }

    //view cart
    public function cart()
    {
        $data = [
            'title' => 'List Roti',
            'cart' => \Config\Services::cart(),
            'isi' => 'v_cart'
        ];
        echo view('layout/v_wrapper', $data);
    }

    //update stok
    public function update()
    {
        $cart = \Config\Services::cart();
        $i = 1;
        foreach ($cart->contents() as $key => $value) {
            $cart->update(array(
                'rowid' => $value['rowid'],
                'qty' => $this->request->getPost('qty' . $i++),
            ));
        }

        session()->setFlashdata('pesan', 'Isi keranjang berhasil diupdate.');
        return redirect()->to(base_url('home/cart'));
    }

    public function delete($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        session()->setFlashdata('pesan', 'Isi keranjang berhasil diupdate.');
        return redirect()->to(base_url('home/cart'));
    }
}
