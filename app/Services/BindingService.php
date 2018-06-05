<?php
namespace App\Services;

use App\User;
use App\Article;

class BindingService
{
    static function binding(){
        if(session()->has('user')){
            $binding = [
                'dropMenu' => [
                    ['title'=>'使用者：'.session('name'),'subMenu'=>[
                        ['url'=>url('/user/updatePwd'),'title'=>'修改密碼'],
                        'divider',
                        ['url'=>url('/user/logout'),'title'=>'登出'],
                    ]],
                ],
                'navMenu'=>[],
            ];
        }else{
            $binding = [
                'dropMenu' =>[],
                'navMenu' => [
                    ['url'=>url('/login'),'title'=>'登入'],
                ]
            ];
        }
        array_push($binding['dropMenu'],['title'=>'相片瀏覽','subMenu'=>[]]);
        $fileTitle = [
            'culture'=>['title'=>'日本文化體驗','subMenu'=>[
                'Tomioka' => '世界文化遺產 富岡製絲廠見學',
                'EdoTokyoMuseum'=>'江戶東京博物館見學',
                'KusatsuOnsen'=>'草津溫泉'
            ]],
            'University'=>['title'=>'專門學校及實習場域體驗學習','subMenu'=>[
				'Agricultural'=>'農業大學校、農業試驗所參訪見學',
                'ElectronicSchool'=>'日本電子專門學校體驗學習',
                'LaPorte'=>'法式餐廳(LA PORTE)實習',
                'BridalSchool'=>'三幸學園千葉BEAUTY & BRIDAL專門學校',
            ]],
            'communicate'=>['title'=>'日本高校交流','subMenu'=>[
                'agricultural'=>'更級農業高校',
                'Odawara'=>'小田原東高校',
            ]],
            'enterprise'=>['title'=>'企業參訪見學','subMenu'=>[
                'DesignExhibition'=>'東京國際商業設計展',
                'JTBGMT'=>'JTB-GMT參訪',
                'soySauce'=>'弓削醬油工廠見學',
                'fancl'=>'FANCL工廠見學',
            ]],
            'farmhouse'=>['title'=>'農家寄宿體驗','subMenu'=>[
                'HomeStay'=>'長野縣青木村寄宿'
            ]],
        ];
        $index = count($binding['dropMenu'])-1;
        $binding['categories'] = [];
        // dd($binding,$fileTitle);
        foreach(glob('./images/category/*') as $directory){
            $dir = array_reverse(explode('/',$directory))[0];
            array_push($binding['dropMenu'][$index]['subMenu'],['title'=>$fileTitle[$dir]['title'],'subMenu'=>[]]);
            $binding['categories'][$fileTitle[$dir]['title']] = [];
            foreach(glob('./images/category/'.$dir.'/*') as $file){
                $current = array_reverse(explode('/',$file))[0];
                $data = $fileTitle[$dir]['subMenu'][$current];
                $last = count($binding['dropMenu'][$index]['subMenu'])-1;
                array_push($binding['dropMenu'][$index]['subMenu'][$last]['subMenu'],['url'=>url('/photo/category/'.$dir.'/'.$current),'title'=>$data]);
                array_unshift($binding['categories'][$fileTitle[$dir]['title']],$data);
            }
        }
        $alreadyCategory = [];
        foreach(array_pluck(array_values($fileTitle),'subMenu') as $values){
            foreach(array_values($values) as $value)
                array_push($alreadyCategory,$value);
        }
        $otherCategory = Article::whereNotIn('category',$alreadyCategory)->get()->pluck('category')->unique()->toarray();
        $binding['categories']['自定義分類'] = $otherCategory;
        $binding['categoriesCounts'] = [];
        foreach(array_merge($alreadyCategory,$otherCategory) as $category){
            $binding['categoriesArticlesCounts'][$category] = Article::orWhere('category',$category)->count();
        }

        return $binding;
    }
}
