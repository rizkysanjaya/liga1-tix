<?php

namespace App\Controllers;
use App\Models\Contact;

class ContactController extends BaseController
{
    protected $contact;
 
    function __construct()
    {
        $this->contact = new Contact();
    }

    public function index()
    {        
	$data['contacts'] = $this->contact->findAll();

        return view('contacts/index', $data);
    }

    public function create()
    {

        $validate = $this->validate([
            'name' => [
                'label' => 'Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} is required.',
                    'valid_email' => 'Please enter a valid email address.'
                ]
            ],
            'phone' => [
                'label' => 'Phone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.'
                ]
            ],
            'address' => [
                'label' => 'Address',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.'
                ]
            ]
        ]);
        if (!$validate) {
            return redirect('contact')->with('errors', 'Isi dengan benar');
            
        }

        $this->contact->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ]);



		return redirect('contact')->with('success', 'Data Added Successfully');	
    }

    public function edit($id)
    {
        
        $this->contact->update($id, [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
            ]);

            return redirect('contact')->with('success', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $this->contact->delete($id);

        return redirect('contact')->with('success', 'Data Deleted Successfully');
    }

}