<?php
namespace app\index\controller;
use QL\QueryList;
class Index
{
    public function index()
    {
        $html = 'http://www.ibos.com.cn/';
        $rules = array(
            'date' => array('.news-info>dl>dt','text'),
            'title' => array('.news-info>dl>dd','text'),
        );
        $data = QueryList::Query($html,$rules)->data;
        
        $str = "authorization date,company name\n";
        foreach ($data as $each_record) {
            $str .= "{$each_record['date']},{$each_record['title']}\n";
        }
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=授权商家记录.csv");
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        return json();
        echo $str;
    }
}
