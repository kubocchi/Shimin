<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ActiveCenterResource;
use App\ActiveCenter;
use App\FileManagement\Repositories\BaseRepository;
use App\FileManagement\Repositories\AttachmentCategory\AttachmentCategoryRepository;
use App\FileManagement\Repositories\Attachment\AttachmentRepository;

class ActiveCenterController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get ActiveCenters
        $activeCenters;
        $type = $request->input('type');
        $search = $request->input('search');
        switch ($type) 
        {
            # All type
            case '0':
                $activeCenters = ActiveCenter::Where('title', 'like', '%' . $search . '%')
                            ->orderBy('created_at', 'desc')->paginate(10);
                break;
            # Running type
            case '1':
                $activeCenters = ActiveCenter::Where('title', 'like', '%' . $search . '%')
                            ->whereDate('start_date', '<=', date("Y-m-d"))
                            ->whereDate('end_date', '>=', date("Y-m-d"))
                            ->orderBy('created_at', 'desc')->paginate(10);
                break;
            # Future type
            case '2':
                $activeCenters = ActiveCenter::Where('title', 'like', '%' . $search . '%')
                    ->whereDate('start_date', '>', date("Y-m-d"))
                    ->orderBy('created_at', 'desc')->paginate(10);
                break;
            # Previous type
            case '3':
                $activeCenters = ActiveCenter::Where('title', 'like', '%' . $search . '%')
                    ->whereDate('end_date', '<', date("Y-m-d"))
                    ->orderBy('created_at', 'desc')->paginate(10);
                break;
        }

        // Return collection of ActiveCenters as a resource
        return ActiveCenterResource::collection($activeCenters);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activeCenter = $request->isMethod('put') ? ActiveCenter::findOrFail($request->id) : new ActiveCenter;

        $activeCenter->title = $request->input('title');
        $activeCenter->start_date = $request->input('start_date');
        $activeCenter->end_date = $request->input('end_date');
        $activeCenter->content = $request->input('content');
        $activeCenter->file = $request->input('file');
        $activeCenter->deactivate = $request->input('deactivate');
        $activeCenter->created_by = $request->input('created_by');
        $activeCenter->updated_by = $request->input('updated_by');
        if($activeCenter->save()) {
            return new ActiveCenterResource($activeCenter);
        }
    }
    /**
     * Display the specified resource.
     *$
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get ActiveCenters
        $activeCenter = ActiveCenter::findOrFail($id);

        // Return single ActiveCenters as a resource
        return new ActiveCenterResource($activeCenter);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get ActiveCenters
        $activeCenter = ActiveCenter::findOrFail($id);

        if($activeCenter->delete()) {
            return new ActiveCenterResource($activeCenter);
        }    
    }

    public function postImageUpload(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = str_random(8).'.'.$extension;
        $request->file('file')->storeAs('uploads', $fileName);
        return '/uploads/'.$fileName;
    }

    /**
     * AttachmentRepository instance
     *
     * @var App\FileManagement\Repositories\AttachmentRepository
     **/
    protected $attachmentRepo;

    public function __construct(AttachmentRepository $attachmentRepo)
    {
        $this->attachmentRepo = $attachmentRepo;
    }

    /**
     * Delete an attachment
     * 
     * @param  Request $request 
     * @return Response           
     */
    public function deleteAttachment(Request $request)
    {
        try {

            $attachment_id = $request->input('attachment_id');

            if (!$attachment_id) {
                throw new Exception("You are trying to delete a non-existing file", 1);
            }

            $attachment = $this->attachmentRepo->delete(intval($attachment_id));

            return response()->json(array(
                'success' => true,
                'data' => $attachment,
                'errors' => []
            ), 200);

        } catch(\Exception $e) {

            return response()->json(array(
                'success' => false,
                'data' => 'Server error happened',
                'errors' => $e->getMessage()
            ), 200);

        }
    }

    /**
     * Pull all the attachments for the logged in user
     * 
     * @param  Request $request 
     * @return Response           
     */
    public function pullAttachments($ids)
    {   
        try {

            // if (!Auth::check()) {
            //     throw new Exception("User has to be logged in", 1);
            // }

            // $user_id = Auth::user()->id;
            //dd($ids); die();

            $attachments = $this->attachmentRepo->whereIn('id', explode(',', $ids))->orderBy('created_at', 'DESC')->all();

            return response()->json(array(
                'success' => true,
                'data' => $attachments,
                'errors' => []
            ), 200);

        } catch(\Exception $e) {

            return response()->json(array(
                'success' => false,
                'data' => 'Server error happened',
                'errors' => $e->getMessage()
            ), 200);

        }
    }

    /**
     * Store files locally
     * 
     * @param  Request $request 
     * @return Response           
     */
    public function storeAttachments(Request $request)
    {
    	try {

            $attachments = $this->processAttachments($request);
            $data = null;
            if (count($attachments) > 0) {
                $data = $this->attachmentRepo->saveInBulk($attachments);
            }

    		return response()->json(array(
                'success' => true,
                'data' => $data,
                'errors' => []
            ), 200);

    	} catch(\Exception $e) {
    		return response()->json(array(
                'success' => false,
                'data' => 'Server error happened',
                'errors' => $e
            ), 200);
    	}
    }

    /**
     * We are categorizing uploaded files. Since we can't attach data to immutable javascript file objects, we have to
     * send a nested array where the second array (with key = 1) will hold custom data, such as category ID of that file
     * 
     * @param  Request $request 
     * @return array          
     */
    public function processAttachments($request)
    {
        $attachments_input = $request->input('attachments');
        $attachments_files = $request->file('attachments');
        $attachments = [];

        if (count($attachments_files)) {
            foreach ($attachments_files as $key => $value) {
                //$category_id = $attachments_input[$key][1] != 'undefined' ? $attachments_input[$key][1] : NULL;
                $value[0]->category_id = NULL;
                array_push($attachments, $value[0]);
            }
        }

        return $attachments;
    }
}
