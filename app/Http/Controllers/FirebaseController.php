<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    public function index()
    {
        //ini diganti dari file yg udah di download si URL
        //ini ambil dari firebase dari realtime database
        $factory = (new Factory)
            ->withServiceAccount(__DIR__ . '/larafire-82d74-firebase-adminsdk-v67li-adc27ace23.json')
            ->withDatabaseUri('https://larafire-82d74-default-rtdb.firebaseio.com/');
        $database = $factory->createDatabase();

        return $database->getReference('users')->getChildKeys();
        // $newPost = $database->getReference();
        // $database->getReference();

        // $newPost = $database->getReference('users');

        //Tambah Data
        // $newPost = $database
        // ->getReference('users')
        // ->push([
        //         'id'           => 'USR-004',
        //         'name'         => 'Wida 4'
        // ]);

        //$newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-
        //$newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-
        //$newPost->getChild('title')->set('Changed post title');
        //$newPost->getValue(); // Fetches the data from the realtime database
        //$newPost->remove();
        // echo"<pre>";
        // print_r($newPost->getvalue());
        // }

        // return $newPost->getUri();
    }

    public function formInput()
    {
        return view('firebase.form');
    }

    //input data
    public function inputData(Request $request)
    {
        $factory = (new Factory)
            ->withServiceAccount(__DIR__ . '/larafire-82d74-firebase-adminsdk-v67li-adc27ace23.json')
            ->withDatabaseUri('https://larafire-82d74-default-rtdb.firebaseio.com/');
        $database = $factory->createDatabase();

        //Tambah Data
        $newPost = $database
            ->getReference('users')
            ->push([
                'id'           => $this->randomString(5),
                'name'         => $request->name
            ]);

        echo "Data berhasil disimpan";
    }

    //Untuk Id users
    // strlen = untuk menghitung jumlah data
    // mt_rand = untuk menentukan panjang dari data yang mau di acak/ di random
    // .= untuk menggabungkan 2 variabel string
    public function randomString($length)
    {
        $str        = "";
        $characters = '123456789';
        $max        = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
}
