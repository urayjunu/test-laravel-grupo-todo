<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Categoria;
use App\ProductoCategoria;
use App\Producto;

class CategoriaController extends Controller
{
    public function index()
    {

        $categorias = Categoria::all();
        return view('admin.categoria.index', ['categorias' => $categorias]);
    }

    public function categoriaPorId($id)
    {

        $categoria = Categoria::find($id);
        return json_encode(array('success' => true, "error" => 0, "msg" => "OK", 'categoria' => $categoria));
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
            'nombre'   => 'required|min:5|max:50',
            'descripcion'   => 'min:5|max:150',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error al guardar"));
        } else {

            try {
                // store categoria
                $categoria = new Categoria;
                $categoria->nombre      = $request->nombre;
                $categoria->descripcion = $request->descripcion;
                $categoria->save();

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
            'nombre'   => 'required|min:5|max:50',
            'id'   => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error al guardar"));
        } else {

            try {
                // update categoria
                Categoria::where('id', $request->id)->update(['nombre' => $request->nombre]);
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
        $categoria = Categoria::find($id);
        $categoria->delete();
    }


    /**
     * Listado de categorias
     */
    public function listado()
    {
        $categorias = Categoria::all();
        return view('front.categoria.index', ['categorias' => $categorias]);
    }


    /**
     * Detalle de categoria
     */
    public function detalle( $id )
    {

        $categoria = Categoria::find($id);
        $categoria_productos = ProductoCategoria::where('id_categoria', $id)->get();

        $productos = [];
        foreach($categoria_productos as $categoria_producto){
            if(isset($categoria_producto->id_producto)){
                $producto = Producto::find($categoria_producto->id_producto);

                if (isset($producto->nombre)) {
                    $productos[] = $producto;
                }
            }
        }

        $categoria->productos = $productos;

        $categorias = Categoria::all();

        return view('front.categoria.detail', ['categoria' => $categoria, 'categorias' => $categorias ]);

    }

}
