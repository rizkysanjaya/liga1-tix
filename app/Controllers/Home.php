<?php

namespace App\Controllers;
// use Myth\Auth\Controllers\AuthController;

class Home extends BaseController
{
    
    public function index()
    {        
        
        if (in_groups('admin')) {
            return redirect()->to(base_url('/admin/dashboard'));    
        } else {
            return view('landpage');
        }
        // $group = new \Myth\Auth\Models\GroupModel();
        // $db = \Config\Database::connect();
        // $builder = $db->table('users');
        // $builder->select('users.id as userid, users.username, users.email, role');
        // $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        // $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        // $query = $builder->get();
        // $data = ['users'] = $query->getResultArray();



            // $redirectURL = session('redirect_url') ?? site_url('/');
            // $currentRole =  session(getGroupForUsers(1)) ;// ambil role dari user yang login
            
            // unset($_SESSION['redirect_url']);
      
            // return redirect()->to($redirectURL);
      
            //   return view('landpage');
            
    }

    // public function dashboard()
    // {
    //     return view('dashboard');
    // }
}
