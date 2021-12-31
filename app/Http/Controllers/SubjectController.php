<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Response;
use Validator;

class SubjectController extends Controller
{
    public function getSubjects()
    {
        $subject = Subject::all();

        if (count($subject) < 1) {

            return response()->json([
                "status" => "404 Not Found !",
                "message" => "No Records Found.",
            ]);
        } else {
            return response()->json([
                "status" => "200 Ok",
                "total" => count($subject),
                "message" => "Subject retrieved successfully.",
                "Subjects" => $subject,
            ]);
        }
    }

// Add Subject
    public function addSubject(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'sub_name' => 'required',
            'sub_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'Fields cannot be empty!',
            ]);
        }

        $subject = Subject::create($input);
        return response()->json([

            "message" => "Subject added successfully.",
            "status" => "200 Ok",
            "Subject Details" => $subject,
        ]);
    }

    //Update Subject
    public function updateSubject(Request $request, $id)
    {
        $subject = Subject::find($id);

        if (empty($subject)) {

            return response()->json([
                "status" => "404 Not Found!",
                "message" => "Nothing to udate Subject Not Found",
            ]);

        } else {

            $input = $request->all();
            $validator = Validator::make($input, [
                'sub_name' => 'required',
                'sub_code' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'status' => 'Validation failed',
                ]);
            }

            Subject::where('id', $id)->update($input);

            return response()->json([
                "status" => "200 Ok",
                "message" => "Subject updated successfully.",

            ]);
        }

    }

    //Delete Subject
    public function deleteSubject($id)
    {
        $subject = Subject::find($id);

        if ($subject) {
            $subject->delete();
            return response()->json([
                "status" => "200 Ok",
                "message" => "Subject record deleted successfully.",
            ]);
        } else {
            return response()->json([
                "status" => "404 Not Found!",
                "message" => "Nothing to delete Subject Not Found",
            ]);
        }
    }

    public function searchSubject($name)
    {
        $search_result = Subject::where('sub_name', 'like', '%' . $name . '%')->get();
        if (count($search_result)>0) {
            return $search_result;
        } else {
            $data['status'] = "404 No Results";
            return $data;
        }

    }
    // Subject Methods Ends Here
}
