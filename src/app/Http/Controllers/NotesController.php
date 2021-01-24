<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

 use App\Models\Note;

 use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Http\Response;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Auth;

class NotesController extends Controller
{
	
	
	    public function __construct()
    {
      
        $this->middleware('auth:api');
    }
	
     private function notFoundMessage()
    {

        return [
            'code' => 404,
            'message' => 'Note not found',
            'success' => false,
        ];

    }

    private function successfulMessage($code, $message, $status, $count, $payload)
    {

        return [
            'code' => $code,
            'message' => $message,
            'success' => $status,
            'count' => $count,
            'data' => $payload,
        ];

    }
	
	//create new note
    public function create(Request $request)
    {

        $rules = [
            'title' => 'required|string',
            'content' => 'required|string|max:255',
            'author_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response['data'] = $validator->messages();
            return $response;
        }

        $note = new Note;
        $note->title = $request->title;
        $note->content = $request->content;
        $note->author_id = $request->author_id;

        $note->save();
        $response = $this->successfulMessage(201, 'Successfully created', true, $note->count(), $note);
        return response($response);

    }
	
	public function allNotes()
    {

        $notes = Note::all();
        $response = $this->successfulMessage(200, 'Successfully', true, $notes->count(), $notes);

        return response($response);
    }

    public function notesByAuthor($authorId)
    {
        $author = User::findOrfail($authorId);
        $notes = $author->notes;
        $response = $this->successfulMessage(200, 'Successfully', true, $notes->count(), $notes);

        return response($response);
    }
	
	 public function permanentDelete($id)
    {

        $note = Note::destroy($id);
        if ($note) {

            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $note);

        } else {

            $response = $this->notFoundMessage();
        }

        return response($response);
    }
	
	//returns both non-deleted and softdeleted
    public function notesWithSoftDelete()
    {

        $notes = Note::withTrashed()->get();
        $response = $this->successfulMessage(200, 'Successfully', true, $notes->count(), $notes);
        return response($response);

    }
	
	public function softDeleted()
    {
        $notes = Note::onlyTrashed()->get();

        $response = $this->successfulMessage(200, 'Successfully', true, $notes->count(), $notes);
        return response($response);
    }
	
	public function restore($id)
    {

        $note = Note::onlyTrashed()->find($id);

        if (!is_null($note)) {

            $note->restore();
            $response = $this->successfulMessage(200, 'Successfully restored', true, $note->count(), $note);
        } else {

            return response($response);
        }
        return response($response);
    }
	
	public function permanentDeleteSoftDeleted($id)
    {
        $note = Note::onlyTrashed()->find($id);

        if (!is_null($note)) {

            $note->forceDelete();
            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $note);
        } else {

            return response($response);
        }
        return response($response);
    }
}
