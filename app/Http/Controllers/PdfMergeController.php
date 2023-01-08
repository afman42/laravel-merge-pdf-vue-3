<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class PdfMergeController extends Controller
{
  public function index(){
    return view('pdf-merge');
  }

  public function addMerge(Request $request){
    $oMerger = PDFMerger::init();
    $allFilename = $request->allFilename;

    if ($allFilename === null) {
      return response()->json(['error' => "Please add file"]);
    }
    foreach ($allFilename as $value) {
        $oMerger->addPDF(public_path('pdf/'.$value), 'all');
    }

    $oMerger->merge();
    $oMerger->save('merged_result.pdf');    
     
    return response()->json(['success' => "Success merge pdf"]);
  }
}
