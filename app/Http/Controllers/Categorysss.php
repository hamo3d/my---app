<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1- sql
        // $data = DB::select('SELECT * FROM categories');
        // return response()->json(['status' =>true , 'message'=>'success','data' =>$data], Response::HTTP_OK);


        //2 - query builder
        // $data = DB::table('categories')->get();
        // return response()->json(['status'=>true , 'message' =>'success' , 'data' => $data] , Response::HTTP_OK );


        //3-  Eloquent

        // $data = Category::all();
        // وضع شرط
        // $data = Category::get();
        // $data = Category::all();
        // $data = Category::with('products')->withCount('Products')->get();
        // $data = Category::where('id' , '>' , 60)->get();
        // $data = Category::simplePaginate(10);




        //بدون شروط
        // $data = Category::with('products')->withCount('products')->get();

        /// مع شروط
        // $data = Category::with(['products'=>function($query){

            // $query->where('price','>', '300');
        // }]
    // )->withCount(['products' => function($query){
        // $query->where('price' , '>' , '300');
    // }])->get();

        // $data = Category::with('Products')->has('Products','>=',3)->get();

        // $data = Category::with('products')->withCount('products')->get();

        // $data = Category::whereHas('Products',function($query){

            // $query->where('price','>=' , 400);

        // })->with('Products')->get();

        // $data = Category::whereDoesntHave('Products',function($query){

            // $query->where('price','<',400);
        // })->with('Products')->get();

        $data = Category::with('categories')->get();
        return  response()->view('cms.parent',['data',$data]);




    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $validatore = Validator($request->all(),[
            'name' => 'required|string|min:3|max:30',
            'info' => 'required|string|max:150',
            'visible' =>'required|boolean',
        ]);
        if(! $validatore -> fails()){
              // 1- sql
            // $data = DB::insert('insert into categories (name, info, visible ) values (?, ?,?)', [$request->input('name'),$request->input('info'),$request->input('visible')]);
            // return response()->json(['status' => $data , 'message' => $data ? ' success' : 'filed'],$data ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

            // 2- query builder
            // $data = DB::table('categories')->insert([
                // 'name' => $request->input('name'),
                // 'info' => $request->input('info'),
                // 'visible' => $request->input('visible'),


                /// اختصار
                //  $data = DB::table('categories')->insert([$request->all()]);
            // ]);
            // return response()->json(['status' => $data , 'message' => $validatore ? 'success' : ' filed'], $data ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);



             //3- Eloquent

        // $category = new Category();
        // $category->name = $request->input('name');
        // $category->info = $request->input("info");
        // $category->visible = $request->input('visible');
        // $data = $category->save();
        // return response()->json(['status' => $data , 'message' => $validatore ? 'success' : ' filed','object' => $category], $data ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

        // اختصار
        // dd($request->all());
        $data = Category::create($request->all());
        return response()->json(['status' =>  ! is_null($data)  , 'message' => $validatore ? 'success' : ' filed','object' => $data], $data ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);



        }else{
            return response()->json(['status' => false , 'meesage' => $validatore->getMessageBag()->first()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 1- sql
        // $data = DB::selectOne('select * from categories  where id = ?',[$id]);
    //
        // return response()->json(['status' =>  ! is_null($data)  , 'message' => $data ? 'success' : ' not found','object' => $data], $data ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
//
        // 2- query builder
        // $data = DB::table('categories')->where('id' ,'=', $id)->first();
        // $data = DB::table('categories')->find($id,['*']);
        // return response()->json(['status' =>  ! is_null($data)  , 'message' => $data ? 'success' : ' not found','object' => $data], $data ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        //3- Eloquent
        // $data = Category::where('id','=' , $id)->first();
        // return response()->json(['status' =>  ! is_null($data)  , 'message' => $data ? 'success' : ' not found','object' => $data], $data ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        // $data = Category::find($id);
        // return response()->json(['status' =>  ! is_null($data)  , 'message' => $data ? 'success' : ' not found','object' => $data], $data ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        // $data = Category::findOrFail($id);
        // return response()->json(['status' =>  true  , 'message' =>  'success' ,'object' => $data], Response::HTTP_OK );
        $data = Category::findOrfail($id);
        return Response()->json(['status' => true  ,  'message' =>    'success', 'object' => $data],Response::HTTP_OK);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //الاول بيانات والثاني شروط والثالث رسائل
        $validatore = Validator($request->all(),[
            'name' => 'required|string|min:3|max:30',
            'info' => 'required|string|max:150',
            'visible' => 'required|boolean',
        ]);
        if(! $validatore->fails()){
            // $updateRowsCount = DB::update('update categories SET name = ?, info = ? , visible = ? where id = ?  ', [$request->input('name'),$request->input('info'),$request->input('visible'),$id]);
            // return Response()->json(['status' => $updateRowsCount == 1  , 'message' => $updateRowsCount == 1 ? 'success' : 'failed' , 'object ' => $request->all()],$updateRowsCount == 1 ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

            // qeruy bilder
            // $updateRowsCount = DB::table('categories')->where('id' ,'=', $id)->update($request->all());
            // return Response()->json(['status' => $updateRowsCount == 1  , 'message' => $updateRowsCount == 1 ? 'success' : 'failed' , 'object ' => $request->all()],$updateRowsCount == 1 ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

            // Eloquent
            $category = Category::findOrfail($id);
            $category->name = $request->input('name');
            $category->info = $request->input('info');
            $category->visible = $request->input('visible');
            $update = $category->save();
            return Response()->json(['status' => $update , 'message' => $update ? 'success' : 'failed' , 'object ' => $category],$update == 1 ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        }else{
            return response()->json(['status'=> false , 'message' => $validatore->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // 1- sql
        // $delete = DB::delete('delete FROM categories where id = ? ',[$id]);
        // return response()->json(['status' => $delete == 1 , 'message' => $delete == 1 ? 'success' : 'failed' ],$delete == 1 ? Response::HTTP_OK  : Response::HTTP_NOT_FOUND);
//
        //2 query builder
        // $delete = DB::table('categories')->delete($id);
        // return response()->json(['status' => $delete == 1 , 'message' => $delete == 1 ? 'success' : 'failed' ],$delete == 1 ? Response::HTTP_OK  : Response::HTTP_NOT_FOUND);
//
        // Eloquent
        // $category = Category::destroy($id);
        // return response()->json(['status' => $category == 1 , 'message' => $category ? 'success' : 'failed' ],$category ? Response::HTTP_OK  : Response::HTTP_NOT_FOUND);
//
        $category = Category::findOrFail($id);
        $deleted = $category->delete();
        return response()->json(['status' => $deleted, 'message' => $deleted ? 'success' : 'failed' ],$deleted ? Response::HTTP_OK  : Response::HTTP_BAD_REQUEST);

    }
}
