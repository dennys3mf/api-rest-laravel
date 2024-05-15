<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

/**
 * @OA\Info(
 *     title="Servilex API",
 *     version="1.0.0"
 * )
 */

class ArticuloController extends Controller

{
    /**
     * @OA\Get(
     *     path="/api/articulos",
     *     @OA\Response(
     *         response=200,
     *         description="Obtener todos los artículos",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items()
     *         )
     *     )
     * )
     */
    public function index()
    {
        $articulos = Articulo::all();
        return $articulos;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/articulos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Crear un nuevo artículo",
     *         @OA\JsonContent()
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'descripcion' => 'required|max:255',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        ]);

        $articulo = new Articulo();
        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;
        $articulo->save();

        return response()->json($articulo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/articulos/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Actualizar un artículo existente",
     *         @OA\JsonContent()
     *     )
     * )
     */
    public function update(Request $request)
    {
        $articulo = Articulo::findOrfail($request->id);
        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;
        $articulo->save();
        return $articulo;
    }

    /**
     * @OA\Delete(
     *     path="/api/articulos/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Eliminar un artículo existente",
     *         @OA\JsonContent()
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $articulo = Articulo::destroy($request->id);
        return $articulo;
    }
}
