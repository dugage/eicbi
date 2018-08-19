<?php

use App\Models\VideoCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creamos 1 administrador
        factory(\App\User::class, 1)->create()->each(function ($user){
            \Silber\Bouncer\BouncerFacade::assign('admin')->to($user);
        });
        // Creamos 15 usuarios
        factory(\App\User::class, 15)->create()->each(function ($user){
            \Silber\Bouncer\BouncerFacade::assign('user')->to($user);
        });
        // Creamos 5 categorías para vídeos
        //factory(\App\Models\VideoCategory::class, 5)->create()->each(function ($videoCategory){
           
        //});
        $categories = [
            ['name'=>'Blockchain'],
            ['name'=>'Minería'],
            ['name'=>'Criptomonedas'],
            ['name'=>'Busines'],
            ['name'=>'Red P2P'],
        ];
        foreach($categories as $category){
            VideoCategory::create($category);
        }
        // Creamos 15 vídeos
        factory(\App\Models\Video::class, 15)->create()->each(function ($video){
           
        });

        // Creamos 15 referral
        factory(\App\Models\Referral::class, 15)->create()->each(function ($referral){
           
        });

    }
}
