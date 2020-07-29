<?php

namespace App\Http\Controllers\admin;

use App\Contest;
use App\ContestParticipant;
use App\Http\Controllers\Controller;
use App\Report;
use Illuminate\Http\Request;
use App\Notifications\report as Message;
use Notification;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        $reports=Report::all();
        return view('admin/reports/list',compact('reports'));
    }

    public function seenReport($id){
        Report::where('id',$id)->update(['status'=>'seen']);
        return back()->with('success','the report is marked as seen successfully');
    }
    public function unseenReport($id){
        Report::where('id',$id)->update(['status'=>'unseen']);
        return back()->with('success','the report is marked as unseen successfully');
    }
    public function deleteReport($id){
        Report::where('id',$id)->delete();
        return back()->with('success','the user is deleted successfully');
    }
    
    public function selectedReports(Request $request){
        $request->validate([
          'checked_reports'=>'required'
        ]);
        if(isset($request->type)){
            if($request->type=='unread'){
                foreach($request->checked_reports as $ID){
                    Report::where('id',$ID)->update(['status'=>'unseen']);
                  }
                  return back()->with('success','The selected users have been unblocked');
            }else{
                foreach($request->checked_reports as $ID){
                    Report::where('id',$ID)->update(['status'=>'seen']);
                  }
                  return back()->with('success','The selected users have been blocked');
            }
        }else{
          foreach($request->checked_reports as $ID){
            Report::where('id',$ID)->forceDelete();
          }
        }
        return back()->with('success','The selected users have been deleted');
      }

      public function mailReport($id){
        $report=Report::where('id',$id)->firstOrFail();
        $contest=Contest::where('id',$report->contest_id)->firstOrFail();
        $entry=ContestParticipant::where('id',$report->entry_id)->firstOrFail();
        $entryCreator=$entry->getParticipant;
        $reportCreator=$report->getCreator;
        $arr=['report'=>$report,'contest'=>$contest,'entry'=>$entry,'entryCreator'=>$entryCreator,'reportCreator'=>$reportCreator];

        Notification::route('mail', $entry->getParticipant->email)->notify(new Message($arr));

        return back()->with('success','The report details is sent to the mail of entry creator');
      }

}
