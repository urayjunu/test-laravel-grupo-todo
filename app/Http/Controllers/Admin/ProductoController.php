<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Producto;
use App\ProductoCategoria;
use App\Categoria;



class ProductoController extends Controller
{     
    
    public function index()
    {	 
        $productos = Producto::all();
       // $categorias = Categoria::all();
        $categorias = Categoria::select(
                    'id', 'subcategoria_id','nombre')
                ->where('subcategoria_id','=',0)                    
                ->orderBy('nombre')
                ->get();
       
        $categorias_ = Categoria::select(
                    'id', 'subcategoria_id','nombre')
                ->orderBy('nombre')
                ->get();

        return view('admin.producto.index', ['productos' => $productos, 'categorias' => $categorias,'categorias_' => $categorias_]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $producto = Producto::findOrFail($id);
            $categorias_producto = Categoria::where('id', $producto->categoria_id)
                                   ->first();
            //dd($categorias_producto);

        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage("El valor no es correcto"))->withInput();
        }

       // $categorias_producto
        if($categorias_producto->subcategoria_id == 0){
            $cate = $categorias_producto->nombre;
           
        }else{
             $categoria_ = Categoria::where('id', $categorias_producto->subcategoria_id)
             ->first();
             $cate = $categoria_->nombre .'/'. $categorias_producto->nombre; 
        }
        

       
        /*
        $categorias = [];
        foreach ($categorias_producto as $key => $categoria_producto) {
            $categoria = Categoria::find($categoria_producto->id_categoria);
            $categorias[$key]['nombre'] = $categoria['nombre'];
        }*/
        $producto->categorias = $cate;

        return view('admin.producto.detail', ['producto' => $producto]);
    }
    /*public function show($id)
    {

        try {
            $producto = Producto::findOrFail($id);
            $categorias_producto = ProductoCategoria::where('id_producto', $id)->get();

        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage("El valor no es correcto"))->withInput();
        }

        dd($producto);

        
        $categorias = [];
        foreach ($categorias_producto as $key => $categoria_producto) {
            $categoria = Categoria::find($categoria_producto->id_categoria);
            $categorias[$key]['nombre'] = $categoria['nombre'];
        }

        $producto->categorias = $categorias;

        return view('admin.producto.detail', ['producto' => $producto]);
    }*/

    public function productoPorId($id)
    {
        $producto = Producto::find($id);
        return json_encode(array('success' => true, "error" => 0, "msg" => "OK", 'producto' => $producto));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(
            'nombre'        => 'required|min:3|max:50',
            'categorias'   => 'required',
            'descripcion'   => 'min:5|max:150',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error al guardar"));
        } else {

            try {
                // store producto
                $producto = new Producto;
                $producto->nombre       = $request->nombre;
                $producto->categoria_id = $request->categorias;
                $producto->descripcion  = $request->descripcion;
                $producto->save();

            } catch (Exception $e) {
                return json_encode(array("error" => 1, "msg" => $e->getMessage()));
            }

            //return back()->withInput();
            return json_encode(array('success' => true, "error" => 0, "msg" => "OK"));
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $rules = array(
            'nombre'        => 'required|min:5|max:50',
            'descripcion'   => 'min:5|max:100',
            'id'            => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error al guardar"));
        } else {

            try {

                // update producto
                $producto = Producto::find($request->id);
                Producto::where('id', $request->id)->update(['nombre' => $request->nombre, 'descripcion' => $request->descripcion,'categoria_id' => $request->categorias]);

            } catch (Exception $e) {
                return json_encode(array("error" => 1, "msg" => $e->getMessage()));
            }
            //return json_encode(array('success' => true, "error" => 0, "msg" => "OK"));
            return back()->withInput();
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
        // delete
        $ingredient = Producto::find($id);
        $ingredient->delete();
    }


    public function listado()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();

        $producto_completo = [];
        foreach($productos as $producto){
            $producto_categorias = ProductoCategoria::where('id_producto', $producto->id)->get();
            foreach($producto_categorias as $producto_categoria){
                $categoria = Categoria::find( $producto_categoria->id_categoria );

            }

            if (isset($categoria)) {
                $producto['categoria'] = $categoria['nombre'];
                $producto['categoriaId'] = $categoria['id'];
                $producto_completo[] = $producto;
            }
        }

        return view( 'front.producto.index', [ 'productos' => $producto_completo, 'categorias' => $categorias ]);
    }


    /**
     * Detalle de producto
     */
    public function detalle($id)
    {
        $producto = Producto::find($id);
        
       
        $categorias_producto = ProductoCategoria::where('id_producto', $id)->get();

        $categorias = [];
        foreach ($categorias_producto as $categoria_producto) {
            if (isset($categoria_producto->id_categoria)) {
                $categoria = Categoria::find($categoria_producto->id_categoria);

                if (isset($categoria)) {
                    $categorias[] = $categoria;
                }
            }
        }

        $producto->categorias = $categorias;

        $categorias = Categoria::all();

        return view('front.producto.detail', ['producto' => $producto, 'categorias' => $categorias]);
    }
}
