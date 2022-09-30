<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // QB
        // $data=DB::table('products')->select(['name','price','code','count'])->get();
        // echo "the name is".$data->name;
        // for($i=0;$i<count($data);$i++){
        //     echo "the name is ".$data[$i]->name." and the price is ".$data[$i]->price."<h1 style='background-color:red; text-align:center;'>hello moahemd</h1>";
        // }
        // EQ
        // $data=Product::all();
        // $data=Product::select(['id','name','price'])->get();
        // sql native
        $data=DB::select('select * from products');
        foreach($data as $d){
            echo "the id ".$d->id." the name is ".$d->name." and the price is ".$d->price."<h1 style='background-color:red; text-align:center;'>hello moahemd</h1>";
            // dd($d);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //query Builder
        // $inserted=DB::table('products')->insert([
        //     'name'=>'first product',
        //     'price'=>20,
        //     'code'=>'212',
        //     'count'=>232,
        //     'created_at'=>now(),
        //     'updated_at'=>now()
        // ]);
        // echo $inserted ? 'the inserted success':'the inserted faild';
        // $inserted=DB::table('products')->insertGetId([
        //     'name'=>'first product',
        //     'price'=>20,
        //     'code'=>'213',
        //     'count'=>232,
        //     'created_at'=>now(),
        //     'updated_at'=>now()
        // ]);
        // echo $inserted ? 'the inserted success'.$inserted:'the inserted faild';
    //     $product=new Product();
    //     $product->name='third product';
    //     $product->code='124';
    //     $product->price=233;
    //     $product->count=234;
    //     $isSaved=$product->save();
    //    echo $isSaved ? 'the product success inserted the name is'.$product->name:'faild';
    $inserted=DB::insert('insert into products(name,count,price,code) values (?,?,?,?)',['fivth product',234,22,'235']);
    echo $inserted ? "the successfully inserted":"faild inserted";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // QB
        // $data=DB::table('products')->select(['name','price'])->where('id','=',$id)->first();
        // $data=DB::table('products')->find($id);
        //EQ
        // $data=product::where('id',$id)->first();
        // $data=Product::find($id);
        // $data=Product::findOrFail($id);
        // if(is_null($data)){
        //     return "error";
        // }
        //Sql Native
        // differnce between selectOne and select
        // selectOne retrieve object but select retrieve object inside array
        $data=DB::selectOne('select * from products where id = ?',[$id]);
        echo "the name is ".$data->name."and is the price ".$data->price;
        dd($data);
     

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // QB
        // $data=DB::table('products')->where('id','=',$id)->update([
        //     'name'=>'cola',
        //     'price'=>5,
        //     'count'=>33
        // ]);
        // echo $data ? "the updated is successfully":'the updated is fail';
        // EQ
        // $data=product::findOrFail($id);
        // $data->name="makaCola";
        // $data->price=3;
        // $data->count=5;
        // $isUpdated=$data->save();
        // echo $isUpdated ? "the updated is successfully":'the updated is fail';
        // SQL NATIVE
        // $data=DB::update('update products set name=? where id=?',['sweet',4]);
        // echo $data ? "the updated is successfully ":"the updated is fail".$data;
        // deleted method
        // QB
        // $data=DB::table('products')->where('id','=',$id)->delete();
        // $data=DB::table('products')->delete($id); note not return boolean
       //    EQ
    //    $data=Product::findOrFail($id);
    //    $isDelecte=$data->delete();
    //    $data=Product::destroy($id); note not return boolean
    //SQL Native
    //  $data=DB::delete('delete from products where id =?',[$id]);
    //     echo $data ? "the deleted is successfully":"the deleted is faild";
    //SoftDeleted
    // $data=Product::findOrFail($id);
    // $isDelected=$data->delete();
    // echo $isDelected ? " deleted succssfully":"deleted fail";
    // INTRASHED
    //  $data=Product::withTrashed()->findOrFail($id);
    // $data=Product::onlyTrashed()->findOrFail($id); //return row is softDeleted
    // echo $data->name;
    //RESTORE
    // $data=Product::withTrashed()->findOrFail($id);
    // $isRestore=$data->restore();
    // echo $isRestore ? "the restore is sucessfully":"the restore is faild";
    $data=Product::findOrFail($id);
    $data->forceDelete();
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // QB
        $data=DB::table('products')->where('id','=',$id)->delete();
        echo $data ? "the deleted is successfully":"the deleted is faild";

    }
}
