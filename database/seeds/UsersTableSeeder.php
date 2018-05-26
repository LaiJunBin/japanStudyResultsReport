<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['梅家綸','王沅嘉','陳卉君','許恩碩','郭莉萱','唐家玲','曾育婷','賴俊賓','李東叡','毛衍凱','黃振嘉','羅嵐馨','簡思齊','魏國豪','王煌景','黃裔捷','鄭雅惠','周琮智','陳莉諪','曾才榮','廖兆陽','于賢華'];
        $users = ['C01','A03','A05','B07','A09','C11','C12','B08','A13','C02','B14','B10','A06','B15','B16','B04','teacher20','teacher21','teacher22','teacher18','teacher19','teacher17'];
        for($i=0;$i<count($users);$i++){
            DB::table('users')->insert([
                'name' => $names[$i],
                'user' => $users[$i],
                'pwd' => $users[$i]
            ]);
        }
    }

}
