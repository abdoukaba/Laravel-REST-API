<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Models\Sneaker;
 use App\Models\User;
 use App\Http\Resources\SneakerResource;
 use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\SneakerRequest;
use Illuminate\Http\Response;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Auth;

class SneakerController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
        $this->middleware('auth:api')->except(['index','show','search']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return SneakerResource::collection(Sneaker::with('ratings')->paginate(5));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
           $sneaker = Sneaker::findOrfail($id);

           return new SneakerResource($sneaker);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SneakerRequest $request)
    {
    
     try {
        $sneaker = Sneaker::create([
        'user_id' => auth('api')->user()->id,
        'sneaker_name' => $request->sneaker_name,
        'hyper_level' => $request->hyper_level,
        'price' => $request->price,
        'release_date' => $request->release_date,
         ]);

         $sneaker->fill($request->validated())->save();
         return new SneakerResource($sneaker);

      } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data ");
      }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SneakerRequest $request, $id)
    {
      // check if currently authenticated user is the owner of the sneaker
      if ($auth('api')->user()->id !== $sneaker->user_id) {
        return response()->json(['error' => 'You can only edit your own sneakers.'], 403);
      }

     try {
           $sneaker = Sneaker::find($id);
           $sneaker->fill($request->validated())->save();
      return new SneakerResource($sneaker);

       } catch(\Exception $exception) {
           throw new HttpException(400, "Invalid data ");
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

      if (!$id) {
            throw new HttpException(400, "Invalid id");
      }

      $sneaker = Sneaker::findOrfail($id);
      
      $sneaker->delete();

      return response()->json(null, 204);
    }



    public function search(Request $request)
    {
        if (!$request->filled('query')) {
            return response('No query found', \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
        $search = $request->input('query');
        $query  = Sneaker::query();
        $query->where(function (Builder $builder) use ($search) {
            $builder->where('sneaker_name', 'LIKE', '%' . $search . '%');
       
        });
        
        JsonResource::withoutWrapping();
        return SneakerResource::collection($query->get());
    }
}
