<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Producto;
use App\ProductoCategoria;
use App\Categoria;



class CategoriaController extends Controller
{
    public $menuc = array();

    public function index()
    {
        //$categorias = Categoria::all();
        $this->menuc = array();

        $categorias = Categoria::where('subcategoria_id','=',0)                    
                ->orderBy('nombre')
                ->get();
        $categorias_ = Categoria::all();
        $cate = array();
        $idCate = array();
        $menuCate = $this->crear_sub(0);

        return view('admin.categoria.index', ['categorias' => $categorias,'categorias_' => $categorias_
            ,'menuCate' => $this->menuc]);

    }

    public function crear_sub($sub) 
    { 
       $consulta = Categoria::where('subcategoria_id','=',$sub)                    
                ->orderBy('nombre')
                ->get();
       
                   
       foreach ($consulta as $row) {
            $this->menuc[] = array(
                                    'id'=> $row['id'],
                                    'subcategoria_id'=> $row['subcategoria_id'],
                                    'nombre'=> $row['nombre'],
                                    'ruta'=> $row['ruta'],
                                   );
            $this->crear_sub($row['id']);
       }
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
            'nombre'   => 'required|min:3jmn|max:50',
            'descripcion'   => 'min:2|max:150',
        );
        $rta = "";
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error al guardar"));
        } else {
            try {
                if($request->categ <> 0){
                    $ruta = Categoria::find($request->categ);
                    $rta = $ruta->ruta.'/';
                }
                // store categoria
                $categoria = new Categoria();
                $categoria->nombre = $request->nombre;
                $categoria->descripcion = $request->descripcion;
                $categoria->subcategoria_id = $request->categ;
                $categoria->ruta = $rta.$request->nombre;
                $categoria->save();

            } catch (Exception $e) {
                return json_encode(array("error" => 100, "msg" => $e->getMessage()));
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
    public function show($id)
    {

        try {
            $categoria = Categoria::findOrFail($id);

            } catch (ModelNotFoundException $exception) {
                return back()->withError($exception->getMessage("El valor no es correcto"))->withInput();
            }
       
        return view('admin.categoria.detail', ['categoria' => $categoria]);
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
        $rta = "";
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 103, "msg" => "Error al guardar"));
        } else {

                try {
                    if($request->id <> 0){
                        $ruta = Categoria::find($request->id);
                        $rta = $ruta->ruta;
                    }

                    Categoria::where('id', $request->id)->update([
                        'nombre' => $request->nombre, 
                        'descripcion' => $request->descripcion,
                        'ruta' => $rta,
                    ]);
                } catch (Exception $e) {
                    return json_encode(array("error" => 102, "msg" => $e->getMessage()));
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
