<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $categorias = Categoria::all();

        return view('admin.producto.index', ['productos' => $productos, 'categorias' => $categorias]);
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
            $categorias_producto = ProductoCategoria::where('id_producto', $id)->get();

        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage("El valor no es correcto"))->withInput();
        }

        $categorias = [];
        foreach ($categorias_producto as $key => $categoria_producto) {
            $categoria = Categoria::find($categoria_producto->id_categoria);
            $categorias[$key]['nombre'] = $categoria['nombre'];
        }

        $producto->categorias = $categorias;

        return view('admin.producto.detail', ['producto' => $producto]);
    }

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
                $producto->descripcion  = $request->descripcion;
                $producto->save();

                foreach ($request->categorias as $categoriaId)  {
                    $categoria_producto = new ProductoCategoria;
                    $categoria_producto->id_producto    = $producto->id;
                    $categoria_producto->id_categoria   = $categoriaId;
                    $categoria_producto->save();
                }

            } catch (Exception $e) {
                return json_encode(array("error" => 1, "msg" => $e->getMessage()));
            }

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
                Producto::where('id', $request->id)->update(['nombre' => $request->nombre, 'descripcion' => $request->descripcion]);
                ProductoCategoria::where('id_producto', $request->id)->delete();

                foreach ($request->categorias as $categoriaId) {
                    $categorias_producto = new ProductoCategoria;
                    $categorias_producto->id_producto  = $request->id;
                    $categorias_producto->id_categoria = $categoriaId;
                    $categorias_producto->save();
                }

            } catch (Exception $e) {
                return json_encode(array("error" => 1, "msg" => $e->getMessage()));
            }
            return json_encode(array('success' => true, "error" => 0, "msg" => "OK"));
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
       
        $productos = Producto::select(
            'productos.id','productos.nombre','productos.descripcion','categorias.nombre as nombre_categoria')
            ->leftJoin('categorias','productos.categoria_id','=','categorias.id')
            ->get();
        
        $categorias = Categoria::all();
        $categorias_ = Categoria::where('subcategoria_id','=',0)                    
                        ->orderBy('nombre')
                        ->get();

        return view( 'front.producto.index', [ 'productos' => $productos, 'categorias' => $categorias, 'categorias_' => $categorias_ ]);

    }
    public function list($id)
    {
       
        $productos = Producto::select(
            'productos.id','productos.nombre','productos.descripcion','categorias.nombre as nombre_categoria')
            ->leftJoin('categorias','productos.categoria_id','=','categorias.id')
            ->where('productos.categoria_id',$id)
            ->get();
        //dd($productos);
        $categorias = Categoria::all();
        $categorias_ = Categoria::where('subcategoria_id','=',0)                    
                        ->orderBy('nombre')
                        ->get();

        return view( 'front.producto.index', [ 'productos' => $productos, 'categorias' => $categorias, 'categorias_' => $categorias_ ]);

    }


    /**
     * Detalle de producto
     */
    public function detalle($id)
    {
       $producto = Producto::select(
            'productos.id','productos.nombre','productos.descripcion','categorias.nombre as nombre_categoria')
            ->leftJoin('categorias','productos.categoria_id','=','categorias.id')
            ->where('productos.id',$id)
            ->first();
        $categorias = Categoria::all();
        $categorias_ = Categoria::where('subcategoria_id','=',0)                    
                        ->orderBy('nombre')
                        ->get();
//dd($producto);
        return view('front.producto.detail', ['producto' => $producto, 'categorias' => $categorias, 'categorias_' => $categorias_]);
    }

}
