<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth:api',['except' => ['show']]);
    }
    public function index()
    {
        //
        $get = Products::latest()->get();
        // $get = DB::table('products')->get();
        return response()-> json([
            'success' => true,
            'message' => 'tampil data',
            'data' => $get
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validator = Validator::make($request->all(),[
            'nama_produk' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ],
        [
            'nama_produk.required' => 'masukan nama produk',
            'kategori.required' => 'masukan kategori',
            'stok.required' => 'masukan stok',
            'harga.required' => 'masukan harga',
        ]
        );

        if($validator->fails()){
            return response()-> json([
                'success' => false,
                'message' => 'gagal tambah',
                'data' => $validator->errors()
            ],401);
        }else{
            $post = Products::create([
                'nama_produk'=>$request->input('nama_produk'),
                'kategori'=>$request->input('kategori'),
                'stok'=>$request->input('stok'),
                'harga'=>$request->input('harga')
            ]);
            if($post){
                return response()-> json([
                    'success' => true,
                    'message' => 'berhasil tambah',
                    'data' => $post
                ],200);
            }
            else{
                return response()-> json([
                    'success' => false,
                    'message' => 'gagal tambah',
                    'data' => 'gagal simpan'
                ],401);
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nama_produk)
    {
        //
        $filter = Products::where('nama_produk','LIKE','%'.$nama_produk.'%')->get();
        return response()->json([
            'succes'=> true,
            'message'=>'filter product',
            'data'=>$filter
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(),[
            'nama_produk' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ],
        [
            'nama_produk.required' => 'masukan nama produk',
            'kategori.required' => 'masukan kategori',
            'stok.required' => 'masukan stok',
            'harga.required' => 'masukan harga',
        ]
        );

        if($validator->fails()){
            return response()-> json([
                'success' => false,
                'message' => 'gagal tambah',
                'data' => $validator->errors()
            ],401);
        }else{
            $update = Products::where('id',$id)->update([
                'nama_produk'=>$request->input('nama_produk'),
                'kategori'=>$request->input('kategori'),
                'stok'=>$request->input('stok'),
                'harga'=>$request->input('harga')
            ]);
            if($update){
                return response()-> json([
                    'success' => true,
                    'message' => 'berhasil update',
                    'data' => $update
                ],200);
            }else{
                return response()-> json([
                    'success' => false,
                    'message' => 'gagal update',
                    'data' => 'gagal update'
                ],401);
            }
        }
    }

    // update tanpa id di params

    public function updateNoParams(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'nama_produk' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ],
        [
            'nama_produk.required' => 'masukan nama produk',
            'kategori.required' => 'masukan kategori',
            'stok.required' => 'masukan stok',
            'harga.required' => 'masukan harga',
        ]
        );

        if($validator->fails()){
            return response()-> json([
                'success' => false,
                'message' => 'gagal tambah',
                'data' => $validator->errors()
            ],401);
        }else{
            $update = Products::where('id',$request->input('id'))->update([
                'nama_produk'=>$request->input('nama_produk'),
                'kategori'=>$request->input('kategori'),
                'stok'=>$request->input('stok'),
                'harga'=>$request->input('harga')
            ]);
            if($update){
                return response()-> json([
                    'success' => true,
                    'message' => 'berhasil update',
                    'data' => $update
                ],200);
            }else{
                return response()-> json([
                    'success' => false,
                    'message' => 'gagal update',
                    'data' => 'gagal update'
                ],401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $hapus=Products::find($id);
        if($hapus){
            $hapus->delete();
            return response()-> json([
                'success' => true,
                'message' => 'berhasil hapus',
                'data' => $hapus
            ],200);
        }else{
            return response()-> json([
                'success' => true,
                'message' => 'gagal hapus',
                'data' => $id
            ],401);
        }
    }


    public function destroyNoParams(Request $request)
        {
            //
            $hapus=Products::find($request->input('id'));
            if($hapus){
                $hapus->delete();
                return response()-> json([
                    'success' => true,
                    'message' => 'berhasil hapus',
                    'data' => $hapus
                ],200);
            }else{
                return response()-> json([
                    'success' => true,
                    'message' => 'gagal hapus',
                    'data' => $request->input('id')
                ],401);
            }
        }
}