<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Validator;
use App\Models\Student;
use App\Models\Subject;

class StudentController extends Controller
{
     //Student methods starts here

     public function getStudents()
     {
         $student = Student::all();
 
         if (count($student) < 1) {
 
             return response()->json([
                 "status" => "404 Not Found !",
                 "message" => "No Records Found.",
             ]);
         } else {
             return response()->json([
                 "status" => "200 Ok",
                 "total" => count($student),
                 "message" => "Student retrieved successfully.",
                 "Students" => $student,
             ]);
         }
     }
 //Add Student
     public function addStudent(Request $request)
     {
         $input = $request->all();
 
         $validator = Validator::make($input, [
             'first_name' => 'required',
             'last_name' => 'required',
             'email' => 'required',
             'mobile_no' => 'required',
             'city' => 'required',
 
         ]);
 
         if ($validator->fails()) {
             return response()->json([
                 'errors' => $validator->errors(),
                 'status' => 'Fields cannot be empty!',
             ]);
         }
 
         $student = Student::create($input);
         return response()->json([
 
             "message" => "Student added successfully.",
             "status" => "200 Ok",
             "Student Details" => $student,
         ]);
     }
 
     //Update Student
     public function updateStudent(Request $request, $id)
     {
         $student = Student::find($id);
 
         if (empty($student)) {
             return response()->json([
                 "status" => "404 Not Found!",
                 "message" => "Nothing to delete Student Not Found",
             ]);
 
         } else {
 
             $input = $request->all();
             $validator = Validator::make($input, [
                 'first_name' => 'required',
                 'last_name' => 'required',
                 'email' => 'required',
                 'mobile_no' => 'required',
                 'city' => 'required',
 
             ]);
 
             if ($validator->fails()) {
                 return response()->json([
                     'errors' => $validator->errors(),
                     'status' => 'Validation failed',
                 ]);
             }
 
             Student::where('id', $id)->update($input);
 
             return response()->json([
                 "status" => "200 Ok",
                 "message" => "Student updated successfully.",
 
             ]);
         }
 
     }
 
     //Delete Student
     public function deleteStudent($id)
     {
         $student = Student::find($id);
         if (empty($student)) {
 
             return response()->json([
                 "status" => "404 Not Found!",
                 "message" => "Nothing to delete Student Not Found",
             ]);
 
         } else {
 
             $student->delete();
             return response()->json([
                 "status" => "200 Ok",
                 "message" => "Student record deleted successfully.",
             ]);
         }
     }
 

     public function searchStudent($name)
     {
         $search_result = Student::where('first_name','like','%'.$name.'%')->get();
         if(count($search_result)>0){
            return $search_result;
         }else{
             $data['status'] = "404 No Results !";
            return $data;
         }
        
     } 
     //Student methods ends here
     

}
