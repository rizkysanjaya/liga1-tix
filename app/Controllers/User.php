<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;


class User extends BaseController
{
    protected $order;

    public function index($id)
    {
        $this->order = new Order();

        $data['tiket'] = $this->order->where('id_user', user()->id)->findAll();
        return view('user/profile', $data);
    }

    public function download($id)
    {
        return $this->response->download('assets/etiket/' . $id . '.pdf', null);
    }
}
